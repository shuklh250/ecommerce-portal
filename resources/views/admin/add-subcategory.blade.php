@extends('admin.includes.main')
@push('title')
    <title>Add Category</title>
@endpush

<style>
    /* Center Align Content */
    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    /* Form Styling */
    .form-label {
        font-weight: bold;
    }

    /* Table Styling */
    #categoryTable th {
        background-color: black;
        color: white;
        font-weight: bold;
    }

    #categoryTable td {
        background-color: #f8f9fa;
        /* Light Grey Color for rows */
    }

    #categoryTable .btn-info {
        margin-right: 5px;
    }

    /* Heading Text Styling */
    h4 {
        font-size: 1.5rem;
        font-weight: 600;
    }
</style>
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="card p-4 mt-4">
                    <div class="row">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Display Error Message -->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div id="message"></div>
                        <div class="col-xl-8 col-md-8 mx-auto">
                            <h4 class="text-center mb-4">Add Subcategory</h4>

                            <form id="subcategoryForm">
                                @csrf
                                <div class="row mt-3">
                                    {{-- CATEGORY SELECT --}}
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Select Category</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- SUBCATEGORY NAME INPUT --}}
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Subcategory Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Subcategory Name" required>
                                    </div>

                                    {{-- SUBMIT BUTTON --}}
                                    <div class="col-lg-9 mx-auto">
                                        <button class="btn btn-primary w-100" type="submit">Add Subcategory</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Categories Table with Hide/Show and Delete Button -->
                        <div class="col-lg-12 mt-5">
                            <h4 class="text-center mb-4">All Categories</h4>

                            <table class="table table-bordered" id="categoryTable">
                                <thead class="bg-dark text-white"> <!-- Table Head Black with White Text -->
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subcategoryBody">
                                    <!-- Dummy Data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#subcategoryForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('subcategory.store')}}",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#subcategoryForm')[0].reset();
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function (key, value) {
                            errorMessage += '<li>' + value[0] + '</li>';
                        });
                        errorMessage += '</ul></div>';
                        $('#message').html(errorMessage);
                    }

                })
            });
        })
    </script>
    <script>
        $(document).ready(function () {
            fetchSubcategories();

            function fetchSubcategories() {
                $.ajax({
                    url: "{{ route('subcategory.fetch') }}",
                    type: 'GET',
                    success: function (response) {
                        let rows = '';
                        $.each(response.subcategories, function (index, subcategory) {
                            let buttonText = subcategory.status == 1 ? 'Hide' : 'Show';
                            rows += `<tr>
                            <td>${index + 1}</td>
                            <td>${subcategory.name}</td>
                            <td>${subcategory.category.category_name}</td>
                            <td>${subcategory.status == 1 ? 'Show' : 'Hide'}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="toggleStatus(${subcategory.id},${subcategory.status})">${buttonText}</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteSubcategory(${subcategory.id})">Delete</button>
                            </td>
                        </tr>`;
                        });

                        $('#subcategoryBody').html(rows);
                    },
                    error: function () {
                        $('#subcategoryBody').html('<tr><td colspan="5">Error loading data.</td></tr>');
                    }
                });
            }
            window.deleteSubcategory = function (id) {
                if (confirm("Are you sure to delete this subcategory?")) {
                    $.ajax({
                        url: "{{ route('delete.subcategory') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function (res) {
                            $('#message').html('<div class="alert alert-success">' + res.message + '</div>');
                            fetchSubcategories();
                        }
                    });
                }
            }

            window.toggleStatus = function (id, currentStatus) {
                let newstatus = currentStatus == 1 ? 0 : 1;
                let actionText = newstatus == 1 ? 'Show' : 'Hide';

                console.log(newstatus);
                console.log(actionText);
                if (confirm('Are you sure you want to ' + actionText + ' this category?')) {
                    $.ajax({
                        url: "{{ route('subcategory.changestatus') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            status: newstatus
                        },
                        success: function (res) {
                            fetchSubcategories();
                        }
                    });
                }
            }
        });

    </script>
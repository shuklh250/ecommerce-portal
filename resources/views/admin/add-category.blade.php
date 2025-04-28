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
                        <div class="col-xl-8 col-md-8 mx-auto"> <!-- Center Align Form -->
                            <h4 class="text-center mb-4">Add Category</h4>

                            <form id="categoryForm">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" name="category" class="form-control" placeholder="Electronics">
                                    </div>

                                    <div class="col-lg-9 mx-auto">
                                        <button class="btn btn-primary w-100" type="submit">Add Category</button>
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
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="categoryBody">
                                    <!-- Dummy Data -->




                                    {{-- <tr>
                                        <td>4</td>
                                        <td>Furniture</td>
                                        <td>Inactive</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">Hide Category</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr> --}}
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
            $('#categoryForm').submit(function (e) {
                e.preventDefault();
                $('#message').html('');
                $('.error').remove();
                $.ajax({
                    url: "{{ route('insert.category') }}",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.status == 'success') {
                            $('#message').html('<p style="color :green;">' + response.message + '</p>');
                            $('#categoryForm')[0].reset();

                        }
                    },
                    error: function (xhr) {
                        if (xhr.status == 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                let inputfield = $('[name="' + key + '"]');
                                inputfield.after('<div class="error" style="color:red">' + value[0] + '</div>')
                            });

                        }
                    }
                });
            });
        });
        // Function to fetch categories
        function fetchcategorys() {
            $.ajax({
                url: "{{ route('fecth.category') }}", // Correct route name here
                type: 'GET',
                success: function (response) {
                    if (response.status == 'success') {
                        let categories = response.categories; // 'Categories' => 'categories'
                        let categoryRows = '';

                        categories.forEach(function (category, index) {
                            let buttonText = category.status == 1 ? 'Hide' : 'Show';
                            let buttonClass = category.status == 1 ? 'btn-info' : 'btn-warning';

                            categoryRows += `<tr>
                        <td>${index + 1}</td>
                        <td>${category.category_name}</td>
                        <td>${category.status == 1 ? 'Show' : 'Hide'}</td>
                        <td>
                            <button class="btn ${buttonClass} btn-sm" onclick="toggleCategoryStatus(${category.id}, ${category.status})">${buttonText}</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteCategory(${category.id})">Delete</button>
                        </td>
                    </tr>`;
                        });
                        $('#categoryBody').html(categoryRows);
                    }
                }
            });
        }

    </script>
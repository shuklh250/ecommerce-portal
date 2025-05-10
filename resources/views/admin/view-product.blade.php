@extends('admin.includes.main')
@push('title')
    <title>View Product</title>
@endpush

@section('content')

                <div id="layoutSidenav_content">
                    <main>
                        <div class="card p-4 mt-4">
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="container-fluid px-4">
                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="d-flex">
                                            <h4>View Products</h4>

                                        </div>
                                        <div class="mt-3">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            <h5>Product</h5>
                                                        </th>
                                                        <th scope="col">
                                                            <h5>Price</h5>
                                                        </th>
                                                        <th scope="col">
                                                            <h5>Discount</h5>
                                                        </th>
                                                        <th scope="col">
                                                            <h5>Category</h5>
                                                        </th>
                                                        <th scope="col">
                                                            <h5>Subcategory</h5>
                                                        </th>

                                                        <th scope="col">
                                                            <h5>Stock</h5>
                                                        </th>
                                                        <th scope="col">
                                                            <h5>Short Description</h5>
                                                        </th>

                                                        <th scope="col">
                                                            <h5>Description</h5>
                                                        </th>

                                                        <th scope="col">
                                                            <h5>Action</h5>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($products as $key => $product)
                                                        <tr>
                                                            <th>
                                                                <div class="d-flex">
                                                                    <div
                                                                        style="width: 100px; height: 100px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px solid #ddd;">
                                                                        @if ($product->image)
                                                                            <img src="{{ asset('uploads/products/' . $product->image) }}"
                                                                                style="width: 100%; height: 100%; object-fit: contain;"
                                                                                class="mb-2">
                                                                        @endif
                                                                    </div>


                                                                    <div class="p-3">
                                                                        <h5>{{$product->name}}</h5>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>₹ {{ $product->price }}</td>
                                                            <td>{{ $product->discount_price ?? '0'}}%</td>
                                                            <td>{{ $product->category->category_name }}</td>
                                                            <td>{{ $product->subcategory->name }}</td>
                                                            <td>{{ $product->stock_quantity }}</td>
                                                            <td>{{ $product->short_description }}</td>
                                                            <td>{{ $product->description }}</td>
                                                            <td>

                                                                <a href="javascript:void(0);" class="btn {{$product->status == 1 ? 'btn-success ' : 'btn-warning ' }}btn-sm toggle-status-btn" data-id="{{ $product->id }}"
                                                                    data-status="{{ $product->status }}">{{$product->status == 1 ? 'Show' : 'Hide' }}
                                                                </a>
                                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $product->id }}">Update
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>

                                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete-product"
                                                                    data-id="{{ $product->id }}">Delete <i
                                                                        class="fa-solid fa-trash"></i></a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    @foreach ($products as $product)
                        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ url('admin/update-product/' . $product->id) }}" method="POST"
                                    enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Update Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Fields -->
                                            <div class="mb-3">
                                                <label>Product Image</label><br>
                                                @if ($product->image)
                                                    <img src="{{ asset('uploads/products/' . $product->image) }}" width="100" class="mb-2">
                                                @endif
                                                <input type="file" name="image" class="form-control">
                                                @if(old('product_id') == $product->id)
                                                    @error('image')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>


                                            <div class="mb-3">
                                                <label>Product Name</label>
                                                <input type="text" name="name"
                                                    value="{{ old('product_id') == $product->id ? old('name') : $product->name }}"
                                                    class="form-control">
                                                @if(old('product_id') == $product->id)
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <div class="mb-3">
                                                <label>Category</label>
                                                <select name="category_id" id="category_id_{{ $product->id }}"
                                                    class="form-control category-dropdown" data-product-id="{{ $product->id }}">
                                                    <option value="">-- Select Category --</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @if(old('product_id') == $product->id)
                                                    @error('category_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label>Subcategory</label>
                                                <select name="subcategory_id" id="subcategory_id_{{ $product->id }}" class="form-control">
                                                    <option value="">-- Select Subcategory --</option>
                                                    {{-- Subcategories will be loaded via AJAX --}}
                                                </select>
                                                @if(old('product_id') == $product->id)
                                                    @error('subcategory_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label>Price</label>
                                                <input type="number" name="price" value="{{ $product->price }}" class="form-control">

                                                @if(old('product_id') == $product->id)
                                                    @error('price')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>


                                            <div class="mb-3">
                                                <label>Discount (%)</label>
                                                <input type="number" name="discount_price" value="{{ $product->discount_price }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Stock</label>
                                                <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Short Description</label>
                                                <textarea name="short_description"
                                                    class="form-control">{{ $product->short_description }}</textarea>
                                                @if(old('product_id') == $product->id)
                                                    @error('short_description')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if ($errors->any() && old('product_id'))
                        <script>
                            $(document).ready(function () {
                                $('#editModal{{ old('product_id') }}').modal('show');
                            });
                        </script>
                    @endif
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        $(document).ready(function () {

                            $(document).on('change', '.category-dropdown', function () {
                                let categoryId = $(this).val();
                                let productId = $(this).data('product-id');
                                loadSubcategories(categoryId, productId);
                            });

                            @foreach ($products as $product)
                                $('#editModal{{ $product->id }}').on('shown.bs.modal', function () {
                                    let categoryId = $('#category_id_{{ $product->id }}').val();
                                    loadSubcategories(categoryId, {{ $product->id }}, {{ $product->subcategory_id ?? 'null' }});
                                });
                            @endforeach


                            function loadSubcategories(categoryId, productId, selectedSubcategoryId = null) {
                                if (categoryId) {
                                    $.ajax({
                                        url: '{{ route('get.subcategory') }}',
                                        type: 'GET',
                                        data: {
                                            id: categoryId
                                        },
                                        dataType: 'json',

                                        success: function (data) {
                                            let subSelect = $('#subcategory_id_' + productId);
                                            subSelect.empty();
                                            subSelect.append('<option value="">-- Select Subcategory --</option>');
                                            $.each(data, function (key, sub) {
                                                let selected = (selectedSubcategoryId && sub.id == selectedSubcategoryId) ? 'selected' : '';
                                                subSelect.append('<option value="' + sub.id + '" ' + selected + '>' + sub.name + '</option>');
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    </script>

                    {{-- flash message --}}
                    <script>
                        setTimeout(() => {
                            $('.alert-success').fadeOut('slow');
                        }, 2000); // 4 seconds
                    </script>

                    {{-- deleet product --}}

                    <script>
                        $(document).on('click', '.delete-product', function (e) {
                            e.preventDefault();

                            let productId = $(this).data('id');

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This product will be deleted permanently!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Only delete if confirmed
                                    $.ajax({
                                        url: "{{ route('admin.product.delete') }}",
                                        type: 'DELETE',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            id: productId
                                        },
                                        success: function (response) {
                                            Swal.fire(
                                                'Deleted!',
                                                response.success,
                                                'success'
                                            ).then(() => {
                                                location.reload();
                                            });
                                        },
                                        error: function () {
                                            Swal.fire(
                                                'Error!',
                                                'Something went wrong. Try again.',
                                                'error'
                                            );
                                        }
                                    });
                                }
                            });
                        });

                    </script>
            {{-- hide and show product --}}

        <script>
            $(document).on('click', '.toggle-status-btn', function (e) {
                e.preventDefault();

                let button = $(this);
                let productId = button.data('id');
                let currentStatus = button.data('status');
                let newStatus = currentStatus == 1 ? 0 : 1;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to " + (newStatus == 1 ? "show" : "hide") + " this product!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.product.toggleStatus') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: productId,
                                status: newStatus
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire('Updated!', response.success, 'success').then(() => {
                                        location.reload(); // ✅ Page reload after success
                                    });
                                } else {
                                    Swal.fire('Error!', 'Status not updated.', 'error');
                                }
                            },
                            error: function () {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        </script>



@endsection
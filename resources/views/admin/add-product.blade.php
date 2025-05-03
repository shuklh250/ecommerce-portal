@extends('admin.includes.main')
@push('title')
    <title>Add Product</title>
@endpush

@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="card p-4 mt-4">
                    <form id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-8 col-md-8">
                                <h4>Add Product</h4>


                                <div class="row mt-3">
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Watch">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control" placeholder="₹ 1499.00">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Descount Price</label>
                                        <input type="text" name="Descountprice" class="form-control"
                                            placeholder="₹ 1499.00">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" name="category_id" aria-label="Default select example"
                                            id="categoryDropdown">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category_name}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">SubCategory</label>
                                        <select class="form-select" name="subcategory_id" id="subcategoryDropdown">
                                            <option selected disabled>Select SubCategory</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Stock Quantity</label>
                                        <input type="text" class="form-control" name="stock" placeholder="25 pcs">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Short Description</label>
                                        <input type="text" class="form-control" name="shortdescription"
                                            placeholder="25 pcs">
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Product Description</label>
                                        <textarea class="form-control" name="description"
                                            placeholder="Fill product description here" id="floatingTextarea"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary ">Add Product</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mt-5">
                                <div class="text-center">
                                    <img src="{{asset('dashboard/assets/img/products/2.jpg')}}" style="width:155px;"
                                        class="rounded-circle">
                                    <div class="mt-3">
                                        <label for="image" class="form-label btn btn-dark">Choose Image</label>
                                        <input type="file" class="form-control d-none" name="image" id="image">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>

                </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

            $('#productForm').on('submit', function (e) {

                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('add.insertproduct') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({

                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        })
                        $('#productForm')[0].reset();

                    },
                    error: function (xhr) {

                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            Swal.fire({

                                icon: 'error',
                                title: 'Error',
                                text: value[0]
                            });

                        });
                    }

                });
            });
        </script>



        <script>
            $(document).ready(function () {

                $('#categoryDropdown').on('change', function () {
                    let categoryId = $(this).val();

                    if (categoryId) {

                        $.ajax({
                            url: '{{ route('get.subcategory') }}',
                            type: 'GET',
                            data: {
                                id: categoryId
                            },
                            dataType: 'json',
                            success: function (data) {
                                $('#subcategoryDropdown').empty();
                                $('#subcategoryDropdown').append('<option disabled selected >Select Subcategory</option>');

                                $.each(data, function (key, value) {

                                    $('#subcategoryDropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                                })
                            }
                        })
                    } else {
                        $('#subcategoryDropdown').empty();
                    }

                });
            })
        </script>

@endsection
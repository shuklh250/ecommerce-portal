@extends('vendor.includes.main')
@push('title')
<title>Add Product</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <div class="card p-4 mt-4">
                            <div class="row">
                            
                            <div class="col-xl-8 col-md-8">
                                    <h4>Add Product</h4>

                                    
                                        <div class="row mt-3">
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control" placeholder="Watch">
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="text" class="form-control" placeholder="₹ 1499.00">
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Category</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>Select Category</option>
                                                    <option value="1">Electronics</option>
                                                    <option value="2">Grocery</option>
                                                    <option value="3">Furniture</option>
                                                </select>
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Stock Quantity</label>
                                            <input type="text" class="form-control" placeholder="25 pcs">
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Product Description</label>
                                            <textarea class="form-control" placeholder="Fill product description here" id="floatingTextarea"></textarea>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn-primary ">Add Product</button>
                                        </div>
                                        </div>
                                    
                            </div>

                            <div class="col-xl-4 col-md-4 mt-5">
                                <div class="text-center">
                                    <img src="{{asset('dashboard/assets/img/products/2.jpg')}}" style="width:155px;" class="rounded-circle">
                                    <div class="mt-3">
                                        <label for="image" class="form-label btn btn-dark">Choose Image</label>
                                        <input type="file" class="form-control d-none" id="image">
                                    </div>
                                </div>

                            </div>
                            </div>

                            
                        </div>
                </main>


                

@endsection
                
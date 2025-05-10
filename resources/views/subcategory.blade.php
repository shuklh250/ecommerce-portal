@extends('layouts.main')

@push('title')
    <title>Sub-Category</title>
@endpush

@section('content')
    <div class="container-fluid bg-light p-5">
        <h1 class="text-center text-secondary"><i class="fa-solid fa-list"></i> Sub-Category</h1>
    </div>

    <!-- Products -->
    <style>
        <styl>.product-img {
            transition: transform 0.3s ease;
        }

        .card:hover .product-img {
            transform: scale(1.05);
        }

        .toggle-like-btn {
            position: relative;
            z-index: 10;
        }
    </style>

    <style>
        .fixed-img-height {
            height: 200px;
            /* Ye aap apni zarurat ke mutabiq adjust kar sakte ho */
            object-fit: cover;
        }
    </style>

    <section class="my-5">
        <div class="container">

            <div class="row theme-product">

                @foreach ($products as $product)
                    <div class="col-lg-3 mb-4">
                        <div class="card position-relative h-100 shadow-sm">

                            <!-- Like Button -->
                            <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                                <a href="javascript:void(0);" class="toggle-like-btn" data-id="{{ $product->id }}"
                                    data-liked="{{ $product->isLikedByUser() ? '1' : '0' }}">
                                    @if($product->isLikedByUser())
                                        <i class="fas fa-heart text-danger"></i>
                                    @else
                                        <i class="far fa-heart text-muted"></i>
                                    @endif
                                </a>
                            </div>

                            <!-- Product Image -->
                            <a href="{{ url('category/electronics/tv/detail') }}" class="overflow-hidden d-block">
                                <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top product-img"
                                    alt="{{ $product->name }}" style="height: 250px;">
                            </a>

                            <div class="card-body text-center">
                                <!-- Product Name -->
                                <h6 class="card-title">
                                    <a href="{{ url('category/electronics/tv/detail') }}"
                                        class="text-dark text-decoration-none">
                                        {{ $product->name }}
                                    </a>
                                </h6>

                                <!-- Rating -->
                                <div class="mb-2">
                                    <span class="text-warning">★ ★ ★ ★ ☆</span>
                                    <small class="text-muted">(120)</small>
                                </div>

                                <!-- Price -->
                                <h5 class="text-success fw-bold mb-1">₹{{ $product->price }}</h5>
                                <span class="text-muted text-decoration-line-through">₹699.00</span>

                                <!-- Add to Cart -->
                                <button class="btn btn-primary btn-sm mt-3 w-100">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Samsung
                                    LED TV</a></h6>
                            <h5 class="card-title text-center">₹ 7999.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Sony LED
                                    TV</a></h6>
                            <h5 class="card-title text-center">₹ 15999.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Onida LED
                                    TV</a></h6>
                            <h5 class="card-title text-center">₹ 12999.00</h5>

                        </div>
                    </div>
                </div>


                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">MI LED
                                    TV</a></h6>
                            <h5 class="card-title text-center">₹ 5999.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Samsung
                                    LED TV</a></h6>
                            <h5 class="card-title text-center">₹ 7999.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Sony LED
                                    TV</a></h6>
                            <h5 class="card-title text-center">₹ 15999.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Onida LED
                                    TV</a></h6>
                            <h5 class="card-title text-center">₹ 12999.00</h5>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        toastr.options = {
            "positionClass": "toast-bottom-right",
            "timeOut": "2000",
            "closeButton": true,
            "progressBar": true
        };

        $(document).on('click', '.toggle-like-btn', function () {
            let $this = $(this);
            let productId = $this.data('id');
            let isLiked = $this.data('liked');
            let icon = $this.find('i');

            $.ajax({
                url: "{{ route('product.toggle-like') }}",
                method: "POST",
                data: {
                    product_id: productId,
                    status: isLiked == 1 ? 0 : 1
                },
                success: function (res) {
                    if (res.success) {
                        if (isLiked == 1) {
                            icon.removeClass('fas text-danger').addClass('far text-muted');
                            $this.data('liked', 0);
                            toastr.error('Removed from Liked');
                        } else {
                            icon.removeClass('far text-muted').addClass('fas text-danger');
                            $this.data('liked', 1);
                            toastr.success('Added to Liked');
                        }
                    }
                }
            });
        });

    });
</script>
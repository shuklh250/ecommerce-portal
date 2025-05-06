@extends('layouts.main')
@push('title')
    <title>Home Page</title>
@endpush


@section('content')

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('assets/images/slider1.png')}}" class="d-block w-100" alt="Slider 1">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/slider2.png')}}" class="d-block w-100" alt="Slider 2">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/slider3.png')}}" class="d-block w-100" alt="Slider 3">
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Product Section -->

    <section class="my-5">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Top Deals</h2>
                <a href="{{ url('category/electronics') }}"
                    class="btn btn-sm theme-green-btn text-light rounded-pill px-3 py-2">View All</a>
            </div>


            <div class="d-flex justify-content-end mb-2">
                <button class="btn btn-outline-secondary me-2" onclick="scrollTopDealsLeft()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-outline-secondary" onclick="scrollTopDealsRight()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>


            <div class="scroll-container d-flex overflow-auto" id="topDealsContainer"
                style="scroll-behavior: smooth; gap: 1rem;">
                @foreach ($TopDeals as $TopDeal)
                    <div class="card product-card h-100 position-relative" style="min-width: 250px; flex: 0 0 auto;">


                        <div class="position-absolute top-0 end-0 m-2">
                            <a href="javascript:void(0);" class="toggle-like-btn" data-id="{{ $TopDeal->id }}"
                                data-liked="{{ $TopDeal->isLikedByUser() ? '1' : '0' }}">
                                @if($TopDeal->isLikedByUser())
                                    <i class="fas fa-heart text-danger"></i>
                                @else
                                    <i class="far fa-heart text-muted"></i>
                                @endif
                            </a>

                        </div>


                        <!-- Product image -->
                        <a href="#"><img src="{{ asset('uploads/products/' . $TopDeal->image) }}"
                                class="card-img-top product-image" alt="{{ $TopDeal->name }}"></a>

                        <div class="card-body text-center">
                            <h6 class="card-title">
                                <a href="#" class="text-dark text-decoration-none">{{ $TopDeal->name }}</a>
                            </h6>
                            <div class="mb-2">
                                <span class="text-warning">★ ★ ★ ★ ☆</span>
                                <small class="text-muted">(120)</small>
                            </div>
                            <div>
                                <span class="fw-bold text-success">₹{{ $TopDeal->price }}</span>
                                <span class="price-original text-muted text-decoration-line-through">₹699.00</span>
                            </div>
                            <button class="btn btn-primary btn-sm mt-2 w-100">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>



    <!-- Best of Electronics -->

    <section class="my-5">
        <div class="container">

            <div class="d-flex">
                <div class="flex-grow-1">
                    <h2>Best of Electronics</h2>
                </div>
                <div><a href="{{url('category/electronics')}}"
                        class="btn btn-sm theme-green-btn text-light rounded-pill px-3 py-2">View All</a></div>

            </div>
            <div class="row theme-product">
                <div class="col-lg-3">
                    <div class="card ">

                        <a href="#"><img src="{{asset('assets/images/products/5.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center "><a href="#"
                                    class="text-dark text-decoration-none">Camera</a></h6>
                            <h5 class="card-title text-center">₹ 2499.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/2.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Apple
                                    Watch</a></h6>
                            <h5 class="card-title text-center">₹ 1499.00</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">LED TV</a>
                            </h6>
                            <h5 class="card-title text-center">₹ 5999.00</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/8.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Washing
                                    Machine</a></h6>
                            <h5 class="card-title text-center">₹ 13999.00</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Categories -->

    <section class="my-5">
        <div class="container">

            <div class="d-flex">
                <div class="flex-grow-1">
                    <h2>Popular Categories</h2>
                </div>
                <div><a href="{{url('category/electronics')}}"
                        class="btn btn-sm theme-green-btn text-light rounded-pill px-3 py-2">View All</a></div>

            </div>
            <div class="row theme-product">
                <div class="col-lg-3">
                    <div class="card ">

                        <a href="#"><img src="{{asset('assets/images/products/9.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center "><a href="#" class="text-dark text-decoration-none">Hand
                                    Bag</a></h6>
                            <h5 class="card-title text-center">₹ 799.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/2.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Apple
                                    Watch</a></h6>
                            <h5 class="card-title text-center">₹ 1499.00</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/10.jpg')}}" class="card-img-top"
                                alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Laptop
                                    Bag</a></h6>
                            <h5 class="card-title text-center">₹ 599.00</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/8.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Washing
                                    Machine</a></h6>
                            <h5 class="card-title text-center">₹ 13999.00</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Recently Viewed -->

    <section class="my-5">
        <div class="container">

            <div class="d-flex">
                <div class="flex-grow-1">
                    <h2>Recently Viewed</h2>
                </div>
                <div><a href="{{url('category/electronics')}}"
                        class="btn btn-sm theme-orange-btn text-light rounded-pill px-3 py-2">View All</a></div>

            </div>
            <div class="row theme-product">
                <div class="col-lg-3">
                    <div class="card ">

                        <a href="#"><img src="{{asset('assets/images/products/5.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center "><a href="#"
                                    class="text-dark text-decoration-none">Camera</a></h6>
                            <h5 class="card-title text-center">₹ 2499.00</h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/6.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Women
                                    Shoes</a></h6>
                            <h5 class="card-title text-center">₹ 1099.00</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/7.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">LED TV</a>
                            </h6>
                            <h5 class="card-title text-center">₹ 5999.00</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">

                        <a href="#"><img src="{{asset('assets/images/products/8.jpg')}}" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h6 class="card-title text-center"><a href="#" class="text-dark text-decoration-none">Washing
                                    Machine</a></h6>
                            <h5 class="card-title text-center">₹ 13999.00</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        // STEP 1: Toastr Configuration - sabse upar lagao
        toastr.options = {
            "positionClass": "toast-bottom-right",
            "timeOut": "500",
            "closeButton": true,
            "progressBar": true
        };

        // STEP 2: AJAX Call for Like/Dislike
        $(document).on('click', '.toggle-like-btn', function () {
            let $this = $(this);
            let productId = $this.data('id');
            let isLiked = $this.data('liked');
            let icon = $this.find('i');

            $.ajax({
                url: "{{ route('product.toggle-like') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
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
    </script>






    <script>
        const container = document.getElementById('topDealsContainer');

        function scrollTopDealsLeft() {
            container.scrollBy({ left: -300, behavior: 'smooth' });
        }

        function scrollTopDealsRight() {
            container.scrollBy({ left: 300, behavior: 'smooth' });
        }
    </script

@endsection
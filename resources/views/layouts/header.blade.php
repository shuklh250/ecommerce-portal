<!doctype html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @stack('title')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery (Toastr se pehle hona chahiye) -->

  <!-- Toastr CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    .product-card {
      transition: box-shadow 0.3s ease-in-out;
    }

    .product-card:hover {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .toast-success {
      background-color: #28a745 !important;
      color: #fff !important;
      font-weight: bold;
    }

    .toast-error {
      background-color: #dc3545 !important;
      color: white !important;
    }


    .product-image {
      height: 200px;
      object-fit: contain;
      padding: 10px;
    }

    .price-original {
      text-decoration: line-through;
      color: #888;
      font-size: 14px;
    }

    .scroll-container::-webkit-scrollbar {
      display: none;
    }

    .scroll-container {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .theme-purple-btn {
      background-color: #6f42c1;
      color: white;
    }

    .theme-purple-btn:hover {
      background-color: #59359e;
      /* Slightly darker on hover */
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg theme-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('assets/images/logo/logo.png')}}"
          style="width:250px;"></a>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
      <div>
        <form class="d-flex" role="search">
          <div class="input-group">
            <input class="form-control form-control-sm" style="width:350px;" type="search"
              placeholder="Search for Products" aria-label="Search">
            <button class="btn btn-light text-secondary btn-sm" type="submit"><i
                class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>
      <div>

        <a href="#" class="text-decoration-none text-light">Become a Seller</a>
        <a href="{{url('cart-list/product')}}"
          class="btn theme-green-btn btn-sm text-light ms-1 rounded-pill px-3 py-2"><i
            class="fa-solid fa-cart-shopping"></i> Cart</a>

        @if(!session()->has('user_email'))

      <a href="{{url('login')}}" class="btn theme-orange-btn btn-sm text-light ms-1 rounded-pill px-3 py-2"><i
        class="fa-solid fa-user"></i> Login</a>
    @else
      <a href="{{ route('profile') }}" class="btn theme-purple-btn btn-sm ms-1 rounded-pill px-3 py-2">
        <i class="fa-solid fa-user-circle"></i> Profile
      </a>
    @endif

      </div>
    </div>
  </nav>
  <!-- Category Nav -->

  <nav class="navbar navbar-expand-lg  shadow p-3 bg-body-tertiary rounded">
    <div class="container">

      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="nav">
          @foreach ($categories as $category)
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="{{ url('category/' . $category->category_name) }}"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $category->category_name }}
          </a>

          @php
          // Filter only active subcategories (status = 1)
          $activeSubcategories = $category->subcategories->where('status', 1);
        @endphp

          @if ($activeSubcategories->count())
          <ul class="dropdown-menu">
          @foreach ($activeSubcategories as $subcategory)
          <li>
          <a class="dropdown-item"
          href="{{ url('category/' . $category->category_name . '/' . $subcategory->name) }}">
          {{ $subcategory->name }}
          </a>
          </li>
        @endforeach
          </ul>
        @endif
          </li>
      @endforeach
        </ul>

      </div>
    </div>
  </nav>
@extends('admin.layouts.main')
@push('title')
    <title>Admin Login</title>
@endpush

@section('content') 
    <section>
        <div class="container position-absolute top-50 start-50 translate-middle">

            <div class="row">
                <div class="col-lg-10">
                    <!-- Display Flash Message -->
                    @if (session('success'))
                        <div class="alert  alert-success" id="flash-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('Error'))
                    <div class="alert alert-danger" id="flash-message">
                        {{ session('Error') }}
                    </div>
                @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <img src="{{asset('dashboard/assets/img/admin.jpg')}}" class="rounded-3 img-fluid">
                            </div>
                        </div>

                        <div class="col-lg-6 mt-5 p-5">
                            <div class="row">

                                <div class="col-lg-12 mb-3">
                                    <h2>Login Page</h2>

                                </div>

                            </div>
                            <div>

                                <form action="{{ route('userlogin') }}"  method="POST">                                    
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" placeholder="John Doe">
                                        </div>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>

                                        @enderror

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="******">
                                        </div>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror


                                    </div>

                                    <button type="submit" class="btn btn-primary text-light form-control form-control-lg">Login</button>
                                    <div class="text-center p-2">New user? <a href="{{route('signup')}}"
                                            class="text-decoration-none">Signup</a></div>
                                    <div class="text-center p-2">forgot password? <a href="{{url('admin/login')}}"
                                            class="text-decoration-none">click</a></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
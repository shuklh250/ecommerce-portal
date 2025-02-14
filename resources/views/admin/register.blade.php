@extends('admin.layouts.main')
@push('title')
    <title>Admin Register</title>
@endpush

@section('content')
    <section>
        <div class="container position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <img src="{{asset('dashboard/assets/img/vendor.jpg')}}" class="rounded-3 img-fluid">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                                placeholder="John Doe">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        {{--
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" placeholder="+91 ">
                                        </div> --}}

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                                placeholder="john@gmail.com">

                                            @error('email')

                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="******">

                                            @error('password')
                                                <div class="text-danger"> {{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password"  class="form-control" name="password_confirmation" >
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        {{--
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" placeholder="Enter your address"
                                                id="floatingTextarea2" style="height: 100px"></textarea>
                                        </div> --}}
                                    </div>

                                    {{-- <a type="submit"
                                        class="btn btn-primary text-light form-control form-control-lg">Signup<s /a> --}}
                                            <button type="submit"
                                                class="btn btn-primary text-light form-control form-control-lg">Register</button>

                                            <div class="text-center p-2">Have an account? <a href="{{url('admin/login')}}"
                                                    class="text-decoration-none">Login</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
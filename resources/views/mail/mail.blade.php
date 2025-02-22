@extends('admin.layouts.main')
@push('title')
    <title>Admin Register</title>
@endpush

@section('content')
    <section>
        <div class="container position-absolute top-50 start-50 translate-middle">
            <div class="row">
                @if (session('success'))
                <div class="alert  alert-success" id="flash-message">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" id="flash-message">
                {{ session('error') }}
            </div>
            @endif
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <img src="{{asset('dashboard/assets/img/vendor.jpg')}}" class="rounded-3 img-fluid">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <form method="POST" action="{{ route('contact') }}" enctype="multipart/form-data">
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
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                            @error('name')

                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                               >

                                            @error('email')

                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Subject</label>
                                            <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">

                                            @error('subject')

                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">Message</label>
                                            <input type="text" class="form-control" name="message" value="{{ old('message') }}"
                                               >

                                            @error('message')

                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label">file</label>
                                            <input type="file" class="form-control" name="file" value=""
                                                placeholder="john@gmail.com">

                                            
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
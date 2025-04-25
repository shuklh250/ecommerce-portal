@extends('layouts.main')

@push('title')
    <title>Login</title>
@endpush

@section('content')
    <div class="container-fluid bg-light p-5">
        <h1 class="text-center text-secondary"><i class="fa-solid fa-user"></i> User Login</h1>
    </div>

    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <img src="{{asset('assets/images/register.jpg')}}" class="rounded-3 img-fluid">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <form action="" id="login-form">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-text mb-2">Please enter your email</div>
                                        <input type="email" class="form-control form-control-lg" name="email"
                                            placeholder="e-mail">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-text mb-2">Please enter your password</div>
                                        <input type="text" class="form-control form-control-lg" name="password"
                                            placeholder="password">
                                    </div>
                                    <button type="submit"
                                        class="btn theme-orange-btn text-light form-control form-control-lg">
                                        Login
                                    </button>
                                    <div class="text-center p-5 my-5">Don't have an account? <a href="{{url('register')}}"
                                            class="text-decoration-none">Signup</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#login-form').on('submit', function (e) {
                e.preventDefault();
                let formdata = $(this).serialize();
                $.ajax({
                    url: '{{route("user.verifylogin")  }}',
                    method: 'POST',
                    data: formdata,

                    success: function (response) {
                        alert("Login successfully");
                    }, error: function (xhr) {
                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;
                            console.log(errors);
                        } else {
                            alert('Something went wrong');
                        }
                    },
                });

            });
        });
    </script>

@endsection
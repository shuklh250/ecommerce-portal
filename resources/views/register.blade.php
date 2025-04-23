@extends('layouts.main')

@push('title')
    <title>Register</title>
@endpush

@section('content')
    <div class="container-fluid bg-light p-5">
        <h1 class="text-center text-secondary"><i class="fa-solid fa-user"></i> User Register</h1>
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
                                <form method="POST" action="" id="register">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-text mb-2">Please enter your E-mail</div>
                                        <input type="email" name="email" class="form-control form-control-lg"
                                            placeholder="E-mail" id="email">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-text mb-2">Password</div>
                                        <input type="text" name="password" class="form-control form-control-lg"
                                            placeholder="password" id="password">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-text mb-2">Please confirm your password</div>
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-lg" placeholder="Confirm Password">
                                    </div>


                                    <button type="submit"
                                        class="btn theme-orange-btn text-light form-control form-control-lg">
                                        Register
                                    </button>
                                    <div class="text-center p-5 my-5">Have an account? <a href="{{url('login')}}"
                                            class="text-decoration-none">Login</a></div>
                                    <div id="loader" style="display:none;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#register').on('submit', function (e) {

                e.preventDefault();
                $('#loader').show();
                let formdata = $(this).serialize();

                $.ajax({
                    url: '{{route("user.register")  }}',
                    type: 'POST',
                    data: formdata,

                    complete: function (response) {
                        $('#loader').hide();
                    },

                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Registered!',
                            text: 'OTP send on your E-mail',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        $('#register')[0].reset();

                        setTimeout(() => {
                            console.log(response);
                            window.location.href = response.redirect_url;
                        }, 3000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let allErrors = xhr.responseJSON.errors
                            let shownErrors = '';
                            $('#register [name]').each(function () {
                                let field = $(this).attr('name');
                                if (allErrors[field]) {
                                    shownErrors += allErrors[field].join('<br>') + '<br>';
                                }
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation required',
                                html: shownErrors || 'Please fill all required fields properly'
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection
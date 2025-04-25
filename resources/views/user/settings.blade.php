@extends('user.layouts.main')
@push('title')
    <title>Settings</title>
@endpush

@section('content')

    <div id="layoutSidenav_content">
        <main>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session("success") }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ session("error") }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                </script>
            @endif


            <div class="container p-4">
                <div class="card p-4">
                    <div class="row">

                        <div class="col-xl-8 col-md-8">
                            <h4>Account Setting</h4>

                            <form id="account-setting">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ $user->name ?? '' }}" class="form-control"
                                            placeholder="John">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}"
                                            placeholder="john@gmail.com" disabled>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" name="phone" class="form-control" value="{{ $user->phone ?? '' }}"
                                            placeholder="+91 ">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-primary " id="accoiunt-setting">Save Changes</button>
                                    </div>
                                </div>

                        </div>

                        <div class="col-xl-4 col-md-4 mt-5">
                            <div class="text-center">
                                <img src="{{asset('dashboard/assets/img/user.png')}}" style="width:155px;">
                                <div class="mt-3">
                                    <label for="image" class="form-label btn btn-dark">Choose Image</label>
                                    <input type="file" class="form-control d-none" id="image">
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                </form>
                <div class="card p-4 mt-4">
                    <div class="row">

                        <div class="col-xl-12 col-md-12">
                            <h4>Billing Address</h4>


                            <div class="row mt-3">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select your Country</option>
                                        <option value="1">India</option>
                                        <option value="2">USA</option>
                                        <option value="3">Nepal</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" placeholder="John">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Doe">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="john@gmail.com">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="+91 ">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Pin Code</label>
                                    <input type="text" class="form-control" placeholder="141001">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Landmark</label>
                                    <input type="text" class="form-control" placeholder="India Gate">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select your City</option>
                                        <option value="1">Ludhiana</option>
                                        <option value="2">Moga</option>
                                        <option value="3">Jalandhar</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">State</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select your State</option>
                                        <option value="1">Punjab</option>
                                        <option value="2">Bihar</option>
                                        <option value="3">UP</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-primary ">Save Changes</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#account-setting').on('submit', function (e) {
                    e.preventDefault();
                    let formdata = $(this).serialize();
                    $.ajax({
                        url: '{{route("update.profile") }}',
                        method: 'POST',
                        data: formdata,
                        success: function (response) {
                            alert("profile updated successfully");
                        },
                        error: function (xhr) {
                            if (xhr.status == 422) {
                                let errors = xhr.responseJSON.errors;
                                if (errors.phone) {
                                    $('input[name="phone"]').after('<div class="text-danger">' + errors.phone[0] + '</div>');
                                }
                                if (errors.name) {
                                    $('input[name="name"]').after('<div class="text-danger">' + errors.name[0] + '</div>');
                                }
                            } else {
                                alert("Something went wrong");
                            }
                        }
                    });
                });
            });
        </script>
@endsection





$('.pay-and-submit-btn').on('click', function () {
hideModal();
$('#bookingForm').off('submit').submit(); // Allow form submission
});
@extends('admin.includes.main')
@push('title')
    <title>Users</title>
@endpush

@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="card p-4 mt-4">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="d-flex">
                                <h4>Users</h4>

                            </div>
                            <div class="mt-3">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>

                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Phone No.</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $user->name }}</td>
                                                <td>+91 7896541230</td>
                                                <td>{{ $user->email }}</td>
                                                <td>Reference site about Lorem Ipsum, giving information on its</td>
                                                <td>
                                                    <span
                                                        class="{{ $user->status == 1 ? 'badge text-bg-success' : 'badge text-bg-danger'}} ">{{ ($user->status == 1) ? "Unblock" : "Block" }}</span>
                                                </td>
                                                <td>
                                                    <button
                                                        class=" {{ $user->status == 1 ? 'btn btn-danger btn-sm ' : 'btn btn-success btn-sm'}}"
                                                        onclick="toggleStatus({{$user->id}},{{ $user->status }})">{{ $user->status == 1 ? "Block" : "Unblok" }}

                                                    </button>

                                                    <a href="#" class="btn btn-success btn-sm"><i
                                                            class="fa-solid fa-shield"></i></a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>


@endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function toggleStatus(id, status) {
            const newstatus = status == 1 ? 0 : 1;

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change this user's status?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('users.status') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            status: newstatus
                        },
                        success: function (res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated',
                                text: 'User status has been changed!',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            // Page reload or DOM update
                            setTimeout(() => location.reload(), 1500);
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    });
                }
            });
        }
    </script>
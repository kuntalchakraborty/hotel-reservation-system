@extends('back.layouts.adminLayout')
@section('adminContent')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Users List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Users List</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Users List</h5>
                                <!-- Button to open Add User modal -->
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add
                                    New User</button>
                            </div>
                            <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th width="102px">Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <!-- Edit and Delete buttons -->
                                                <button class="btn btn-primary btn-sm editUser"
                                                    data-id="{{ $user->id }}">Edit</button>
                                                @if ($user->role === 'user')
                                                    <button class="btn btn-danger btn-sm deleteUser"
                                                        data-id="{{ $user->id }}">Delete</button>
                                                @endif
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
        </section>
    </main>
    <!-- Modal for Editing User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('stylesheet')
@endpush
@push('scripts')
    <script>
        $(document).on('submit', '#addUserForm', function (e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const addUrl = "{{ url('admin/users') }}";
            $.ajax({
                url: addUrl,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Added!',
                        response.message,
                        'success'
                    );
                    $('#addUserModal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON.message || 'Failed to add user.';
                    Swal.fire(
                        'Error!',
                        errorMessage,
                        'error'
                    );
                }
            });
        });
        $(document).on('click', '.editUser', function() {
            const userId = $(this).data('id');
            const editUrl = "{{ url('admin/users') }}/" + userId + "/edit";
            $.ajax({
                url: editUrl,
                type: 'GET',
                success: function(response) {
                    $('#editUserModal #name').val(response.name);
                    $('#editUserModal #email').val(response.email);
                    $('#editUserModal #role').val(response.role);
                    $('#editUserModal').modal('show');
                    $('#editUserModal').data('user-id', userId);
                },
                error: function() {
                    alert('Failed to fetch user data.');
                }
            });
        });


        $(document).on('click', '.deleteUser', function() {
            const userId = $(this).data('id');
            const deletUrl = "{{ url('admin/users') }}/" + userId;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deletUrl,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            location.reload();
                        },
                        error: function() {
                            Swal.fire(
                                'Failed!',
                                'Failed to delete user.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        $(document).on('submit', '#editUserForm', function(e) {
            e.preventDefault();

            const userId = $('#editUserModal').data('user-id');
            const formData = $(this).serialize();
            const updateUrl = "{{ url('admin/users') }}/" + userId;
            $.ajax({
                url: updateUrl,
                type: 'PUT',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        response.message,
                        'success'
                    );
                    $('#editUserModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON.message || 'Failed to update user.';
                    Swal.fire(
                        'Error!',
                        errorMessage,
                        'error'
                    );
                }
            });
        });
    </script>
@endpush

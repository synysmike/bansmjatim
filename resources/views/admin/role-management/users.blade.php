@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="{{ asset('admin_theme/library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_theme/library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('admin-container')
    <section>
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.role-management.index') }}">Role Management</a></div>
                <div class="breadcrumb-item">{{ $tittle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Users List</h4>
                            <div class="card-header-action">
                                <button class="btn btn-primary" onclick="showUserModal()">
                                    <i class="fas fa-plus"></i> Add New User
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Kab/Kota</th>
                                            <th>Jabatan</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="userForm">
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="id">
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Password <span class="text-danger" id="passwordRequired">*</span></label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="form-text text-muted" id="passwordHint">Leave blank to keep current password</small>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Role <span class="text-danger">*</span></label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Kab/Kota</label>
                            <input type="text" class="form-control" id="kab_kota" name="kab_kota">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js-custom')
    <script src="{{ asset('admin_theme/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        let table;
        let isEditMode = false;

        $(document).ready(function() {
            table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.role-management.users') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'username', name: 'username' },
                    { data: 'name', name: 'name' },
                    { data: 'kab_kota', name: 'kab_kota' },
                    { data: 'jabatan', name: 'jabatan' },
                    { data: 'roles', name: 'roles', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                saveUser();
            });
        });

        function showUserModal(userId = null) {
            isEditMode = userId !== null;
            $('#userModalLabel').text(isEditMode ? 'Edit User' : 'Add New User');
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#passwordRequired').show();
            $('#passwordHint').hide();
            $('.invalid-feedback').text('').hide();
            $('.form-control').removeClass('is-invalid');

            if (isEditMode) {
                $('#passwordRequired').hide();
                $('#passwordHint').show();
                $('#password').removeAttr('required');
                
                $.ajax({
                    url: "{{ url('admin/role-management/users') }}/" + userId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const user = response.user;
                            $('#userId').val(user.id);
                            $('#username').val(user.username);
                            $('#name').val(user.name);
                            $('#kab_kota').val(user.kab_kota);
                            $('#jabatan').val(user.jabatan);
                            $('#role').val(user.role_id);
                        }
                    }
                });
            } else {
                $('#password').attr('required', true);
            }

            $('#userModal').modal('show');
        }

        function saveUser() {
            const formData = {
                _token: '{{ csrf_token() }}',
                username: $('#username').val(),
                name: $('#name').val(),
                password: $('#password').val(),
                role: $('#role').val(),
                kab_kota: $('#kab_kota').val(),
                jabatan: $('#jabatan').val(),
            };

            const userId = $('#userId').val();
            const url = userId 
                ? "{{ url('admin/role-management/users') }}/" + userId
                : "{{ route('admin.role-management.store-user') }}";
            const method = userId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#userModal').modal('hide');
                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').text('').hide();
                        $('.form-control').removeClass('is-invalid');
                        
                        $.each(errors, function(key, value) {
                            const input = $('#' + key);
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(value[0]).show();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'An error occurred'
                        });
                    }
                }
            });
        }

        function editUser(id) {
            showUserModal(id);
        }

        function deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/role-management/users') }}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Failed to delete user'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush

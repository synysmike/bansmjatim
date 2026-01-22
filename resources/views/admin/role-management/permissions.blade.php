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
                            <h4>Permissions List</h4>
                            <div class="card-header-action">
                                <button class="btn btn-primary" onclick="showPermissionModal()">
                                    <i class="fas fa-plus"></i> Add New Permission
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="permissionsTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Permission Name</th>
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

    <!-- Permission Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionModalLabel">Add New Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="permissionForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="permissionName" name="name" required 
                                placeholder="e.g., manage-users, view-reports, edit-content">
                            <small class="form-text text-muted">Use lowercase with hyphens (e.g., manage-users, view-reports)</small>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Permission</button>
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

        $(document).ready(function() {
            table = $('#permissionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.role-management.permissions') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'roles', name: 'roles', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#permissionForm').on('submit', function(e) {
                e.preventDefault();
                savePermission();
            });
        });

        function showPermissionModal() {
            $('#permissionForm')[0].reset();
            $('#permissionModalLabel').text('Add New Permission');
            $('.invalid-feedback').text('').hide();
            $('.form-control').removeClass('is-invalid');
            $('#permissionModal').modal('show');
        }

        function savePermission() {
            const formData = {
                _token: '{{ csrf_token() }}',
                name: $('#permissionName').val()
            };

            $.ajax({
                url: "{{ route('admin.role-management.store-permission') }}",
                type: 'POST',
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
                        $('#permissionModal').modal('hide');
                        table.ajax.reload();
                        
                        // Show message that permissions will be available in role management
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'info',
                                title: 'Permission Created',
                                text: 'The new permission is now available when creating or editing roles.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }, 2100);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').text('').hide();
                        $('.form-control').removeClass('is-invalid');
                        
                        $.each(errors, function(key, value) {
                            const input = $('#permissionName');
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

        function deletePermission(id) {
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
                        url: "{{ url('admin/role-management/permissions') }}/" + id,
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
                                text: xhr.responseJSON?.message || 'Failed to delete permission'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush

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
                            <h4>Roles List</h4>
                            <div class="card-header-action">
                                <button class="btn btn-primary" onclick="showRoleModal()">
                                    <i class="fas fa-plus"></i> Add New Role
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="rolesTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Role Name</th>
                                            <th>Permissions</th>
                                            <th>Users Count</th>
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

    <!-- Role Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="roleForm">
                    <div class="modal-body">
                        <input type="hidden" id="roleId" name="id">
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="roleName" name="name" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Permissions</label>
                            <div class="row" id="permissionsContainer">
                                <div class="col-12">
                                    <div class="text-center py-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <p class="mt-2">Loading permissions...</p>
                                    </div>
                                </div>
                            </div>
                            <small class="form-text text-muted">Select which pages/features this role can access</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Permissions Management Modal -->
    <div class="modal fade" id="permissionsModal" tabindex="-1" role="dialog" aria-labelledby="permissionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionsModalLabel">Manage Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="permissionsForm">
                    <div class="modal-body">
                        <input type="hidden" id="permissionRoleId" name="role_id">
                        <div class="form-group">
                            <label>Role: <strong id="permissionRoleName"></strong></label>
                        </div>
                        <div class="form-group">
                            <label>Select Permissions</label>
                            <div class="row" id="permissionsModalContainer">
                                <!-- Permissions will be loaded here -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Permissions</button>
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
        let allPermissions = [];

        // Load permissions dynamically
        function loadPermissions() {
            return $.ajax({
                url: "{{ route('admin.role-management.get-all-permissions') }}",
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        allPermissions = response.permissions;
                        renderPermissions();
                    }
                }
            });
        }

        // Render permissions in the role modal
        function renderPermissions(selectedPermissionIds = []) {
            let html = '';
            if (allPermissions.length === 0) {
                html = '<div class="col-12"><p class="text-muted">No permissions available. Create permissions first.</p></div>';
            } else {
                allPermissions.forEach(function(permission) {
                    const checked = selectedPermissionIds.includes(parseInt(permission.id)) ? 'checked' : '';
                    html += `
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input permission-checkbox" type="checkbox" 
                                    value="${permission.id}" id="perm_${permission.id}" name="permissions[]" ${checked}>
                                <label class="form-check-label" for="perm_${permission.id}">
                                    ${permission.name}
                                </label>
                            </div>
                        </div>
                    `;
                });
            }
            $('#permissionsContainer').html(html);
        }

        $(document).ready(function() {
            // Load permissions on page load
            loadPermissions();

            table = $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.role-management.roles') }}",
                    type: 'GET'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
                    { data: 'users_count', name: 'users_count' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#roleForm').on('submit', function(e) {
                e.preventDefault();
                saveRole();
            });

            $('#permissionsForm').on('submit', function(e) {
                e.preventDefault();
                savePermissions();
            });
        });

        function showRoleModal(roleId = null) {
            isEditMode = roleId !== null;
            $('#roleModalLabel').text(isEditMode ? 'Edit Role' : 'Add New Role');
            $('#roleForm')[0].reset();
            $('#roleId').val('');
            $('.invalid-feedback').text('').hide();
            $('.form-control').removeClass('is-invalid');

            // Reload permissions to get latest list
            loadPermissions().then(function() {
                if (isEditMode) {
                    $.ajax({
                        url: "{{ url('admin/role-management/roles') }}/" + roleId,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                const role = response.role;
                                $('#roleId').val(role.id);
                                $('#roleName').val(role.name);
                                
                                // Render permissions with selected ones checked
                                renderPermissions(role.permission_ids);
                            }
                        }
                    });
                } else {
                    // Render permissions without any selected
                    renderPermissions([]);
                }
            });

            $('#roleModal').modal('show');
        }

        function saveRole() {
            const formData = {
                _token: '{{ csrf_token() }}',
                name: $('#roleName').val(),
                permissions: $('.permission-checkbox:checked').map(function() {
                    return $(this).val();
                }).get()
            };

            const roleId = $('#roleId').val();
            const url = roleId 
                ? "{{ url('admin/role-management/roles') }}/" + roleId
                : "{{ route('admin.role-management.store-role') }}";
            const method = roleId ? 'PUT' : 'POST';

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
                        $('#roleModal').modal('hide');
                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').text('').hide();
                        $('.form-control').removeClass('is-invalid');
                        
                        $.each(errors, function(key, value) {
                            const input = $('#roleName');
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

        function managePermissions(roleId) {
            // Reload permissions to get latest list
            loadPermissions().then(function() {
                $.ajax({
                    url: "{{ url('admin/role-management/roles') }}/" + roleId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const role = response.role;
                            $('#permissionRoleId').val(role.id);
                            $('#permissionRoleName').text(role.name);
                            
                            // Render permissions with selected ones checked
                            let html = '';
                            if (allPermissions.length === 0) {
                                html = '<div class="col-12"><p class="text-muted">No permissions available. Create permissions first.</p></div>';
                            } else {
                                allPermissions.forEach(function(permission) {
                                    const checked = role.permission_ids.includes(parseInt(permission.id)) ? 'checked' : '';
                                    html += `
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input permission-modal-checkbox" type="checkbox" 
                                                    value="${permission.id}" id="perm_modal_${permission.id}" name="permissions[]" ${checked}>
                                                <label class="form-check-label" for="perm_modal_${permission.id}">
                                                    ${permission.name}
                                                </label>
                                            </div>
                                        </div>
                                    `;
                                });
                            }
                            $('#permissionsModalContainer').html(html);
                            $('#permissionsModal').modal('show');
                        }
                    }
                });
            });
        }

        function savePermissions() {
            const roleId = $('#permissionRoleId').val();
            const permissions = $('.permission-modal-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: "{{ url('admin/role-management/roles') }}/" + roleId,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#permissionRoleName').text(),
                    permissions: permissions
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#permissionsModal').modal('hide');
                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Failed to save permissions'
                    });
                }
            });
        }

        function editRole(id) {
            showRoleModal(id);
        }

        function deleteRole(id) {
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
                        url: "{{ url('admin/role-management/roles') }}/" + id,
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
                                text: xhr.responseJSON?.message || 'Failed to delete role'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush

@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
@endpush

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.role-management.index') }}" class="hover:text-admin-primary transition-colors">Role Management</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle }}</span>
        </nav>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">Roles List</h2>
                <button type="button" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium" onclick="showRoleModal()">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Add New Role</span>
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="rolesTable" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Role Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Permissions</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Users Count</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-admin-border">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Role Modal (Add/Edit) -->
    <div id="roleModal" class="modal-wrapper modal-lg" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('roleModal')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 class="text-xl font-semibold text-white" id="roleModalLabel">Add New Role</h5>
                    <button type="button" onclick="modalManager.close('roleModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <form id="roleForm">
                    <div class="p-6 overflow-y-auto flex-1 bg-white">
                        <input type="hidden" id="roleId" name="id">
                        <div class="mb-6">
                            <label for="roleName" class="form-label">Role Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" id="roleName" name="name" required placeholder="e.g. admin, editor">
                            <div class="text-red-500 text-sm mt-1 hidden" id="roleNameError"></div>
                        </div>
                        <div class="mb-6">
                            <label class="form-label">Permissions</label>
                            <div id="permissionsContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-64 overflow-y-auto p-2 border border-admin-border rounded-lg">
                                <div class="col-span-2 text-center py-4 text-admin-text-secondary text-sm">Loading permissions...</div>
                            </div>
                            <p class="text-sm text-admin-text-secondary mt-1">Select which pages/features this role can access</p>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-admin-border flex items-center justify-end space-x-3 bg-white">
                        <button type="button" onclick="modalManager.close('roleModal')" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Save Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Permissions Management Modal -->
    <div id="permissionsModal" class="modal-wrapper modal-lg" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('permissionsModal')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 class="text-xl font-semibold text-white" id="permissionsModalTitle">Manage Permissions</h5>
                    <button type="button" onclick="modalManager.close('permissionsModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <form id="permissionsForm">
                    <div class="p-6 overflow-y-auto flex-1 bg-white">
                        <input type="hidden" id="permissionRoleId" name="role_id">
                        <input type="hidden" id="permissionRoleNameInput" name="name" value="">
                        <div class="mb-4">
                            <label class="form-label">Role</label>
                            <p class="font-semibold text-admin-text-primary text-lg" id="permissionRoleNameDisplay">—</p>
                        </div>
                        <div class="mb-6">
                            <label class="form-label">Select Permissions</label>
                            <div id="permissionsModalContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-64 overflow-y-auto p-2 border border-admin-border rounded-lg">
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-admin-border flex items-center justify-end space-x-3 bg-white">
                        <button type="button" onclick="modalManager.close('permissionsModal')" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Save Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        const ROLES_BASE_URL = "{{ url('admin/role-management/roles') }}";
        const STORE_ROLE_URL = "{{ route('admin.role-management.store-role') }}";
        const GET_PERMISSIONS_URL = "{{ route('admin.role-management.get-all-permissions') }}";
        let rolesTable;
        let isEditMode = false;
        let allPermissions = [];

        function loadPermissions() {
            return $.ajax({
                url: GET_PERMISSIONS_URL,
                type: 'GET'
            }).done(function(response) {
                if (response.success) {
                    allPermissions = response.permissions;
                }
            });
        }

        function renderPermissions(containerId, selectedPermissionIds) {
            const container = document.getElementById(containerId);
            if (!container) return;
            selectedPermissionIds = selectedPermissionIds || [];
            if (allPermissions.length === 0) {
                container.innerHTML = '<div class="col-span-2 text-admin-text-secondary text-sm py-2">No permissions available. Create permissions first.</div>';
                return;
            }
            const isModal = containerId === 'permissionsModalContainer';
            const namePrefix = isModal ? 'perm_modal_' : 'perm_';
            const checkboxClass = isModal ? 'permission-modal-checkbox' : 'permission-checkbox';
            let html = '';
            allPermissions.forEach(function(permission) {
                const checked = selectedPermissionIds.indexOf(parseInt(permission.id)) !== -1 ? 'checked' : '';
                html += `
                    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-admin-light cursor-pointer">
                        <input type="checkbox" class="rounded border-admin-border text-admin-primary focus:ring-admin-primary ${checkboxClass}" value="${permission.id}" id="${namePrefix}${permission.id}" name="permissions[]" ${checked}>
                        <span class="text-sm text-admin-text-primary">${permission.name}</span>
                    </label>
                `;
            });
            container.innerHTML = html;
        }

        $(document).ready(function() {
            loadPermissions();

            rolesTable = $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: "{{ route('admin.role-management.roles') }}", type: 'GET' },
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

        function showRoleModal(roleId) {
            isEditMode = (roleId != null && roleId !== '');
            document.getElementById('roleModalLabel').textContent = isEditMode ? 'Edit Role' : 'Add New Role';
            document.getElementById('roleForm').reset();
            document.getElementById('roleId').value = '';
            var errEl = document.getElementById('roleNameError');
            if (errEl) errEl.classList.add('hidden');
            var nameEl = document.getElementById('roleName');
            if (nameEl) nameEl.classList.remove('border-red-500');

            if (isEditMode) {
                loadPermissions().done(function() {
                    $.get(ROLES_BASE_URL + '/' + roleId).done(function(response) {
                        if (response.success && response.role) {
                            var role = response.role;
                            document.getElementById('roleId').value = role.id;
                            document.getElementById('roleName').value = role.name || '';
                            renderPermissions('permissionsContainer', role.permission_ids || []);
                        } else {
                            if (typeof showToast === 'function') showToast('Failed to load role.', 'error');
                            else alert('Failed to load role.');
                        }
                        if (typeof modalManager !== 'undefined') modalManager.open('roleModal');
                    }).fail(function(xhr) {
                        var msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to load role';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    });
                });
            } else {
                if (typeof modalManager !== 'undefined') modalManager.open('roleModal');
                loadPermissions().done(function() {
                    renderPermissions('permissionsContainer', []);
                });
            }
        }

        function saveRole() {
            const roleId = document.getElementById('roleId').value;
            const name = (document.getElementById('roleName').value || '').trim();
            if (!name) {
                if (typeof showToast === 'function') showToast('Role name is required.', 'error');
                else alert('Role name is required.');
                return;
            }
            const permissions = [];
            document.querySelectorAll('.permission-checkbox:checked').forEach(function(cb) {
                if (cb.value) permissions.push(cb.value);
            });

            const url = roleId ? ROLES_BASE_URL + '/' + roleId : STORE_ROLE_URL;
            const method = roleId ? 'PUT' : 'POST';
            const data = { _token: '{{ csrf_token() }}', name: name, permissions: permissions };

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(response) {
                    if (response.success) {
                        if (typeof showToast === 'function') showToast(response.message || 'Role saved.', 'success');
                        else alert(response.message || 'Role saved.');
                        if (typeof modalManager !== 'undefined') modalManager.close('roleModal');
                        rolesTable.ajax.reload();
                    } else {
                        var msg = (response && response.message) || 'Failed to save role';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON && xhr.responseJSON.errors;
                        var errEl = document.getElementById('roleNameError');
                        var nameEl = document.getElementById('roleName');
                        if (errors && errors.name) {
                            if (errEl) { errEl.textContent = errors.name[0]; errEl.classList.remove('hidden'); }
                            if (nameEl) nameEl.classList.add('border-red-500');
                        }
                    } else {
                        var msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to save role';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                }
            });
        }

        function managePermissions(roleId) {
            if (!roleId) return;
            loadPermissions().done(function() {
                $.get(ROLES_BASE_URL + '/' + roleId).done(function(response) {
                    if (response.success && response.role) {
                        const role = response.role;
                        const roleName = (role.name || '').trim() || ('Role #' + role.id);
                        document.getElementById('permissionRoleId').value = role.id;
                        document.getElementById('permissionRoleNameInput').value = roleName;
                        document.getElementById('permissionRoleNameDisplay').textContent = roleName;
                        document.getElementById('permissionsModalTitle').textContent = 'Manage Permissions: ' + roleName;
                        renderPermissions('permissionsModalContainer', role.permission_ids || []);
                        if (typeof modalManager !== 'undefined') modalManager.open('permissionsModal');
                    } else {
                        const msg = (response && response.message) || 'Failed to load role';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                }).fail(function(xhr) {
                    const msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to load role';
                    if (typeof showToast === 'function') showToast(msg, 'error');
                    else alert(msg);
                });
            });
        }

        function savePermissions() {
            const roleId = document.getElementById('permissionRoleId').value;
            const roleName = document.getElementById('permissionRoleNameInput').value.trim();
            if (!roleId) {
                if (typeof showToast === 'function') showToast('Role ID is missing.', 'error');
                else alert('Role ID is missing.');
                return;
            }
            const permissions = [];
            document.querySelectorAll('.permission-modal-checkbox:checked').forEach(function(cb) {
                if (cb.value) permissions.push(cb.value);
            });

            $.ajax({
                url: ROLES_BASE_URL + '/' + roleId,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: roleName || ('Role #' + roleId),
                    permissions: permissions
                },
                success: function(response) {
                    if (response.success) {
                        if (typeof showToast === 'function') showToast(response.message || 'Permissions saved.', 'success');
                        else alert(response.message || 'Permissions saved.');
                        if (typeof modalManager !== 'undefined') modalManager.close('permissionsModal');
                        rolesTable.ajax.reload();
                    } else {
                        const msg = (response && response.message) || 'Failed to save';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                },
                error: function(xhr) {
                    const msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to save permissions';
                    if (typeof showToast === 'function') showToast(msg, 'error');
                    else alert(msg);
                }
            });
        }

        function editRole(id) {
            showRoleModal(id);
        }

        function deleteRole(id) {
            if (id === undefined || id === null || id === '' || id === 'undefined') {
                if (typeof showToast === 'function') showToast('Invalid role. Cannot delete.', 'error');
                else alert('Invalid role. Cannot delete.');
                return;
            }
            var roleId = parseInt(id, 10);
            if (isNaN(roleId) || roleId < 1) {
                if (typeof showToast === 'function') showToast('Invalid role ID.', 'error');
                else alert('Invalid role ID.');
                return;
            }
            if (!confirm('Are you sure you want to delete this role? This cannot be undone.')) return;
            $.ajax({
                url: ROLES_BASE_URL + '/' + roleId,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        if (typeof showToast === 'function') showToast(response.message || 'Role deleted.', 'success');
                        else alert(response.message || 'Role deleted.');
                        rolesTable.ajax.reload();
                    } else {
                        if (typeof showToast === 'function') showToast(response.message || 'Error', 'error');
                        else alert(response.message || 'Error');
                    }
                },
                error: function(xhr) {
                    const msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to delete role';
                    if (typeof showToast === 'function') showToast(msg, 'error');
                    else alert(msg);
                }
            });
        }
    </script>
@endpush

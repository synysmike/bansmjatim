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
                <h2 class="text-xl font-semibold text-white">Permissions List</h2>
                <button type="button" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium" onclick="showPermissionModal()">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Add New Permission</span>
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="permissionsTable" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Permission Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Roles</th>
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
    <!-- Permission Modal (Add) -->
    <div id="permissionModal" class="modal-wrapper modal-md" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('permissionModal')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 class="text-xl font-semibold text-white" id="permissionModalLabel">Add New Permission</h5>
                    <button type="button" onclick="modalManager.close('permissionModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <form id="permissionForm">
                    <div class="p-6 overflow-y-auto flex-1 bg-white">
                        <div class="mb-6">
                            <label for="permissionName" class="form-label">Permission Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" id="permissionName" name="name" required placeholder="e.g. manage-users, view-reports, edit-content">
                            <p class="text-sm text-admin-text-secondary mt-1">Use lowercase with hyphens (e.g., manage-users, view-reports)</p>
                            <div class="text-red-500 text-sm mt-1 hidden" id="permissionNameError"></div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-admin-border flex items-center justify-end space-x-3 bg-white">
                        <button type="button" onclick="modalManager.close('permissionModal')" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Save Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        const STORE_PERMISSION_URL = "{{ route('admin.role-management.store-permission') }}";
        const PERMISSIONS_BASE_URL = "{{ url('admin/role-management/permissions') }}";
        let permissionsTable;

        $(document).ready(function() {
            permissionsTable = $('#permissionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: "{{ route('admin.role-management.permissions') }}", type: 'GET' },
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
            document.getElementById('permissionForm').reset();
            document.getElementById('permissionModalLabel').textContent = 'Add New Permission';
            document.getElementById('permissionNameError').classList.add('hidden');
            document.getElementById('permissionNameError').textContent = '';
            var nameEl = document.getElementById('permissionName');
            if (nameEl) nameEl.classList.remove('border-red-500');
            if (typeof modalManager !== 'undefined') modalManager.open('permissionModal');
        }

        function savePermission() {
            var name = document.getElementById('permissionName').value.trim();
            $.ajax({
                url: STORE_PERMISSION_URL,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', name: name },
                success: function(response) {
                    if (response.success) {
                        if (typeof showToast === 'function') showToast(response.message || 'Permission created.', 'success');
                        else alert(response.message || 'Permission created.');
                        if (typeof modalManager !== 'undefined') modalManager.close('permissionModal');
                        permissionsTable.ajax.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errEl = document.getElementById('permissionNameError');
                        var nameEl = document.getElementById('permissionName');
                        if (errors.name) {
                            errEl.textContent = errors.name[0];
                            errEl.classList.remove('hidden');
                            if (nameEl) nameEl.classList.add('border-red-500');
                        }
                    } else {
                        var msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to save permission';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                }
            });
        }

        function deletePermission(id) {
            if (!confirm('Are you sure you want to delete this permission? This cannot be undone.')) return;
            $.ajax({
                url: PERMISSIONS_BASE_URL + '/' + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        if (typeof showToast === 'function') showToast(response.message || 'Permission deleted.', 'success');
                        else alert(response.message || 'Permission deleted.');
                        permissionsTable.ajax.reload();
                    } else {
                        if (typeof showToast === 'function') showToast(response.message || 'Error', 'error');
                        else alert(response.message || 'Error');
                    }
                },
                error: function(xhr) {
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) || 'Failed to delete permission';
                    if (typeof showToast === 'function') showToast(msg, 'error');
                    else alert(msg);
                }
            });
        }
    </script>
@endpush

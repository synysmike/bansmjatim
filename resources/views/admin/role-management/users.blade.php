@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                <h2 class="text-xl font-semibold text-white">Users List</h2>
                <button class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium" onclick="showUserModal()">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Add New User</span>
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="flex flex-wrap items-center gap-4 mb-4">
                <label for="filterJabatan" class="text-sm font-medium text-admin-text-secondary">Filter by Jabatan (Role):</label>
                <select id="filterJabatan" class="form-select w-48 sm:w-56">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        @if(!empty($role->id))
                        <option value="{{ (int) $role->id }}">{{ e($role->name) }}</option>
                        @endif
                    @endforeach
                </select>
                <button type="button" id="btnClearFilter" class="btn btn-secondary text-sm py-2 px-3" style="display: none;">Clear filter</button>
            </div>
            <div class="overflow-x-auto">
                <table id="usersTable" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kab/Kota</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Jabatan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Roles</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Action</th>
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
    <!-- User Modal -->
    <div id="userModal" class="modal-wrapper modal-md" data-open="false">
        <!-- Backdrop -->
        <div class="modal-backdrop" onclick="modalManager.close('userModal')"></div>
        
        <!-- Modal Content -->
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 class="text-xl font-semibold text-white" id="userModalLabel">Add New User</h5>
                    <button type="button" onclick="modalManager.close('userModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                
                <form id="userForm">
                    <div class="p-6 overflow-y-auto flex-1 bg-white">
                        <input type="hidden" id="userId" name="id">
                        
                        <div class="mb-6">
                            <label class="form-label">Username <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" id="username" name="username" required>
                            <div class="text-red-500 text-sm mt-1 hidden invalid-feedback"></div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" id="name" name="name" required>
                            <div class="text-red-500 text-sm mt-1 hidden invalid-feedback"></div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="form-label">Password <span class="text-red-500" id="passwordRequired">*</span></label>
                            <input type="password" class="form-input" id="password" name="password">
                            <small class="text-admin-text-secondary text-sm mt-1 hidden" id="passwordHint">Leave blank to keep current password</small>
                            <div class="text-red-500 text-sm mt-1 hidden invalid-feedback"></div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="form-label">Jabatan (Role) <span class="text-red-500">*</span></label>
                            <select class="form-select" id="user_role" name="jabatan_role_id" required>
                                <option value="">Select Jabatan / Role</option>
                                @foreach($roles as $r)
                                    @if(!empty($r->id))
                                    <option value="{{ (int) $r->id }}">{{ e($r->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="text-red-500 text-sm mt-1 hidden invalid-feedback" id="roleError"></div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="form-label">Kab/Kota</label>
                            <input type="text" class="form-input" id="kab_kota" name="kab_kota">
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-admin-border flex items-center justify-end space-x-3 bg-white">
                        <button type="button" onclick="modalManager.close('userModal')" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
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
                    type: 'GET',
                    data: function(d) {
                        var roleId = $('#filterJabatan').val();
                        if (roleId) d.role_id = roleId;
                    }
                },
                language: {
                    processing: '<div class="flex items-center justify-center p-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-admin-primary"></div><span class="ml-3 text-admin-text-primary">Loading...</span></div>',
                    emptyTable: '<div class="text-center py-8 text-admin-text-secondary">No data available</div>',
                    zeroRecords: '<div class="text-center py-8 text-admin-text-secondary">No matching records found</div>'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
                    { data: 'username', name: 'username', className: 'font-medium text-admin-text-primary' },
                    { data: 'name', name: 'name', className: 'text-admin-text-primary' },
                    { data: 'kab_kota', name: 'kab_kota', className: 'text-admin-text-secondary' },
                    { data: 'jabatan', name: 'jabatan', className: 'text-admin-text-secondary' },
                    { data: 'roles', name: 'roles', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                drawCallback: function() {
                    // Apply Tailwind classes to DataTable elements
                    $('.dataTables_wrapper').addClass('w-full');
                    $('.dataTables_filter input').addClass('form-input ml-2');
                    $('.dataTables_length select').addClass('form-select ml-2');
                    $('.dataTables_paginate .paginate_button').addClass('btn btn-secondary mx-1');
                    $('.dataTables_paginate .paginate_button.current').removeClass('btn-secondary').addClass('btn-primary');
                }
            });

            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                saveUser();
            });

            $('#filterJabatan').on('change', function() {
                table.ajax.reload();
                $('#btnClearFilter').toggle(!!$(this).val());
            });

            $('#btnClearFilter').on('click', function() {
                $('#filterJabatan').val('');
                table.ajax.reload();
                $(this).hide();
            });
        });

        function showUserModal(userId = null) {
            isEditMode = userId !== null;
            $('#userModalLabel').text(isEditMode ? 'Edit User' : 'Add New User');
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#passwordRequired').show();
            $('#passwordHint').hide();
            $('.invalid-feedback').text('').addClass('hidden');
            $('.form-input, .form-select').removeClass('border-red-500');

            if (isEditMode) {
                $('#passwordRequired').hide();
                $('#passwordHint').removeClass('hidden');
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
                            $('#user_role').val(user.role_id);
                        }
                    }
                });
            } else {
                $('#password').attr('required', true);
            }

            modalManager.open('userModal');
        }

        function saveUser() {
            var roleEl = document.getElementById('user_role') || document.querySelector('#userForm select[name="jabatan_role_id"]');
            var roleVal = roleEl ? String(roleEl.value || '').trim() : '';
            var payload = {
                _token: '{{ csrf_token() }}',
                username: document.getElementById('username').value,
                name: document.getElementById('name').value,
                password: document.getElementById('password').value,
                jabatan_role_id: roleVal,
                kab_kota: document.getElementById('kab_kota').value
            };
            var userId = document.getElementById('userId').value;
            if (userId) { payload._method = 'PUT'; }
            var url = userId 
                ? "{{ url('admin/role-management/users') }}/" + userId
                : "{{ route('admin.role-management.store-user') }}";
            var method = 'POST';

            $.ajax({
                url: url,
                type: method,
                contentType: 'application/json',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                data: JSON.stringify(payload),
                success: function(response) {
                    if (response.success) {
                        if (typeof showToast !== 'undefined') {
                            showToast(response.message, 'success');
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                        modalManager.close('userModal');
                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').text('').addClass('hidden');
                        $('.form-input, .form-select').removeClass('border-red-500');
                        var roleInputId = { 'role': 'user_role', 'role_id': 'user_role', 'jabatan_role_id': 'user_role' };
                        $.each(errors, function(key, value) {
                            var inputId = roleInputId[key] || key;
                            var input = $('#' + inputId);
                            input.addClass('border-red-500');
                            var feedback = input.siblings('.invalid-feedback').first();
                            if (!feedback.length) feedback = $('#roleError');
                            feedback.text(value[0]).removeClass('hidden');
                        });
                    } else {
                        const message = xhr.responseJSON?.message || 'An error occurred';
                        if (typeof showToast !== 'undefined') {
                            showToast(message, 'error');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: message
                            });
                        }
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
                                if (typeof showToast !== 'undefined') {
                                    showToast(response.message, 'success');
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                }
                                table.ajax.reload();
                            } else {
                                const message = response.message || 'Error occurred';
                                if (typeof showToast !== 'undefined') {
                                    showToast(message, 'error');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: message
                                    });
                                }
                            }
                        },
                        error: function(xhr) {
                            const message = xhr.responseJSON?.message || 'Failed to delete user';
                            if (typeof showToast !== 'undefined') {
                                showToast(message, 'error');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: message
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush
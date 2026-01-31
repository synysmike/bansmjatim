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
            <span class="text-admin-primary font-medium">{{ $tittle }}</span>
        </nav>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-admin-success rounded-lg p-4 mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle admin-icon-lg text-admin-success"></i>
                <p class="text-admin-text-primary font-medium">{{ session('success') }}</p>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-admin-text-secondary hover:text-admin-text-primary transition-colors">
                <i class="fas fa-times admin-icon"></i>
            </button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Staff List</h2>
                <a href="{{ route('admin.staff.create') }}" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Add New Staff</span>
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-admin-border" id="staff-table">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Unit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Photo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-admin-border">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        const STAFF_BASE_URL = "{{ url('admin/staff') }}";

        $(document).ready(function() {
            $('#staff-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.staff.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'unit', name: 'unit' },
                    { data: 'photo_preview', name: 'photo_preview', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function deleteStaff(id) {
            if (!confirm('Are you sure you want to delete this staff?')) return;
            $.ajax({
                url: STAFF_BASE_URL + '/' + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        $('#staff-table').DataTable().ajax.reload();
                        if (typeof showToast === 'function') showToast(response.message || 'Staff deleted successfully.', 'success');
                        else alert(response.message || 'Staff deleted successfully.');
                    }
                },
                error: function() {
                    if (typeof showToast === 'function') showToast('Error deleting staff.', 'error');
                    else alert('Error deleting staff.');
                }
            });
        }
    </script>
@endpush

@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
@endpush

@section('admin-container')
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle }}</span>
        </nav>
    </div>

    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">Form Templates</h2>
                <a href="{{ route('admin.form-builder.create') }}" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Create Form</span>
                </a>
            </div>
        </div>

        <div class="p-6">
            <div id="form-builder-table-missing" class="hidden mb-4 p-4 rounded-lg bg-amber-50 border border-amber-200 text-amber-800">
                <p class="font-semibold">Table <code>form_templates</code> not found.</p>
                <p class="text-sm mt-1">Create it in database <code>banc9232_laravel</code> with exact name <code>form_templates</code> (with letter <strong>p</strong>), then refresh. Run: <code class="bg-amber-100 px-1 rounded">php artisan migrate</code> or run the SQL in <code>database/migrations/form_templates_table.sql</code>.</p>
            </div>
            <div class="overflow-x-auto">
                <table id="tabel-form-builder" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Form Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Fields</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
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
        const FORM_BUILDER_INDEX_URL = "{{ route('admin.form-builder.index') }}";
        const FORM_BUILDER_DELETE_URL = "{{ url('admin/form-builder') }}";

        $(document).ready(function() {
            $('#tabel-form-builder').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: FORM_BUILDER_INDEX_URL,
                    type: 'GET',
                    dataSrc: function(json) {
                        if (json.table_missing) {
                            document.getElementById('form-builder-table-missing').classList.remove('hidden');
                        }
                        return json.data || [];
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'form_data_preview', name: 'form_data_preview', orderable: false, searchable: false },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[ 1, 'asc' ]]
            });
        });

        function deleteTemplate(id) {
            if (!confirm('Delete this form template? This cannot be undone.')) return;
            $.ajax({
                url: FORM_BUILDER_DELETE_URL + '/' + id,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json'
            }).done(function(res) {
                if (res.success) {
                    if (typeof showToast === 'function') showToast(res.message || 'Deleted.', 'success');
                    else alert(res.message || 'Deleted.');
                    $('#tabel-form-builder').DataTable().ajax.reload(null, false);
                }
            }).fail(function(xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Delete failed.';
                if (typeof showToast === 'function') showToast(msg, 'error');
                else alert(msg);
            });
        }
    </script>
@endpush

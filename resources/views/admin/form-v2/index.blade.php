@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
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

    <!-- 1. Definisi Field -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover mb-8">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">Definisi Field</h2>
                <button type="button" id="btn-tambah-field" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Tambah Field</span>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="tabel-field-def" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Field</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Label</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Wajib</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. Konfigurasi Form V2 -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">Konfigurasi Form V2</h2>
                <button type="button" id="btn-tambah-config" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Tambah Konfigurasi</span>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="tabel-config-v2" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Link</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Field</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Modal Field Definition -->
    <div id="modalFieldDef" class="modal-wrapper modal-md" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modalFieldDef')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white" id="modalFieldDefTitle">Tambah Field</h3>
                    <button type="button" onclick="modalManager.close('modalFieldDef')" class="text-white hover:text-gray-200"><i class="fas fa-times admin-icon-lg"></i></button>
                </div>
                <form id="form-field-def">
                    <input type="hidden" id="field-def-id" name="id" value="">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="form-label">Nama field (unique)</label>
                            <input type="text" name="nama_field" id="fd-nama_field" class="form-input w-full" required placeholder="npsn">
                        </div>
                        <div>
                            <label class="form-label">Tipe</label>
                            <select name="tipe" id="fd-tipe" class="form-select w-full" required>
                                @foreach(\App\Models\FormFieldDefinition::TYPES as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Label</label>
                            <input type="text" name="label" id="fd-label" class="form-input w-full" required placeholder="NPSN">
                        </div>
                        <div>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="required" id="fd-required" value="1">
                                <span>Wajib diisi</span>
                            </label>
                        </div>
                        <div>
                            <label class="form-label">Placeholder</label>
                            <input type="text" name="placeholder" id="fd-placeholder" class="form-input w-full" placeholder="Opsional">
                        </div>
                        <div id="fd-options-wrap">
                            <label class="form-label">Options (JSON, untuk select / radio / checkbox)</label>
                            <textarea name="options" id="fd-options" class="form-textarea w-full" rows="3" placeholder='[{"value":"a","label":"A"},{"value":"b","label":"B"}]'></textarea>
                        </div>
                        <div>
                            <label class="form-label">Urutan</label>
                            <input type="number" name="sort_order" id="fd-sort_order" class="form-input w-full" value="0" min="0">
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t flex justify-end gap-2 bg-white">
                        <button type="button" onclick="modalManager.close('modalFieldDef')" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Config -->
    <div id="modalConfig" class="modal-wrapper modal-md" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modalConfig')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white" id="modalConfigTitle">Tambah Konfigurasi Form</h3>
                    <button type="button" onclick="modalManager.close('modalConfig')" class="text-white hover:text-gray-200"><i class="fas fa-times admin-icon-lg"></i></button>
                </div>
                <form id="form-config">
                    <input type="hidden" id="config-id" name="id" value="">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="form-label">Link (slug URL)</label>
                            <input type="text" name="link" id="cfg-link" class="form-input w-full" required placeholder="url_form">
                        </div>
                        <div>
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" id="cfg-judul" class="form-input w-full" required>
                        </div>
                        <div>
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" id="cfg-kategori" class="form-input w-full" placeholder="Opsional">
                        </div>
                        <div>
                            <label class="form-label">Field (urutkan sesuai tampilan)</label>
                            <select name="field_names[]" id="cfg-field_names" class="form-select w-full" multiple>
                                <!-- filled by JS from getFieldDefinitionsList -->
                            </select>
                        </div>
                        <div>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="is_active" id="cfg-is_active" value="1" checked>
                                <span>Aktif</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="signature_enabled" id="cfg-signature_enabled" value="1" checked>
                                <span>Tampilkan TTD (signature)</span>
                            </label>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t flex justify-end gap-2 bg-white">
                        <button type="button" onclick="modalManager.close('modalConfig')" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
    <script>
        var FIELD_DEF_URL = "{{ route('admin.form-v2.field-definitions') }}";
        var FIELD_DEF_STORE = "{{ route('admin.form-v2.field-definitions.store') }}";
        var CONFIGS_URL = "{{ route('admin.form-v2.configs') }}";
        var CONFIGS_STORE = "{{ route('admin.form-v2.configs.store') }}";
        var FIELD_LIST_URL = "{{ route('admin.form-v2.field-definitions-list') }}";
        var csrf = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $('#tabel-field-def').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: FIELD_DEF_URL, type: 'GET' },
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_field' },
                    { data: 'tipe' },
                    { data: 'label' },
                    { data: 'required', render: function(d) { return d ? 'Ya' : 'Tidak'; } },
                    { data: 'actions', orderable: false, searchable: false }
                ]
            });

            $('#tabel-config-v2').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: CONFIGS_URL, type: 'GET' },
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'link' },
                    { data: 'judul' },
                    { data: 'field_list', orderable: false },
                    { data: 'actions', orderable: false, searchable: false }
                ]
            });

            $('#btn-tambah-field').on('click', function() {
                $('#modalFieldDefTitle').text('Tambah Field');
                $('#form-field-def').trigger('reset');
                $('#field-def-id').val('');
                $('#fd-required').prop('checked', false);
                $('#fd-sort_order').val(0);
                modalManager.open('modalFieldDef');
            });

            $('#form-field-def').on('submit', function(e) {
                e.preventDefault();
                var id = $('#field-def-id').val();
                var url = id ? "{{ url('admin/form-v2/field-definitions') }}/" + id : FIELD_DEF_STORE;
                var data = {
                    nama_field: $('#fd-nama_field').val(),
                    tipe: $('#fd-tipe').val(),
                    label: $('#fd-label').val(),
                    required: $('#fd-required').prop('checked') ? 1 : 0,
                    placeholder: $('#fd-placeholder').val(),
                    options: $('#fd-options').val() || '',
                    sort_order: $('#fd-sort_order').val() || 0,
                    _token: csrf
                };
                if (id) data._method = 'PUT';
                $.ajax({ url: url, type: 'POST', data: data }).done(function(res) {
                    if (res.success) { $('#tabel-field-def').DataTable().ajax.reload(null, false); modalManager.close('modalFieldDef'); alert(res.message); }
                }).fail(function(xhr) {
                    alert(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menyimpan');
                });
            });

            $(document).on('click', '[data-edit-field]', function() {
                var id = $(this).data('edit-field');
                $.get("{{ url('admin/form-v2/field-definitions') }}/" + id).done(function(d) {
                    $('#modalFieldDefTitle').text('Edit Field');
                    $('#field-def-id').val(d.id);
                    $('#fd-nama_field').val(d.nama_field);
                    $('#fd-tipe').val(d.tipe);
                    $('#fd-label').val(d.label);
                    $('#fd-required').prop('checked', !!d.required);
                    $('#fd-placeholder').val(d.placeholder || '');
                    $('#fd-options').val(d.options ? (typeof d.options === 'string' ? d.options : JSON.stringify(d.options, null, 2)) : '');
                    $('#fd-sort_order').val(d.sort_order || 0);
                    modalManager.open('modalFieldDef');
                });
            });

            window.deleteFieldDef = function(id) {
                if (!confirm('Hapus field ini?')) return;
                $.ajax({ url: "{{ url('admin/form-v2/field-definitions') }}/" + id, type: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } }).done(function(res) {
                    if (res.success) { $('#tabel-field-def').DataTable().ajax.reload(null, false); alert(res.message); }
                });
            };

            // Config modal: load field list for multiselect
            $('#btn-tambah-config').on('click', function() {
                $('#modalConfigTitle').text('Tambah Konfigurasi Form');
                $('#form-config').trigger('reset');
                $('#config-id').val('');
                $('#cfg-is_active').prop('checked', true);
                loadFieldNamesSelect([]);
                modalManager.open('modalConfig');
            });

            function loadFieldNamesSelect(selected) {
                $.get(FIELD_LIST_URL).done(function(list) {
                    var $sel = $('#cfg-field_names');
                    $sel.empty();
                    list.forEach(function(f) {
                        $sel.append($('<option>').val(f.nama_field).text(f.label + ' (' + f.nama_field + ')').prop('selected', selected.indexOf(f.nama_field) !== -1));
                    });
                    if ($sel.hasClass('select2-hidden-accessible')) $sel.select2('destroy');
                    $sel.select2({ placeholder: 'Pilih field', width: '100%' });
                });
            }

            $('#form-config').on('submit', function(e) {
                e.preventDefault();
                var id = $('#config-id').val();
                var url = id ? "{{ url('admin/form-v2/configs') }}/" + id : CONFIGS_STORE;
                var method = id ? 'PUT' : 'POST';
                var fieldNames = $('#cfg-field_names').val() || [];
                if (fieldNames.length === 0) { alert('Pilih minimal satu field.'); return; }
                var data = {
                    link: $('#cfg-link').val(),
                    judul: $('#cfg-judul').val(),
                    kategori: $('#cfg-kategori').val(),
                    field_names: fieldNames,
                    is_active: $('#cfg-is_active').prop('checked') ? 1 : 0,
                    signature_enabled: $('#cfg-signature_enabled').prop('checked') ? 1 : 0,
                    _token: csrf
                };
                if (id) data._method = 'PUT';
                $.ajax({ url: url, type: 'POST', data: data }).done(function(res) {
                    if (res.success) { $('#tabel-config-v2').DataTable().ajax.reload(null, false); modalManager.close('modalConfig'); alert(res.message); }
                }).fail(function(xhr) {
                    alert(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menyimpan');
                });
            });

            $(document).on('click', '[data-edit-config]', function() {
                var id = $(this).data('edit-config');
                $.get("{{ url('admin/form-v2/configs') }}/" + id).done(function(d) {
                    $('#modalConfigTitle').text('Edit Konfigurasi Form');
                    $('#config-id').val(d.id);
                    $('#cfg-link').val(d.link);
                    $('#cfg-judul').val(d.judul);
                    $('#cfg-kategori').val(d.kategori || '');
                    $('#cfg-is_active').prop('checked', d.is_active !== false);
                    $('#cfg-signature_enabled').prop('checked', d.signature_enabled !== false);
                    var selected = d.field_names || [];
                    $.get(FIELD_LIST_URL).done(function(list) {
                        var $sel = $('#cfg-field_names');
                        $sel.empty();
                        list.forEach(function(f) {
                            $sel.append($('<option>').val(f.nama_field).text(f.label + ' (' + f.nama_field + ')').prop('selected', selected.indexOf(f.nama_field) !== -1));
                        });
                        if ($sel.hasClass('select2-hidden-accessible')) $sel.select2('destroy');
                        $sel.select2({ placeholder: 'Pilih field', width: '100%' });
                    });
                    modalManager.open('modalConfig');
                });
            });

            window.deleteConfig = function(id) {
                if (!confirm('Hapus konfigurasi ini?')) return;
                $.ajax({ url: "{{ url('admin/form-v2/configs') }}/" + id, type: 'DELETE', headers: { 'X-CSRF-TOKEN': csrf } }).done(function(res) {
                    if (res.success) { $('#tabel-config-v2').DataTable().ajax.reload(null, false); alert(res.message); }
                });
            };
        });
    </script>
@endpush

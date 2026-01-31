@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
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

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">Config List</h2>
                <button type="button" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium" id="config-tambah">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Tambah Form</span>
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="tabel-config" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Field</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Link</th>
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

@push('modals')
    <!-- Config Modal (Add/Edit) -->
    <div id="configModal" class="modal-wrapper modal-lg" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('configModal')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 class="text-xl font-semibold text-white" id="configModalLabel">Tambah Form</h5>
                    <button type="button" onclick="modalManager.close('configModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <form id="config-form" enctype="multipart/form-data">
                    <div class="p-6 overflow-y-auto flex-1 bg-white">
                        <input type="hidden" name="id" id="config-id" value="">
                        <div class="mb-6">
                            <label for="select-form" class="form-label">Pilih nama tabel / kolom input</label>
                            <select name="tag[]" id="select-form" class="form-select w-full" multiple="multiple"></select>
                        </div>
                        <div class="mb-6">
                            <label for="config-judul" class="form-label">Judul form <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" name="judul" id="config-judul" required placeholder="Judul form">
                        </div>
                        <div class="mb-6">
                            <label for="config-kat" class="form-label">Kategori Form</label>
                            <input type="text" class="form-input" name="kat" id="config-kat" placeholder="Kategori">
                        </div>
                        <div class="mb-6">
                            <label for="config-link" class="form-label">Link controller</label>
                            <input type="text" class="form-input" name="link" id="config-link" placeholder="link-controller">
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-admin-border flex items-center justify-end space-x-3 bg-white">
                        <button type="button" onclick="modalManager.close('configModal')" class="btn btn-secondary">Close</button>
                        <button type="submit" id="config-btn-save" class="btn btn-primary">Simpan</button>
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
        const CONFIG_INDEX_URL = "{{ route('admin.config.index') }}";
        const CONFIG_STORE_URL = "{{ route('admin.config.store') }}";
        const LIST_FORM_URL = "{{ url('list-form') }}";
        const SELECTLIST_URL = "{{ url('selectlist') }}";
        let configTable;
        let select2Instance;

        $(document).ready(function() {
            configTable = $('#tabel-config').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: CONFIG_INDEX_URL, type: 'GET' },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'tabel', name: 'tabel' },
                    { data: 'judul', name: 'judul' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'link', name: 'link' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ],
                columnDefs: [
                    {
                        targets: 1,
                        render: function(data) {
                            if (!data) return '—';
                            var text = (data + '').length > 60 ? (data + '').substring(0, 60) + '…' : data;
                            return '<span class="text-sm text-admin-text-secondary" title="' + (data + '').replace(/"/g, '&quot;') + '">' + text + '</span>';
                        }
                    }
                ]
            });

            initSelect2();
            $('#config-tambah').on('click', openConfigModalAdd);
            $(document).on('click', '.config-edit-btn', function() {
                var id = $(this).data('id');
                openConfigModalEdit(id);
            });
            $(document).on('click', '.config-del-btn', function() {
                var encryptedId = $(this).data('id');
                deleteConfig(encryptedId);
            });
            $(document).on('click', '.config-copy-link', function() {
                var url = $(this).data('url');
                if (!url) return;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(function() {
                        if (typeof showToast === 'function') showToast('Link disalin ke clipboard', 'success');
                        else alert('Link disalin.');
                    }).catch(function() { fallbackCopy(url); });
                } else {
                    fallbackCopy(url);
                }
            });
            $('#config-form').on('submit', saveConfig);
        });

        function fallbackCopy(text) {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.setAttribute('readonly', '');
            ta.style.position = 'fixed';
            ta.style.opacity = '0';
            document.body.appendChild(ta);
            ta.select();
            try {
                document.execCommand('copy');
                if (typeof showToast === 'function') showToast('Link disalin ke clipboard', 'success');
                else alert('Link disalin.');
            } catch (err) {
                if (typeof showToast === 'function') showToast('Gagal menyalin', 'error');
                else alert('Gagal menyalin');
            }
            document.body.removeChild(ta);
        }

        function initSelect2() {
            var $select = $('#select-form');
            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }
            select2Instance = $select.select2({
                placeholder: 'Pilih kolom input',
                allowClear: true,
                dropdownParent: $('#configModal'),
                ajax: {
                    url: LIST_FORM_URL,
                    type: 'post',
                    dataType: 'json',
                    data: function(params) {
                        return { search: params.term, _token: '{{ csrf_token() }}' };
                    },
                    processResults: function(response) {
                        return { results: response || [] };
                    },
                    cache: true
                }
            });
            select2Instance.on('change', function() {});
        }

        function openConfigModalAdd() {
            document.getElementById('configModalLabel').textContent = 'Tambah Form';
            document.getElementById('config-form').reset();
            document.getElementById('config-id').value = '';
            $('#select-form').val(null).trigger('change');
            if (typeof modalManager !== 'undefined') modalManager.open('configModal');
            setTimeout(function() { initSelect2(); }, 100);
        }

        function openConfigModalEdit(id) {
            document.getElementById('configModalLabel').textContent = 'Edit Form';
            document.getElementById('config-id').value = id;
            $.get("{{ url('admin/config') }}/" + id).done(function(data) {
                document.getElementById('config-judul').value = data.judul || '';
                document.getElementById('config-kat').value = data.kategori || '';
                document.getElementById('config-link').value = data.link || '';
                if (typeof modalManager !== 'undefined') modalManager.open('configModal');
                setTimeout(function() {
                    initSelect2();
                    $.get(SELECTLIST_URL + '/' + id).done(function(selectData) {
                        var arr = Array.isArray(selectData) ? selectData : (selectData ? [selectData] : []);
                        var opts = arr.map(function(v) { return new Option(v, v, true, true); });
                        $('#select-form').empty().append(opts).trigger('change');
                    });
                }, 150);
            });
        }

        function saveConfig(e) {
            e.preventDefault();
            var form = document.getElementById('config-form');
            var formData = new FormData(form);
            var btn = document.getElementById('config-btn-save');
            btn.disabled = true;
            $.ajax({
                url: CONFIG_STORE_URL,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(response) {
                    if (typeof showToast === 'function') showToast('Berkas telah tersimpan', 'success');
                    else alert('Berkas telah tersimpan');
                    if (typeof modalManager !== 'undefined') modalManager.close('configModal');
                    configTable.ajax.reload();
                },
                error: function(xhr) {
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Gagal menyimpan';
                    if (typeof showToast === 'function') showToast(msg, 'error');
                    else alert(msg);
                },
                complete: function() { btn.disabled = false; }
            });
        }

        function deleteConfig(encryptedId) {
            if (!confirm('Apakah Anda yakin? Data akan dihapus permanen.')) return;
            $.ajax({
                url: "{{ url('admin/config') }}/" + encodeURIComponent(encryptedId),
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    if (typeof showToast === 'function') showToast('Data telah terhapus', 'success');
                    else alert('Data telah terhapus');
                    configTable.ajax.reload();
                },
                error: function(xhr) {
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Gagal menghapus';
                    if (typeof showToast === 'function') showToast(msg, 'error');
                    else alert(msg);
                }
            });
        }
    </script>
@endpush

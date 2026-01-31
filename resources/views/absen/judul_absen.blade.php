@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <style>
        .table-neat { border-collapse: collapse; width: 100%; font-size: 0.875rem; margin: 0 auto; }
        .table-neat thead th,
        #list_absen thead th,
        .dataTables_wrapper .table-neat thead th { padding: 0.75rem 1rem; text-align: center !important; font-weight: 600; color: #1e293b; background: #f1f5f9; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .table-neat tbody td { padding: 0.75rem 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; text-align: center; }
        .table-neat tbody tr:hover { background: #f8fafc; }
        .table-neat tbody tr:last-child td { border-bottom: none; }
        #list_absen_wrapper .dataTables_length,
        #list_absen_wrapper .dataTables_filter { margin-bottom: 0.75rem; }
        #list_absen_wrapper .dataTables_info,
        #list_absen_wrapper .dataTables_paginate { margin-top: 0.75rem; }
        .overflow-x-auto > .dataTables_wrapper { width: 100%; }
    </style>
@endpush

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle ?? 'Judul Absen' }}</h1>
        <nav class="flex items-center justify-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle ?? 'Judul Absen' }}</span>
        </nav>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white text-center flex-1">Daftar Judul Absen kegiatan BAN-PDM Jawa Timur</h2>
                <button type="button" id="btn-tambah-judul" class="inline-flex items-center gap-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Tambah Judul Kegiatan</span>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto rounded-lg border border-admin-border">
                <table id="list_absen" class="table-neat min-w-full">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Absen</th>
                            <th>URL Absen</th>
                            <th>Tanggal</th>
                            <th>Active?</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Modal: Form Judul Kegiatan (Tambah / Edit) -->
    <div id="modal-judul-kegiatan" class="modal-wrapper modal-md" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modal-judul-kegiatan')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white" id="modal-judul-kegiatan-title">Tambah Judul Kegiatan</h3>
                    <button type="button" onclick="modalManager.close('modal-judul-kegiatan')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <form id="id-form">
                    <input type="hidden" name="id" id="form-id" value="">
                    <div class="p-6 space-y-5">
                        <div class="form-group">
                            <label for="judul" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="judul" id="judul" class="form-control form-input" placeholder="Nama kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="url" class="form-label">URL Kegiatan</label>
                            <input type="text" name="url" id="url" class="form-control form-input" placeholder="url-kegiatan">
                        </div>
                        <div class="form-group">
                            <label for="datepicker" class="form-label">Pilih Tanggal</label>
                            <input type="text" id="datepicker" class="form-control form-input datepicker" placeholder="DD-MM-YYYY" readonly>
                            <input type="hidden" name="tanggal" id="tanggal" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Aktifkan kolom</label>
                            <label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                                <input type="checkbox" id="aktif" class="rounded border-admin-border text-admin-primary focus:ring-admin-primary">
                                <input type="hidden" name="active" id="active" value="0">
                                <span class="text-admin-text-secondary">Kolom Aktif</span>
                            </label>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-admin-border flex justify-end gap-3 bg-white">
                        <button type="button" onclick="modalManager.close('modal-judul-kegiatan')" class="btn btn-secondary">Batal</button>
                        <button type="submit" id="btn-save" class="btn btn-primary inline-flex items-center gap-2">
                            <i class="fas fa-save admin-icon"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin_theme/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            var JUDUL_ABSEN_INDEX = "{{ route('admin.judul_absen.index') }}";
            var JUDUL_ABSEN_STORE = "{{ route('admin.judul_absen.store') }}";
            function judulAbsenDestroyUrl(id) { return "{{ url('admin/judul_absen') }}" + '/' + id; }

            $('.datepicker').daterangepicker({
                locale: { format: 'DD-MM-YYYY' },
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start) {
                $('#tanggal').val(start.format('DD-MM-YYYY'));
            });

            $('#aktif').on('change', function() {
                $('#active').val($(this).is(':checked') ? 1 : 0);
            });

            var table = $('#list_absen').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: JUDUL_ABSEN_INDEX, type: 'GET' },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', orderable: false, searchable: false },
                    { data: 'judul', name: 'judul', width: '25%' },
                    { data: 'url', name: 'url', width: '25%' },
                    { data: 'tanggal', name: 'tanggal', width: '10%' },
                    { data: 'act', name: 'act', width: '10%', orderable: false, searchable: false },
                    { data: 'action', name: 'action', width: '25%', orderable: false, searchable: false }
                ],
                order: [[0, 'asc']],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: { first: "Pertama", last: "Terakhir", next: "Selanjutnya", previous: "Sebelumnya" },
                    zeroRecords: "Tidak ada data",
                    processing: "Memproses..."
                }
            });

            new $.fn.dataTable.Buttons(table, {
                buttons: [{ text: 'Reload', action: function(e, dt) { dt.ajax.reload(); } }]
            });
            table.buttons(0, null).container().prependTo($('#list_absen').closest('.overflow-x-auto'));

            $('#btn-tambah-judul').on('click', function() {
                $('#modal-judul-kegiatan-title').text('Tambah Judul Kegiatan');
                $('#id-form').trigger('reset');
                $('#form-id').val('');
                $('#aktif').prop('checked', false);
                $('#active').val(0);
                $('#datepicker').val('');
                $('#tanggal').val('');
                modalManager.open('modal-judul-kegiatan');
            });

            $(document).on('click', '.btn-edit-judul', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var judul = $(this).data('judul');
                var url = $(this).data('url');
                var tanggal = $(this).data('tanggal');
                var active = $(this).data('active');
                $('#modal-judul-kegiatan-title').text('Edit Judul Kegiatan');
                $('#form-id').val(id);
                $('#judul').val(judul);
                $('#url').val(url);
                $('#datepicker').val(tanggal);
                $('#tanggal').val(tanggal);
                $('#aktif').prop('checked', active == 1);
                $('#active').val(active ? 1 : 0);
                modalManager.open('modal-judul-kegiatan');
            });

            $(document).on('click', '.btn-delete-judul', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var judul = $(this).data('judul');
                if (!confirm('Yakin ingin menghapus judul absen "' + judul + '"?')) return;
                var $btn = $(this);
                $btn.prop('disabled', true);
                $.ajax({
                    type: 'DELETE',
                    url: judulAbsenDestroyUrl(id),
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    dataType: 'json',
                    success: function(res) {
                        if (typeof showToast === 'function') showToast(res.message || 'Judul absen telah dihapus.', 'success');
                        else alert(res.message || 'Judul absen telah dihapus.');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false);
                        var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menghapus.';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                });
            });

            $('#id-form').on('submit', function(e) {
                e.preventDefault();
                var tgl = $('#datepicker').val();
                $('#tanggal').val(tgl);
                var formData = new FormData(this);
                var $btn = $('#btn-save');
                $btn.prop('disabled', true).find('span').text('Menyimpan...');
                $.ajax({
                    type: 'POST',
                    url: JUDUL_ABSEN_STORE,
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function() {
                        $('#id-form').trigger('reset');
                        $('#form-id').val('');
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        modalManager.close('modal-judul-kegiatan');
                        if (typeof showToast === 'function') showToast('Berkas telah tersimpan', 'success');
                        else alert('Berkas telah tersimpan');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menyimpan';
                        if (typeof showToast === 'function') showToast(msg, 'error');
                        else alert(msg);
                    }
                });
            });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
        });
    </script>
@endpush

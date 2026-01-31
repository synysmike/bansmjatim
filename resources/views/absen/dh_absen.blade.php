<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle ?? 'Absen' }} - {{ $format_tgl ?? '' }} - BAN-PDM Jatim</title>
    <link rel="icon" type="image/png" href="{{ asset('ban.png') }}">

    <link rel="stylesheet" href="{{ asset('public_assets/css/tailwind.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    @include('ad_layout.partials.theme_styles')
    <style>
        .page-container { max-width: 42rem; margin: 0 auto; padding: 2rem 1rem; }
        .card-header { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: #fff; padding: 1.5rem; }
        .table-neat { border-collapse: collapse; width: 100%; font-size: 0.875rem; }
        .table-neat thead th { padding: 0.75rem 1rem; text-align: left; font-weight: 600; color: #1e293b; background: #f8fafc; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .table-neat tbody td { padding: 0.75rem 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-neat tbody tr:hover { background: #f8fafc; }
        .table-neat tbody tr:last-child td { border-bottom: none; }
        #table-1_wrapper .dataTables_length,
        #table-1_wrapper .dataTables_filter { margin-bottom: 0.75rem; }
        #table-1_wrapper .dataTables_info,
        #table-1_wrapper .dataTables_paginate { margin-top: 0.75rem; }
    </style>
</head>
<body class="min-h-screen" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); font-family: 'Ubuntu', sans-serif;">
    <div id="app" class="min-h-screen flex flex-col">
        <main class="flex-1 py-8 px-4">
            <div class="page-container">
                <h1 class="text-3xl font-bold text-slate-800 mb-1">Form Kegiatan {{ $tittle ?? 'Absen' }}</h1>
                <p class="text-sm text-slate-600 mb-6">Tanggal {{ $format_tgl ?? '' }}</p>

                <div id="kolom" class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Absen Kegiatan</h2>
                    </div>
                    <div class="p-6">
                        <form id="id-form" enctype="multipart/form-data">
                            <input type="hidden" name="judul" value="{{ $tittle ?? '' }}">
                            <div class="form-group mb-6">
                                <label for="select-nama" class="form-label">Pilih Nama :</label>
                                <select required id="select-nama" name="nama" class="form-control form-select w-full">
                                    <option value="">--Pilih Nama--</option>
                                    @foreach ($namas ?? [] as $nama)
                                        <option value="{{ $nama->id }}">{{ $nama->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-6">
                                <input type="hidden" id="signature" name="signature">
                                <label for="sig" class="form-label">Tandatangan :</label>
                                <div class="mt-2">
                                    <div class="js-signature border border-slate-200 rounded-lg overflow-hidden bg-white" data-width="600" data-height="200" data-border="1px solid #e2e8f0" data-line-color="#000000" data-auto-fit="true"></div>
                                </div>
                                <div id="errsign" class="text-red-600 text-sm mt-1"></div>
                                <button type="button" id="clearBtn" class="btn btn-danger mt-2">Ulangi TTD</button>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <button type="submit" id="btn-save" class="btn btn-primary inline-flex items-center gap-2">
                                    <i class="fas fa-save"></i>
                                    <span>Simpan</span>
                                </button>
                                <button type="button" id="btn-daftar" class="btn btn-info inline-flex items-center gap-2">
                                    <i class="fas fa-list"></i>
                                    <span>Daftar absen</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (isset($act) && $act == 0)
                <div id="form-closed-message" class="mt-6 p-6 bg-amber-50 border border-amber-200 rounded-2xl text-slate-800">
                    <p>Form absen masih belum dibuka. Silahkan menghubungi <a href="https://wa.me/6281332444088" target="_blank" class="text-indigo-600 hover:underline">Teguh</a> atau <a href="https://wa.me/6287712813719" target="_blank" class="text-indigo-600 hover:underline">Guntur</a>.</p>
                </div>
                @endif
            </div>
        </main>

        <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
            <div class="page-container text-center text-sm text-slate-600">
                Copyright &copy; 2022 &middot; BAN-PDM Provinsi Jawa Timur &middot; ir.teguh IT BANPDMJATIM
            </div>
        </footer>
    </div>

    <!-- Modal: Daftar Hadir -->
    <div id="modal-daftar" class="modal-wrapper modal-xl" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modal-daftar')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="card-header px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white">Daftar Hadir Kegiatan</h3>
                    <button type="button" onclick="modalManager.close('modal-daftar')" class="text-white hover:opacity-80" aria-label="Close">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto">
                    <div class="overflow-x-auto rounded-lg border border-slate-200">
                        <table id="table-1" class="table-neat min-w-full">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Ttd</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-200 flex justify-end bg-white">
                    <button type="button" onclick="modalManager.close('modal-daftar')" class="btn btn-secondary">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed top-4 right-4 z-[60] space-y-2" style="display: none;"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('jq-signature/jq-signature.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script>
        function showToast(message, type) {
            type = type || 'success';
            var container = document.getElementById('toast-container');
            if (!container) return;
            container.style.display = 'block';
            var bg = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6';
            var toast = document.createElement('div');
            toast.style.cssText = 'background:' + bg + ';color:#fff;padding:1rem 1.5rem;border-radius:0.5rem;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);display:flex;align-items:center;gap:0.75rem;min-width:300px;max-width:28rem;';
            toast.innerHTML = '<span class="flex-1">' + message + '</span><button onclick="this.parentElement.remove();" style="background:none;border:none;color:#fff;cursor:pointer;">&times;</button>';
            container.appendChild(toast);
            setTimeout(function() { if (toast.parentNode) toast.remove(); if (container.children.length === 0) container.style.display = 'none'; }, 5000);
        }
        window.modalManager = {
            open: function(id) {
                var m = document.getElementById(id);
                if (m) { m.setAttribute('data-open', 'true'); document.body.style.overflow = 'hidden'; document.body.style.position = 'fixed'; document.body.style.width = '100%'; }
            },
            close: function(id) {
                var m = document.getElementById(id);
                if (m) { m.setAttribute('data-open', 'false'); document.body.style.overflow = ''; document.body.style.position = ''; document.body.style.width = ''; }
            },
            closeAll: function() {
                document.querySelectorAll('.modal-wrapper').forEach(function(m) { m.setAttribute('data-open', 'false'); });
                document.body.style.overflow = ''; document.body.style.position = ''; document.body.style.width = '';
            }
        };
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') modalManager.closeAll(); });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal-wrapper').forEach(function(m) { m.setAttribute('data-open', 'false'); });
        });

        $(document).ready(function() {
            var act = "{{ $act ?? 1 }}";
            if (act === "0") {
                $("#kolom").hide();
            }

            $("#select-nama").select2({ placeholder: "Pilih nama..." });
            $('.js-signature').jqSignature();
            $('#clearBtn').on('click', function() { $('.js-signature').jqSignature('clearCanvas'); });

            $('#btn-daftar').on('click', function() {
                modalManager.open('modal-daftar');
                if ($.fn.DataTable.isDataTable('#table-1')) {
                    $('#table-1').DataTable().ajax.reload(null, false);
                    return;
                }
                $('#table-1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { url: "{{ url()->current() }}", type: 'GET' },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', orderable: false, searchable: false },
                        { data: 'nama', name: 'nama' },
                        { data: 'tanggal', name: 'tanggal' },
                        { data: 'nama_judul', name: 'nama_judul' },
                        { data: 'ttd', name: 'ttd', width: '15%', orderable: false, searchable: false }
                    ],
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                });
                new $.fn.dataTable.Buttons($('#table-1').DataTable(), {
                    buttons: [{ text: 'Reload', action: function(e, dt) { dt.ajax.reload(); } }]
                });
                $('#table-1').DataTable().buttons(0, null).container().prependTo($('#table-1').closest('.overflow-x-auto'));
            });

            $('#id-form').on('submit', function(e) {
                e.preventDefault();
                var dataUrl = $('.js-signature').jqSignature('getDataURL');
                $('#signature').val(dataUrl);
                var formData = new FormData(this);
                var $btn = $('#btn-save');
                $btn.prop('disabled', true).find('span').text('Menyimpan...');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('presensi') }}",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function() {
                        $('#id-form').trigger('reset');
                        $('.js-signature').jqSignature('clearCanvas');
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        showToast('Berkas telah tersimpan', 'success');
                        if ($.fn.DataTable.isDataTable('#table-1')) $('#table-1').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menyimpan', 'error');
                    }
                });
            });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
        });
    </script>
</body>
</html>

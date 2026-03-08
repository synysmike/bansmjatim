<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle ?? $judul ?? 'Form' }} - BAN-PDM Jatim</title>
    <link rel="icon" type="image/png" href="{{ asset('ban.png') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/tailwind.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    @include('ad_layout.partials.theme_styles')
    <style>
        .page-container { max-width: 42rem; margin: 0 auto; padding: 2rem 1rem; }
        .card-header { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: #fff; padding: 1.5rem; }
        .text-muted { color: #64748b; }
    </style>
</head>
<body class="min-h-screen" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); font-family: 'Ubuntu', sans-serif;">
    <div id="app" class="min-h-screen flex flex-col">
        <main class="flex-1 py-8 px-4">
            <div class="page-container">
                <h1 class="text-3xl font-bold text-slate-800 mb-1">{{ $judul ?? 'Form' }} BAN-PDM JAWA TIMUR</h1>
                <p class="text-sm text-muted mb-6">Form v2 (definisi terstruktur)</p>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">{{ $judul ?? 'Form' }}</h2>
                    </div>
                    <div class="p-6">
                        <form id="id-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kat_dh" id="kat_dh" value="{{ $kategori ?? '' }}">

                            @foreach($fields as $field)
                                @include('form-v2.field', ['field' => $field])
                            @endforeach

                            @if($config->signature_enabled ?? true)
                            <div class="form-group mb-6" id="signature-block">
                                <input type="hidden" id="signature" name="signature">
                                <label for="sig" class="form-label">Tandatangan <span class="text-red-500">*</span></label>
                                <div class="mt-2">
                                    <div class="js-signature border border-slate-200 rounded-lg overflow-hidden bg-white" data-width="600" data-height="200" data-border="1px solid #e2e8f0" data-line-color="#000000" data-auto-fit="true"></div>
                                </div>
                                <div id="errsign" class="text-red-600 text-sm mt-1"></div>
                                <button type="button" id="clearBtn" class="btn btn-danger mt-2">Ulangi TTD</button>
                            </div>
                            @endif

                            <div class="flex flex-wrap items-center gap-3 pt-4">
                                <button type="submit" class="btn btn-primary inline-flex items-center gap-2" id="btn-save">
                                    <i class="fas fa-save"></i>
                                    <span>Simpan</span>
                                </button>
                                <button type="button" id="modal-daftar" class="btn btn-info inline-flex items-center gap-2">
                                    <i class="fas fa-list"></i>
                                    <span>Lihat pengunjung</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer class="bg-white border-t border-slate-200 py-6 mt-auto">
            <div class="page-container text-center text-sm text-slate-600">
                Copyright &copy; {{ date('Y') }} BAN-PDM Provinsi Jawa Timur
            </div>
        </footer>
    </div>

    <div id="modal-show" class="modal-wrapper modal-xl" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modal-show')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="card-header px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white">Daftar Pengunjung</h3>
                    <button type="button" onclick="modalManager.close('modal-show')" class="text-white hover:opacity-80" aria-label="Close">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto">
                    <div class="overflow-x-auto">
                        <table id="table-1" class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">No.</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800">Preview</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-200 flex justify-end bg-white">
                    <button type="button" onclick="modalManager.close('modal-show')" class="btn btn-secondary">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed top-4 right-4 z-[60] space-y-2" style="display: none;"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('jq-signature/jq-signature.min.js') }}"></script>
    <script>window.formV2SignatureEnabled = {{ ($config->signature_enabled ?? true) ? 'true' : 'false' }};</script>
    @if($fields->contains('tipe', 'date'))
    <script src="{{ asset('admin_theme/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    @endif
    <script>
        function showToast(message, type) {
            type = type || 'success';
            var c = document.getElementById('toast-container');
            if (!c) return;
            c.style.display = 'block';
            var bg = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6';
            var el = document.createElement('div');
            el.style.cssText = 'background:' + bg + ';color:#fff;padding:1rem 1.5rem;border-radius:0.5rem;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);';
            el.innerHTML = '<span>' + message + '</span>';
            c.appendChild(el);
            setTimeout(function() { el.remove(); if (c.children.length === 0) c.style.display = 'none'; }, 5000);
        }
        window.modalManager = {
            open: function(id) {
                var m = document.getElementById(id);
                if (m) { m.setAttribute('data-open', 'true'); document.body.style.overflow = 'hidden'; document.body.style.position = 'fixed'; document.body.style.width = '100%'; }
            },
            close: function(id) {
                var m = document.getElementById(id);
                if (m) { m.setAttribute('data-open', 'false'); document.body.style.overflow = ''; document.body.style.position = ''; document.body.style.width = ''; }
            }
        };
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') modalManager.close('modal-show'); });

        var blankSignature = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAqgAAADICAYAAAAk0xMvAAAAAXNSR0IArs4c6QAA";
        $(document).ready(function() {
            if (window.formV2SignatureEnabled) {
                $('.js-signature').jqSignature();
                $('#clearBtn').on('click', function() { $('.js-signature').jqSignature('clearCanvas'); });
            }

            @if($fields->contains('tipe', 'date'))
            $('.datepicker-v2').daterangepicker({
                locale: { format: 'DD-MM-YYYY' },
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
            @endif

            $('#modal-daftar').on('click', function() {
                modalManager.open('modal-show');
                if ($.fn.DataTable.isDataTable('#table-1')) {
                    $('#table-1').DataTable().ajax.reload(null, false);
                    return;
                }
                $('#table-1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { url: "{{ url('form-v2/' . $link) }}", type: 'GET' },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'created', name: 'created_at' },
                        { data: 'payload_preview', name: 'payload_preview', orderable: false }
                    ]
                });
            });

            $('#id-form').on('submit', function(e) {
                e.preventDefault();
                if (window.formV2SignatureEnabled) {
                    var currentSignature = $('.js-signature').jqSignature('getDataURL');
                    if (!currentSignature || currentSignature === blankSignature) {
                        showToast('Mohon untuk mengisi TTD terlebih dahulu', 'error');
                        return false;
                    }
                    $('#signature').val(currentSignature);
                }
                var formData = new FormData(this);
                var $btn = $('#btn-save');
                $btn.prop('disabled', true).find('span').text('Menyimpan...');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('form-v2/' . $link) }}",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        if (window.formV2SignatureEnabled) $('.js-signature').jqSignature('clearCanvas');
                        $('#id-form').trigger('reset');
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        showToast('Berkas telah tersimpan', 'success');
                        if ($.fn.DataTable.isDataTable('#table-1')) $('#table-1').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menyimpan', 'error');
                    }
                });
                return false;
            });
        });
    </script>
</body>
</html>

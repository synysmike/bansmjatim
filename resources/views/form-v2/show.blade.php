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
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,500;0,8..60,600;0,8..60,700;1,8..60,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    @include('ad_layout.partials.theme_styles')
    <style>
        :root {
            --form-v2-ink: #1e293b;
            --form-v2-muted: #64748b;
            --form-v2-border: #e2e8f0;
            --form-v2-accent: #0f172a;
            --form-v2-paper: #ffffff;
            --form-v2-bg: #f8fafc;
        }
        body.form-v2-page {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 15px;
            color: var(--form-v2-ink);
            background: var(--form-v2-bg);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        .form-v2-page .font-formal { font-family: 'Source Serif 4', Georgia, serif; }
        .form-v2-page .page-wrap { min-height: 100vh; display: flex; flex-direction: column; }
        .form-v2-page .page-main { flex: 1; padding: 2.5rem 1rem 3rem; }
        .form-v2-page .page-container { max-width: 36rem; margin: 0 auto; }
        .form-v2-page .brand-block {
            text-align: center;
            padding: 1.5rem 0 2rem;
            border-bottom: 1px solid var(--form-v2-border);
        }
        .form-v2-page .brand-block .brand-logo { display: block; height: 48px; margin: 0 auto 0.75rem; }
        .form-v2-page .brand-block .brand-org {
            font-family: 'Source Serif 4', Georgia, serif;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--form-v2-ink);
            letter-spacing: 0.02em;
        }
        .form-v2-page .brand-block .brand-sub {
            font-size: 0.8125rem;
            color: var(--form-v2-muted);
            margin-top: 0.25rem;
        }
        .form-v2-page .form-card {
            background: var(--form-v2-paper);
            border: 1px solid var(--form-v2-border);
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            overflow: hidden;
            margin-top: 2rem;
        }
        .form-v2-page .form-card-head {
            background: var(--form-v2-accent);
            color: #fff;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--form-v2-accent);
        }
        .form-v2-page .form-card-head h2 {
            font-family: 'Source Serif 4', Georgia, serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 0.01em;
        }
        .form-v2-page .form-card-body { padding: 1.75rem 1.5rem; }
        .form-v2-page .form-group { margin-bottom: 1.5rem; }
        .form-v2-page .form-group:last-of-type { margin-bottom: 0; }
        .form-v2-page .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--form-v2-ink);
            margin-bottom: 0.5rem;
        }
        .form-v2-page .form-label .required { color: #b91c1c; }
        .form-v2-page .form-hint { font-size: 0.8125rem; color: var(--form-v2-muted); margin-top: 0.375rem; }
        .form-v2-page input[type="text"],
        .form-v2-page input[type="email"],
        .form-v2-page input[type="number"],
        .form-v2-page input[type="date"],
        .form-v2-page select,
        .form-v2-page textarea {
            width: 100%;
            padding: 0.625rem 0.75rem;
            font-size: 0.9375rem;
            font-family: inherit;
            color: var(--form-v2-ink);
            background: #fff;
            border: 1px solid var(--form-v2-border);
            border-radius: 4px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .form-v2-page input:focus,
        .form-v2-page select:focus,
        .form-v2-page textarea:focus {
            outline: none;
            border-color: var(--form-v2-accent);
            box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.08);
        }
        .form-v2-page .sig-block {
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--form-v2-border);
        }
        .form-v2-page .js-signature {
            border: 1px solid var(--form-v2-border) !important;
            border-radius: 4px;
            background: #fafafa !important;
        }
        .form-v2-page .btn-group { margin-top: 1.75rem; padding-top: 1.5rem; border-top: 1px solid var(--form-v2-border); display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; }
        .form-v2-page .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.9375rem;
            font-weight: 500;
            font-family: inherit;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
            border: 1px solid transparent;
        }
        .form-v2-page .btn-primary {
            background: var(--form-v2-accent);
            color: #fff;
            border-color: var(--form-v2-accent);
        }
        .form-v2-page .btn-primary:hover:not(:disabled) { background: #1e293b; border-color: #1e293b; }
        .form-v2-page .btn-primary:disabled { opacity: 0.7; cursor: not-allowed; }
        .form-v2-page .btn-outline {
            background: #fff;
            color: var(--form-v2-ink);
            border-color: var(--form-v2-border);
        }
        .form-v2-page .btn-outline:hover { background: #f8fafc; border-color: var(--form-v2-accent); color: var(--form-v2-accent); }
        .form-v2-page .btn-danger {
            background: #fff;
            color: #b91c1c;
            border-color: #fecaca;
            font-size: 0.875rem;
        }
        .form-v2-page .btn-danger:hover { background: #fef2f2; border-color: #b91c1c; }
        .form-v2-page .page-footer {
            margin-top: auto;
            padding: 1.5rem 1rem;
            text-align: center;
            font-size: 0.8125rem;
            color: var(--form-v2-muted);
            border-top: 1px solid var(--form-v2-border);
            background: var(--form-v2-paper);
        }
        .form-v2-page .modal-wrapper .modal-content { border-radius: 4px; border: 1px solid var(--form-v2-border); }
        .form-v2-page .modal-wrapper .card-header {
            background: var(--form-v2-accent);
            color: #fff;
            padding: 1rem 1.25rem;
            font-family: 'Source Serif 4', Georgia, serif;
            font-size: 1.125rem;
        }
        .form-v2-page #table-1 { font-size: 0.875rem; }
        .form-v2-page #table-1 th { background: #f8fafc; font-weight: 600; color: var(--form-v2-ink); }
    </style>
</head>
<body class="form-v2-page min-h-screen">
    <div id="app" class="page-wrap">
        <main class="page-main">
            <div class="page-container">
                <header class="brand-block">
                    <img src="{{ asset('ban.png') }}" alt="Logo" class="brand-logo">
                    <div class="brand-org">Badan Akreditasi Nasional Pendidikan Anak Usia Dini, Pendidikan Dasar, dan Pendidikan Menengah</div>
                    <div class="brand-sub">Provinsi Jawa Timur</div>
                </header>

                <div class="form-card">
                    <div class="form-card-head">
                        <h2>Daftar Hadir {{ $judul ?? 'Form' }} pada tanggal {{ $today ?? now()->format('d-m-Y') }}</h2>
                    </div>
                    <div class="form-card-body">
                        <form id="id-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kat_dh" id="kat_dh" value="{{ $kategori ?? '' }}">

                            @foreach($fields as $field)
                                @include('form-v2.field', ['field' => $field])
                            @endforeach

                            @if($config->signature_enabled ?? true)
                            <div class="form-group sig-block" id="signature-block">
                                <input type="hidden" id="signature" name="signature">
                                <label for="sig" class="form-label">Tanda Tangan <span class="required">*</span></label>
                                <div class="form-hint">Gunakan mouse atau jari untuk menandatangani di bawah ini.</div>
                                <div class="mt-2">
                                    <div class="js-signature overflow-hidden bg-white" data-width="600" data-height="200" data-border="1px solid #e2e8f0" data-line-color="#1e293b" data-auto-fit="true"></div>
                                </div>
                                <div id="errsign" class="text-red-600 text-sm mt-1"></div>
                                <button type="button" id="clearBtn" class="btn btn-danger mt-2">Ulangi Tanda Tangan</button>
                            </div>
                            @endif

                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id="btn-save">
                                    <i class="fas fa-pen-to-square"></i>
                                    <span>Simpan</span>
                                </button>
                                <button type="button" id="modal-daftar" class="btn btn-outline">
                                    <i class="fas fa-list"></i>
                                    <span>Lihat Daftar Pengunjung</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer class="page-footer">
            &copy; {{ date('Y') }} BAN-PDM Provinsi Jawa Timur. Hak Cipta Dilindungi.
        </footer>
    </div>

    <div id="modal-show" class="modal-wrapper modal-xl" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modal-show')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="card-header px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white">Daftar Pengunjung</h3>
                    <button type="button" onclick="modalManager.close('modal-show')" class="text-white hover:opacity-80" aria-label="Tutup">
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
                    <button type="button" onclick="modalManager.close('modal-show')" class="btn btn-outline">Tutup</button>
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
            var bg = type === 'success' ? '#0f172a' : type === 'error' ? '#b91c1c' : '#475569';
            var el = document.createElement('div');
            el.style.cssText = 'background:' + bg + ';color:#fff;padding:0.875rem 1.25rem;border-radius:4px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);font-size:0.9375rem;';
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
                        showToast('Mohon mengisi tanda tangan terlebih dahulu.', 'error');
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
                        showToast('Data berhasil disimpan.', 'success');
                        if ($.fn.DataTable.isDataTable('#table-1')) $('#table-1').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Gagal menyimpan.', 'error');
                    }
                });
                return false;
            });
        });
    </script>
</body>
</html>

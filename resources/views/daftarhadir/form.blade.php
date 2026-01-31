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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
                <p class="text-sm text-muted mb-6">{{ $judul ?? 'Form' }}</p>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">{{ $judul ?? 'Form' }} BAN-PDM JAWA TIMUR</h2>
                    </div>
                    <div class="p-6">
                        <form id="id-form" enctype="multipart/form-data">
                            {!! $kategori !!}
                            @if (isset($ass) && $ass !== null)
                                <div class="form-group mb-6">
                                    <label for="selectValue" class="form-label">Pilih Nama :</label>
                                    <select id="selectValue" name="nia_ass" class="form-control w-full" required>
                                        <option value="">--Pilih Nama--</option>
                                        @foreach ($ass as $nama)
                                            <option value="{{ $nama->nia }}">{{ $nama->nia }} {{ $nama->nama_tanpa_gelar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @foreach ($form as $key)
                                {!! $key->tag_field !!}
                            @endforeach

                            <div class="form-group mb-6">
                                <input type="hidden" id="kat_dh" name="kat_dh" value="{{ $kat }}">
                                <input type="hidden" id="signature" name="signature">
                                <label for="sig" class="form-label">Tandatangan :</label>
                                <div class="mt-2">
                                    <div class="js-signature border border-slate-200 rounded-lg overflow-hidden bg-white" data-width="600" data-height="200" data-border="1px solid #e2e8f0" data-line-color="#000000" data-auto-fit="true"></div>
                                </div>
                                <div id="errsign" class="text-red-600 text-sm mt-1"></div>
                                <button type="button" id="clearBtn" class="btn btn-danger mt-2">Ulangi TTD</button>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 pt-4">
                                <button type="submit" class="btn btn-primary inline-flex items-center gap-2" id="btn-save">
                                    <i class="fas fa-save"></i>
                                    <span>Simpan</span>
                                </button>
                                <button type="button" id="modal-2" class="btn btn-info inline-flex items-center gap-2">
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
                Copyright &copy; 2022 &middot; BAN-PDM Provinsi Jawa Timur &middot; ir.teguh IT BANPDMJATIM
            </div>
        </footer>
    </div>

    <!-- Modal: Lihat pengunjung -->
    <div id="modal-show" class="modal-wrapper modal-xl" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modal-show')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="card-header px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white">{{ $judul ?? 'Daftar' }}</h3>
                    <button type="button" onclick="modalManager.close('modal-show')" class="text-white hover:opacity-80" aria-label="Close">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200" id="table-1">
                            <thead class="bg-slate-100">
                                <tr>
                                    @foreach ($theads as $tbh)
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-800 uppercase tracking-wider">{{ $tbh }}</th>
                                    @endforeach
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

    <!-- Modal: Success (Cetak Hasil) -->
    <div id="modal-success" class="modal-wrapper modal-sm" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('modal-success')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-slate-800 mb-2">Berhasil</h4>
                    <p class="text-slate-600 mb-6">Berkas telah tersimpan.</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <button type="button" onclick="modalManager.close('modal-success')" class="btn btn-secondary">Tutup</button>
                        <a id="btn-cetak-hasil" href="#" target="_blank" class="btn btn-primary inline-flex items-center gap-2">
                            <i class="fas fa-print"></i>
                            <span>Cetak Hasil</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed top-4 right-4 z-[60] space-y-2" style="display: none;"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin_theme/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('jq-signature/jq-signature.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('admin_theme/library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/cleave.js/dist/addons/cleave-phone.id.js') }}"></script>
    <script>
        function showToast(message, type) {
            type = type || 'success';
            var container = document.getElementById('toast-container');
            if (!container) return;
            container.style.display = 'block';
            var bg = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#3b82f6';
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
            if ($('#selectValue').length) {
                $('#selectValue').select2({ placeholder: "Pilih nama | Ketik nama/NIA anda di sini, lalu pilih nama anda" });
            }
            if (typeof Cleave !== 'undefined') {
                try { new Cleave(".phone-number", { phone: true, phoneRegionCode: "id" }); } catch (e) {}
            }
            $('.datepicker').daterangepicker({
                locale: { format: 'DD-MM-YYYY' },
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
            $('.js-signature').jqSignature();
            $('#clearBtn').on('click', function() { $('.js-signature').jqSignature('clearCanvas'); });
            function limitMe(e) {
                if (e.keyCode === 8) return true;
                return this.value.length < parseInt($(this).attr("maxLength") || 999, 10);
            }
            $('input[type="number"]#title, number#title').attr('maxLength', '8').on('keypress', limitMe);

            $('#modal-2').on('click', function() {
                modalManager.open('modal-show');
                if ($.fn.DataTable.isDataTable('#table-1')) {
                    $('#table-1').DataTable().ajax.reload(null, false);
                    return;
                }
                var label = @json($unit ?? []);
                var columns = [];
                $.each(label, function(k, v) { columns.push({ name: v, data: v }); });
                $('#table-1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { url: '{{ $link ?? "" }}', type: 'GET' },
                    columns: columns,
                    bAutoWidth: false
                });
                new $.fn.dataTable.Buttons($('#table-1').DataTable(), { buttons: ['copy', 'csv', 'pdf'] });
                $('#table-1').DataTable().buttons(0, null).container().prependTo($('#table-1').closest('.overflow-x-auto'));
            });

            $("#jumlah_progli").on('change', function() {
                if (this.value === "lain") {
                    $("#jumlah_progli").remove();
                    $("#field_progli").append("<input required id='jumlah_progli' placeholder='Masukan Jumlah Progli' name='jumlah_progli' class='form-control w-full' type='text'>");
                }
            });
            $(".daftar_progli").summernote({
                dialogsInBody: true,
                placeholder: 'Progli 1 :, Progli 2 :, Progli 3:, dan seterusnya... (Wajib Diakhiri (,) koma di setiap progli)',
                minHeight: 150,
                toolbar: [ ['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough']], ['para', ['paragraph']] ]
            });

            var blankSignature = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAqgAAADICAYAAAAk0xMvAAAAAXNSR0IArs4c6QAACy9JREFUeF7t1jERAAAMArHi33Rv/JAq4EIHdo4AAQIECBAgQIBASGChLKIQIECAAAECBAgQOAPVExAgQIAAAQIECKQEDNRUHcIQIECAAAECBAgYqH6AAAECBAgQIEAgJWCgpuoQhgABAgQIECBAwED1AwQIECBAgAABAikBAzVVhzAECBAgQIAAAQIGqh8gQIAAAQIECBBICRioqTqEIUCAAAECBAgQMFD9AAECBAgQIECAQErAQE3VIQwBAgQIECBAgICB6gcIECBAgAABAgRSAgZqqg5hCBAgQIAAAQIEDFQ/QIAAAQIECBAgkBIwUFN1CEOAAAECBAgQIGCg+gECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIGUgIGaqkMYAgQIECBAgAABA9UPECBAgQIECAAIPCDEAyXM/m1YAAAAASUVORK5CYII=";

            $('#id-form').on('submit', function(e) {
                e.preventDefault();
                var currentSignature = $('.js-signature').jqSignature('getDataURL');
                if (currentSignature === blankSignature) {
                    showToast('Mohon untuk mengisi TTD terlebih dahulu', 'error');
                    return false;
                }
                $('#signature').val(currentSignature);
                var formData = new FormData(this);
                var $btn = $('#btn-save');
                $btn.prop('disabled', true).find('span').text('Menyimpan...');
                $.ajax({
                    type: "POST",
                    url: "{{ $link ?? '' }}",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.js-signature').jqSignature('clearCanvas');
                        $('#id-form').trigger("reset");
                        $btn.prop('disabled', false).find('span').text('Simpan');
                        showToast('Berkas telah tersimpan', 'success');
                        $('#btn-cetak-hasil').attr('href', 'https://banpdmjatim.id/print_biodata/rakorda?_token=' + (data.id || ''));
                        modalManager.open('modal-success');
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

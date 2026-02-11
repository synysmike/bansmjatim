@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="{{ asset('admin_theme/library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_theme/library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('admin-container')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(isset($id))
                        <div class="card-header bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-white">{{ $tittle ?? 'Report Daftar Hadir' }}</h2>
                            <a href="{{ route('report_dh.pdf', $id) }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                                <i class="fas fa-file-pdf admin-icon"></i>
                                <span>Export PDF</span>
                            </a>
                        </div>
                        @endif
                        <div id="kolom" class="card-body">
                            <div class="table-1">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Nama</td>
                                            <td>Tanggal</td>
                                            <td>Kegiatan</td>
                                            <td>Ttd</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('js-custom')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin_theme/library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('jq-signature/jq-signature.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ url()->current() }}", // this page url
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'nama_judul',
                        name: 'nama_judul'
                    },
                    {
                        data: 'ttd',
                        name: 'ttd',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush

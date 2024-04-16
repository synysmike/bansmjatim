@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="admin_theme/library/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
@endpush
@section('admin-container')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Hadir</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">NPSN</th>
                                            <th class="text-center">NIA</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Nama Lembaga</th>
                                            <th class="text-center">Kab./Kota</th>
                                            <th class="text-center">jabatan</th>
                                            <th class="text-center">Alamat kantor</th>
                                            <th class="text-center">HP</th>
                                            <th class="text-center">Kategori DH</th>
                                            <th class="text-center">TTD</th>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-custom')
    <script src="admin_theme/library/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin_theme/library/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <!-- Page Specific JS File -->
    {{-- <script src="admin_theme/js/page/bootstrap-modal.js"></script> --}}
    <script>
        $(document).ready(function() {
            //datatable yajra
            var table = $('#table-1').DataTable({
                processing: true,
                // serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "/dhtable", // ambil data
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'npsn',
                        name: 'npsn'
                    },
                    {
                        data: 'nia',
                        name: 'nia'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nama_lembaga',
                        name: 'nama_lembaga'
                    },
                    {
                        data: 'kabkota',
                        name: 'kabkota'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'alamat_kantor',
                        name: 'alamat_kantor'
                    },
                    {
                        data: 'hp',
                        name: 'hp'
                    },
                    {
                        data: 'kat_dh',
                        name: 'kat_dh'
                    },

                    {
                        data: 'ttd',
                        name: 'ttd'
                    },
                    
                ],
            });
        });
    </script>
@endpush

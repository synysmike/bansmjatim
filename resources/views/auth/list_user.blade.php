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
                            <h4>datatable user</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> No. </th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Kab./Kota</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Aksi</th>
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            //datatable yajra
            var table = $('#table-1').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                ajax: {
                    url: "/user", // ambil data
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'kab_kota',
                        name: 'kab_kota'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
            });
            // ** HAPUS DATA * / 
            $(document).on('click', '.delete', function() {
                dataId = $(this).attr('id');
                console.log(dataId);
                swal({
                    dangerMode: true,
                    title: 'Apakah Anda Yakin?',
                    text: 'Data akan dihapus permanen',
                    icon: 'warning',
                    buttons: ["Tidak", "Iya"],
                }).then(function(value) {
                    if (value) {
                        $.ajax({
                            type: "DELETE",
                            url: "/user/" + dataId,
                            success: function(data) {
                                var oTable = $("#table-1").dataTable();
                                oTable.fnDraw(false);
                                swal("Berhasil", "Data telah terhapus", "success");
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush

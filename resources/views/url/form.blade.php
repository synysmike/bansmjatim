@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="admin_theme/library/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
@endpush
@section('admin-container')
    <section>
        <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
            aria-hidden="true">
            <form id="id-form" action="post">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">Title</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Masukan Sumber alamat situs</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input id="judul" name="judul" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Sumber Link</label>
                                                <input name="long_url" type="text" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" type="text" class="form-control summernote-simple"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Generate/Edit Shorten Link</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Shorten link</label>
                                                <input id="set-slug"  type="text" class="form-control">
                                                <input id="slug" name="slug" type="hidden" class="form-control">
                                                <input id="short_url" name="short_url" type="hidden" class="form-control">
                                                <p><strong>Hasil generate :</strong></p>
                                                <p id="preview-link"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group text-right">
                                <button id="form_submit" type="submit" class="button btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Shorten link</h4>
                        </div>
                        <div class="card-body">
                            <button class="button btn btn-primary mb-3 text-right show-btn" id="modal">Tambah</button>
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> No. </th>
                                            <th class="text-center"> Judul </th>
                                            <th class="text-center"> Long URL </th>
                                            <th class="text-center"> Short URL </th>
                                            <th class="text-center" style="width:15%"> Action</th>

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
    <script src="admin_theme/library/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <!-- Page Specific JS File -->
    {{-- <script src="admin_theme/js/page/bootstrap-modal.js"></script> --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            var table = $('#table-1').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "/link/", // ambil data
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'long_url',
                        name: 'long_url'
                    },
                    {
                        data: 'short_url',
                        name: 'short_url'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
            });

            table.buttons(0, null).container().prependTo(
                table.table().container()
            );
            $(document).on('click', '.go-btn', function() {

                var judul = $(this).data('name');
                var url = $(this).data('url');
                swal("Mengalihkan...",
                "Anda Akan dialihkan ke halaman "+judul,
                "info");
                // window.location.href = url;
                window.open(url, '_blank');
                
            });
            $(document).on('click', '.show-btn', function() {
                $('#id-form').trigger("reset");
                $("#my-modal").modal('show');
                $(".summernote-simple").summernote();
                $("#judul").keyup(function() {
                    let text = $(this).val();
                    let find = /[^a-zA-Z0-9 ]| /gi;
                    let value = text.replace(find, "-");
                    $("#set-slug").val(value);
                    var prev = $("#set-slug").val();
                    var low_prev = prev.toLowerCase();
                    $("#preview-link").html("https://form.bansmprovjatim.com/link/" + low_prev);
                    $("#short_url").val("https://form.bansmprovjatim.com/link/" + low_prev);
                    $("#slug").val(low_prev);
                });
                $("#set-slug").keyup(function() {
                    var prev = $("#set-slug").val();
                    var low_prev = prev.toLowerCase();
                    $("#preview-link").html("https://form.bansmprovjatim.com/link/" + low_prev);
                    $("#short_url").val("https://form.bansmprovjatim.com/link/" + low_prev);
                    $("#slug").val(low_prev);
                });


                if ($("#id-form").length > 0) {
                        $("#id-form").validate({
                            // validasi mime type
                            rules: {
                                //idfield
                                document: {
                                    // wajib
                                    extension: "pdf", // ekstensi pdf
                                    filesize: 2097152, // ukuran file < 2mb
                                },
                                // nama : {
                                //     required : true,
                                // }
                            },
                            messages: {
                                //pesan error diambil dari atribut
                                document: {
                                    required: "Tidak Boleh Kosong",
                                    extension: "Mohon mengunggah dokumen berekstensi *pdf"
                                }
                            },
                            submitHandler: function(form) {
                                var actionType = $('#form_submit').val();
                                var formData = new FormData(form);
                                $('#form_submit').html('Menyimpan . .');
                                $.ajax({
                                    type: "POST",
                                    url: "/link",
                                    data: formData,
                                    dataType: 'json',
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        // console.log(response);
                                        $('#form-tambah-edit').trigger(
                                            "reset");
                                        $('#my-modal').modal(
                                            "hide");
                                        $('#form_submit').html('Simpan');
                                        //Reload Total Finansial Planing
                                        swal("Berhasil",
                                            "Berkas telah tersimpan",
                                            "success");
                                        // refresh yajra datatable
                                        var oTable = $("#table-1")
                                            .dataTable();
                                        oTable.fnDraw(false);
                                    },
                                    error: function(data) {
                                        console.log('Error', data);
                                        $('#errkcmtn').text(data
                                            .responseJSON.errors
                                            .kecamatan);
                                        $('#form_submit').html(
                                            'Gagal Simpan, mohon diperbaiki lalu klik saya lagi'
                                        );
                                    }
                                });
                            }
                        });
                    }
            });

            // ** HAPUS DATA * / 
            $(document).on('click', '.del-btn', function() {
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
                            url: "link/" + dataId,
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

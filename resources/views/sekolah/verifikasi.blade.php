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
                            <p style="-webkit-text-fill-color: red;"><strong>MOHON PERHATIAN</strong></br>
                                - Mohon cek dengan teliti format surat permohonan</br>
                                - SK/Ijop untuk Lembaga Madrasah (dibawah KEMENAG) memang tidak memiliki Masa berakhir</br>
                                - Cek Dokumen Sertifikat Akreditasi hanya untuk lembaga Berstatus non-BT (Bukan Lembaga
                                Baru)</p>
                            
                        </div>
                        
                        <div class="card-body">
                            <div id="total">
                                <><p id="hasil"></p><>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NPSN</th>
                                            <th>Nama Sekolah/Madrasah</th>
                                            <th>Kab./Kota</th>
                                            <th>Status</th>
                                            <th>Cek Berkas</th>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-show">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <form id="id-form" action="" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="tittle">Cek Dokumen Upload</br></h4>
                    </div>
                    <div class="modal-body">
                        <p style="-webkit-text-fill-color: red;">*Arahkan mouse ke salah satu berkas, lalu tekan "CTRL" pada
                            keyboard dan naik/turunkan skrol
                            pada mouse untuk membesar atau memperkecil gambar.</p>
                        <div class="row">
                            <div class="col-4">
                                <h4>Surat Permohonan</h4>
                                <div class="col12">
                                    <h3 style="-webkit-text-fill-color: red;" id="prerr">belum upload</h3>
                                    <iframe id="pr" src="" width="100%" height="500px"></iframe>
                                    <a href="" id="linkpr" target="_blank" class="btn btn-lg btn-dark">Buka di tab
                                        baru</a>
                                    <input type="hidden" name="id" id="id">
                                </div>
                                </br>
                                <div class="col-12">
                                    <p><strong>Apakah Surat permohonan sudah benar?</strong></p>
                                    <input type="radio" id="prsudah" value="1" name="pr"
                                        class="form-control-input">
                                    <label class="col-form-label" for="prsudah">Sudah</label>
                                    <input type="radio" id="prbelum" value="0" name="pr"
                                        class="form-control-input">
                                    <label class="col-form-label" for="prbelum">Belum</label>
                                </div>
                                <div id="errpr"></div>
                                <div class="col-12" id="alasanpr">
                                    <p><strong>Alasan Belum :</strong></p>
                                    <textarea name="alasanpr" data-height="150" class="form-control alasanpr"></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4>SK/Ijop</h4>
                                <div class="col-12">
                                    <h3 style="-webkit-text-fill-color: red;" id="skerr">belum upload</h3>
                                    <iframe id="sk" src="" width="100%" height="500px"></iframe>
                                    <a href="" id="linksk" target="_blank" class="btn btn-lg btn-dark">Buka di tab
                                        baru</a>
                                </div>
                                </br>
                                <div class="col-12">
                                    <p><strong>Apakah SK/IJOP sudah benar?</strong></p>
                                    <input type="radio" id="sksudah" value="1" name="sk"
                                        class="form-control-input">
                                    <label class="col-form-label" for="sksudah">Sudah</label>
                                    <input type="radio" id="skbelum" value="0" name="sk"
                                        class="form-control-input">
                                    <label class="col-form-label" for="skbelum">Belum</label>
                                </div>
                                <div id="errsk"></div>
                                <div class="col-12" id="alasansk">
                                    <p><strong>Alasan Belum :</strong></p>
                                    <textarea name="alasansk" data-height="150" class="form-control alasansk"></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4>Sertifikat Akreditasi</h4>
                                <div class="col-12">
                                    <h3 style="-webkit-text-fill-color: red;" id="saerr">belum upload</h3>
                                    <iframe id="sa" src="" width="100%" height="500px"></iframe>
                                    <a href="" id="linksa" target="_blank" class="btn btn-lg btn-dark">Buka di
                                        tab
                                        baru</a>
                                </div>
                                </br>
                                <div class="col-12">
                                    <p><strong>Apakah Sertifikat Akreditasi sudah benar?</strong></p>
                                    <input type="radio" id="sasudah" value="1" name="sa"
                                        class="form-control-input">
                                    <label class="col-form-label" for="sasudah">Sudah</label>
                                    <input type="radio" id="sabelum" value="0" name="sa"
                                        class="form-control-input">
                                    <label class="col-form-label" for="sabelum">Belum</label>
                                </div>
                                <div id="errsa"></div>
                                <div class="col-12" id="alasansa">
                                    <p><strong>Alasan Belum :</strong></p>
                                    <textarea name="alasansa" data-height="150" class="form-control alasansa"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="form_submit" type="submit" class="btn btn-primary">Simpan Verifikasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
            $("#total").load("/total", "data", function(response, status, request) {

                $('#total').html('Total Sasaran Lembaga RE 2023 yang sudah diverifikasi : ' +
                response); // dom element                
            });
            //datatable yajra
            var table = $('#table-1').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "/verifikasi", // ambil data
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
                        data: 'nama',
                        name: 'nama'
                    },

                    {
                        data: 'kabkota',
                        name: 'kabkota'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },


                    {
                        data: 'aksi',
                        name: 'aksi'
                    }

                ],
            });
            $(document).on('click', '.show-btn', function() {
                $('#id-form').trigger("reset");
                $(".alasanpr").summernote('reset');
                $(".alasansk").summernote('reset');
                $(".alasansa").summernote('reset');
                var data_id = $(this).data('id');
                $.get("/verifikasi/" + data_id, function(data) {
                    // $("#modal-judul").html("Edit Data");
                    // $("tombol-simpan").val("edit-post");
                    $("#modal-show").modal('show');
                    $('#id').val(data.id);
                    $('#tittle').text('Cek Dokumen Upload ' + data.nama);
                    if (data.sk == 'X') {
                        $('#skerr').show();
                        $('#sk').hide();
                        $('#skerr').text('SK belum diunggah');
                    } else {
                        $('#sk').show();
                        $('#skerr').hide();
                        $('#sk').attr('src', data.sk);
                    }

                    if (data.sa == 'X') {
                        $('#saerr').show();
                        $('#sa').hide();
                        $('#saerr').text('Sertifikat akreditasi belum diunggah');
                    } else {
                        $('#sa').show();
                        $('#saerr').hide();
                        $('#sa').attr('src', data.sa);
                    }

                    if (data.pr == 'X') {
                        $('#prerr').show();
                        $('#pr').hide();
                        $('#prerr').text('Surat Permohonan belum diunggah');

                    } else {
                        $('#pr').show();
                        $('#prerr').hide();
                        $('#pr').attr('src', data.pr);
                    }

                    $('#linksk').attr('href', data.sk);
                    $('#linksa').attr('href', data.sa);
                    $('#linkpr').attr('href', data.pr);
                    $(".alasanpr").summernote({
                        dialogsInBody: true,
                        minHeight: 150,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough']],
                            ['para', ['paragraph']]
                        ]
                    });
                    $(".alasansk").summernote({
                        dialogsInBody: true,
                        minHeight: 150,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough']],
                            ['para', ['paragraph']]
                        ]
                    });
                    $(".alasansa").summernote({
                        dialogsInBody: true,
                        minHeight: 150,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough']],
                            ['para', ['paragraph']]
                        ]
                    });
                    // $('#id').val(data.id);
                    // $('#npsnhd').val(data.npsn);
                    $('#alasanpr').hide();
                    $('#alasansk').hide();
                    $('#alasansa').hide();
                    $('#prbelum').click(function() {
                        $('#alasanpr').show();

                    });
                    $('#skbelum').click(function() {
                        $('#alasansk').show();

                    });
                    $('#sabelum').click(function() {
                        $('#alasansa').show();

                    });
                    $('#prsudah').click(function() {
                        $('#alasanpr').hide();

                    });
                    $('#sksudah').click(function() {
                        $('#alasansk').hide();

                    });
                    $('#sasudah').click(function() {
                        $('#alasansa').hide();

                    });

                    if ($("#id-form").length > 0) {
                        $("#id-form").validate({
                            // validasi mime type
                            submitHandler: function(form) {
                                var actionType = $('#form_submit').val();
                                var formData = new FormData(form);
                                $('#form_submit').html('Menyimpan . .');
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('verifikasi.store') }}",
                                    data: formData,
                                    dataType: 'json',
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        // console.log(response);
                                        $("#total").load("/total", "data",
                                            function(response, status,
                                                request) {
                                                $('#total').html(
                                                    'Total Sasaran Lembaga RE 2023 yang sudah diverifikasi :' +
                                                    response
                                                    ); // dom element                
                                            });
                                        $('#id-form').trigger(
                                            "reset");
                                        $(".alasanpr").summernote('reset');
                                        $(".alasansk").summernote('reset');
                                        $(".alasansa").summernote('reset');
                                        $('#modal-show').modal(
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

                                        $('#errpr').text(
                                            'mohon dipilih dulu').attr(
                                            'style',
                                            '-webkit-text-fill-color: red;'
                                            );
                                        $('#errsk').text(
                                            'mohon dipilih dulu').attr(
                                            'style',
                                            '-webkit-text-fill-color: red;'
                                            );
                                        $('#errsa').text(
                                            'mohon dipilih dulu').attr(
                                            'style',
                                            '-webkit-text-fill-color: red;'
                                            );
                                        $('#form_submit').html(
                                            'Gagal Simpan, mohon diperbaiki lalu klik saya lagi'
                                        );
                                    }
                                });
                            }
                        });
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



            });
        });
    </script>
@endpush

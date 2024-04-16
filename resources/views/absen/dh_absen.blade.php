@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="admin_theme/library/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('admin-container')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div id="kolom" class="card-body">
                            <h5 class="card-title">Form Kegiatan {{ $tittle }} tanggal {{ $format_tgl }}</h5>
                            <form id="id-form" enctype="multipart/form-data">
                                <div class="col-8">
                                    <div class="form-group pb-3">
                                        <label>Pilih Nama :</label>
                                        <input hidden class="form-control" type="text" name="judul" value="{{ $tittle }}">
                                        {{-- <input hidden class="form-control" type="text" name="" value="{{ $tittle }}"> --}}
                                        <select required id="select-nama" name="nama" class="form-control">
                                            <option value="">--Pilih Nama--</option>
                                            @foreach ($namas as $nama)
                                                <option value = "{{ $nama->id }}">{{ $nama->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='form-group '>
                                        <input required type='hidden' id='signature' name='signature'>
                                        <label for="sig">Tandatangan :</label>
                                        </br>
                                        <div class="js-signature" data-width="responsive" data-height="responsive"
                                            data-border="1px solid black" data-line-color="#000000" data-auto-fit="true">
                                        </div>
                                        <div id="errsign" class="alert-danger"></div>
                                        <button id="clearBtn" class="btn btn-danger">Ulangi TTD</button>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-icon icon-right"
                                        id="btn-save">simpan</button>
                                        <button id="list" class= 'btn btn-outline-info'> Daftar absen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="my-modal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Daftar Hadir Kegiatan</h4>
                </div>
                <div class="modal-body">
                    <div class="table-">
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
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div id="my-modal" class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl fade " tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js-custom')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="admin_theme/library/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin_theme/library/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('jq-signature/jq-signature.min.') }}js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <!-- Page Specific JS File -->
    {{-- <script src="admin_theme/js/page/bootstrap-modal.js"></script> --}}
    <script>
        $(document).ready(function() {
            var cek = "{{ $act }}";
            if(cek == 0){
                // console.log();
                $("#kolom *").prop('disabled',true);
                $("#kolom *").hide()
                $("#kolom").append("<p>Form absen masih belum dibuka, silahkan menghubungi <a href='https://wa.me/6281332444088' target='_blank'>Teguh</a> Atau <a href='https://wa.me/6287712813719' target='_blank'>Guntur</a></p>")
            }
            // console.log(cek);
            
            $("#select-nama").select2();
            //modal button
            $(document).on('click', '#list', function(e) {
                e.preventDefault();
                $("#my-modal").modal('show');
            });
            //js-signature
            $('.js-signature').jqSignature();
            //clear sign button
            $('#clearBtn').click(function(e) {
                e.preventDefault();
                $('.js-signature').jqSignature('clearCanvas');
                // $('#btn-save').attr('disabled', true);                
            });
            //datatable yajra
            var table = $('#table-1').DataTable({
                "bAutoWidth": false,
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "/dh_absen", // ambil data
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width : '5%'
                    },

                    {
                        data: 'nama',
                        name: 'nama',
                        
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        
                    },

                    {
                        data: 'nama_judul',
                        name: 'nama_judul',
                        
                    },
                    {
                        data: 'ttd',
                        name: 'ttd',
                        width : '10%'
                    },

                ],               
                
                aLengthMenu: [
                    [10, 50, 100, 200, -1],
                    [10, 50, 100, 200, "All"]
                ],
            });
            new $.fn.dataTable.Buttons(table, {
                buttons: [{
                    text: 'Reload',
                    action: function(e, dt, node, config) {
                        dt.ajax.reload();
                    }
                }],
            });
            table.buttons(0, null).container().prependTo(
                table.table().container()
            );
            $(document).on('submit', '#id-form', function(e) {
                e.preventDefault();
                var dataUrl = $('.js-signature').jqSignature('getDataURL');
                var img = dataUrl;
                // // // console.log(img)
                var anchor = $("#signature");
                anchor.val(img);
                // console.log(cek.val());
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "/dh_absen",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#id-form').trigger(
                            "reset");
                            $('.js-signature').jqSignature('clearCanvas');
                        // window.location.reload()
                        $('#btn-save').html('Tersimpan');
                        //Reload Total Finansial Planing
                        swal("Berhasil",
                            "Berkas telah tersimpan",
                            "success");
                        var oTable = $("#table-1")
                            .dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#errnama').text('Mohon Mengisi Nama');
                    }
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endpush

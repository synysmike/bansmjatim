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
                            <div class="card-body">
                                <h5 class="card-title">Form Judul Kegiatan ...</h5>
                                <form id="id-form">
                                    <div class="col-8">
                                        <div class="form-group pb-3">
                                            <label>Nama Kegiatan</label>
                                            <input name="judul" id="judul" type="text" class="form-control">
                                        </div>
                                        <div class="form-group pb-3">
                                            <label>Pilih Tanggal</label>
                                            <input id="datepicker" type="text" class="form-control datepicker">
                                            <input name="tanggal" id="tanggal" type="text" class="form-control" hidden>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="control-label">Aktifkan kolom</div>
                                            <label class="custom-switch mt-2">
                                                <input id="aktif" type="checkbox" class="custom-switch-input" >
                                                    <input name="active" id="active" type="text" class="form-control" hidden>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Kolom Aktif</span>
                                            </label>
                                        </div>
                                        <button id="btn-save" type="submit"
                                            class="btn btn-primary btn-icon icon-right">simpan</button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <span></span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="list_absen" class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <td>No.</td>
                                            <td>Judul Absen</td>
                                            <td> Tanggal</td>
                                            <td> Active?</td>
                                            <td>Action</td>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                        </tr>
                                    </tfoot>
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
                var table = $('#list_absen').DataTable({
                "bAutoWidth": false,
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "/judul_absen", // ambil data
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width : '5%'
                    },

                    {
                        data: 'judul',
                        name: 'judul',
                        width : '25%'
                        
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        width : '5%'
                        
                    },
                    {
                        data: 'act',
                        name: 'act',
                        width : '5%'
                        
                    },

                    
                    {
                        data: 'action',
                        name: 'action',
                        width : '15%'
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
                // $(".datepicker").datepicker();
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
                //switches
                $('#aktif').change(function(e) {
                    e.preventDefault();
                    if ($(this).is(':checked')) {
                        switchStatus = $(this).is(':checked'); 
                        switchVal = $(this).val(1);
                        $("#active").val(1); 
                        // alert(switchVal); // To verify
                    } else {
                        switchStatus = $(this).is('');
                        switchVal = $(this).val(0) ;
                        $("#active").val(0);
                        // alert(switchVal); // To verify
                    }
                });
                
                $(document).on('click', '#edit', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var judul = $(this).data('judul');
                    var tanggal = $(this).data('tanggal');
                    var active = $(this).data('active');
                    // console.log(id,judul,tanggal,active);
                    $("#judul").val(judul);
                    $("#datepicker").val(tanggal);
                    $("#tanggal").val(tanggal);
                    $("#aktif").prop("checked", active == 1 ? true : false);
                    $("#active").val(active);
                    var inp_id = "<input name='id' id='id' type='text' class='form-control' value='" + id + "' hidden>";
                    $('#id-form').append(inp_id);
                });
                $(document).on('submit', '#id-form', function(e) {
                    e.preventDefault()
                    var tgl = $("#datepicker").val();
                    var cek = $("#tanggal").val(tgl);
                    // console.log(cek.val());
                    var formData = new FormData(this);
                    if ($("#id").length>0) {
                        // console.log('ada id');
                        formData.append('id', $("#id").val());
                    } 


                    $.ajax({
                        type: "POST",
                        url: "/judul_absen",
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data) {

                            $('#id-form').trigger(
                                "reset");
                            // window.location.reload()
                            $('#btn-save').html('Tersimpan');
                            //Reload Total Finansial Planing
                            swal("Berhasil",
                                "Berkas telah tersimpan",
                                "success");
                            table.ajax.reload();
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

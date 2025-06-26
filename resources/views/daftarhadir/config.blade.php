@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/admin_theme/library/selectric/public/selectric.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endpush

@section('admin-container')
    <section class="section">
        <div class="section-header">
            <h1>Advanced Forms nih boss</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Advanced Forms</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Input Text</h4>
                            <button class="btn btn-primary" type="button" data-toggle="modal" id = "tambah">Tambah
                                Form</button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-config" class="table table-light">
                                    <thead>
                                        <tr>
                                            <td class="text-center"x>no</td>
                                            <td class="text-center"x>field</td>
                                            <td class="text-center"x>judul</td>
                                            <td class="text-center"x>kategori</td>
                                            <td class="text-center"x>link</td>
                                            <td class="text-center">Aksi</td>
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
        </div>
    </section>
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="id-form" enctype="multipart/form-data">
                        <div class="col-md-12 col-lg-12">
                            <div class="section-title">Config table</div>
                            <div class="form-group">
                                <label>Pilih nama tabel</label>
                                {{-- @php
                                    $list = [];
                                @endphp --}}
                                <p>Field form terpasang :
                                </p>


                                <select name="tabel[]" id="select-form" class="form-control" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <input hidden class='form-control' type="text" name="tag[]" id="tag">

                        <div class="col-md-12 col-lg-12">
                            <div class="section-title">Config form</div>
                            <div class="form-group">
                                <label>Set judul form</label>
                                <input class='form-control' type="text" name="judul" id="judul">
                                <input id='id' type='hidden' class='form-control' placeholder='npsn' name='id'
                                    value=''>
                            </div>
                            <div class="form-group">
                                <label>Kategori Form</label>
                                <input class='form-control' type="text" name="kat" id="kat">
                            </div>
                            <div class="form-group">
                                <label>link controller</label>
                                <input class='form-control' type="text" name="link" id="link">
                            </div>
                            

                            {{-- <div class='form-group'>
                                <label for='jumlah_progli'>
                                    Jumlah Progli
                                </label>
                                <input required id='jumlah_progli' name='jumlah_progli' class='form-control'
                                    type='textarea'>

                                <div class='invalid-feedback'></div>
                            </div> --}}
                            <div class="form-group">
                                <button type="submit" id="btn-save" class="btn btn-info"> Simpan</button>
                                <a hide id="rdr" class="btn btn-primary btn-lg" target="_blank"> lihat form</a>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js-custom')
    <!-- JS Libraies -->
    <script src="{{ asset('admin_theme/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/admin_theme/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/admin_theme/library/select2/dist/js/select2.full.min.js"></script>
    <script src="/admin_theme/library/selectric/public/jquery.selectric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="/admin_theme/js/page/forms-advanced-forms.js"></script> --}}


    <script>
        $(document).ready(function() {

            // var vals = [{
            //         id: 1,
            //         text: '1',
            //         value: '1'
            //     },
            //     {
            //         id: 2,
            //         text: '2',
            //         value: '2'
            //     },
            //     {
            //         id: 3,
            //         text: '3',
            //         value: '3'
            //     },
            //     {
            //         id: 4,
            //         text: '4',
            //         value: '4'
            //     }
            // ];
            // var lain = $("#jumlah_progli").select2({
            //     placeholder: "Pilih Jumlah Progli",
            //     allowClear: true,
            //     data: vals

            // });
            // console.log(lain.val())
            
            $("#rdr").hide()
            var table = $('#tabel-config').DataTable({
                'processing': true,
                'serverSide': true,
                'bAutoWidth': false, //aktifkan server-side 
                'ajax': {
                    'url': '/config', // ambil data
                    'type': 'GET'
                },
                // parsing nama columns
                'columns': [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tabel',
                        name: 'tabel',
                        // width : '10px'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },

                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'link',
                        name: 'link'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],
                columnDefs: [{
                        width: '20%',
                        targets: 1,
                        render: function(data, type, row, meta) {

                            return '<div id="accordion"><div class="card"><div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapse' +
                                meta.row +
                                '" aria-expanded="true" aria-controls="collapseOne">Click To View</button></h5></div> <div id="collapse' +
                                meta.row +
                                '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body">' +
                                data + '</div></div></div></div>'

                        }
                    },

                    {
                        targets: [5],
                        className: 'text-nowrap text-center'
                    }

                ]
            });
            // Select2


            // Set up the Select2 control
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


            $("#link").keyup(function(e) {
                $("#rdr").attr("href", this.val)
            });

            var cek = $("#select-form").select2({
                placeholder: "Pilih Kolom Input",
                allowClear: true,
                ajax: {
                    url: "/list-form",
                    type: "post",
                    dataType: 'json',
                    // delay: 250,
                    data: function(params) {
                        return {
                            // _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });


            // ** tambahDATA * / 
            $('#tambah').click(function() {
                $('#id-form').attr("id", "id-form-tambah");
                $("#my-modal").modal('show');
                $('#id-form').trigger("reset");
                $("#select-form").val('').trigger('change');
                cek.on("select2:close", function(e) {
                    var vals = cek.val()
                    $("#tag").val(vals)
                    // console.log(vals)
                });


                // ** SIMPAN DATA * / 
                $(document).on('submit', '#id-form-tambah', function(e) {
                    e.preventDefault()
                    var formData = new FormData(this);
                    console.log(formData)

                    $.ajax({
                        type: "POST",
                        url: "/config",
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            // console.log(response);
                            $('#id-form').trigger("reset");
                            $('#my-modal').modal(
                                "hide");
                            $('#btn-save').html('Simpan');
                            var url = $("#link").val()
                            $("#rdr").show()
                            $('#select-form').val(null).trigger('change');
                            $("#rdr").attr("href",
                                "https://form.bansmprovjatim.com/form/" +
                                url)
                            //Reload Total Finansial Planing
                            swal("Berhasil",
                                "Berkas telah tersimpan",
                                "success");
                            // refresh yajra datatable
                            var oTable = $("#tabel-config")
                                .dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function(data) {
                            console.log('Error', data);
                            $('#errnama').text('Mohon Mengisi Nama');
                        }
                    });
                });

            });


            // ** editDATA * / 
            $(document).on('click', '.show-btn', function() {
                var data_id = $(this).attr('data-id');
                // console.log(data_id)
                $.get("/config/" + data_id, function(data) {
                    $('#id-form').attr("id", "id-form-edit");
                    $("#my-modal").modal('show');
                    $('#id-form').trigger("reset");
                    $.ajax({
                        type: 'GET',
                        url: 'selectlist/' + data_id
                    }).then(function(data) {
                        //Clearing selections
                        cek.val(null).trigger('change');
                        $("#tag").val(data)
                        var columns = [];
                        $.each(data, function(key, value) {
                            var my_item = {};
                            my_item.id = value;
                            my_item.text = value;
                            columns.push(my_item);
                        });
                        // console.log(columns);
                        // data.category=[{id: "2", title: "sdsd"},{id: "2", title: "sdsd"}]; 
                        for (i = 0; i < columns.length; ++i) {
                            var currentObject = columns[i];
                            var option = new Option(currentObject.text, currentObject.id,
                                true, true);
                            cek.append(option).trigger('change');
                        }
                    });
                    cek.on("select2:close", function(e) {
                        cek.val(null).trigger('change');
                        var vals = cek.val()
                        $("#tag").val(vals)
                        // console.log(vals)
                    });
                    $('#judul').val(data.judul);
                    $('#id').val(data_id);
                    $('#kat').val(data.kategori);
                    $('#link').val(data.link);
                    // ** SIMPAN DATA * / 
                    $(document).on('submit', '#id-form-edit', function(e) {
                        e.preventDefault()
                        var formData = new FormData(this);
                        $.ajax({
                            type: "POST",
                            url: "/config",
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                // console.log(response);
                                $('#id-form').trigger("reset");
                                $('#my-modal').modal(
                                    "hide");
                                $('#btn-save').html('Simpan');
                                var url = $("#link").val()
                                $("#rdr").show()
                                $('#select-form').val(null).trigger('change');
                                $("#rdr").attr("href",
                                    "https://form.bansmprovjatim.com/form/" +
                                    url)
                                //Reload Total Finansial Planing
                                swal("Berhasil",
                                    "Berkas telah tersimpan",
                                    "success");
                                // refresh yajra datatable
                                var oTable = $("#tabel-config")
                                    .dataTable();
                                oTable.fnDraw(false);
                            },
                            error: function(data) {
                                console.log('Error', data);
                                $('#errnama').text('Mohon Mengisi Nama');
                            }
                        });
                    });
                });
            });

            // ** HAPUS DATA * / 
            $(document).on('click', '.del-btn', function() {
                dataId = $(this).attr('data-id');
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
                            url: "/config/" + dataId,
                            success: function(data) {
                                var oTable = $("#tabel-config").dataTable();
                                oTable.fnDraw(false);
                                swal("Berhasil", "Data telah terhapus",
                                    "success");
                            }
                        });
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

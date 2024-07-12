@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/admin_theme/library/selectric/public/selectric.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
    <link href="admin_theme/css/jquery.magnify.css" rel="stylesheet">

@endpush

@section('admin-container')
    <section class="section">
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
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
                                            <td class="text-center">no</td>
                                            <td class="text-center">judul</td>
                                            <td class="text-center">file</td>
                                            <td class="text-center">desc</td>
                                            <td class="text-center">jenis</td>
                                            <td class="text-center">show</td>
                                            <td class="text-center">range_show</td>
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
                    <h5 class="modal-title" id="my-modal-title">Form Galeri</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="id-form" enctype="multipart/form-data">
                        <div class="col-md-12 col-lg-12">
                            <div class="section-title">Form Galeri</div>
                            <div class="form-group">
                                <label>Set judul Galeri</label>
                                <input class='form-control' type="text" name="judul" id="judul">
                                <input type="text" class="form-control" id="id_info" name="id_info" value=""
                                    hidden>
                                <div class="alert-danger" id="errjudul"></div>
                            </div>
                            <div class="form-group">
                                <label>Pilih File Galeri</label>
                                <input class='form-control' type="file" name="gambar" id="gambar">
                                <div class="alert-danger" id="errgambar"></div>
                            </div>
                            <div class="form-group">
                                <label for="jenis">Jenis Galeri</label>
                                <select id="jenis" class="form-control" name="jenis">
                                    <option value="Banner">Banner</option>
                                    <option value="Promo">Promo</option>
                                </select>
                                <div class="alert-danger" id="errjenis"></div>
                            </div>

                            <div class="form-group">
                                <div class="control-label">Aktifkan kolom</div>
                                <label class="custom-switch mt-2">
                                    <input id="show" type="checkbox"
                                        @if ($cek == 1) checked value=1
                                    @elseif($cek == 0)
                                    value=0 @endif
                                        class="custom-switch-input">
                                    <input name="show" id="show" type="text" class="form-control" hidden>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">YA</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Rentang Waktu Penampilan Galeri</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input name="range_show" type="text" class="form-control daterange-cus" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Galeri</label>
                                <div class="form-control" name="desc" id="desc"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btn-save" class="btn btn-info"> Simpan</button>
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
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
    <script src="/admin_theme/library/selectric/public/jquery.selectric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <script src="admin_theme/js/jquery.magnify.js"></script>
    {{-- C:\laragon\www\bansmjatim\public\admin_theme\js --}}


    <!-- Page Specific JS File -->
    {{-- <script src="/admin_theme/js/page/forms-advanced-forms.js"></script> --}}


    <script>
        $(document).ready(function() {
            $("[data-magnify=gallery]").magnify(
                [
                    'zoomIn',
                    'zoomOut',
                    'prev',
                    'fullscreen',
                    'next',
                    'actualSize',
                    'rotateRight'
                ]
            );
            $("#rdr").hide()
            $('#jenis').select2();
            $('#show').change(function(e) {
                e.preventDefault();
                if ($(this).is(':checked')) {
                    switchStatus = $(this).is(':checked');
                    switchVal = $(this).val(1);
                    $("#active").val(1);
                    // alert(switchVal); // To verify
                } else {
                    switchStatus = $(this).is('');
                    switchVal = $(this).val(0);
                    $("#active").val(0);
                    // alert(switchVal); // To verify
                }
            });
            $('.daterange-cus').daterangepicker({
                // "autoApply": true,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Clear",
                    "fromLabel": "Dari",
                    "toLabel": "Sampai",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Min",
                        "Sen",
                        "Sel",
                        "Rab",
                        "Kam",
                        "Jum",
                        "Sab"
                    ],
                    "monthNames": [
                        "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mei",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember"
                    ],
                    "firstDay": 1,
                },
                "linkedCalendars": false,
                "opens": "center",
                "drops": "auto"
            });
            $('.daterange-cus').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
            });
            $('.daterange-cus').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            var table = $('#tabel-config').DataTable({
                'processing': true,
                'serverSide': true,
                'bAutoWidth': false, //aktifkan server-side 
                'ajax': {
                    'url': '/galeri', // ambil data
                    'type': 'GET'
                },
                // parsing nama columns
                'columns': [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'file',
                        name: 'file'
                    },
                    {
                        data: 'desc',
                        name: 'desc'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'show',
                        name: 'show'
                    },
                    {
                        data: 'range_show',
                        name: 'range_show'
                    },

                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ],

                columnDefs: [{
                        width: '20%',
                        targets: 3,
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
                        targets: [7],
                        className: 'text-nowrap text-center'
                    },
                    {
                        targets: [6],
                        className: 'text-nowrap text-center'
                    }
                ]
            });

            // ** tambahDATA * / 
            $('#tambah').click(function() {
                $('#id-form').attr("id", "id-form-tambah");
                $("#my-modal").modal('show');
                $('#id-form').trigger("reset");
                $("#select-form").val('').trigger('change');
                $("#desc").summernote();
                // ** SIMPAN DATA * / 
                $(document).on('submit', '#id-form-tambah', function(e) {
                    e.preventDefault()
                    var formData = new FormData(this);
                    console.log(formData)

                    $.ajax({
                        type: "POST",
                        url: "/galeri",
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
                            $('#errjudul').text(data.responseJSON.errors.judul);
                            $('#errjenis').text(data.responseJSON.errors.jenis);
                            $('#errgambar').text(data.responseJSON.errors.file);
                        }
                    });
                });

            });


            // ** editDATA * / 
            $(document).on('click', '.show-btn', function() {
                var data_id = $(this).attr('data-id');
                // console.log(data_id)
                $.get("/galeri/" + data_id, function(data) {
                    $('#id-form').attr("id", "id-form-edit");
                    $("#my-modal").modal('show');
                    $('#id-form').trigger("reset");
                    $('#id_info').attr('value', data_id);
                    $('#judul').val(data.judul);
                    var smmrnote = data.desc;
                    $("#desc").summernote('code', smmrnote);
                    $('#jenis').val(data.jenis);
                    $('#link').val(data.link);
                    // ** SIMPAN DATA * / 
                    $(document).on('submit', '#id-form-edit', function(e) {
                        e.preventDefault()
                        var formData = new FormData(this);
                        $.ajax({
                            type: "POST",
                            url: "/galeri",
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
                            url: "/galeri/" + dataId,
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

@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/admin_theme/library/selectric/public/selectric.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
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
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#my-modal">Tambah Form</button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-config" class="table table-light">
                                    <thead>
                                        <tr>
                                            <td>no</td>
                                            <td>field</td>
                                            <td>judul</td>
                                            <td>kategori</td>
                                            <td>link</td>
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
                                <p>Field form terpasang : @foreach ($newdata as $datanya)
                                        {{ $datanya . ',' }}
                                    @endforeach
                                    {{-- @php
                                        dd($newdata);
                                    @endphp --}}
                                </p>


                                <select name="tabel[]" class="form-control selectric" multiple="multiple">
                                    <option value=''>-- Pilih field --</option>
                                    @foreach ($forms as $form)
                                        <option @if (in_array($form->nama_field, $newdata)) {{ ' selected ' }} @endif
                                            value='{{ $form->nama_field }}'>{{ $form->nama_field }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input hidden class='form-control' type="text" name="tag[]" id="tag">

                        <div class="col-md-12 col-lg-12">
                            <div class="section-title">Config form</div>
                            <div class="form-group">
                                <label>Set judul form</label>
                                <input class='form-control' type="text" name="judul" id="judul"
                                    value='{{ $data->judul }}'>
                            </div>
                            <div class="form-group">
                                <label>Kategori Form</label>
                                <input class='form-control' type="text" name="kat" id="kat"
                                    value='{{ $data->kategori }}'>
                            </div>
                            <div class="form-group">
                                <label>link controller</label>
                                <input class='form-control' type="text" name="link" id="link"
                                    value='{{ $data->link }}'>
                            </div>
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

    <!-- Page Specific JS File -->
    {{-- <script src="/admin_theme/js/page/forms-advanced-forms.js"></script> --}}


    <script>
        $(document).ready(function() {
            $("#rdr").hide()
            var table = $('#tabel-config').DataTable({
                'processing': true,
                'serverSide': true,
                'bAutoWidth': false, //aktifkan server-side 
                'ajax': {
                    'url': '/configtable', // ambil data
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
                ],
                columnDefs: [{
                    width: '20%',
                    targets: 1
                }]
            });
            // Selectric


            if (jQuery().selectric) {

                $(".selectric").select2({
                    placeholder: "Pilih kolom inputa"
                });


                $('.selectric').on('select2:select', function(e) {
                    var lbl = $('.label').text()
                        $("#tag").val(lbl)
                });

                // $(".selectric").selectric({
                //     disableOnMobile: false,
                //     nativeOnMobile: false,
                //     onClose: function() {
                //         var lbl = $('.label').text()
                //         $("#tag").val(lbl)
                //     },
                // });
            }

            $("#link").keyup(function (e) { 
                $("#rdr").attr("href", this.val)
            });


            $(document).on('submit', '#id-form', function(e) {
                e.preventDefault()
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "/settable",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#id-form').trigger(
                            "reset");
                        $('#btn-save').html('Tersimpan');
                        var url = $("#link").val()
                        $("#rdr").show()
                        $("#rdr").attr("href", "https://form.bansmprovjatim.com/form/" + url)
                        //Reload Total Finansial Planing
                        swal("Berhasil",
                            "Berkas telah tersimpan",
                            "success");

                    },
                    error: function(data) {
                        console.log('Error', data);

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

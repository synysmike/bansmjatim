<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $judul }}&mdash; BAN-PDM JATIM</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{ $judul }}" />
    {{-- <meta property="og:type" content="video.movie" /> --}}
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="/ban.png" />
    <link rel="icon" type="image/x-icon" href="/ban.png">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin_theme/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin_theme/library/selectric/public/selectric.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin_theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_theme/css/components.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- Start GA -->

    <!-- END GA -->
</head>

<body>
    <div id="app">
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-show">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>{{ $judul }}</h3>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        @foreach ($theads as $tbh)
                                            <th class="text-center">{{ $tbh }}</th>
                                        @endforeach
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
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <!-- Footer -->
                        <div class="login-brand">
                            <img src="/ban.png" alt="logo" width="150" class="shadow-light">
                        </div>
                        <!-- Content -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>{{ $judul }} BAN-PDM JAWA TIMUR</h4>
                            </div>
                            <div class="card-body">
                                <form id="id-form" enctype="multipart/form-data">
                                    {!! $kategori !!}
                                    @if ($ass !== null)
                                        <div class="form-group pb-3"> <label>Pilih Nama :</label> <select
                                                id="selectValue" name="nia_ass" class="form-control" required>
                                                <option value="">--Pilih Nama--</option>
                                                @foreach ($ass as $nama)
                                                    <option value = "{{ $nama->nia }}">{{ $nama->nia }}
                                                        {{ $nama->nama_tanpa_gelar }}</option>
                                                @endforeach
                                            </select></div>
                                    @endif
                                    @foreach ($form as $key)
                                        {!! $key->tag_field !!}
                                    @endforeach

                                    <div class='form-group'>
                                        <input required type='hidden' id='kat_dh' name='kat_dh'
                                            value="{{ $kat }}">
                                        <input required type='hidden' id='signature' name='signature'>
                                        <label for="sig">Tandatangan :</label>
                                        </br>
                                        <div class="js-signature" data-width="600" data-height="200"
                                            data-border="1px solid black" data-line-color="#000000"
                                            data-auto-fit="true"></div>
                                        <div id="errsign" class="alert-danger"></div>
                                        <button id="clearBtn" class="btn btn-danger">Ulangi TTD</button>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-icon icon-right"
                                        id="btn-save">simpan</button>
                                </form>
                                {{-- <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button> --}}
                                <button class="btn btn-primary btn-lg trigger--fire-modal-2" id="modal-2">lihat
                                    pengunjung</button>
                            </div>
                        </div>
                        <!-- Footer -->
                        <div class="simple-footer">
                            Copyright &copy; BAN-PDM Provinsi Jawa Timur by IR.TEGUH
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <div class="modal fade" tabindex="-1" role="dialog" id="editModal-show">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <form id="edit-form" action="" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="tittle" class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($form as $key)
                                {!! $key->tag_field !!}
                            @endforeach
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>
    </div>

    <!-- General JS Scripts -->

    <script src="{{ asset('admin_theme/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('admin_theme/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/stisla.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- JS Libraies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('jq-signature/jq-signature.min.') }}js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js">
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    <script src="{{ asset('/admin_theme/library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/cleave.js/dist/addons/cleave-phone.id.js') }}"></script>
    <script src="{{ asset('admin_theme/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('admin_theme/js/page/auth-register.js') }}"></script>
    <!-- Template JS File -->
    {{-- <script src="admin_theme/js/scripts.js"></script>
    <script src="admin_theme/js/custom.js"></script> --}}
    <script>
        $(document).ready(function() {
            $("#selectValue").select2({
                placeholder: "Pilih nama | Ketikan nama/NIA anda Disini, lalu pilih nama anda"
            });
            "use strict";
            var cleavePN = new Cleave(".phone-number", {
                phone: true,
                phoneRegionCode: "id",
            });
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
            // for limit number char on phone number
            // $('#btn-save').attr('disabled', true);
            $('.js-signature').jqSignature();
            $('#clearBtn').click(function() {
                $('.js-signature').jqSignature('clearCanvas');
                // $('#btn-save').attr('disabled', true);                
            });
            $('number#title').attr('maxLength', '8').keypress(limitMe);

            function limitMe(e) {
                if (e.keyCode == 8) {
                    return true;
                }
                return this.value.length < $(this).attr("maxLength");
            }
            $(document).on('click', '.show-btn', function() {
                $('#id-form').trigger("reset");
                $("#editModal-show").modal('show');
                var data_id = $(this).data('id');

                $.get("{{ $link }}/" + data_id, function(data) {
                    console.log(data.nama);
                });
            });

            $('#modal-2').click(function() {
                $("#modal-show").modal('show');
                // dynamic datatable
                var label = [];
                '@foreach ($unit as $unt)';
                label.push('{!! $unt !!}');
                '@endforeach';
                // console.log(label);
                var columns = [];

                $.each(label, function(key, value) {
                    var my_item = {};
                    my_item.name = value;
                    my_item.data = value;
                    columns.push(my_item);
                });
                // datatable yajra
                var table = $('#table-1').DataTable({
                    'processing': true,
                    'serverSide': true, //aktifkan server-side 
                    'ajax': {
                        'url': '{{ $link }}', // ambil data
                        'type': 'GET'
                    },
                    // parsing nama columns
                    'columns': columns,
                    'bAutoWidth': false,

                });
                // console.log(table);
                new $.fn.dataTable.Buttons(table, {
                    buttons: [
                        'copy', 'csv', 'pdf'
                    ],

                });
                table.buttons(0, null).container().prependTo(
                    table.table().container()
                );
                var oTable = $("#table-1").dataTable();
                oTable.fnDraw(false);
            });
            $("#jumlah_progli").on('change', function() {
                var vals = this.value
                console.log(vals)
                if (vals == "lain") {
                    $("#jumlah_progli").remove()
                    $("#field_progli").append(
                        "<input required id='jumlah_progli' placeholder='Masukan Jumlah Progli' name='jumlah_progli' class='form-control' type='textarea'>"
                        )

                }
            })
            $(".daftar_progli").summernote({
                dialogsInBody: true,
                placeholder: 'Progli 1 :, Progli 2 :, Progli 3:, dan seterusnya... (Wajib Diakhiri (,) koma di setiap progli)',
                minHeight: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['paragraph']]
                ]
            });
            // klik submit
            // $(document).on('click', '#btn-save', function() {
            //     // $('#signature').empty();
            //     // var img = $('<img>').attr('src', dataUrl);
            //     // $('#signature').append($('<p>').text("Here's your signature:"));
            //     // $('#signature').append(img);
            //     // console.log(sig.signature('toDataURL'));
            //     // var mycanvas = document.getElementById('canvas');
            //     var dataUrl = $('.js-signature').jqSignature('getDataURL');
            //     var img = dataUrl;
            //     // // // console.log(img)
            //     var anchor = $("#signature");
            //     anchor.val(img);
            //     $("#id-form").submit();
            // });
            $(document).on('submit', '#id-form', function(e) {
                var dataUrl = $('.js-signature').jqSignature('getDataURL');
                var img = dataUrl;
                // // // console.log(img)
                var anchor = $("#signature");
                anchor.val(img);
                e.preventDefault()
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ $link }}",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.js-signature').jqSignature('clearCanvas');
                        $('#id-form').trigger(
                            "reset");
                        $('#btn-save').html('Tersimpan');
                        //Reload Total Finansial Planing
                        swal("Berhasil",
                            "Berkas telah tersimpan",
                            "success");
                    },
                    error: function(data) {
                        console.log('Error', data);
                        // $('#errnama').text('Mohon Mengisi Nama');
                        // $('#errhp').text("nomor HP jangan kosong");
                        // $('#errsehat').text(
                        //     'cek ukuran/jenis file, harus pdf, dan maksimal 1MB');
                        // $('#errfotorek').text(
                        //     'cek ukuran/jenis file, harus pdf/jpg/png, dan maksimal 1MB');
                        // $('#errtugas').text(
                        //     'cek ukuran/jenis file, harus pdf, dan maksimal 1MB');
                        // $('#btn-save').html(
                        //     'Gagal Simpan, mohon diperbaiki lalu klik saya lagi'
                        // );
                    }
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        //   $(document).ready(() => {            
        // })    
    </script>

</body>

</html>

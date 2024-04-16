<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Bukutamu &mdash; BAN-S/M JATIM</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="Bukutamu" />
    {{-- <meta property="og:type" content="video.movie" /> --}}
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="/ban.png" />
    <link rel="icon" type="image/x-icon" href="/ban.png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="admin_theme/library/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="admin_theme/library/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="admin_theme/css/style.css">
    <link rel="stylesheet" href="admin_theme/css/components.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>

<body>
    <div id="app">
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-show">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center"> No. </th>
                                        <th class="text-center"> Tanggal </th>
                                        <th class="text-center"> Nama </th>
                                        <th class="text-center"> HP </th>
                                        <th class="text-center"> Asal </th>
                                        <th class="text-center"> Keperluan </th>
                                        <th class="text-center"> TTD </th>
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
                            <img src="/ban.png" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <!-- Content -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Buku Tamu BAN-S/M</h4>
                            </div>

                            <div class="card-body">
                                <form id="id-form" class="needs-validation" novalidate=""
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nama">NAMA</label>
                                            <input required id="nama" type="text" class="form-control"
                                                name="nama" autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="hp">No HP</label>
                                            <input minlength="9" required
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength="13" type="number" name="hp" class="form-control pl-1">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="asal">Asal</label>
                                        <input required id="asal" type="text" class="form-control"
                                            name="asal">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input required id="alamat" type="text" class="form-control"
                                            name="alamat">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kpr">Keperluan</label>
                                        <input required id="kpr" type="text" class="form-control"
                                            name="kpr">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input required type="hidden" id="signature" name="signature">
                                    </div>
                                    <div class="form-group">
                                        <label for="sig">Tandatangan :</label></br>
                                        <div class="js-signature" data-width="600" data-height="200"
                                            data-border="1px solid black" data-line-color="#000000"
                                            data-auto-fit="true"></div>
                                        <div id="errsign" class="alert-danger" id=""></div>
                                        <button id="clearBtn" class="btn btn-danger">Ulangi TTD</button>
                                        <button type="button" class="btn btn-primary btn-icon icon-right"
                                            id="btn-save">simpan</button>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        {{-- <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button> --}}
                                        <button class="btn btn-primary btn-lg trigger--fire-modal-2"
                                            id="modal-2">lihat pengunjung</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="simple-footer">
                            Copyright &copy; BAN-S/M Provinsi Jawa Timur by IR.TEGUH
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="admin_theme/library/jquery/dist/jquery.min.js"></script>
    <script src="admin_theme/library/popper.js/dist/umd/popper.js"></script>
    <script src="admin_theme/library/tooltip.js/dist/umd/tooltip.js"></script>
    <script src="admin_theme/library/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="admin_theme/library/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="admin_theme/library/moment/min/moment.min.js"></script>
    <script src="admin_theme/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>

    <script src="{{ asset('admin_theme/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="admin_theme/library/selectric/public/jquery.selectric.min.js"></script>
    <script src="admin_theme/library/jquery.pwstrength/jquery.pwstrength.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="jq-signature/jq-signature.min.js"></script>
    <script src="admin_theme/js/page/auth-register.js"></script>

    <!-- Template JS File -->
    {{-- <script src="admin_theme/js/scripts.js"></script>
    <script src="admin_theme/js/custom.js"></script> --}}



    <script>
        $(document).ready(function() {
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



            $('#modal-2').click(function() {
                $("#modal-show").modal('show');
                var table = $('#table-1').DataTable({
                    processing: true,
                    serverSide: true, //aktifkan server-side 
                    ajax: {
                        url: "/bukutamu", // ambil data
                        type: 'GET'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'tgl',
                            name: 'tgl'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'nohp',
                            name: 'nohp'
                        },
                        {
                            data: 'asal',
                            name: 'asal'
                        },
                        {
                            data: 'keperluan',
                            name: 'keperluan'
                        },
                        {
                            data: 'ttd',
                            name: 'ttd'
                        }

                    ],
                });
            });

            $(document).on('click', '#btn-save', function(e) {
                // $('#signature').empty();
                // var img = $('<img>').attr('src', dataUrl);
                // $('#signature').append($('<p>').text("Here's your signature:"));
                // $('#signature').append(img);
                // console.log(sig.signature('toDataURL'));
                // var mycanvas = document.getElementById('canvas');

                $("#id-form").submit();
                return false;
            });

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
                    url: "{{ route('bukutamu.store') }}",
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
                        $('#errnama').text(data.responseJSON.errors
                            .nama);
                        $('#errhp').text(data.responseJSON.errors.hpks);
                        $('#errasal').text(data.responseJSON.errors
                            .asal);
                        $('#errkpr').text(data.responseJSON.errors.hp);
                        $('#errsign').text(data.responseJSON.errors
                            .signature);
                        $('#btn-save').html(
                            'Gagal Simpan, mohon diperbaiki lalu klik saya lagi'
                        );
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

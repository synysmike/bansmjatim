<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Rakorda 1 &mdash; BAN-S/M JATIM</title>
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
                                        <th class=""> No. </th>
                                        <th class=""> Nama </th>                                        
                                        <th class=""> Asal </th>                                        
                                        <th class=""> Unit Kerja </th>                                        
                                        <th class=""> Jabatan </th>                                        
                                        <th class=""> TTD </th>
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
                                <h4>Daftar Hadir RAKORDA I BAN-S/M</h4>
                            </div>

                            <div class="card-body">
                                <form id="id-form" class="needs-validation" novalidate=""
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nama">NAMA</label>
                                            <input required id="nama" type="text" class="form-control"
                                                name="nama" autofocus>
                                            <div class="alert-danger" id="errnama"></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nama">Jabatan</label>
                                            <input required id="jabatan" type="text" class="form-control"
                                                name="jabatan" autofocus>
                                            <div class="alert-danger" id="errjabatan"></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nama">Unit Kerja</label>
                                            <input required id="unit" type="text" class="form-control"
                                                name="unit" autofocus>
                                            <div class="alert-danger" id="errunit"></div>
                                        </div>
                                        <div class='form-group col-6'>
                                            <label for='k_asal'>
                                                Kab./Kota
                                            </label>
                                            <div class='invalid-feedback'>
                                                Mohon Mengisi Kab./Kota
                                            </div>
                                            <select required name="asal" class="form-control row mb-4" id="k_asal">
                                                <option value=''>--- Pilih Kab.Kota ---</option>
                                                <option value='KOTA SURABAYA'>KOTA SURABAYA</option>
                                                <option value='KOTA MALANG'>KOTA MALANG</option>
                                                <option value='KOTA MADIUN'>KOTA MADIUN</option>
                                                <option value='KOTA KEDIRI'>KOTA KEDIRI</option>
                                                <option value='KOTA MOJOKERTO'>KOTA MOJOKERTO</option>
                                                <option value='KOTA BLITAR'>KOTA BLITAR</option>
                                                <option value='KOTA PASURUAN'>KOTA PASURUAN</option>
                                                <option value='KOTA PROBOLINGGO'>KOTA PROBOLINGGO</option>
                                                <option value='KOTA BATU'>KOTA BATU</option>
                                                <option value='Kab. GRESIK'>Kab. GRESIK</option>
                                                <option value='Kab. SIDOARJO'>Kab. SIDOARJO</option>
                                                <option value='Kab. MOJOKERTO'>Kab. MOJOKERTO</option>
                                                <option value='Kab. JOMBANG'>Kab. JOMBANG</option>
                                                <option value='Kab. BOJONEGORO'>Kab. BOJONEGORO</option>
                                                <option value='Kab. TUBAN'>Kab. TUBAN</option>
                                                <option value='Kab. LAMONGAN'>Kab. LAMONGAN</option>
                                                <option value='Kab. MADIUN'>Kab. MADIUN</option>
                                                <option value='Kab. NGAWI'>Kab. NGAWI</option>
                                                <option value='Kab. MAGETAN'>Kab. MAGETAN</option>
                                                <option value='Kab. PONOROGO'>Kab. PONOROGO</option>
                                                <option value='Kab. PACITAN'>Kab. PACITAN</option>
                                                <option value='Kab. KEDIRI'>Kab. KEDIRI</option>
                                                <option value='Kab. NGANJUK'>Kab. NGANJUK</option>
                                                <option value='Kab. BLITAR'>Kab. BLITAR</option>
                                                <option value='Kab. TULUNGAGUNG'>Kab. TULUNGAGUNG</option>
                                                <option value='Kab. TRENGGALEK'>Kab. TRENGGALEK</option>
                                                <option value='Kab. MALANG'>Kab. MALANG</option>
                                                <option value='Kab. PASURUAN'>Kab. PASURUAN</option>
                                                <option value='Kab. PROBOLINGGO'>Kab. PROBOLINGGO</option>
                                                <option value='Kab. LUMAJANG'>Kab. LUMAJANG</option>
                                                <option value='Kab. BONDOWOSO'>Kab. BONDOWOSO</option>
                                                <option value='Kab. SITUBONDO'>Kab. SITUBONDO</option>
                                                <option value='Kab. JEMBER'>Kab. JEMBER</option>
                                                <option value='Kab. BANYUWANGI'>Kab. BANYUWANGI</option>
                                                <option value='Kab. PAMEKASAN'>Kab. PAMEKASAN</option>
                                                <option value='Kab. SAMPANG'>Kab. SAMPANG</option>
                                                <option value='Kab. SUMENEP'>Kab. SUMENEP</option>
                                                <option value='Kab. BANGKALAN'>Kab. BANGKALAN</option>
                                            </select>
                                            <div id="errkasal" class="alert-danger"></div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="hp">No HP</label>
                                            <input minlength="9" required
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength="13" type="number" name="hp" class="form-control pl-1">
                                            <div class="alert-danger" id="errhp"></div>
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
                                            id="btn-save">Klik 2x untuk simpan</button>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        {{-- <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button> --}}
                                        
                                    </div>
                                </form>
                                <button class="btn btn-primary btn-lg trigger--fire-modal-2"
                                id="modal-2">Lihat Daftar Hadir</button>
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
                        url: "/rakorda", // ambil data
                        type: 'GET'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        
                        {
                            data: 'asal',
                            name: 'asal'
                        },
                        {
                            data: 'unit',
                            name: 'unit'
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        
                        {
                            data: 'ttd',
                            name: 'ttd'
                        }

                    ],
                });
            });

            $(document).on('click', '#btn-save', function() {
                // $('#signature').empty();
                // var img = $('<img>').attr('src', dataUrl);
                // $('#signature').append($('<p>').text("Here's your signature:"));
                // $('#signature').append(img);
                // console.log(sig.signature('toDataURL'));
                // var mycanvas = document.getElementById('canvas');
                var dataUrl = $('.js-signature').jqSignature('getDataURL');
                var img = dataUrl;
                // // console.log(img)
                anchor = $("#signature");
                anchor.val(img);
                $("#id-form").submit();

            });


            $(document).on('submit', '#id-form', function(e) {
                e.preventDefault()
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "rakorda",
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
                        var oTable = $("#table-1")
                            .dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(data) {
                        console.log('Error', data);
                        $('#errnama').text('Mohon Mengisi Nama');
                        $('#errhp').text("nomor HP jangan kosong");
                        $('#errasal').text(
                            "asalnya belum diisi,Apakah Anda dari Asesor/Lembaga(Sekolah/Madrasah/Yayasan)/Dinas/Kemenag?"
                            );
                        $('#errsign').text("jangan di kosongi tandatangannya");
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

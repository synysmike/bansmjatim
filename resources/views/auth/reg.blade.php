@extends('auth.wrapper')
@push('tittle')
<title>Registrasi KPA &mdash; BAN-S/M JATIM</title>
<meta property="og:title" content="Registrasi KPA" />
{{-- <meta property="og:type" content="video.movie" /> --}}
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:image" content="/ban.png" />
<link rel="icon" type="image/x-icon" href="/ban.png">
@endpush
@push('cssform-custom')
    <link rel="stylesheet" href="admin_theme/modules/prism/prism.css">
    <link rel="stylesheet" href="{{ asset('/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush
@section('form')

    <section class="section">
        <div class="d-flex align-items-stretch flex-wrap">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="m-3 p-4">
                    <img src="/ban.png" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                    <h4 class="text-dark font-weight-normal">Selamat Datang Di <span class="fon.t-weight-bold">BAN-S/M
                            Provinsi
                            Jawa Timur</span>
                    </h4>
                    <p class="text-muted">
                       <h5> Silahkan klik <a
                            href="https://bansmprovjatim.com/login">Login</a> Untuk Menuju halaman login</h5>
                            <p><strong>untuk kpa login dengan username menggunakan nomer hp yang sudah diregistrasi, passwordnya menggunakan "kpabanjatim" (tanpa petik),</strong>
                            
                            Jika belum registrasi, silahkan isi form dibawah ini</p>
                    </p>
                    <form id="id-form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <div class='form-group'>
                            <label for='nama'>
                                Nama
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi nama
                            </div>
                            <input id='nama' type='text' class='form-control' name='nama' tabindex='1'
                                value='' required autofocus>
                        </div>
                        <div id="errnama" class="alert-danger"></div>
                        <div class='form-group'>
                            <label for='tgl_lhr'>
                                Tanggal Lahir
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi Tanggal Lahir
                            </div>
                            <input id='tgl_lhr' type='text' class='form-control datepicker' name='tgl_lhr'
                                tabindex='1' value='' required >
                        </div>

                        <div class='form-group'>
                            <label for='unit'>
                                Kab./Kota
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi Kab./Kota
                            </div>
                            <select required name="k_asal" class="form-control row mb-4" id="k_asal">
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
                        <div class='form-group'>
                            <label for='unsur'>
                                Unsur
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi Unsur
                            </div>
                            <select required name="unsur" class="form-control row mb-4" id="unsur">
                                <option value=''>--- Pilih Unit Kerja ----</option>
                                <option value='1'>KEMENAG</option>
                                <option value='2'>CABDIN</option>
                                <option value='3'>DINAS</option>
                            </select>
                            <div id="errunsur" class="alert-danger"></div>
                        </div>
                        <div class='form-group'>
                            <label for='unit'>
                                Unit Kerja
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi Unit Kerja
                            </div>
                            <input id='unit' type='text' class='form-control' name='unit' tabindex='1'
                                value='' required>
                                <div id="errunit" class="alert-danger"></div>
                        </div>


                        <div class="form-group">
                            <label>Masukan No. HP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input minlength="9" required
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="13" type="number"name='nohp' id='nohp' class="form-control">
                                <div id="errhp" class="alert-danger"></div>
                            </div>
                        </div>
                        {{-- <div class='form-group'>
                            <label for='npwp'>
                                NPWP
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi NPWP
                            </div>
                            <input id='npwp' type='text' class='form-control' name='npwp' tabindex='1'
                                value='' >
                        </div>
                        <div class='form-group'>
                            <label for='norek'>
                                No. Rekening
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi No. Rekening
                            </div>
                            <input id='norek' type='text' class='form-control' name='norek' tabindex='1'
                                value='' >
                        </div> --}}
                        <div class='form-group'>
                            <label for='alamat_r'>
                                Alamat Rumah
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi Alamat Rumah
                            </div>
                            <input id='alamat_r' type='text' class='form-control' name='alamat_r' tabindex='1'
                                value='' >
                        </div>
                        <div class='form-group'>
                            <label for='alamat_k'>
                                Alamat Kantor
                            </label>
                            <div class='invalid-feedback'>
                                Mohon Mengisi Alamat Kantor
                            </div>
                            <input id='alamat_k' type='text' class='form-control' name='alamat_k' tabindex='1'
                                value='' >
                        </div>
                        <div class='form-group'>
                            <button type="button" class="btn btn-primary btn-icon icon-right"
                                id="btn-save">KLIK 2X</button>
                        </div>
                    </form>
                    
                    {{-- <img class="img-fluid" src="{{ asset('storage/ttdbukutamu/'.$data->ttd) }}" alt="{{ $data->ttd }}">
                --}}
                </div>
            </div>

            @include('auth.bg')
        </div>
    </section>
@endsection


@push('jsform-custom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin_theme/library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="/admin_theme/js/scripts.js"></script>
    <script src="/admin_theme/js/custom.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/addons/cleave-phone.id.js"
        integrity="sha512-U479UBH9kysrsCeM3Jz6aTMcWIPVpmIuyqbd+KmDGn6UJziQQ+PB684TjyFxaXiOLRKFO9HPVYYeEmtVi/UJIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}



    {{-- <script src="{{ asset('admin_theme/js/page/forms-advanced-forms.js') }}"></script> --}}

    <script>
        $(document).ready(function() {    
            $('number#title').attr('maxLength', '13').keypress(limitMe);

        function limitMe(e) {
            if (e.keyCode == 8) {
                return true;
            }
            return this.value.length < $(this).attr("maxLength");
        }        
            $(document).on('click', '#btn-save', function(e) {
                e.preventDefault();
                $("#id-form").submit();
                return false;                
            });
            
            $(document).on('submit', '#id-form', function(e) {
            e.preventDefault()
                if ($("#id-form").length > 0) {
                    // console.log('berhasil submit');

                    $('#id-form').validate({
                        submitHandler: function(form) {
                            var actionType = $('#form_submit').val();
                            var formData = new FormData(form);
                            $.ajax({
                                type: "POST",
                                // url: "#",
                                url: "{{ route('kpa.store') }}",
                                data: formData,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    $('#id-form').trigger(
                                        "reset");
                                        swal("Berhasil",
                                        "Berkas telah tersimpan",
                                        "success");
                                    $('#btn-save').html('Data Tersimpan');
                                    
                                    //Reload Total Finansial Planing
                                    
                                },
                                error: function(data) {
                                    console.log('Error', data);
                                    $('#errnama').text(data.responseJSON.errors.nama);
                                    $('#errhp').text(data.responseJSON.errors.nohp);
                                    $('#errkasal').text(data.responseJSON.errors.k_asal);
                                    $('#errunit').text(data.responseJSON.errors.unit);
                                    $('#errunsur').text(data.responseJSON.errors.unsur);
                                    $('#btn-save').html(
                                        'Gagal Simpan, mohon diperbaiki lalu klik saya lagi'
                                    );
                                }
                            });
                        }
                    });
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

        });
    </script>
@endpush

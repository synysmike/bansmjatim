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
                                            <label>Masukan nama kegiatan baru</label>
                                            <input name="judul" id="judul" type="text" class="form-control">
                                        </div>
                                        <div class="form-group pb-3">
                                            <label>Nama kegiatan saat ini</label>
                                            <input type="text" class="form-control" disabled value="{{ $data->judul }}">
                                        </div>
                                        <div class="form-group pb-3">
                                            <label>Pilih Tanggal</label>
                                            <input id="datepicker" type="text" class="form-control datepicker">
                                        </div>
                                        <div class="form-group pb-3">
                                            <label>Tanggal kegiatan saat ini</label>
                                            <input type="text" class="form-control" disabled
                                                placeholder="{{ $data->tanggal }}">
                                            <input name="tanggal" id="tanggal" type="text" class="form-control" hidden>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label">Aktifkan kolom</div>
                                            <label class="custom-switch mt-2">
                                                <input id="aktif" type="checkbox" @if ($cek == 1)
                                                    checked value=1
                                                @elseif($cek == 0)
                                                value=0
                                                @endif  class="custom-switch-input" >
                                                    <input name="active" id="active" type="text" class="form-control" hidden>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Kolom Aktif</span>
                                            </label>
                                        </div>
                                        <button id="btn-save" type="submit"
                                            class="btn btn-primary btn-icon icon-right">simpan</button>
                                        <a href="/dh_absen" target="_blank" class="btn btn-primary btn-icon icon-right">
                                            lihat form</a>
                                    </div>
                                </form>
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
                
                // var cb = document.getElementById('aktif')
                // cb.addEventListener('change', (e) => {
                //     this.checkboxValue = e.target.checked ? '1' : '0';
                //     console.log(this.checkboxValue);
                //     cb.value = this.checkboxValue;
                // })

                //datatable yajra
                $(document).on('submit', '#id-form', function(e) {
                    // this takes care of disabling the form's submission
                    //     e.preventDefault();
                    //     var formData = new FormData(this);
                    //     console.log('bisa kok');

                    //     // the rest of your code...
                    // });


                    e.preventDefault()
                    var tgl = $("#datepicker").val();
                    var cek = $("#tanggal").val(tgl);
                    // console.log(cek.val());
                    var formData = new FormData(this);

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

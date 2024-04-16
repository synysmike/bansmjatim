@extends('ad_layout.wrapper')
@push('css-custom')
<link rel="stylesheet" href="admin_theme/library/datatables/media/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
<link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
@endpush
@section('admin-container')
<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>ketik jenjang yang anda ingin tampilkan di kolom pencarian untuk menampilkan daftar jenjang yang akan anda edit</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center"> No. </th>
                                        <th class="text-center">NPSN</th>
                                        <th class="text-center">Nama Lembaga</th>
                                        <th class="text-center">Jenjang</th>
                                        <th class="text-center">Kab./Kota</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Status Lembaga</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Status Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-show">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <form id="id-form" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="tittle" class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='npsn'>NPSN</label>
                                <div class='col-sm-12 col-md-7'>
                                    <input id='id' type='hidden' class='form-control' placeholder='npsn' name='id'
                                        value=''>
                                    <input disabled id='npsn' type='text' class='form-control' placeholder='npsn'
                                        name='npsn' value=''>
                                    <input id='npsnhd' type='hidden' class='form-control' placeholder='npsn'
                                        name='npsnhd' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='nama_satuan_pendidikan'>Nama Satuan Pendidikan</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='nama_satuan_pendidikan' type='text'
                                        class='form-control' placeholder='nama_satuan_pendidikan'
                                        name='nama_satuan_pendidikan' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='jenjang2'>Jenjang</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='jenjang2' type='text'
                                        class='form-control' placeholder='jenjang2' name='jenjang2' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='status'>Status</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='status' type='text'
                                        class='form-control' placeholder='status' name='status' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='lokasi'>Lokasi</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='lokasi' type='text'
                                        class='form-control' placeholder='lokasi' name='lokasi' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='tahun_akre'>Tahun
                                    akre</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='tahun_akre' type='text'
                                        class='form-control' placeholder='tahun_akre' name='tahun_akre' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='nilai_akhir'>NA</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='nilai_akhir' type='text'
                                        class='form-control' placeholder='nilai_akhir' name='nilai_akhir' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='peringkat'>Peringkat</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='peringkat' type='text'
                                        class='form-control' placeholder='peringkat' name='peringkat' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='no_sk'>NO
                                    SK</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='no_sk' type='text'
                                        class='form-control' placeholder='no_sk' name='no_sk' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='tgl_sk'>TGL
                                    SK</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='tgl_sk' type='text'
                                        class='form-control' placeholder='tgl_sk' name='tgl_sk' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='status_sasaran'>STATUS SASARAN</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='status_sasaran' type='text'
                                        class='form-control' placeholder='status_sasaran' name='status_sasaran'
                                        value=''>
                                </div>
                            </div>
                            {{-- <div class='form-group row mb-4'> <label
                            class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                            for='tahap_visit'>Tahap
                            Visit</label>
                        <div class='col-sm-12 col-md-7'> <input disabled id='tahap_visit' type='text'
                                class='form-control' placeholder='tahap_visit' name='tahap_visit' value=''>
                        </div>
                    </div> --}}
                            {{-- if swasta {diberi input ijop, tgl berlaku ijop (mulai, sampai dengan)} --}}
                            {{-- kurang form nama+nohp kepsek nama+nohp penanggung jawab akreditasi  --}}
                        </div>
                        <div class="col-6">
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='kab_kota'>Kab./Kota</label>
                                <div class='col-sm-12 col-md-7'> <input disabled id='kab_kota' type='text'
                                        class='form-control' placeholder='kab_kota' name='kab_kota' value=''>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                    for='kecamatan'>Kecamatan</label>
                                <div class='col-sm-12 col-md-7'> <input id='kecamatan' type='text' class='form-control'
                                        placeholder='kecamatan' name='kecamatan' value=''>
                                        <div class="alert-danger" id="errkcmtn"></div>
                                    
                                </div>
                            </div>
                            <div class='form-group row mb-4'>
                                <label class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='kelurahan'>
                                    Kelurahan
                                </label>
                                <div class='col-sm-12 col-md-7'> <input id='kelurahan' type='text' class='form-control'
                                        placeholder='kelurahan' name='kelurahan' value=''>
                                        <div class="alert-danger" id="errklrhn"></div>
                                    </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='alamat'>
                                    Alamat
                                </label>
                                <div class='col-sm-12 col-md-7'> <input id='alamat' type='text' class='form-control'
                                        placeholder='alamat' name='alamat' value=''>
                                        <div class="alert-danger" id="erralmt"></div>
                                </div>
                            </div>
                            <div class='form-group row mb-4'>
                                <label class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='namaks'>
                                    Nama Kepala Sekolah
                                </label>
                                <div class='col-sm-12 col-md-7'>
                                    <input id='namaks' type='text' class='form-control'
                                        placeholder='Nama Kepala Sekolah' name='namaks' value=''>
                                        
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='hpks'>
                                    No HP Kepala Sekolah
                                </label>
                                <div class='col-sm-12 col-md-7'>
                                    <input id='hpks' type='text' class='form-control' placeholder='No HP Kepala Sekolah'
                                        name='hpks' value=''>
                                        <div class="alert-danger" id="errhpks"></div>
                                </div>
                            </div>
                            <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='namapj'>
                                    Nama Penanggung Jawab Akreditasi
                                </label>
                                <div class='col-sm-12 col-md-7'>
                                    <input id='namapj' type=' text' class='form-control'
                                        placeholder='Nama Penanggung Jawab Akreditasi' name='namapj' value=''>
                                    </div>
                                </div>
                                <div class=' form-group row mb-4'> <label
                                        class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='hppj'>
                                        No HP Penanggung Jawab Akreditasi
                                    </label>
                                    <div class='col-sm-12 col-md-7'>
                                        <input id='hppj' type='text' class='form-control'
                                            placeholder='No HP Penanggung Jawab Akreditasi' name='hppj' value=''>
                                            <div class="alert-danger" id="errhppj"></div>
                                        </div>
                                </div>
                                {{-- kasih if sekolah negeri disini --}}
                                <div id="file-success" class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='lokasi'>Status Ijop</label>
                                <div class='col-sm-12 col-md-7'>
                                    {{-- <p> {{ $unit->file_ijop !== '' ? 'Sudah Upload' }}</p> --}}
                                    <span class="badge badge-success">Sudah terunggah</span>
                                    {{-- <div class="alert-danger" id="errfile"></div> --}}
                                </div>
                            </div>
                                <div id="collapse1" class='form-group row mb-4'> <label
                                        class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                        for='lokasi'>Unggah
                                        Ijop</label>
                                    <div class='col-sm-12 col-md-7'>
                                        <input id='ijop' type='file' class='form-control' placeholder='ijop' name='ijop'
                                            value=''>
                                            <div class="alert-danger" id="errfile"></div>
                                    </div>
                                </div>
                                <div id="collapse2" class='form-group row mb-4'> <label class='col-form-label '
                                        for='lokasi'>Masa
                                        Berlaku Ijop</label>
                                    <div class='col-sm-12 col-md-7'>
                                        <input id='masa_ijop' type='input' class='form-control datepicker'
                                            placeholder='masa_ijop' name='masa_ijop' value=''>
                                            <div class="alert-danger" id="errmasa"></div>
                                        </div>
                                </div>
                                <div class='form-group row mb-4'>
                                    <label class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                        for='status'>Kondisi Lembaga</label>
                                    <div class='col-sm-12 col-md-7'>
                                        <div class="col-md12">
                                            <input checked="" type="radio" id="kondisi1" value="1" name="kondisi"
                                                class="form-control-input">
                                            <label class="col-form-label" for="kondisi1">Masih Buka</label>
                                        </div>
                                        <div class="col-md12">
                                            <input checked="" type="radio" id="kondisi2" value="0" name="kondisi"
                                                class="form-control-input">
                                            <label class="col-form-label " for="kondisi2">Sudah Tutup</label>
                                        </div>
                                    </div>
                                    <div class="alert-danger" id="errkondisi"></div>
                                </div>
                                <div id="div-keterangan" class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan
                                        Lembaga
                                        tutup</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="keterangan" class="summernote-simple"></textarea>
                                    </div>
                                </div>

                                <div id="field_bt" class='form-group row mb-4'> <label
                                        class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='kelas'>KELAS
                                        Terakhir (Khusus Sasaran BT)</label>
                                    <div class='col-sm-12 col-md-7'>
                                        <select name="kelas" class="form-control row mb-4" id="kelas">
                                            <option value="I">1</option>
                                            <option value="II">2</option>
                                            <option value="III">3</option>
                                            <option value="IV">4</option>
                                            <option value="V">5</option>
                                            <option value="VI">6</option>
                                            <option value="VII">7</option>
                                            <option value="VIII">8</option>
                                            <option value="IX">9</option>
                                            <option value="X">10</option>
                                            <option value="XI">11</option>
                                            <option value="XII">12</option>
                                        </select>
                                            <div class="alert-danger" id="errkelas"></div>
                                    </div>
                                </div>
                                <div id="field_bt2" class='form-group row mb-4'>
                                    <label class='col-form-label text-md-right col-12 col-md-3 col-lg-3'
                                        for='status'>Sudah Pernah Meluluskan?</label>
                                    <div class='col-sm-12 col-md-7'>
                                        <div class="col-md12">
                                            <input checked="" type="radio" id="lulus1" value="1"
                                                name="lulus" class="form-control-input">
                                            <label class="col-form-label" for="lulus1">Sudah</label>
                                        </div>
                                        <div class="col-md12">
                                            <input checked="" type="radio" id="lulus2" value="0"
                                                name="lulus" class="form-control-input">
                                            <label class="col-form-label " for="lulus2">Belum</label>
                                        </div>
                                    </div>
                                    <div class="alert-danger" id="errlulus"></div>
                                </div>
                                {{-- <div class='form-group row mb-4'> <label
                                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3' for='kuota_bt'>KUOTA
                                    BT</label>
                                <div class='col-sm-12 col-md-7'> <input id='kuota_bt' type='text' class='form-control'
                                        placeholder='kuota_bt' name='kuota_bt' value=''>
                                </div>
                            </div> --}}
                                {{-- //if bt { dikasih input kelas berapa } --}}
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="form_submit" type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </div>
        </form>
    </div>
</div>
@endsection

@push('js-custom')
<script src="admin_theme/library/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="admin_theme/library/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
<script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
<!-- Page Specific JS File -->
{{-- <script src="admin_theme/js/page/bootstrap-modal.js"></script> --}}
<script>
    $(document).ready(function () {
        //datatable
        var table = $('#table-1').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            ajax: {
                url: "/bmps", // ambil data
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'npsn',
                    name: 'npsn'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jenjang2',
                    name: 'jenjang2'
                },
                {
                    data: 'kab_kota',
                    name: 'kab_kota'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'aksi',
                    name: 'aksi'
                },
                {
                    data: 'kondisi',
                    name: 'kondisi'
                }
            ],
        });
        // modal
        $(document).on('click', '.show-btn', function () {
            $('#id-form').trigger("reset");
            var data_id = $(this).data('id');
            $.get("/sekolah/" + data_id, function (data) {
                // $("#modal-judul").html("Edit Data");
                // $("tombol-simpan").val("edit-post");
                $("#modal-show").modal('show');
                $('#tittle').text(data.nama);
                $('#no').val(data.no);
                $('#id').val(data.id);
                $('#npsnhd').val(data.npsn);
                $('#npsn').val(data.npsn);
                $('#nama_satuan_pendidikan').val(data.nama);
                $('#jenjang1').val(data.jenjang1);
                $('#jenjang2').val(data.jenjang2);
                $('#status').val(data.status);
                $('#alamat').val(data.alamat);
                $('#kelurahan').val(data.kelurahan);
                $('#kecamatan').val(data.kecamatan);
                $('#kab_kota').val(data.kab_kota);
                $('#lokasi').val(data.lokasi);
                $('#tahun_akre').val(data.tahun_akre);
                $('#nilai_akhir').val(data.nilai_akhir);
                $('#peringkat').val(data.peringkat);
                $('#namaks').val(data.namaks);
                $('#hpks').val(data.no_ks);
                $('#namapj').val(data.namapj);
                $('#hppj').val(data.hppj);
                $('#no_sk').val(data.no_sk);
                $('#tgl_sk').val(data.tgl_sk);
                $('#status_sasaran').val(data.status_sasaran);
                $('#tahap_visit').val(data.tahap_visit);
                var smmrnote = data.keterangan;
                $(".summernote-simple").summernote('code', smmrnote);
                $('#kuota_bt').val(data.kuota_bt);
                var status = data.status;
                var peringkat = data.peringkat;
                var file_ijop = data.file_ijop;
                var meluluskan = data.meluluskan;

                

                
                if (peringkat == "BT") {
                        $('#field_bt').show();
                        $('#field_bt2').show();
                    } else {
                        $('#field_bt').hide();
                        $('#field_bt2').hide();
                    }
                    var lulus = document.getElementById('lulus1');
                    var belum = document.getElementById('lulus2');
                    if (meluluskan == null) {
                        belum.checked = true
                        lulus.checked = false
                    } else if(meluluskan == 0){
                        belum.checked = true
                        lulus.checked = false
                    }else if(meluluskan == 1){
                        belum.checked = false
                        lulus.checked = true
                    }


                if (status == "NEGERI") 
                {
                    $('#collapse1').hide();
                    $('#collapse2').hide();
                    $('#file-success').hide();
                } 
                else if (status == "SWASTA"&&file_ijop !== null) 
                {
                    $('#collapse1').hide();
                    $('#collapse2').hide();
                    $('#file-success').show();
                }
                
                else
                {
                    $('#collapse1').show();
                    $('#collapse2').show();
                    $('#file-success').hide();
                }


                var buka = document.getElementById('kondisi1');
                var tutup = document.getElementById('kondisi2');
                var kondisi = data.kondisi;
                if (kondisi == 0) {
                    tutup.checked = true
                    buka.checked = false
                } else {
                    tutup.checked = false
                    buka.checked = true

                }
                if (tutup.checked) {
                    $('#div-keterangan').show();
                } else {
                    $('#div-keterangan').hide();
                }


                $('#kondisi1').click(function () {
                    $('#div-keterangan').hide();
                });
                $('#kondisi2').click(function () {
                    $('#div-keterangan').show();
                });

                // klik submit
                if ($("#id-form").length > 0) {
                    $("#id-form").validate({
                        // validasi mime type
                        rules: {
                            document: {
                                // wajib
                                extension: "pdf", // ekstensi pdf
                                filesize: 2097152, // ukuran file < 2mb
                            }
                        },
                        messages: {
                            document: {
                                required: "Tidak Boleh Kosong",
                                extension: "Mohon mengunggah dokumen berekstensi *pdf"
                            }
                        },
                        submitHandler: function (form) {
                            var actionType = $('#form_submit').val();
                            var formData = new FormData(form);
                            $('#form_submit').html('Menyimpan . .');
                            $.ajax({
                                type: "POST",
                                url: "{{ route('sekolah.store') }}",
                                data: formData,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    // console.log(response);
                                    $('#form-tambah-edit').trigger(
                                        "reset");
                                    $('#modal-show').modal(
                                        "hide");
                                    $('#form_submit').html('Simpan');
                                    //Reload Total Finansial Planing
                                    swal("Berhasil",
                                        "Berkas telah tersimpan",
                                        "success");
                                    // refresh yajra datatable
                                    var oTable = $("#table-1")
                                        .dataTable();
                                    oTable.fnDraw(false);
                                },
                                error: function (data) {
                                    console.log('Error',data);
                                    $('#errkcmtn').text(data.responseJSON.errors.kecamatan);
                                    $('#errhpks').text(data.responseJSON.errors.hpks);
                                    $('#errhppj').text(data.responseJSON.errors.hppj);
                                    $('#erralmt').text(data.responseJSON.errors.alamat);
                                    $('#errklrhn').text(data.responseJSON.errors.kelurahan);
                                    $('#errfile').text(data.responseJSON.errors.ijop);
                                    $('#errkondisi').text(data.responseJSON.errors.kondisi);
                                    $('#errmasa').text(data.responseJSON.errors.ijop_masa);
                                    $('#errkelas').text(data.responseJSON.errors.ijop_kelas);
                                    $('#form_submit').html('Gagal Simpan, mohon diperbaiki lalu klik saya lagi');
                                }
                            });
                        }
                    });
                }
            });
            // cek ukuran file yg diupload
            $.validator.addMethod('filesize', function (value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param)
                },
                'Ukuran dokumen terlalu besar'); // notifikasi apabila file > 2mb

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });



    });

</script>
@endpush

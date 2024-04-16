@extends('admin.layout.wrapper')
@section('admin-container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control">
                                    <option value="">-- Pilih Nama Anggota --</option>
                                    <option value="">Prof. Dr. Ir. Syaad Patmanthara, M.Pd</option>
                                    <option value="">Drs. R. Mujiraharjo, MM.</option>
                                    <option value="">DR. Ruddy Winarko, M.BA., MM.</option>
                                    <option value="">Phonny Aditiawan Mulyana, SE.,MM.</option>
                                    <option value="">Dr. Harmanto, M.Pd</option>
                                    <option value="">Dr. Nursamsu, M.Pd</option>
                                    <option value="">Nur Hidayati, M.Pd</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="judul">Judul
                                Kegiatan</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="judul" type="text" class="form-control" placeholder="Judul Kegiatan">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="tanggal">Tanggal
                                Kegiatan</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="tanggal" type="text" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="judul">Unggah
                                Bukti</label>
                            <div class="col-sm-12 col-md-7">
                                <input id="judul" type="file" class="form-control" placeholder="Judul Kegiatan">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>

    </div>
    </div>
@endsection

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
                                            <th>#</th>
                                            <th>Nama Field</th>
                                            <th>Tag Field</th>
                                        </tr>
                                    </thead>
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
    <script src="/admin_theme/library/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/admin_theme/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/admin_theme/library/select2/dist/js/select2.full.min.js"></script>
    <script src="/admin_theme/library/selectric/public/jquery.selectric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>

    <script>
        $(document).ready(function() {


            // $.ajax({
            //     type: "get",
            //     url: "{{ URL::to('list-form/list/') }}",
            //     // data: "data",
            //     dataType: "json",
            //     success: function(response) {
            //         console.log(response.data)
            //     }
            // });
            $('#tabel-config').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ URL::to('list-form/list/') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,

                    },
                    {
                        data: 'nama_field',
                        name: 'nama_field',
                        className: 'text-center'

                    },
                    {
                        data: 'tag_field',
                        name: 'tag_field',
                        className: 'text-center'

                    }
                ]

            });

            $('#tambah').click(function() {
                $('#id-form').attr("id", "id-form-tambah");
                $("#my-modal").modal('show');
            });
        });
    </script>
@endpush

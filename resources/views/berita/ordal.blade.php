@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/admin_theme/library/selectric/selectric.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
                            <button class="btn btn-primary" type="button" data-toggle="modal" id = "tambah">Tambah
                                Berita</button>
                            <button class="btn btn-primary" type="button" data-toggle="modal" id = "kategori">Tambah
                                Kategori</button>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Judul</th>
                                            <th>Gambar</th>
                                            <th>Isi</th>
                                            <th>Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->gmb }}</td>
                                                <td>{{ $item->isi }}</td>
                                                <td><a href="{{ url('form/' . $item->slug) }}" target="_blank"
                                                        class="btn btn-primary">Lihat Form</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="createCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Add modal-lg class here -->
            <form id="category-form" class="form-horizontal" enctype='multipart/form-data'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col mb-6">
                                <label for="categoryName" class="form-label">Nama Kategori</label>
                                <input type="text" id="categoryName" name="categoryName" class="form-control"
                                    placeholder="Masukan Nama Kategori">
                                <input type="hidden" name="id" id="category-id">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-6">
                                <label for="categoryDescription" class="form-label">Deskripsi Kategori</label>
                                <textarea name="categoryDescription" id="categoryDescription" class="form-control"
                                    placeholder="Masukan Deskripsi Kategori"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="btn_simpan_kategori" type="submit" class="btn btn-primary">Simpan Kategori</button>
                        </div>
                    </div>
            </form>
            <div class="container mt-5">
                <div class="card-datatable table-responsive pt-0 justify-content-center">
                    <table id="tabel-kategori" class="display responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    <div id="berita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
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
                                <input id='id' type='hidden' class='form-control' placeholder='npsn'
                                    name='id' value=''>
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
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/admin_theme/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admin_theme/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/admin_theme/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/admin_theme/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/admin_theme/library/select2/dist/js/select2.full.min.js"></script>
    <script src="/admin_theme/library/selectric/jquery.selectric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>




    <script>
        $(document).ready(function() {

            $('#tambah').click(function() {
                $('#berita').modal('show');
            });
            $('#kategori').click(function() {
                $('#createCategory').modal('show');
                $('#tabel-kategori').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/kategori',
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
                            data: 'desc',
                            name: 'desc'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
            // 🖊️ Edit button handler
            $('#tabel-kategori').on('click', '.editBtn', function() {
                let id = $(this).data('id');
                // Fetch data and show in modal or form
                $.get('/kategori/' + id + '/edit', function(data) {
                    // Populate form fields with `data`
                    $('#category-form input[name="categoryName"]').val(data.nama);
                    $('#category-form textarea[name="categoryDescription"]').val(data.desc);
                    $('#category-form input[name="id"]').val(data.id);
                });
            });

            // 🗑️ Delete button handler
            $('#tabel-kategori').on('click', '.deleteBtn', function() {
                let id = $(this).data('id');
                if (confirm("Are you sure you want to delete this category?")) {
                    $.ajax({
                        url: '/kategori/' + id,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // refresh yajra datatable
                            var oTable = $('#tabel-kategori')
                                .dataTable();
                            oTable.fnDraw(false);
                            alert('Category deleted successfully!');
                        },
                        error: function(xhr) {
                            alert('Failed to delete category.');
                        }
                    });
                }
            });

            // ** SIMPAN DATA * / 
            $(document).on('submit', '#category-form', function(e) {
                e.preventDefault()
                var formData = new FormData(this);
                // console.log(formData)

                $.ajax({
                    type: "POST",
                    url: "/kategori",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(response);
                        $('#category-form').trigger("reset");
                        $('#createCategory').modal(
                            "hide");
                        $('#btn-save').html('Simpan');
                        //Reload Total Finansial Planing
                        swal("Berhasil",
                            "Data Kategori Tersimpan",
                            "success");
                        // refresh yajra datatable
                        var oTable = $('#tabel-kategori')
                            .dataTable();
                        oTable.fnDraw(false);
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

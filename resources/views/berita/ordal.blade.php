@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.1.0/daterangepicker.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.4.0/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-selectric@1.13.0/public/selectric.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-timepicker@0.5.2/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.8.0/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" />
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
                            <button class="btn btn-primary" type="button" data-toggle="modal" id = "tambah">Tambah
                                Berita</button>
                            <button class="btn btn-primary" type="button" data-toggle="modal" id = "kategori">Tambah
                                Kategori</button>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">
                                <<table id="beritaTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Judul</th>
                                            <th>Gambar</th>
                                            <th>Isi</th>

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
                    <h5 id="berita-modal-tittle" class="modal-title" id="my-modal-title">Title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="id-form" enctype="multipart/form-data">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input class='form-control' type="text" name="judul" id="judul">
                                <input id='id' type='hidden' class='form-control' placeholder='npsn'
                                    name='id' value=''>
                            </div>
                            <div class="form-group">
                                <label>Pilih Gambar</label>
                                <input class='form-control' type="file" name="gmb" id="gmb">
                                <img id="image" src="" alt="Picture" hidden
                                    style="max-width: 100%; margin-top: 10px;">

                            </div>
                            <div class="form-group">
                                <button type="button" id="cropBtn" class="btn btn-primary">Crop & Preview</button>
                                <img hidden id="croppedPreview" src="" alt="Cropped Image"
                                    style="margin-top: 10px; max-width: 100%;">

                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori Form</label>
                                <select class="form-control" name="kategori" id="list-kategori" style="width: 100%">
                                    <option value="">Pilih Kategori</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Isi Berita</label>
                                <textarea name="isi" id="isi" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btn-save" class="btn btn-info"> Simpan</button>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.1.0/daterangepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.4.0/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-timepicker@0.5.2/js/bootstrap-timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.8.0/dist/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-selectric@1.13.0/public/jquery.selectric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>

    <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>




    <script>
        $(document).ready(function() {
            $('#beritaTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/ordal_berita',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'isi',
                        name: 'isi'
                    }
                ]
            });

            $('#tambah').click(function() {
                $('#berita').modal('show');
                $('#berita-modal-tittle').text('Tambah Berita');
                $('#isi').summernote({
                    height: 200
                });
                let cropper;

                $('#gmb').on('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = $('#image');
                            img.attr('src', e.target.result).removeAttr('hidden');

                            // Destroy previous cropper instance if exists
                            if (cropper) {
                                cropper.destroy();
                            }

                            // Wait for image to load before initializing Cropper
                            img.on('load', function() {
                                cropper = new Cropper(this, {
                                    aspectRatio: 1, // Optional: square crop
                                    viewMode: 1,
                                    autoCropArea: 0.8,
                                    responsive: true,
                                    background: false
                                });
                            });
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $('#image').attr('hidden', true).attr('src', '');
                        if (cropper) {
                            cropper.destroy();
                            cropper = null;
                        }
                    }
                });
                $('#cropBtn').on('click', function() {
                    if (cropper) {
                        const canvas = cropper.getCroppedCanvas({
                            width: 300, // optional: set desired output size
                            height: 300
                        });

                        // Show preview
                        const croppedDataUrl = canvas.toDataURL('image/png');
                        $('#croppedPreview').removeAttr('hidden');
                        $('#croppedPreview').attr('src', croppedDataUrl);

                        // Optional: convert to Blob for upload
                        canvas.toBlob(function(blob) {
                            // You can now send `blob` via AJAX or FormData
                            console.log('Blob ready:', blob);
                        }, 'image/png');
                    }
                });

                $('#list-kategori').select2({
                    placeholder: "Pilih Kategori",
                    allowClear: true,
                    ajax: {
                        url: '/get-kat',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: data.map(function(item) {
                                    return {
                                        id: item.id, // use item.id for value
                                        text: item.nama // use item.nama for display
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

            // ** TAMBAH BERITA ** //
            $(document).on('submit', '#id-form', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData();

                // Append all fields except empty 'id'
                $(form).serializeArray().forEach(function(field) {
                    if (field.name === 'id' && !field.value.trim()) {
                        // Skip empty id
                        return;
                    }
                    formData.append(field.name, field.value);
                });

                // Append file inputs manually
                const fileInput = form.querySelector('#gmb');
                if (fileInput && fileInput.files.length > 0) {
                    formData.append('gmb', fileInput.files[0]);
                }

                // Append cropped image if available
                const croppedImage = document.getElementById('croppedPreview').src;
                if (croppedImage && croppedImage.startsWith('data:image')) {
                    const byteString = atob(croppedImage.split(',')[1]);
                    const mimeString = croppedImage.split(',')[0].split(':')[1].split(';')[0];
                    const ab = new ArrayBuffer(byteString.length);
                    const ia = new Uint8Array(ab);
                    for (let i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }
                    const blob = new Blob([ab], {
                        type: mimeString
                    });
                    formData.append('croppedImage', blob, 'croppedImage.png');
                }

                $.ajax({
                    type: "POST",
                    url: "/ordal_berita",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        $('#id-form').trigger("reset");
                        $('#btn-save').html('Simpan');
                        swal("Berhasil", "Data Berita Tersimpan", "success");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(data) {
                        console.log('Error', data);
                    }
                });
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

            // ** SIMPAN DATA KATEGORI* / 
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
                        $('#category-form input[name="id"]').val('');
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

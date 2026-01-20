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
                                <table id="beritaTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Judul</th>
                                            <th>Gambar</th>
                                            <th>Isi</th>
                                            <th>Action</th>

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
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Global cropper instance
            let cropper = null;

            // Function to initialize cropper
            function initCropper(imageElement) {
                // Destroy previous cropper instance if exists
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }

                // Remove any existing load handlers to prevent duplicates
                $(imageElement).off('load.cropperInit');

                // Check if image is already loaded
                if (imageElement.complete && imageElement.naturalHeight !== 0) {
                    // Image is already loaded, initialize immediately
                    cropper = new Cropper(imageElement, {
                        aspectRatio: 1, // Optional: square crop
                        viewMode: 1,
                        autoCropArea: 0.8,
                        responsive: true,
                        background: false
                    });
                } else {
                    // Wait for image to load before initializing Cropper
                    $(imageElement).on('load.cropperInit', function() {
                        if (!cropper) {
                            cropper = new Cropper(imageElement, {
                                aspectRatio: 1, // Optional: square crop
                                viewMode: 1,
                                autoCropArea: 0.8,
                                responsive: true,
                                background: false
                            });
                        }
                    });
                }
            }

            // Function to reset form
            function resetBeritaForm() {
                $('#id-form')[0].reset();
                $('#id').val('');
                $('#berita-modal-tittle').text('Tambah Berita');
                $('#image').attr('hidden', true).attr('src', '');
                $('#croppedPreview').attr('hidden', true).attr('src', '');
                $('#list-kategori').val(null).trigger('change');
                if ($('#isi').summernote('code')) {
                    $('#isi').summernote('code', '');
                }
                // Destroy cropper if exists
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                // Clear file input
                $('#gmb').val('');
            }

            // Initialize summernote
            $('#isi').summernote({
                height: 200
            });

            // Handle file input change (for both add and edit)
            $(document).on('change', '#gmb', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = $('#image');
                        img.attr('src', e.target.result).removeAttr('hidden');
                        // Hide cropped preview when new image is selected
                        $('#croppedPreview').attr('hidden', true).attr('src', '');
                        // Initialize cropper
                        initCropper(img[0]);
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

            // Handle crop button click
            $(document).on('click', '#cropBtn', function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        width: 800, // Better quality for preview
                        height: 800
                    });

                    // Show preview
                    const croppedDataUrl = canvas.toDataURL('image/png');
                    $('#croppedPreview').removeAttr('hidden');
                    $('#croppedPreview').attr('src', croppedDataUrl);
                    $('#clearCropBtn').show();

                    swal("Success", "Gambar berhasil di-crop! Preview ditampilkan di bawah.", "success");
                } else {
                    swal("Warning", "Silakan pilih gambar terlebih dahulu.", "warning");
                }
            });

            // Handle clear crop button
            $(document).on('click', '#clearCropBtn', function() {
                $('#croppedPreview').attr('hidden', true).attr('src', '');
                $('#clearCropBtn').hide();
                // Reinitialize cropper if image exists
                if ($('#image').attr('src')) {
                    initCropper($('#image')[0]);
                }
            });

            $('#tambah').click(function() {
                resetBeritaForm();
                $('#berita').modal('show');
                $('#berita-modal-tittle').text('Tambah Berita');

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

            // ** EDIT BERITA ** //
            $(document).on('click', '.editBeritaBtn', function() {
                let id = $(this).data('id');
                
                // Reset form first
                resetBeritaForm();
                
                $.get('/admin/berita/' + id + '/edit', function(data) {
                    $('#berita').modal('show');
                    $('#berita-modal-tittle').text('Edit Berita');
                    $('#id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#isi').summernote('code', data.isi);
                    
                    // Set kategori
                    if (data.id_kat) {
                        // Fetch kategori list first
                        $.get('/get-kat', function(kategoris) {
                            var kategori = kategoris.find(k => k.id == data.id_kat);
                            if (kategori) {
                                $('#list-kategori').empty();
                                var option = new Option(kategori.nama, kategori.id, true, true);
                                $('#list-kategori').append(option).trigger('change');
                            }
                        });
                    }
                    
                    // Show existing image if available
                    if (data.gmb) {
                        const imageUrl = '{{ asset("") }}' + data.gmb;
                        const img = $('#image');
                        
                        // Wait for image to load before initializing cropper
                        img.on('load', function() {
                            // Only initialize if image is visible and cropper doesn't exist
                            if (!cropper && !img.attr('hidden')) {
                                initCropper(img[0]);
                            }
                        });
                        
                        img.attr('src', imageUrl).removeAttr('hidden');
                        
                        // If image is already loaded (cached), initialize immediately
                        if (img[0].complete && img[0].naturalHeight !== 0) {
                            setTimeout(function() {
                                if (!cropper) {
                                    initCropper(img[0]);
                                }
                            }, 100);
                        }
                    }
                });
            });

            // ** DELETE BERITA ** //
            $(document).on('click', '.deleteBeritaBtn', function() {
                let id = $(this).data('id');
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Data berita akan dihapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/admin/berita/' + id,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                swal("Berhasil", "Berita berhasil dihapus!", "success");
                                $('#beritaTable').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                swal("Error", "Gagal menghapus berita.", "error");
                            }
                        });
                    }
                });
            });

            // ** TAMBAH/UPDATE BERITA ** //
            $(document).on('submit', '#id-form', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData();
                const beritaId = $('#id').val();
                const isEdit = beritaId && beritaId.trim() !== '';

                // Append all fields
                $(form).serializeArray().forEach(function(field) {
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

                const url = isEdit ? '/admin/berita/' + beritaId : '/ordal_berita';
                const method = isEdit ? 'PUT' : 'POST';
                formData.append('_method', method);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        $('#berita').modal('hide');
                        resetBeritaForm();
                        swal("Berhasil", isEdit ? "Berita berhasil diperbarui!" : "Berita berhasil disimpan!", "success");
                        $('#beritaTable').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        console.log('Error', data);
                        swal("Error", "Terjadi kesalahan saat menyimpan data.", "error");
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

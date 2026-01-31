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
    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" />
@endpush

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">Berita Management</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <a href="#" class="hover:text-admin-primary transition-colors">Content</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">Berita</span>
        </nav>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-white">Berita List</h2>
                <div class="flex items-center space-x-3">
                    <button class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium" type="button" onclick="modalManager.open('beritaModal')" id="tambah">
                        <i class="fas fa-plus admin-icon"></i>
                        <span>Tambah Berita</span>
                    </button>
                    <button class="inline-flex items-center space-x-2 bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition-all font-medium" type="button" onclick="modalManager.open('categoryModal')" id="kategori">
                        <i class="fas fa-tags admin-icon"></i>
                        <span>Tambah Kategori</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="beritaTable" class="min-w-full divide-y divide-admin-border">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Isi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-admin-border">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Category Modal -->
    <div id="categoryModal" class="modal-wrapper modal-lg" data-open="false">
        <!-- Backdrop -->
        <div class="modal-backdrop" onclick="modalManager.close('categoryModal')"></div>
        
        <!-- Modal Content -->
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <form id="category-form" enctype='multipart/form-data'>
                    <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                        <h5 class="text-xl font-semibold text-white">Tambah Kategori</h5>
                        <button type="button" onclick="modalManager.close('categoryModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                            <i class="fas fa-times admin-icon-lg"></i>
                        </button>
                    </div>
                    <div class="p-6 overflow-y-auto flex-1 bg-white">
                        <div class="mb-4">
                            <label for="categoryName" class="form-label">Nama Kategori</label>
                            <input type="text" id="categoryName" name="categoryName" class="form-input"
                                placeholder="Masukan Nama Kategori">
                            <input type="hidden" name="id" id="category-id">
                        </div>
                        <div class="mb-6">
                            <label for="categoryDescription" class="form-label">Deskripsi Kategori</label>
                            <textarea name="categoryDescription" id="categoryDescription" rows="4" class="form-textarea"
                                placeholder="Masukan Deskripsi Kategori"></textarea>
                        </div>
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-admin-border">
                            <button type="button" onclick="modalManager.close('categoryModal')" class="btn btn-secondary">Batal</button>
                            <button id="btn_simpan_kategori" type="submit" class="btn btn-primary">
                                <i class="fas fa-save admin-icon mr-2"></i>Simpan Kategori
                            </button>
                        </div>
                    </div>
                </form>
                <div class="px-6 pb-6 bg-white">
                    <div class="bg-admin-light rounded-xl p-4">
                        <h6 class="text-sm font-semibold text-admin-text-primary mb-4">Daftar Kategori</h6>
                        <div class="overflow-x-auto">
                            <table id="tabel-kategori" class="min-w-full divide-y divide-admin-border">
                                <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Kategori</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Deskripsi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-admin-border">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Berita Modal -->
    <div id="beritaModal" class="modal-wrapper modal-xl" data-open="false">
        <!-- Backdrop -->
        <div class="modal-backdrop" onclick="modalManager.close('beritaModal')"></div>
        
        <!-- Modal Content -->
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 id="berita-modal-tittle" class="text-xl font-semibold text-white">Tambah Berita</h5>
                    <button type="button" onclick="modalManager.close('beritaModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto flex-1 bg-white">
                    <form id="id-form" enctype="multipart/form-data">
                        <input id='id' type='hidden' name='id' value=''>
                        
                        <!-- Judul Berita -->
                        <div class="mb-6">
                            <label class="form-label">
                                <i class="fas fa-heading admin-icon mr-2 text-admin-primary"></i>Judul Berita
                            </label>
                            <input class="form-input" 
                                   type="text" name="judul" id="judul" placeholder="Masukkan judul berita">
                        </div>

                        <!-- Pilih Gambar -->
                        <div class="mb-6">
                            <label class="form-label">
                                <i class="fas fa-image admin-icon mr-2 text-admin-primary"></i>Pilih Gambar
                            </label>
                            <input class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-admin-primary file:text-white hover:file:bg-admin-primary-dark file:cursor-pointer" 
                                   type="file" name="gmb" id="gmb" accept="image/*">
                            <div class="mt-4">
                                <img id="image" src="" alt="Picture" hidden class="w-full max-h-96 object-contain rounded-lg border border-admin-border">
                            </div>
                        </div>

                        <!-- Crop & Preview -->
                        <div class="mb-6">
                            <div class="flex items-center space-x-2 mb-3">
                                <button type="button" id="cropBtn" class="btn btn-primary">
                                    <i class="fas fa-crop admin-icon mr-2"></i>
                                    <span>Crop & Preview</span>
                                </button>
                                <button type="button" id="clearCropBtn" style="display: none;" class="btn btn-danger">
                                    <i class="fas fa-times admin-icon mr-2"></i>
                                    <span>Clear Crop</span>
                                </button>
                            </div>
                            <div class="mt-3">
                                <img hidden id="croppedPreview" src="" alt="Cropped Image" class="w-full max-h-96 object-contain rounded-lg border-2 border-admin-success shadow-admin">
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-6">
                            <label for="kategori" class="form-label">
                                <i class="fas fa-tags admin-icon mr-2 text-admin-primary"></i>Kategori Berita
                            </label>
                            <select class="form-select" 
                                    name="kategori" id="list-kategori" style="width: 100%">
                                <option value="">Pilih Kategori</option>
                            </select>
                        </div>

                        <!-- Isi Berita -->
                        <div class="mb-6">
                            <label class="form-label">
                                <i class="fas fa-align-left admin-icon mr-2 text-admin-primary"></i>Isi Berita
                            </label>
                            <div id="isi-editor" style="min-height: 300px;"></div>
                            <textarea name="isi" id="isi" style="display: none;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-admin-border">
                            <button type="button" onclick="modalManager.close('beritaModal')" class="btn btn-secondary">Batal</button>
                            <button type="submit" id="btn-save" class="btn btn-info">
                                <i class="fas fa-save admin-icon mr-2"></i>
                                <span>Simpan Berita</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

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
    <!-- Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>

    <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>

    <script>
        // Wait for jQuery and DOM to be ready
        $(document).ready(function() {
            // Initialize Quill Editor
            let quillEditor = new Quill('#isi-editor', {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: [
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'image'],
                            ['clean']
                        ],
                        handlers: {
                            image: function() {
                                // Create file input
                                const input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');
                                input.click();
                                
                                input.onchange = function() {
                                    const file = input.files[0];
                                    if (file) {
                                        // Check file size (max 5MB)
                                        if (file.size > 5 * 1024 * 1024) {
                                            if (typeof showToast !== 'undefined') {
                                                showToast('Ukuran gambar terlalu besar. Maksimal 5MB.', 'error');
                                            } else {
                                                alert('Ukuran gambar terlalu besar. Maksimal 5MB.');
                                            }
                                            return;
                                        }
                                        
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            const range = quillEditor.getSelection(true);
                                            quillEditor.insertEmbed(range.index, 'image', e.target.result);
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                };
                            }
                        }
                    }
                },
                placeholder: 'Tulis isi berita di sini...',
            });
            
            // Update hidden textarea when Quill content changes
            quillEditor.on('text-change', function() {
                $('#isi').val(quillEditor.root.innerHTML);
            });
            
            // Custom styles for Quill to match Tailwind theme
            const style = document.createElement('style');
            style.textContent = `
                .ql-toolbar {
                    border: 1px solid #e2e8f0 !important;
                    border-radius: 0.5rem 0.5rem 0 0 !important;
                    background: #f8fafc !important;
                    padding: 0.75rem !important;
                }
                .ql-container {
                    border: 1px solid #e2e8f0 !important;
                    border-top: none !important;
                    border-radius: 0 0 0.5rem 0.5rem !important;
                    font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
                    font-size: 1rem !important;
                }
                .ql-editor {
                    min-height: 300px !important;
                    color: #0f172a !important;
                    padding: 1rem !important;
                }
                .ql-editor.ql-blank::before {
                    color: #94a3b8 !important;
                    font-style: normal !important;
                }
                .ql-snow .ql-stroke {
                    stroke: #475569 !important;
                }
                .ql-snow .ql-fill {
                    fill: #475569 !important;
                }
                .ql-snow .ql-picker-label {
                    color: #475569 !important;
                }
                .ql-snow .ql-toolbar button:hover,
                .ql-snow .ql-toolbar button.ql-active,
                .ql-snow .ql-toolbar .ql-picker-label:hover,
                .ql-snow .ql-toolbar .ql-picker-label.ql-active {
                    color: #6366f1 !important;
                }
                .ql-snow .ql-toolbar button:hover .ql-stroke,
                .ql-snow .ql-toolbar button.ql-active .ql-stroke,
                .ql-snow .ql-toolbar .ql-picker-label:hover .ql-stroke,
                .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke {
                    stroke: #6366f1 !important;
                }
                .ql-snow .ql-toolbar button:hover .ql-fill,
                .ql-snow .ql-toolbar button.ql-active .ql-fill,
                .ql-snow .ql-toolbar .ql-picker-label:hover .ql-fill,
                .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-fill {
                    fill: #6366f1 !important;
                }
            `;
            document.head.appendChild(style);
            $('#beritaTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/ordal_berita',
                language: {
                    processing: '<div class="flex items-center justify-center p-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-admin-primary"></div><span class="ml-3 text-admin-text-primary">Loading...</span></div>',
                    emptyTable: '<div class="text-center py-8 text-admin-text-secondary">No data available</div>',
                    zeroRecords: '<div class="text-center py-8 text-admin-text-secondary">No matching records found</div>'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                        className: 'font-medium text-admin-text-primary'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'isi',
                        name: 'isi',
                        render: function(data) {
                            if (data && data.length > 100) {
                                return data.substring(0, 100) + '...';
                            }
                            return data || '-';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],
                drawCallback: function() {
                    // Apply Tailwind classes to DataTable elements
                    $('.dataTables_wrapper').addClass('w-full');
                    $('.dataTables_filter input').addClass('form-input ml-2');
                    $('.dataTables_length select').addClass('form-select ml-2');
                    $('.dataTables_paginate .paginate_button').addClass('btn btn-secondary mx-1');
                    $('.dataTables_paginate .paginate_button.current').removeClass('btn-secondary').addClass('btn-primary');
                }
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
                // Clear Quill editor
                if (quillEditor) {
                    quillEditor.setContents([]);
                    $('#isi').val('');
                }
                // Destroy cropper if exists
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                // Clear file input
                $('#gmb').val('');
            }

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

                    if (typeof showToast !== 'undefined') {
                        showToast("Gambar berhasil di-crop! Preview ditampilkan di bawah.", "success");
                    } else {
                        swal("Success", "Gambar berhasil di-crop! Preview ditampilkan di bawah.", "success");
                    }
                } else {
                    if (typeof showToast !== 'undefined') {
                        showToast("Silakan pilih gambar terlebih dahulu.", "warning");
                    } else {
                        swal("Warning", "Silakan pilih gambar terlebih dahulu.", "warning");
                    }
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

            // Initialize Select2 when berita modal opens
            $('#tambah').click(function() {
                resetBeritaForm();
                modalManager.open('beritaModal');
                $('#berita-modal-tittle').text('Tambah Berita');
                
                // Initialize Select2 after modal is shown
                setTimeout(function() {
                    // Destroy existing Select2 if exists
                    if ($('#list-kategori').hasClass('select2-hidden-accessible')) {
                        $('#list-kategori').select2('destroy');
                    }
                    
                    // Find the berita modal container
                    var beritaModalContainer = $('#beritaModal').first();
                    if (beritaModalContainer.length === 0) {
                        beritaModalContainer = $('body');
                    }
                    
                    $('#list-kategori').select2({
                        placeholder: "Pilih Kategori",
                        allowClear: true,
                        dropdownParent: beritaModalContainer,
                        ajax: {
                            url: '/get-kat',
                            dataType: 'json',
                            delay: 250,
                            processResults: function(data) {
                                return {
                                    results: data.map(function(item) {
                                        return {
                                            id: item.id,
                                            text: item.nama
                                        };
                                    })
                                };
                            },
                            cache: true
                        }
                    });
                }, 100);
            });

            // ** EDIT BERITA ** //
            $(document).on('click', '.editBeritaBtn', function() {
                let id = $(this).data('id');
                
                // Reset form first
                resetBeritaForm();
                
                $.get('/admin/berita/' + id + '/edit', function(data) {
                    modalManager.open('beritaModal');
                    $('#berita-modal-tittle').text('Edit Berita');
                    $('#id').val(data.id);
                    $('#judul').val(data.judul);
                    // Set Quill editor content
                    if (quillEditor && data.isi) {
                        quillEditor.root.innerHTML = data.isi;
                        $('#isi').val(data.isi);
                    }
                    
                    // Initialize Select2
                    setTimeout(function() {
                        if ($('#list-kategori').hasClass('select2-hidden-accessible')) {
                            $('#list-kategori').select2('destroy');
                        }
                        
                        var beritaModalContainer = $('#beritaModal').first();
                        if (beritaModalContainer.length === 0) {
                            beritaModalContainer = $('body');
                        }
                        
                        $('#list-kategori').select2({
                            placeholder: "Pilih Kategori",
                            allowClear: true,
                            dropdownParent: beritaModalContainer,
                            ajax: {
                                url: '/get-kat',
                                dataType: 'json',
                                delay: 250,
                                processResults: function(data) {
                                    return {
                                        results: data.map(function(item) {
                                            return {
                                                id: item.id,
                                                text: item.nama
                                            };
                                        })
                                    };
                                },
                                cache: true
                            }
                        });
                        
                        // Set kategori
                        if (data.id_kat) {
                            $.get('/get-kat', function(kategoris) {
                                var kategori = kategoris.find(k => k.id == data.id_kat);
                                if (kategori) {
                                    $('#list-kategori').empty();
                                    var option = new Option(kategori.nama, kategori.id, true, true);
                                    $('#list-kategori').append(option).trigger('change');
                                }
                            });
                        }
                    }, 100);
                    
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
                                if (typeof showToast !== 'undefined') {
                                    showToast("Berita berhasil dihapus!", "success");
                                } else {
                                    swal("Berhasil", "Berita berhasil dihapus!", "success");
                                }
                                $('#beritaTable').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                if (typeof showToast !== 'undefined') {
                                    showToast("Gagal menghapus berita.", "error");
                                } else {
                                    swal("Error", "Gagal menghapus berita.", "error");
                                }
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

                // Update hidden textarea with Quill content before submission
                if (quillEditor) {
                    $('#isi').val(quillEditor.root.innerHTML);
                }

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
                        modalManager.close('beritaModal');
                        resetBeritaForm();
                        if (typeof showToast !== 'undefined') {
                            showToast(isEdit ? "Berita berhasil diperbarui!" : "Berita berhasil disimpan!", "success");
                        } else {
                            swal("Berhasil", isEdit ? "Berita berhasil diperbarui!" : "Berita berhasil disimpan!", "success");
                        }
                        $('#beritaTable').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        console.log('Error', data);
                        if (typeof showToast !== 'undefined') {
                            showToast("Terjadi kesalahan saat menyimpan data.", "error");
                        } else {
                            swal("Error", "Terjadi kesalahan saat menyimpan data.", "error");
                        }
                    }
                });
            });

            $('#kategori').click(function() {
                modalManager.open('categoryModal');
                $('#tabel-kategori').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/kategori',
                        type: 'GET'
                    },
                    language: {
                        processing: '<div class="flex items-center justify-center p-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-admin-primary"></div><span class="ml-3 text-admin-text-primary">Loading...</span></div>',
                        emptyTable: '<div class="text-center py-8 text-admin-text-secondary">No data available</div>',
                        zeroRecords: '<div class="text-center py-8 text-admin-text-secondary">No matching records found</div>'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            className: 'text-center'
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                            className: 'font-medium text-admin-text-primary'
                        },
                        {
                            data: 'desc',
                            name: 'desc'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        }
                    ],
                    drawCallback: function() {
                        // Apply Tailwind classes to DataTable elements
                        $('.dataTables_wrapper').addClass('w-full');
                        $('.dataTables_filter input').addClass('form-input ml-2');
                        $('.dataTables_length select').addClass('form-select ml-2');
                        $('.dataTables_paginate .paginate_button').addClass('btn btn-secondary mx-1');
                        $('.dataTables_paginate .paginate_button.current').removeClass('btn-secondary').addClass('btn-primary');
                    }
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
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Kategori akan dihapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                if (willDelete) {
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
                            if (typeof showToast !== 'undefined') {
                                showToast("Kategori berhasil dihapus!", "success");
                            } else {
                                alert('Category deleted successfully!');
                            }
                        },
                        error: function(xhr) {
                            if (typeof showToast !== 'undefined') {
                                showToast("Gagal menghapus kategori.", "error");
                            } else {
                                alert('Failed to delete category.');
                            }
                        }
                    });
                }
                });
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
                        if (typeof showToast !== 'undefined') {
                            showToast("Data Kategori Tersimpan", "success");
                        } else {
                            swal("Berhasil",
                                "Data Kategori Tersimpan",
                                "success");
                        }
                        // refresh yajra datatable
                        var oTable = $('#tabel-kategori')
                            .dataTable();
                        oTable.fnDraw(false);
                        // Optionally close modal after success
                        // modalManager.close('categoryModal');
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
@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endpush

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="#" class="hover:text-admin-primary transition-colors">Home</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle }}</span>
        </nav>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-admin-success rounded-lg p-4 mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle admin-icon-lg text-admin-success"></i>
                <p class="text-admin-text-primary font-medium">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-admin-text-secondary hover:text-admin-text-primary transition-colors">
                <i class="fas fa-times admin-icon"></i>
            </button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Home Page Contents</h2>
                @if(count($availableKeys ?? []) > 0)
                <button type="button" onclick="openHomeContentModal()" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium" id="btn-add-home-content">
                    <i class="fas fa-plus admin-icon"></i>
                    <span>Add New Content</span>
                </button>
                @endif
            </div>
        </div>
        
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-admin-border" id="contents-table">
                    <thead class="bg-gradient-to-r from-admin-primary to-admin-secondary">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Section Key</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Section Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Content Preview</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Image</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Sort Order</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
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
    <!-- Home Content Modal (Add/Edit) -->
    <div id="homeContentModal" class="modal-wrapper modal-xl" data-open="false">
        <div class="modal-backdrop" onclick="modalManager.close('homeContentModal')"></div>
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="bg-gradient-to-r from-admin-primary to-admin-secondary px-6 py-4 flex items-center justify-between">
                    <h5 id="home-content-modal-title" class="text-xl font-semibold text-white">Add Home Content</h5>
                    <button type="button" onclick="modalManager.close('homeContentModal')" class="text-white hover:text-gray-200 transition-colors" aria-label="Close">
                        <i class="fas fa-times admin-icon-lg"></i>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto flex-1 bg-white">
                    <form id="home-content-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="home_content_id" value="">
                        <input type="hidden" name="_method" id="home_content_method" value="POST">
                        <input type="hidden" name="section_key" id="home_section_key_submit" value="">

                        <div class="mb-4" id="row-section-key-select">
                            <label for="home_section_key" class="form-label">Section Key <span class="text-red-500">*</span></label>
                            <select class="form-select" id="home_section_key" required>
                                <option value="">-- Select Section --</option>
                                @foreach($availableKeys ?? [] as $key => $section)
                                    <option value="{{ $key }}" data-name="{{ $section['name'] }}" data-type="{{ $section['type'] }}">{{ $section['name'] }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-admin-text-secondary mt-1">Each section can only be created once.</p>
                        </div>
                        <div class="mb-4" id="row-section-key-readonly" style="display: none;">
                            <label class="form-label">Section Key</label>
                            <input type="text" class="form-input bg-gray-100" id="home_section_key_display" readonly>
                            <input type="hidden" id="home_section_key_hidden" value="">
                        </div>

                        <div class="mb-4">
                            <label for="home_section_name" class="form-label">Section Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" name="section_name" id="home_section_name" required readonly>
                        </div>

                        <input type="hidden" name="content" id="home_content_value" value="">
                        <div class="mb-4" id="row-content-text" style="display: none;">
                            <label for="home_content_text" class="form-label">Content <span class="text-red-500">*</span></label>
                            <input type="text" class="form-input" id="home_content_text" placeholder="Enter content">
                        </div>

                        <div class="mb-4" id="row-content-rich" style="display: none;">
                            <label class="form-label">Content</label>
                            <div id="home-content-quill" style="min-height: 200px;"></div>
                        </div>

                        <div class="mb-4" id="row-hero-media-type" style="display: none;">
                            <label for="home_media_type" class="form-label">Media Type <span class="text-red-500">*</span></label>
                            <select class="form-select" name="media_type" id="home_media_type">
                                <option value="">-- Select --</option>
                                <option value="video">Video File</option>
                                <option value="youtube">YouTube URL</option>
                                <option value="image">Image File</option>
                            </select>
                        </div>
                        <div class="mb-4" id="row-hero-video" style="display: none;">
                            <label for="home_video_file" class="form-label">Video File</label>
                            <input type="file" class="form-input" name="video_file" id="home_video_file" accept="video/*">
                            <p class="text-sm text-admin-text-secondary mt-1">Max 10MB. mp4, webm, ogg</p>
                        </div>
                        <div class="mb-4" id="row-hero-youtube-url" style="display: none;">
                            <label for="home_media_url" class="form-label">YouTube URL</label>
                            <input type="text" class="form-input" name="media_url" id="home_media_url" placeholder="https://www.youtube.com/watch?v=...">
                        </div>

                        <div class="mb-4" id="row-image" style="display: none;">
                            <label for="home_image" class="form-label">Image <span id="home_image_required" class="text-red-500">*</span></label>
                            <input type="file" class="form-input" name="image" id="home_image" accept="image/*">
                            <p class="text-sm text-admin-text-secondary mt-1">Max 2MB. jpeg, png, jpg, gif</p>
                            <div id="home_image_preview" class="mt-2" style="display: none;">
                                <img id="home_image_preview_img" src="" alt="Preview" class="max-w-xs rounded-lg border border-admin-border">
                            </div>
                        </div>

                        <div class="mb-4" id="row-youtube-api" style="display: none;">
                            <label for="home_youtube_api_key" class="form-label">YouTube API Key</label>
                            <input type="text" class="form-input" name="youtube_api_key" id="home_youtube_api_key">
                        </div>
                        <div class="mb-4" id="row-youtube-channel" style="display: none;">
                            <label for="home_youtube_channel_id" class="form-label">YouTube Channel ID</label>
                            <input type="text" class="form-input" name="youtube_channel_id" id="home_youtube_channel_id">
                        </div>
                        <div class="mb-4" id="row-youtube-results" style="display: none;">
                            <label for="home_max_youtube_results" class="form-label">Max YouTube Results</label>
                            <input type="number" class="form-input" name="max_youtube_results" id="home_max_youtube_results" value="6" min="1" max="50">
                        </div>

                        <div class="mb-4">
                            <label for="home_sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-input" name="sort_order" id="home_sort_order" value="0">
                        </div>
                        <div class="mb-6">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" id="home_is_active" class="rounded border-admin-border text-admin-primary focus:ring-admin-primary">
                                <span class="form-label mb-0">Active</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-admin-border">
                            <button type="button" onclick="modalManager.close('homeContentModal')" class="btn btn-secondary">Cancel</button>
                            <button type="submit" id="home-content-submit-btn" class="btn btn-primary">
                                <i class="fas fa-save admin-icon mr-2"></i><span>Save Content</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js-custom')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        const HOME_EDIT_URL = "{{ url('admin/home') }}";
        const HOME_STORE_URL = "{{ route('admin.home.store') }}";
        const sectionKeys = @json($sectionKeys ?? []);
        let homeQuill = null;

        $(document).ready(function() {
            const table = $('#contents-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.home.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'section_key', name: 'section_key'},
                    {data: 'section_name', name: 'section_name'},
                    {data: 'content', name: 'content',
                        render: function(data) {
                            if (data && data.length > 50) return data.substring(0, 50) + '...';
                            return data || '-';
                        }
                    },
                    {data: 'image_preview', name: 'image_preview', orderable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'sort_order', name: 'sort_order'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });

            $('#home_section_key').on('change', updateHomeFieldsBySectionKey);
            $('#home_media_type').on('change', updateHomeHeroMediaFields);
            $('#home-content-form').on('submit', submitHomeContentForm);
        });

        function initHomeContentQuill() {
            const container = document.getElementById('home-content-quill');
            if (!container || homeQuill) return;
            homeQuill = new Quill(container, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
        }

        function updateHomeFieldsBySectionKey() {
            const select = document.getElementById('home_section_key');
            const nameInput = document.getElementById('home_section_name');
            const opt = select.options[select.selectedIndex];
            const sectionKeyReadonly = document.getElementById('row-section-key-readonly');
            const sectionKeySelect = document.getElementById('row-section-key-select');

            if (!opt || !opt.value) {
                nameInput.value = '';
                hideAllHomeConditionalFields();
                return;
            }
            nameInput.value = opt.getAttribute('data-name') || '';
            const type = opt.getAttribute('data-type') || '';

            document.getElementById('row-content-text').style.display = type === 'text' ? 'block' : 'none';
            document.getElementById('row-content-rich').style.display = type === 'rich_text' ? 'block' : 'none';
            document.getElementById('row-hero-media-type').style.display = type === 'hero_media' ? 'block' : 'none';
            document.getElementById('row-image').style.display = (type === 'image' || type === 'hero_media') ? 'block' : 'none';
            document.getElementById('row-youtube-api').style.display = document.getElementById('row-youtube-channel').style.display = document.getElementById('row-youtube-results').style.display = type === 'youtube' ? 'block' : 'none';

            if (type === 'hero_media') updateHomeHeroMediaFields();
            else {
                document.getElementById('row-hero-video').style.display = 'none';
                document.getElementById('row-hero-youtube-url').style.display = 'none';
            }
            if (type !== 'image' && type !== 'hero_media') {
                document.getElementById('home_image').removeAttribute('required');
            } else if (type === 'image') {
                document.getElementById('home_image').setAttribute('required', 'required');
            }
        }

        function updateHomeHeroMediaFields() {
            const mediaType = document.getElementById('home_media_type').value;
            document.getElementById('row-hero-video').style.display = mediaType === 'video' ? 'block' : 'none';
            document.getElementById('row-hero-youtube-url').style.display = mediaType === 'youtube' ? 'block' : 'none';
            const rowImage = document.getElementById('row-image');
            if (rowImage.style.display === 'block' && mediaType === 'image') rowImage.style.display = 'block';
            else if (mediaType !== 'image' && document.getElementById('home_section_key').value) {
                const type = sectionKeys[document.getElementById('home_section_key').value]?.type;
                rowImage.style.display = (type === 'image' || type === 'hero_media') ? 'block' : 'none';
            }
        }

        function openHomeContentModal() {
            initHomeContentQuill();
            document.getElementById('home-content-modal-title').textContent = 'Add Home Content';
            document.getElementById('home_content_id').value = '';
            document.getElementById('home_content_method').value = 'POST';
            document.getElementById('home_section_key_submit').value = '';
            document.getElementById('row-section-key-select').style.display = 'block';
            document.getElementById('row-section-key-readonly').style.display = 'none';
            document.getElementById('home_section_key').value = '';
            document.getElementById('home_section_key').removeAttribute('disabled');
            document.getElementById('home_section_name').value = '';
            document.getElementById('home_content_text').value = '';
            document.getElementById('home_content_value').value = '';
            if (homeQuill) homeQuill.setContents([]);
            document.getElementById('home_media_type').value = '';
            document.getElementById('home_media_url').value = '';
            document.getElementById('home_image').value = '';
            document.getElementById('home_image').removeAttribute('required');
            document.getElementById('home_image_preview').style.display = 'none';
            document.getElementById('home_youtube_api_key').value = '';
            document.getElementById('home_youtube_channel_id').value = '';
            document.getElementById('home_max_youtube_results').value = '6';
            document.getElementById('home_sort_order').value = '0';
            document.getElementById('home_is_active').checked = true;
            document.getElementById('home_video_file').value = '';
            hideAllHomeConditionalFields();
            document.getElementById('home-content-form').querySelector('input[name="_token"]').value = '{{ csrf_token() }}';
            modalManager.open('homeContentModal');
        }

        function hideAllHomeConditionalFields() {
            ['row-content-text', 'row-content-rich', 'row-hero-media-type', 'row-hero-video', 'row-hero-youtube-url', 'row-image', 'row-youtube-api', 'row-youtube-channel', 'row-youtube-results'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
        }

        function openEditHomeContent(id) {
            initHomeContentQuill();
            fetch(HOME_EDIT_URL + '/' + id + '/edit', {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            }).then(function(r) { return r.json();             }).then(function(data) {
                document.getElementById('home-content-modal-title').textContent = 'Edit Home Content';
                document.getElementById('home_content_id').value = data.id;
                document.getElementById('home_content_method').value = 'PUT';
                document.getElementById('home_section_key_submit').value = data.section_key || '';
                document.getElementById('row-section-key-select').style.display = 'none';
                document.getElementById('row-section-key-readonly').style.display = 'block';
                document.getElementById('home_section_key_display').value = data.section_key || '';
                document.getElementById('home_section_key_hidden').value = data.section_key || '';
                document.getElementById('home_section_name').value = data.section_name || '';
                document.getElementById('home_content_text').value = (data.section_key === 'organization_name') ? (data.content ? data.content.replace(/<[^>]*>/g, '') : '') : '';
                if (homeQuill) {
                    try {
                        homeQuill.root.innerHTML = (data.content != null && data.content !== '') ? data.content : '';
                    } catch (e) {
                        homeQuill.setText(data.content != null ? String(data.content) : '');
                    }
                }
                document.getElementById('home_content_value').value = data.content != null ? data.content : '';
                document.getElementById('home_media_type').value = data.media_type || '';
                document.getElementById('home_media_url').value = data.media_url || '';
                document.getElementById('home_youtube_api_key').value = data.youtube_api_key || '';
                document.getElementById('home_youtube_channel_id').value = data.youtube_channel_id || '';
                document.getElementById('home_max_youtube_results').value = data.max_youtube_results || 6;
                document.getElementById('home_sort_order').value = data.sort_order ?? 0;
                document.getElementById('home_is_active').checked = !!data.is_active;
                document.getElementById('home_image').value = '';
                document.getElementById('home_image').removeAttribute('required');
                document.getElementById('home_image_preview').style.display = data.image_path ? 'block' : 'none';
                if (data.image_path) {
                    var path = data.image_path;
                    document.getElementById('home_image_preview_img').src = path.indexOf('http') === 0 ? path : (window.location.origin + (path.indexOf('/') === 0 ? path : '/' + path));
                }
                document.getElementById('home_video_file').value = '';
                const type = sectionKeys[data.section_key] ? sectionKeys[data.section_key].type : '';
                document.getElementById('row-content-text').style.display = data.section_key === 'organization_name' ? 'block' : 'none';
                document.getElementById('row-content-rich').style.display = (type === 'rich_text') ? 'block' : 'none';
                document.getElementById('row-hero-media-type').style.display = type === 'hero_media' ? 'block' : 'none';
                document.getElementById('row-image').style.display = (type === 'image' || type === 'hero_media') ? 'block' : 'none';
                document.getElementById('row-youtube-api').style.display = document.getElementById('row-youtube-channel').style.display = document.getElementById('row-youtube-results').style.display = type === 'youtube' ? 'block' : 'none';
                updateHomeHeroMediaFields();
                document.getElementById('home_section_key').setAttribute('disabled', 'disabled');
                document.getElementById('home-content-form').querySelector('input[name="_token"]').value = '{{ csrf_token() }}';
                modalManager.open('homeContentModal');
            }).catch(function() {
                if (typeof showToast === 'function') showToast('Failed to load content', 'error'); else alert('Failed to load content.');
            });
        }

        function submitHomeContentForm(e) {
            e.preventDefault();
            const form = document.getElementById('home-content-form');
            const method = document.getElementById('home_content_method').value;
            const id = document.getElementById('home_content_id').value;
            const contentVal = document.getElementById('home_content_value');
            if (document.getElementById('row-content-text').style.display === 'block') {
                contentVal.value = document.getElementById('home_content_text').value || '';
            } else if (document.getElementById('row-content-rich').style.display === 'block' && homeQuill) {
                contentVal.value = homeQuill.root.innerHTML || '';
            } else {
                contentVal.value = '';
            }
            if (method === 'POST') {
                document.getElementById('home_section_key_submit').value = document.getElementById('home_section_key').value || '';
            }
            const formData = new FormData(form);
            if (method === 'PUT') formData.append('_method', 'PUT');
            const url = method === 'PUT' ? HOME_EDIT_URL + '/' + id : HOME_STORE_URL;
            const submitBtn = document.getElementById('home-content-submit-btn');
            submitBtn.disabled = true;
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            }).then(function(r) { return r.json().then(function(j) { return r.ok ? j : Promise.reject(j); }); }).then(function(res) {
                if (typeof showToast === 'function') showToast(res.message || 'Saved successfully.', 'success'); else alert(res.message || 'Saved successfully.');
                modalManager.close('homeContentModal');
                $('#contents-table').DataTable().ajax.reload();
            }).catch(function(err) {
                const msg = (err && err.message) ? err.message : (err && err.errors && Object.values(err.errors).flat().length) ? Object.values(err.errors).flat().join(' ') : 'Failed to save.';
                if (typeof showToast === 'function') showToast(msg, 'error'); else alert(msg);
            }).finally(function() { submitBtn.disabled = false; });
        }

        function deleteContent(id) {
            if (!confirm('Are you sure you want to delete this content?')) return;
            $.ajax({
                url: HOME_EDIT_URL + '/' + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        $('#contents-table').DataTable().ajax.reload();
                        if (typeof showToast === 'function') showToast(response.message || 'Deleted successfully.', 'success'); else alert(response.message || 'Deleted successfully.');
                    }
                },
                error: function() {
                    if (typeof showToast === 'function') showToast('Error deleting content.', 'error'); else alert('Error deleting content.');
                }
            });
        }
    </script>
@endpush
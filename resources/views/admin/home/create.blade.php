@extends('ad_layout.wrapper')
@push('css-custom')
    <link rel="stylesheet" href="/admin_theme/library/summernote/dist/summernote-bs4.css">
@endpush

@section('admin-container')
    <section>
        <div class="section-header">
            <h1>{{ $tittle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home.index') }}">Home Page Content</a></div>
                <div class="breadcrumb-item">{{ $tittle }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create New Content</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <h6>Please fix the following errors:</h6>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                            
                            <form action="{{ route('admin.home.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Section Key <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control @error('section_key') is-invalid @enderror" 
                                                name="section_key" id="section_key" required onchange="updateSectionName()">
                                            <option value="">-- Select Section --</option>
                                            @foreach($availableKeys as $key => $section)
                                                <option value="{{ $key }}" 
                                                        data-name="{{ $section['name'] }}"
                                                        data-description="{{ $section['description'] }}"
                                                        data-type="{{ $section['type'] }}"
                                                        {{ old('section_key') == $key ? 'selected' : '' }}>
                                                    {{ $section['name'] }} - {{ $section['description'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Select which section you want to manage. Each section can only be created once.</small>
                                        @error('section_key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                @if(count($availableKeys) == 0)
                                <div class="alert alert-info">
                                    <strong>Info:</strong> All available sections have already been created. You can edit existing sections from the list.
                                </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Section Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('section_name') is-invalid @enderror" 
                                               name="section_name" id="section_name" value="{{ old('section_name') }}" required readonly>
                                        <small class="form-text text-muted">This will be auto-filled based on your section key selection.</small>
                                        @error('section_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Text Input for simple text fields (like organization_name) -->
                                <div class="form-group row" id="content-text-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Content <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('content') is-invalid @enderror" 
                                               name="content" id="content-text-input" value="{{ old('content') }}" 
                                               placeholder="Enter organization name">
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Rich Text Editor for rich_text fields -->
                                <div class="form-group row" id="content-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Content</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control summernote @error('content') is-invalid @enderror" 
                                                  name="content" id="content-input" rows="10">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Hero Media Fields -->
                                <div class="form-group row" id="hero-media-type-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Media Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control @error('media_type') is-invalid @enderror" 
                                                name="media_type" id="media_type" onchange="updateHeroMediaFields()">
                                            <option value="">-- Select Media Type --</option>
                                            <option value="video" {{ old('media_type') == 'video' ? 'selected' : '' }}>Video File</option>
                                            <option value="youtube" {{ old('media_type') == 'youtube' ? 'selected' : '' }}>YouTube URL</option>
                                            <option value="image" {{ old('media_type') == 'image' ? 'selected' : '' }}>Image File</option>
                                        </select>
                                        <small class="form-text text-muted">Choose the type of media for hero background</small>
                                        @error('media_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row" id="hero-video-file-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Video File</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('video_file') is-invalid @enderror" 
                                               name="video_file" id="video_file" accept="video/*">
                                        <small class="form-text text-muted">Max size: 10MB, Formats: mp4, webm, ogg</small>
                                        @error('video_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row" id="hero-youtube-url-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">YouTube URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('media_url') is-invalid @enderror" 
                                               name="media_url" id="media_url" value="{{ old('media_url') }}" 
                                               placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/...">
                                        <small class="form-text text-muted">Enter full YouTube URL</small>
                                        @error('media_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="image-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Image <span class="text-danger" id="image-required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               name="image" accept="image/*" id="image-input">
                                        <small class="form-text text-muted">Max size: 2MB, Formats: jpeg, png, jpg, gif</small>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="youtube-api-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">YouTube API Key</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('youtube_api_key') is-invalid @enderror" 
                                               name="youtube_api_key" id="youtube_api_key" value="{{ old('youtube_api_key') }}">
                                        @error('youtube_api_key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="youtube-channel-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">YouTube Channel ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('youtube_channel_id') is-invalid @enderror" 
                                               name="youtube_channel_id" id="youtube_channel_id" value="{{ old('youtube_channel_id') }}">
                                        @error('youtube_channel_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" id="youtube-results-field" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Max YouTube Results</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('max_youtube_results') is-invalid @enderror" 
                                               name="max_youtube_results" id="max_youtube_results" value="{{ old('max_youtube_results', 6) }}" min="1" max="50">
                                        @error('max_youtube_results')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sort Order</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               name="sort_order" value="{{ old('sort_order', 0) }}">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="is_active" value="0">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="is_active" class="custom-switch-input" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Active</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Save Content</button>
                                        <a href="{{ route('admin.home.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
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
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
        
        function updateSectionName() {
            var select = document.getElementById('section_key');
            var sectionNameInput = document.getElementById('section_name');
            var selectedOption = select.options[select.selectedIndex];
            
            if (selectedOption.value) {
                var sectionName = selectedOption.getAttribute('data-name');
                sectionNameInput.value = sectionName;
                
                // Show/hide fields based on section type
                var sectionType = selectedOption.getAttribute('data-type');
                
                // Image field
                var imageField = document.getElementById('image-field');
                var imageInput = document.getElementById('image-input');
                if (sectionType === 'image') {
                    imageField.style.display = 'flex';
                    imageInput.setAttribute('required', 'required');
                    document.getElementById('image-required').style.display = 'inline';
                } else if (sectionType === 'youtube') {
                    imageField.style.display = 'none';
                    imageInput.removeAttribute('required');
                } else {
                    imageField.style.display = 'none';
                    imageInput.removeAttribute('required');
                }
                
                // YouTube fields
                var youtubeApiField = document.getElementById('youtube-api-field');
                var youtubeChannelField = document.getElementById('youtube-channel-field');
                var youtubeResultsField = document.getElementById('youtube-results-field');
                if (sectionType === 'youtube') {
                    youtubeApiField.style.display = 'flex';
                    youtubeChannelField.style.display = 'flex';
                    youtubeResultsField.style.display = 'flex';
                } else {
                    youtubeApiField.style.display = 'none';
                    youtubeChannelField.style.display = 'none';
                    youtubeResultsField.style.display = 'none';
                }
                
                // Content field - show text input for 'text' type, rich text editor for 'rich_text' type
                var contentTextField = document.getElementById('content-text-field');
                var contentField = document.getElementById('content-field');
                
                if (sectionType === 'text') {
                    // Show simple text input for text type (like organization_name)
                    contentTextField.style.display = 'flex';
                    contentField.style.display = 'none';
                } else if (sectionType === 'rich_text') {
                    // Show rich text editor for rich_text type
                    contentTextField.style.display = 'none';
                    contentField.style.display = 'flex';
                } else {
                    // Hide both
                    contentTextField.style.display = 'none';
                    contentField.style.display = 'none';
                }
                
                // Hero media fields
                var heroMediaTypeField = document.getElementById('hero-media-type-field');
                var heroVideoFileField = document.getElementById('hero-video-file-field');
                var heroYoutubeUrlField = document.getElementById('hero-youtube-url-field');
                if (sectionType === 'hero_media') {
                    heroMediaTypeField.style.display = 'flex';
                    // Show appropriate fields based on selected media type
                    updateHeroMediaFields();
                } else {
                    heroMediaTypeField.style.display = 'none';
                    heroVideoFileField.style.display = 'none';
                    heroYoutubeUrlField.style.display = 'none';
                    // Also show image field for hero_media if image type selected
                    if (sectionType === 'hero_media') {
                        imageField.style.display = 'flex';
                    }
                }
            } else {
                sectionNameInput.value = '';
                // Hide all conditional fields
                document.getElementById('image-field').style.display = 'none';
                document.getElementById('content-field').style.display = 'none';
                document.getElementById('content-text-field').style.display = 'none';
                document.getElementById('youtube-api-field').style.display = 'none';
                document.getElementById('youtube-channel-field').style.display = 'none';
                document.getElementById('youtube-results-field').style.display = 'none';
                document.getElementById('hero-media-type-field').style.display = 'none';
                document.getElementById('hero-video-file-field').style.display = 'none';
                document.getElementById('hero-youtube-url-field').style.display = 'none';
            }
        }
        
        function updateHeroMediaFields() {
            var mediaType = document.getElementById('media_type').value;
            var videoFileField = document.getElementById('hero-video-file-field');
            var youtubeUrlField = document.getElementById('hero-youtube-url-field');
            var imageField = document.getElementById('image-field');
            
            // Hide all fields first
            videoFileField.style.display = 'none';
            youtubeUrlField.style.display = 'none';
            imageField.style.display = 'none';
            
            // Show appropriate field based on media type
            if (mediaType === 'video') {
                videoFileField.style.display = 'flex';
            } else if (mediaType === 'youtube') {
                youtubeUrlField.style.display = 'flex';
            } else if (mediaType === 'image') {
                imageField.style.display = 'flex';
            }
        }
        
        // Initialize on page load if value is already selected
        $(document).ready(function() {
            if ($('#section_key').val()) {
                updateSectionName();
            }
        });
    </script>
@endpush

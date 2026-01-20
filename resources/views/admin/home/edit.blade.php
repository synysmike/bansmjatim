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
                            <h4>Edit Content: {{ $content->section_name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.home.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Section Key <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('section_key') is-invalid @enderror" 
                                               name="section_key" value="{{ old('section_key', $content->section_key) }}" required readonly>
                                        <small class="form-text text-muted">Section key cannot be changed after creation. This ensures data integrity.</small>
                                        @if(isset($sectionKeys[$content->section_key]))
                                            <div class="alert alert-info mt-2">
                                                <strong>Section Purpose:</strong> {{ $sectionKeys[$content->section_key]['description'] }}
                                            </div>
                                        @endif
                                        @error('section_key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Section Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('section_name') is-invalid @enderror" 
                                               name="section_name" value="{{ old('section_name', $content->section_name) }}" required>
                                        @error('section_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @if($content->section_key === 'organization_name')
                                    <!-- Text Input for organization name -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Organization Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('content') is-invalid @enderror" 
                                                   name="content" value="{{ old('content', strip_tags($content->content ?? '')) }}" 
                                                   placeholder="Enter organization name (e.g., BAN-PDM, BAN-S/M)" required>
                                            <small class="form-text text-muted">Enter the organization name without HTML tags</small>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @else
                                    <!-- Rich Text Editor for other content -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control summernote @error('content') is-invalid @enderror" 
                                                      name="content" rows="10">{{ old('content', $content->content) }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                @if($content->image_path)
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Current Image</label>
                                    <div class="col-sm-9">
                                        <img src="{{ asset($content->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px;">
                                    </div>
                                </div>
                                @endif

                                @if($content->section_key === 'hero_media')
                                    <!-- Hero Media Fields -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Media Type <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control @error('media_type') is-invalid @enderror" 
                                                    name="media_type" id="media_type" onchange="updateHeroMediaFields()">
                                                <option value="">-- Select Media Type --</option>
                                                <option value="video" {{ old('media_type', $content->media_type) == 'video' ? 'selected' : '' }}>Video File</option>
                                                <option value="youtube" {{ old('media_type', $content->media_type) == 'youtube' ? 'selected' : '' }}>YouTube URL</option>
                                                <option value="image" {{ old('media_type', $content->media_type) == 'image' ? 'selected' : '' }}>Image File</option>
                                            </select>
                                            @error('media_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    @if($content->media_type === 'video' && $content->media_url)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Current Video</label>
                                        <div class="col-sm-9">
                                            <video controls style="max-width: 300px;">
                                                <source src="{{ asset($content->media_url) }}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="form-group row" id="hero-video-file-field" style="display: {{ old('media_type', $content->media_type) == 'video' ? 'flex' : 'none' }};">
                                        <label class="col-sm-3 col-form-label">Change Video File</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control @error('video_file') is-invalid @enderror" 
                                                   name="video_file" id="video_file" accept="video/*">
                                            <small class="form-text text-muted">Max size: 10MB, Formats: mp4, webm, ogg. Leave empty to keep current.</small>
                                            @error('video_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row" id="hero-youtube-url-field" style="display: {{ old('media_type', $content->media_type) == 'youtube' ? 'flex' : 'none' }};">
                                        <label class="col-sm-3 col-form-label">YouTube URL</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('media_url') is-invalid @enderror" 
                                                   name="media_url" id="media_url" value="{{ old('media_url', $content->media_url) }}" 
                                                   placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/...">
                                            @error('media_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row" id="hero-image-field" style="display: {{ old('media_type', $content->media_type) == 'image' ? 'flex' : 'none' }};">
                                        <label class="col-sm-3 col-form-label">Change Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                   name="image" accept="image/*">
                                            <small class="form-text text-muted">Leave empty to keep current image</small>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @else
                                    <!-- Regular Image Upload -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Change Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                   name="image" accept="image/*">
                                            <small class="form-text text-muted">Leave empty to keep current image</small>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">YouTube API Key</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('youtube_api_key') is-invalid @enderror" 
                                               name="youtube_api_key" value="{{ old('youtube_api_key', $content->youtube_api_key) }}">
                                        @error('youtube_api_key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">YouTube Channel ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('youtube_channel_id') is-invalid @enderror" 
                                               name="youtube_channel_id" value="{{ old('youtube_channel_id', $content->youtube_channel_id) }}">
                                        @error('youtube_channel_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Max YouTube Results</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('max_youtube_results') is-invalid @enderror" 
                                               name="max_youtube_results" value="{{ old('max_youtube_results', $content->max_youtube_results ?? 6) }}" min="1" max="50">
                                        @error('max_youtube_results')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sort Order</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               name="sort_order" value="{{ old('sort_order', $content->sort_order) }}">
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
                                            <input type="checkbox" name="is_active" class="custom-switch-input" value="1" 
                                                   {{ old('is_active', $content->is_active) ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Active</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Update Content</button>
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
            
            // Initialize hero media fields if section is hero_media
            @if($content->section_key === 'hero_media')
                updateHeroMediaFields();
            @endif
        });
        
        function updateHeroMediaFields() {
            var mediaType = document.getElementById('media_type');
            if (!mediaType) return;
            
            var selectedType = mediaType.value;
            var videoFileField = document.getElementById('hero-video-file-field');
            var youtubeUrlField = document.getElementById('hero-youtube-url-field');
            var imageField = document.getElementById('hero-image-field');
            
            // Hide all fields first
            if (videoFileField) videoFileField.style.display = 'none';
            if (youtubeUrlField) youtubeUrlField.style.display = 'none';
            if (imageField) imageField.style.display = 'none';
            
            // Show appropriate field based on media type
            if (selectedType === 'video' && videoFileField) {
                videoFileField.style.display = 'flex';
            } else if (selectedType === 'youtube' && youtubeUrlField) {
                youtubeUrlField.style.display = 'flex';
            } else if (selectedType === 'image' && imageField) {
                imageField.style.display = 'flex';
            }
        }
    </script>
@endpush

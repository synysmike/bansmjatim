@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-formBuilder/3.4.2/form-render.min.css">
@endpush

@section('admin-container')
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.form-builder.index') }}" class="hover:text-admin-primary transition-colors">Form Builder</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $template->name }}</span>
        </nav>
    </div>

    <div class="bg-white rounded-2xl shadow-admin overflow-hidden">
        <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-white">{{ $template->name }}</h2>
                    @if($template->description)
                        <p class="text-white text-opacity-90 text-sm mt-1">{{ $template->description }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.form-builder.edit', $template->id) }}" class="inline-flex items-center space-x-2 bg-white text-admin-primary px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all font-medium">
                        <i class="fas fa-edit admin-icon"></i>
                        <span>Edit</span>
                    </a>
                    <a href="{{ route('admin.form-builder.index') }}" class="inline-flex items-center space-x-2 bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition-all font-medium">
                        <i class="fas fa-list admin-icon"></i>
                        <span>Back to list</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div id="render-wrap" class="form-render-wrap"></div>
        </div>
    </div>
@endsection

@push('js-custom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-formBuilder/3.4.2/form-render.min.js"></script>
    <script>
        (function() {
            var formData = @json($template->form_data ?? []);
            if (Array.isArray(formData) && formData.length > 0) {
                $('#render-wrap').formRender({ formData: formData });
            } else {
                $('#render-wrap').html('<p class="text-admin-text-secondary">No fields defined for this form.</p>');
            }
        })();
    </script>
@endpush

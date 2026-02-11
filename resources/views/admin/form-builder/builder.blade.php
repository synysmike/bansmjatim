@extends('ad_layout.wrapper')

@push('css-custom')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-formBuilder/3.4.2/form-builder.min.css">
@endpush

@section('admin-container')
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.form-builder.index') }}" class="hover:text-admin-primary transition-colors">Form Builder</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $template ? 'Edit' : 'Create' }}</span>
        </nav>
    </div>

    <form id="form-builder-form" action="{{ $template ? route('admin.form-builder.update', $template->id) : route('admin.form-builder.store') }}" method="POST" class="space-y-6">
        @csrf
        @if($template) @method('PUT') @endif

        <div class="bg-white rounded-2xl shadow-admin overflow-hidden">
            <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
                <h2 class="text-xl font-semibold text-white">Form details</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="form-name" class="form-label">Form name <span class="text-red-500">*</span></label>
                    <input type="text" id="form-name" name="name" class="form-input" value="{{ old('name', $template->name ?? '') }}" required placeholder="e.g. Contact Form" maxlength="255">
                </div>
                <div>
                    <label for="form-description" class="form-label">Description</label>
                    <textarea id="form-description" name="description" class="form-textarea" rows="2" placeholder="Optional description">{{ old('description', $template->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-admin overflow-hidden">
            <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
                <h2 class="text-xl font-semibold text-white">Drag & drop form fields</h2>
                <p class="text-white text-opacity-90 text-sm mt-1">Add and arrange fields below. The definition is saved with the form name.</p>
            </div>
            <div class="p-6">
                <div id="build-wrap" class="formbuilder-wrap"></div>
                <input type="hidden" name="form_data" id="form-data-input" value="">
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="submit" id="form-builder-submit" class="btn btn-primary">
                <i class="fas fa-save admin-icon"></i>
                {{ $template ? 'Update' : 'Save' }} form
            </button>
            <a href="{{ route('admin.form-builder.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection

@push('js-custom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-formBuilder/3.4.2/form-builder.min.js"></script>
    <script>
        (function() {
            var initialFormData = @json($template ? ($template->form_data ?? []) : []);
            var $wrap = $('#build-wrap');
            var $formDataInput = $('#form-data-input');
            var fb;

            if (Array.isArray(initialFormData) && initialFormData.length > 0) {
                fb = $wrap.formBuilder({ formData: initialFormData });
            } else {
                fb = $wrap.formBuilder();
            }

            $('#form-builder-form').on('submit', function(e) {
                try {
                    var instance = (fb && fb.actions) ? fb : $wrap.data('formBuilder');
                    if (!instance || !instance.actions) {
                        e.preventDefault();
                        alert('Form builder not ready. Please try again.');
                        return false;
                    }
                    var data = instance.actions.getData('json');
                    if (typeof data === 'string') {
                        $formDataInput.val(data);
                    } else {
                        $formDataInput.val(JSON.stringify(data || []));
                    }
                } catch (err) {
                    e.preventDefault();
                    alert('Could not get form definition. Please try again.');
                    return false;
                }
            });
        })();
    </script>
@endpush

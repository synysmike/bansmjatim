<div class="form-group mb-6">
    <label for="field-{{ $field->nama_field }}" class="form-label">{{ $field->label }} @if($field->required)<span class="text-red-500">*</span>@endif</label>
    <input type="email" id="field-{{ $field->nama_field }}" name="{{ $field->nama_field }}" class="form-input form-control w-full"
           value="{{ old($field->nama_field) }}" @if($field->required) required @endif
           placeholder="{{ $field->placeholder ?? '' }}">
</div>

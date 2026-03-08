<div class="form-group mb-6">
    <label for="field-{{ $field->nama_field }}" class="form-label">{{ $field->label }} @if($field->required)<span class="text-red-500">*</span>@endif</label>
    <textarea id="field-{{ $field->nama_field }}" name="{{ $field->nama_field }}" class="form-textarea form-control w-full" rows="3"
              @if($field->required) required @endif
              placeholder="{{ $field->placeholder ?? '' }}">{{ old($field->nama_field) }}</textarea>
</div>

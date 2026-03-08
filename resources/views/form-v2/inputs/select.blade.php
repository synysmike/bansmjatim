@php
    $options = $field->options ?? [];
    if (is_string($options)) {
        $options = json_decode($options, true) ?: [];
    }
@endphp
<div class="form-group mb-6">
    <label for="field-{{ $field->nama_field }}" class="form-label">{{ $field->label }} @if($field->required)<span class="text-red-500">*</span>@endif</label>
    <select id="field-{{ $field->nama_field }}" name="{{ $field->nama_field }}" class="form-select form-control w-full" @if($field->required) required @endif>
        <option value="">-- Pilih --</option>
        @foreach($options as $opt)
            @if(is_array($opt))
                <option value="{{ $opt['value'] ?? $opt['id'] ?? '' }}" {{ old($field->nama_field) == ($opt['value'] ?? $opt['id']) ? 'selected' : '' }}>{{ $opt['label'] ?? $opt['text'] ?? $opt['value'] ?? '' }}</option>
            @else
                <option value="{{ $opt }}">{{ $opt }}</option>
            @endif
        @endforeach
    </select>
</div>

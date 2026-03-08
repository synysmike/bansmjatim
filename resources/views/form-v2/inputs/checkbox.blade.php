@php
    $options = $field->options ?? [];
    if (is_string($options)) {
        $options = json_decode($options, true) ?: [];
    }
    $oldVal = old($field->nama_field);
    if (!is_array($oldVal)) {
        $oldVal = $oldVal !== null && $oldVal !== '' ? [$oldVal] : [];
    }
@endphp
<div class="form-group mb-6">
    <span class="form-label block">{{ $field->label }} @if($field->required)<span class="text-red-500">*</span>@endif</span>
    <div class="flex flex-wrap gap-4 mt-2">
        @foreach($options as $opt)
            @php
                $val = is_array($opt) ? ($opt['value'] ?? $opt['id'] ?? '') : $opt;
                $lab = is_array($opt) ? ($opt['label'] ?? $opt['text'] ?? $opt['value'] ?? '') : $opt;
                $checked = in_array((string)$val, array_map('strval', $oldVal));
            @endphp
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="{{ $field->nama_field }}[]" value="{{ $val }}" class="form-checkbox"
                    {{ $checked ? 'checked' : '' }}>
                <span>{{ $lab }}</span>
            </label>
        @endforeach
    </div>
</div>

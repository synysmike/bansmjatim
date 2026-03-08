@php
    $tipe = in_array($field->tipe, \App\Models\FormFieldDefinition::TYPES) ? $field->tipe : 'text';
@endphp
@include('form-v2.inputs.' . $tipe, ['field' => $field])

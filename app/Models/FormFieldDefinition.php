<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormFieldDefinition extends Model
{
    protected $table = 'form_field_definitions';

    protected $fillable = [
        'nama_field',
        'tipe',
        'label',
        'required',
        'options',
        'placeholder',
        'sort_order',
    ];

    protected $casts = [
        'required' => 'boolean',
        'options' => 'array',
    ];

    /**
     * Allowed types for validation.
     */
    public const TYPES = ['text', 'select', 'date', 'textarea', 'number', 'email', 'radio', 'checkbox'];
}

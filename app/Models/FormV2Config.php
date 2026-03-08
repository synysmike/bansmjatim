<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormV2Config extends Model
{
    protected $table = 'form_v2_config';

    protected $fillable = [
        'link',
        'judul',
        'kategori',
        'field_names',
        'is_active',
        'signature_enabled',
    ];

    protected $casts = [
        'field_names' => 'array',
        'is_active' => 'boolean',
        'signature_enabled' => 'boolean',
    ];

    public function submissions()
    {
        return $this->hasMany(FormV2Submission::class, 'link', 'link');
    }

    /**
     * Get ordered field definitions for this config.
     */
    public function getOrderedFieldDefinitions()
    {
        $names = $this->field_names ?? [];
        if (empty($names)) {
            return collect([]);
        }
        $defs = FormFieldDefinition::whereIn('nama_field', $names)->get()->keyBy('nama_field');
        return collect($names)->map(function ($name) use ($defs) {
            return $defs->get($name);
        })->filter()->values();
    }
}

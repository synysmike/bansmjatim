<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormTemplate extends Model
{
    use HasFactory;

    protected $table = 'form_templates';

    protected $fillable = [
        'name',
        'slug',
        'form_data',
        'description',
        'is_active',
    ];

    protected $casts = [
        'form_data' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    /**
     * Get form definition as JSON string for formBuilder/formRender.
     */
    public function getFormDataJsonAttribute(): string
    {
        return $this->form_data ? json_encode($this->form_data) : '[]';
    }
}

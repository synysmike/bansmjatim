<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FormV2Submission extends Model
{
    protected $table = 'form_v2_submissions';

    protected $fillable = [
        'link',
        'kategori',
        'tanggal',
        'payload',
        'signature_path',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}

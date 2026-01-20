<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nama_sekretariat extends Model
{
    // use HasFactory;
    protected $table = 'tbm_nama_sekretariat';
    
    protected $fillable = [
        'nama',
        'unit',
        'photo',
        'createdAt',
        'updated_at',
    ];
    
    protected $dates = [
        'createdAt',
        'updated_at',
    ];
}

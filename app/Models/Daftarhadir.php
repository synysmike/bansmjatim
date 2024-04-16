<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
class Daftarhadir extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function nia_asesor()
    {
        return $this->belongsTo(asesor::class, 'nia', 'nia');
    
    }
}


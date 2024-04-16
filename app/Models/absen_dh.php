<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen_dh extends Model
{
    // use HasFactory;
    protected $table = 'tbr_dhabsen';
    protected $fillable = ['nama_judul',
    'tanggal',
    'createdAt',
    'ttd',
    'soft_deletes',
    'updated_at',
    'id_judul_absen',
    'id_jabatan',
    'id_nama'];

    

}

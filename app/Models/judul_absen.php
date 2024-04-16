<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class judul_absen extends Model
{
    // use HasFactory;
    protected $table = 'tbm_judul_absen';
    protected $fillable = ['judul','tanggal','activate'];

}

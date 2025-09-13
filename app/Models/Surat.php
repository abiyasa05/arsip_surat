<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'kategori',
        'judul',
        'tanggal_surat',
        'deskripsi',
        'file_path',
    ];
}

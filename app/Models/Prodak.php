<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'logo',
        'gejala',
        'usia',
        'kategori',
        'harga',
        'deskripsi',
        'manfaat',
        'dosis',
        'aturan_pakai',
    ];
}

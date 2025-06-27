<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'user_preferences';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'gejala',
        'usia',
        'kategori',
    ];

    // Relasi dengan tabel users (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  

}

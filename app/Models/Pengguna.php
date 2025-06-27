<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Ubah ini
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable // Pastikan ini digunakan, bukan Model
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna'; // Pastikan nama tabel benar

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

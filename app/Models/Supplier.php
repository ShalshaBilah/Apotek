<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
    ];
    protected $primaryKey = 'id_supplier';
    use HasFactory;
}

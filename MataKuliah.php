<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    // Tentukan kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama',
        'kode',
        'sks',
    ];
}


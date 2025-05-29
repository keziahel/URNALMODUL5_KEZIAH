<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Tentukan kolom-kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'telepon',
    ];
}

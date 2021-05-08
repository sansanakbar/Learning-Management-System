<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilSiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_siswa',
        'nama',
        'tgl_lahir',
        'jenis_kelamin',
        'email',
        'kontak',
        'nisn',
        'id_kelas'
    ];
}

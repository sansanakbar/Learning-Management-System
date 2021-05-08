<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilGuru extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_guru',
        'nama',
        'tgl_lahir',
        'jenis_kelamin',
        'email',
        'kontak',
        'nip'
    ];
}

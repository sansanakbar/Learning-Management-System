<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuruMapelKelasMateriDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gurumapelkelas_materi_details';

    protected $fillable = [
        'id_gurumapelkelas',
        'id_materi'
    ];
}


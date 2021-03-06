<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuruMapelKelasDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gurumapel_kelas_details';

    protected $fillable = [
        'id_gurumapel',
        'id_kelas'
    ];
}

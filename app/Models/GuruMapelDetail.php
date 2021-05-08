<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruMapelDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_guru',
        'id_mapel'
    ];
}

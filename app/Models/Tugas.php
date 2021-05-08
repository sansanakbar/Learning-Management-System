<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul_tugas',
        'isi_tugas',
        'lampiran_tugas',
        'path'
    ];
}

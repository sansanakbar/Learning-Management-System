<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul_materi',
        'isi_materi',
        'lampiran_materi',
        'path'
    ];
}

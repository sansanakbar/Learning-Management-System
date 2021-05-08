<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JawabanTugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'isi_jawabantugas',
        'lampiran_jawabantugas',
        'path',
        'nilai_jawabantugas',
        'evaluasi_jawabantugas'
    ];
}

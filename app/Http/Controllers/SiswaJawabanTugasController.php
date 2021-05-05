<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaJawabanTugasController extends Controller
{
    public function index($idGuruMapelKelas, $idTugas){
        $tugas = DB::table('tugass')
                ->where('id', $idTugas)
                ->first();
        //dd($tugas);
        return view('siswa_jawabantugas', compact('tugas'));
    }
}

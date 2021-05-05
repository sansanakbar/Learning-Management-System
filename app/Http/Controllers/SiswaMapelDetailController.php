<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaMapelDetailController extends Controller
{
    public function index($idGuruMapelKelas){
        $noMateri = 1;
        $materis = DB::table('gurumapelkelas_materi_detail')
                    ->join('materis', 'gurumapelkelas_materi_detail.id_materi', '=', 'materis.id')
                    ->where('id_gurumapelkelas', $idGuruMapelKelas)
                    ->select('gurumapelkelas_materi_detail.*', 'materis.judul_materi', 'materis.isi_materi', 'materis.lampiran_materi')
                    ->get();
        
        $noTugas = 1;
        $tugass = DB::table('gurumapelkelas_tugas_detail')
                    ->join('tugass', 'gurumapelkelas_tugas_detail.id_tugas', '=', 'tugass.id')
                    ->where('id_gurumapelkelas', $idGuruMapelKelas)
                    ->select('gurumapelkelas_tugas_detail.*', 'tugass.judul_tugas', 'tugass.isi_tugas', 'tugass.lampiran_tugas')
                    ->get();
        
        return view('siswamapel_detail', compact('noMateri', 'materis', 'noTugas', 'tugass'));
    }
}

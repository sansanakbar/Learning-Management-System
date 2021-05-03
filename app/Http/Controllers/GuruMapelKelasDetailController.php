<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruMapelKelasDetailController extends Controller
{
    public function index($idGuruMapel, $idGuruMapelKelas){
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

        $noSiswa = 1;
        $siswas = DB::table('profil_siswa')
                    ->join('gurumapel_kelas_detail', 'profil_siswa.id_kelas', '=', 'gurumapel_kelas_detail.id_kelas')
                    ->where('gurumapel_kelas_detail.id', $idGuruMapelKelas)
                    ->select('profil_siswa.*', 'gurumapel_kelas_detail.id_gurumapel')
                    ->get();
        
        return view('gurumapelkelas_detail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ], compact('materis', 'noMateri', 'noTugas', 'tugass', 'noSiswa', 'siswas'));
    }
}

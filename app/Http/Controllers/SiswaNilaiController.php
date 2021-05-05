<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaNilaiController extends Controller
{
    public function index(){
        $idUser = auth()->user()->id;
        $idKelas = DB::table('profil_siswa')->where('id_siswa', $idUser)->value('id_kelas');

        $mapels = DB::table('gurumapel_kelas_detail')
                ->join('guru_mapel_detail', 'gurumapel_kelas_detail.id_gurumapel', '=', 'guru_mapel_detail.id') 
                ->join('mapels', 'guru_mapel_detail.id_mapel', '=', 'mapels.id')
                ->join('profil_guru', 'guru_mapel_detail.id_guru', '=', 'profil_guru.id_guru')
                ->where('gurumapel_kelas_detail.id_kelas', $idKelas)
                ->select(
                    'gurumapel_kelas_detail.*', 
                    'guru_mapel_detail.id_guru', 
                    'guru_mapel_detail.id_mapel', 
                    'mapels.kode_mapel', 
                    'mapels.nama_mapel', 
                    'profil_guru.nama'
                    )
                ->get();

        $noTugas = 1;
        $tugass = DB::table('gurumapelkelas_tugas_detail')
                    ->join('tugass', 'gurumapelkelas_tugas_detail.id_tugas', '=', 'tugass.id')
                    ->leftjoin('jawaban_tugass', 'gurumapelkelas_tugas_detail.id', '=', 'jawaban_tugass.id_gurumapelkelastugas')
                    ->select(
                        'gurumapelkelas_tugas_detail.*', 
                        'tugass.judul_tugas', 
                        'tugass.isi_tugas', 
                        'tugass.lampiran_tugas',
                        'jawaban_tugass.nilai'
                        )
                    ->get();
        return view('siswa_nilai', compact('mapels', 'noTugas', 'tugass'));
    }
}

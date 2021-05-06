<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelKelasDetail;
use App\Models\GuruMapelKelasTugasDetail;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaNilaiController extends Controller
{
    public function index(){
        $idUser = auth()->user()->id;
        $idKelas = ProfilSiswa::where('id_siswa', $idUser)->value('id_kelas');

        $mapels = GuruMapelKelasDetail::join('guru_mapel_details', 'gurumapel_kelas_details.id_gurumapel', '=', 'guru_mapel_details.id') 
                ->join('mapels', 'guru_mapel_details.id_mapel', '=', 'mapels.id')
                ->join('profil_gurus', 'guru_mapel_details.id_guru', '=', 'profil_gurus.id_guru')
                ->where('gurumapel_kelas_details.id_kelas', $idKelas)
                ->select(
                    'gurumapel_kelas_details.*', 
                    'guru_mapel_details.id_guru', 
                    'guru_mapel_details.id_mapel', 
                    'mapels.kode_mapel', 
                    'mapels.nama_mapel', 
                    'profil_gurus.nama'
                    )
                ->get();

        $noTugas = 1;
        $tugass = GuruMapelKelasTugasDetail::join('tugas', 'gurumapelkelas_tugas_details.id_tugas', '=', 'tugas.id')
                    ->leftjoin('jawaban_tugas', 'gurumapelkelas_tugas_details.id', '=', 'jawaban_tugas.id_gurumapelkelastugas')
                    ->select(
                        'gurumapelkelas_tugas_details.*', 
                        'tugas.judul_tugas', 
                        'tugas.isi_tugas', 
                        'tugas.lampiran_tugas',
                        'jawaban_tugas.nilai'
                        )
                    ->get();
        return view('siswa_nilai', compact('mapels', 'noTugas', 'tugass'));
    }
}

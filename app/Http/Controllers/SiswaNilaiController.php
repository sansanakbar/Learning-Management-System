<?php

namespace App\Http\Controllers;

use App\Models\ProfilSiswa;
use App\Models\JawabanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GuruMapelKelasDetail;
use App\Models\GuruMapelKelasTugasDetail;

class SiswaNilaiController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
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
        $tugass = JawabanTugas::join('gurumapelkelas_tugas_details', 'gurumapelkelas_tugas_details.id', '=', 'jawaban_tugas.id_gurumapelkelastugas')
                    ->join('tugas', 'gurumapelkelas_tugas_details.id_tugas', '=', 'tugas.id')
                    ->select(
                        'jawaban_tugas.*',
                        'gurumapelkelas_tugas_details.id_tugas', 
                        'gurumapelkelas_tugas_details.id_gurumapelkelas',
                        'tugas.judul_tugas', 
                        'tugas.isi_tugas', 
                        'tugas.lampiran_tugas'
                        )
                    ->get();

        return view('siswa_nilai', compact('mapels', 'noTugas', 'tugass'));
    }
}

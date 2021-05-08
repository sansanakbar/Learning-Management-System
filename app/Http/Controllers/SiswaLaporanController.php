<?php

namespace App\Http\Controllers;

use App\Models\ProfilSiswa;
use App\Models\JawabanTugas;
use Illuminate\Http\Request;
use App\Models\GuruMapelKelasDetail;

class SiswaLaporanController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index(){
        $idAkun = auth()->user()->id;
        $profil = ProfilSiswa::where('id_siswa', $idAkun)->first();

        $tugass = JawabanTugas::where('id_siswa', $idAkun)
                ->join('gurumapelkelas_tugas_details', 'gurumapelkelas_tugas_details.id', '=', 'jawaban_tugas.id_gurumapelkelastugas')
                ->join('gurumapel_kelas_details', 'gurumapel_kelas_details.id', '=', 'gurumapelkelas_tugas_details.id_gurumapelkelas')
                ->join('guru_mapel_details', 'guru_mapel_details.id', '=', 'gurumapel_kelas_details.id_gurumapel')
                ->join('tugas', 'tugas.id', '=', 'gurumapelkelas_tugas_details.id_tugas')
                ->join('mapels', 'mapels.id', '=', 'guru_mapel_details.id_mapel')
                ->orderBy('nilai_jawabantugas', 'asc')
                ->get();

        $idKelas = ProfilSiswa::where('id_siswa', $idAkun)->value('id_kelas');

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

        $nNilai = 0;
        $nilaiRata = 0;

        return view('siswa_laporan', compact('profil', 'tugass', 'nilaiRata', 'mapels', 'nNilai'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelKelasMateriDetail;
use App\Models\GuruMapelKelasTugasDetail;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruMapelKelasDetailController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($idGuruMapel, $idGuruMapelKelas){
        $noMateri = 1;
        $materis = GuruMapelKelasMateriDetail::join('materis', 'gurumapelkelas_materi_details.id_materi', '=', 'materis.id')
                    ->where('id_gurumapelkelas', $idGuruMapelKelas)
                    ->select('gurumapelkelas_materi_details.*', 'materis.judul_materi', 'materis.isi_materi', 'materis.lampiran_materi')
                    ->get();
        
        $noTugas = 1;
        $tugass = GuruMapelKelasTugasDetail::join('tugas', 'gurumapelkelas_tugas_details.id_tugas', '=', 'tugas.id')
                    ->where('id_gurumapelkelas', $idGuruMapelKelas)
                    ->select('gurumapelkelas_tugas_details.*', 'tugas.judul_tugas', 'tugas.isi_tugas', 'tugas.lampiran_tugas')
                    ->get();

        $noSiswa = 1;
        $siswas = ProfilSiswa::join('gurumapel_kelas_details', 'profil_siswas.id_kelas', '=', 'gurumapel_kelas_details.id_kelas')
                    ->where('gurumapel_kelas_details.id', $idGuruMapelKelas)
                    ->select('profil_siswas.*', 'gurumapel_kelas_details.id_gurumapel')
                    ->get();
        
        return view('gurumapelkelas_detail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ], compact('materis', 'noMateri', 'noTugas', 'tugass', 'noSiswa', 'siswas'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use App\Models\GuruMapelDetail;
use Illuminate\Support\Facades\DB;
use App\Models\GuruMapelKelasDetail;
use App\Models\GuruMapelKelasTugasDetail;
use App\Models\GuruMapelKelasMateriDetail;

class GuruMapelKelasDetailController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($idGuruMapel, $idGuruMapelKelas){
        $idKelas = GuruMapelKelasDetail::where('id', $idGuruMapelKelas)->value('id_kelas');
        $kelas = Kelas::where('id', $idKelas)->first();
        
        $idMapel = GuruMapelDetail::where('id', $idGuruMapel)->value('id_mapel');
        $mapel = Mapel::where('id', $idMapel)->first();
        
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
        ], compact('materis', 'noMateri', 'noTugas', 'tugass', 'noSiswa', 'siswas', 'kelas', 'mapel', 'idGuruMapel', 'idGuruMapelKelas'));
    }
}

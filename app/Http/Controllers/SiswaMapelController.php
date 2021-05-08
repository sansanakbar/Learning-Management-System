<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelKelasDetail;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaMapelController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index(){
        $idUser = auth()->user()->id;
        $idKelas = ProfilSiswa::where('id_siswa', $idUser)->value('id_kelas');
        $noMapel = 1;

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
                
        return view('siswa_mapel', compact('noMapel', 'mapels'));
    }
}

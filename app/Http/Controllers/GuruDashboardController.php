<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruMapelDetail;
use App\Models\GuruMapelKelasDetail;
use App\Models\GuruMapelKelasTugasDetail;
use App\Models\GuruMapelKelasMateriDetail;

class GuruDashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index(){
        $idAkun = auth()->user()->id;
        
        $mapels = GuruMapelDetail::where('id_guru', $idAkun)->get();
        $mapelsCount = $mapels->count();

        $kelass = GuruMapelKelasDetail::where('id_guru', $idAkun)
                ->join('guru_mapel_details', 'guru_mapel_details.id', '=', 'gurumapel_kelas_details.id_gurumapel')
                ->get();
        $kelassCount = $kelass->count();
        
        $materis = GuruMapelKelasMateriDetail::where('id_guru', $idAkun)
                ->join('gurumapel_kelas_details', 'gurumapel_kelas_details.id', '=', 'gurumapelkelas_materi_details.id_gurumapelkelas')
                ->join('guru_mapel_details', 'guru_mapel_details.id', '=', 'gurumapel_kelas_details.id_gurumapel')
                ->get();
        $materisCount = $materis->count();

        $tugass = GuruMapelKelasTugasDetail::where('id_guru', $idAkun)
                ->join('gurumapel_kelas_details', 'gurumapel_kelas_details.id', '=', 'gurumapelkelas_tugas_details.id_gurumapelkelas')
                ->join('guru_mapel_details', 'guru_mapel_details.id', '=', 'gurumapel_kelas_details.id_gurumapel')
                ->get();
        $tugassCount = $tugass->count();

        return view('guru_dashboard', compact('mapelsCount', 'kelassCount', 'materisCount', 'tugassCount'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GuruMapel;
use App\Models\GuruMapelDetail;
use App\Models\GuruMapelKelasDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruMapelKelasController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($guruMapel){
        //$idGuruMapel = $guruMapel;
        //dd($idGuruMapel);
        $nokelas = 1;
        $kelass = GuruMapelKelasDetail::leftjoin('kelas', 'gurumapel_kelas_details.id_kelas', '=', 'kelas.id')
                ->where('id_gurumapel', $guruMapel)
                ->select('gurumapel_kelas_details.*', 'kelas.tahun_kelas', 'kelas.no_kelas')
                ->orderBy('kelas.no_kelas')
                ->get();

        $mapel = GuruMapelDetail::join('mapels', 'guru_mapel_details.id_mapel', '=', 'mapels.id')
                ->where('guru_mapel_details.id', $guruMapel)
                ->first();
        //dd($kelass);
        //dd($mapel);
        return view('gurumapel_kelas', ['gurumapel' => $guruMapel], compact('kelass', 'nokelas', 'mapel', 'guruMapel'));
    }
}

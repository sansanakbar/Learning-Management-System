<?php

namespace App\Http\Controllers;

use App\Models\GuruMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruMapelKelasController extends Controller
{
    public function index($guruMapel){
        //$idGuruMapel = $guruMapel;
        //dd($idGuruMapel);
        $nokelas = 1;
        $kelass = DB::table('gurumapel_kelas_detail')
                ->leftjoin('kelass', 'gurumapel_kelas_detail.id_kelas', '=', 'kelass.id')
                ->where('id_gurumapel', $guruMapel)
                ->select('gurumapel_kelas_detail.*', 'kelass.tahun_kelas', 'kelass.no_kelas')
                ->orderBy('kelass.no_kelas')
                ->get();

        $mapel = DB::table('guru_mapel_detail')
                ->join('mapels', 'guru_mapel_detail.id_mapel', '=', 'mapels.id')
                ->where('guru_mapel_detail.id', $guruMapel)
                ->first();
        //dd($kelass);
        //dd($mapel);
        return view('gurumapel_kelas', ['gurumapel' => $guruMapel], compact('kelass', 'nokelas', 'mapel', 'guruMapel'));
    }
}

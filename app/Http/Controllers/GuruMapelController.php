<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruMapelController extends Controller
{
    public function index(){
        $idGuru = auth()->user()->id;
        $noMapel = 1;
        //$mapels = DB::table('guru_mapel_detail')->leftjoin('mapels', "guru_mapel_detail.id_mapel", "=", "mapels.id")->where('id_guru', $idGuru)->get();
        $mapels = GuruMapelDetail::join('mapels', "guru_mapel_details.id_mapel", "=", "mapels.id")
                ->where('id_guru', $idGuru)
                ->select('guru_mapel_details.*', 'mapels.kode_mapel', 'mapels.nama_mapel', 'mapels.deskripsi_mapel')
                ->get();
        //dd($mapels);
        return view('guru_mapel', compact('mapels', 'noMapel'));
    }
}

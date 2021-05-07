<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Models\GuruMapelDetail;
use Illuminate\Support\Facades\DB;

class GuruMapelController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index(){
        $idGuru = auth()->user()->id;
        $noMapel = 1;
        //$mapels = DB::table('guru_mapel_detail')->leftjoin('mapels', "guru_mapel_detail.id_mapel", "=", "mapels.id")->where('id_guru', $idGuru)->get();
        $mapels = GuruMapelDetail::join('mapels', "guru_mapel_details.id_mapel", "=", "mapels.id")
                ->where('id_guru', $idGuru)
                ->select('guru_mapel_details.*', 'mapels.kode_mapel', 'mapels.nama_mapel', 'mapels.deskripsi_mapel')
                ->get();

        $allMapels = Mapel::get();
        //dd($mapels);
        return view('guru_mapel', compact('mapels', 'noMapel', 'allMapels', 'idGuru'));
    }

    public function store(Request $request){
        $mapels = $request->mapel;
        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        foreach($mapels as $mapel){
            $testMapel = GuruMapelDetail::where([
                'id_guru' => $idAkun,
                'id_mapel' => $mapel
            ])->first();

            //dd($testMapel);

            if($testMapel==NULL){
                GuruMapelDetail::insert([
                    'id_guru' => $idAkun,
                    'id_mapel' => $mapel
                ]);
                Log::create([
                    'user_id' => $idAkun,
                    'function' => "Menambah Mata Pelajaran ".$mapel,
                    'date' => $timestamp
                ]);
            }
        }
        return redirect()->route('gurumapel');
    }

    public function destroy($id){
        $user = GuruMapelDetail::where('id', $id)->firstorfail()->delete();
        //$user->delete();

        $id_guru = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_guru,
            'function' => "Guru Melepaskan Mata Pelajaran ID ".$id,
            'date' => $timestamp
        ]);
        
        return redirect()->route('gurumapel');
    }
}

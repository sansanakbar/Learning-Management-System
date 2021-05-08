<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Kelas;
use App\Models\GuruMapel;
use Illuminate\Http\Request;
use App\Models\GuruMapelDetail;
use Illuminate\Support\Facades\DB;
use App\Models\GuruMapelKelasDetail;

class GuruMapelKelasController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($guruMapel){
        $nokelas = 1;
        $kelass = GuruMapelKelasDetail::leftjoin('kelas', 'gurumapel_kelas_details.id_kelas', '=', 'kelas.id')
                ->where('id_gurumapel', $guruMapel)
                ->select('gurumapel_kelas_details.*', 'kelas.tahun_kelas', 'kelas.no_kelas')
                ->orderBy('kelas.no_kelas')
                ->orderBy('kelas.tahun_kelas')
                ->get();

        $allKelass = Kelas::get();

        $mapel = GuruMapelDetail::join('mapels', 'guru_mapel_details.id_mapel', '=', 'mapels.id')
                ->where('guru_mapel_details.id', $guruMapel)
                ->first();

        return view('gurumapel_kelas', ['gurumapel' => $guruMapel], compact('kelass', 'nokelas', 'mapel', 'guruMapel', 'allKelass'));
    }

    public function store(Request $request, $guruMapel){
        $kelass = $request->kelas;
        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        foreach($kelass as $kelas){
            $testKelas = GuruMapelKelasDetail::where([
                'id_gurumapel' => $guruMapel,
                'id_kelas' => $kelas
            ])->first();

            if($testKelas==NULL){
                GuruMapelKelasDetail::create([
                    'id_gurumapel' => $guruMapel,
                    'id_kelas' => $kelas
                ]);
                Log::create([
                    'user_id' => $idAkun,
                    'function' => "Menambah Kelas Ajar ".$kelas,
                    'date' => $timestamp
                ]);
            }
        }
        return redirect()->route('gurumapelkelas', $guruMapel);
    }

    public function destroy($guruMapel, $id){
        GuruMapelKelasDetail::where('id', $id)->firstorfail()->delete();

        $id_guru = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_guru,
            'function' => "Guru Melepas Mata Pelajaran ID ".$id,
            'date' => $timestamp
        ]);
        
        return redirect()->route('gurumapelkelas', $guruMapel);
    }
}

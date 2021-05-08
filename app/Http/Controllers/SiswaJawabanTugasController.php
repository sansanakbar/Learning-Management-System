<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Tugas;
use App\Models\JawabanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\GuruMapelKelasTugasDetail;

class SiswaJawabanTugasController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($idGuruMapelKelas, $idGuruMapelKelasTugas){
        $tugas = GuruMapelKelasTugasDetail::where('gurumapelkelas_tugas_details.id', $idGuruMapelKelasTugas)
                ->join('tugas', 'gurumapelkelas_tugas_details.id_tugas', '=', 'tugas.id')
                ->select('gurumapelkelas_tugas_details.*', 'tugas.judul_tugas', 'tugas.isi_tugas', 'tugas.lampiran_tugas')
                ->first();

        $idAkun = auth()->user()->id;
        
        $jawaban = JawabanTugas::where([
            'id_gurumapelkelastugas' => $idGuruMapelKelasTugas,
            'id_siswa' => $idAkun
            ])
            ->first();

        return view('siswa_jawabantugas', compact('tugas','jawaban', 'idGuruMapelKelas', 'idGuruMapelKelasTugas'));
    }

    public function store(Request $request, $idGuruMapelKelas, $idGuruMapelKelasTugas){
        $idAkun = auth()->user()->id;
        if($request->file('lampiran_jawabantugas')!=NULL){
            $upload = $request->file('lampiran_jawabantugas');
            $path = $upload->store('public/storage');
            JawabanTugas::create([
                'id_siswa' => $idAkun,
                'id_gurumapelkelastugas' => $idGuruMapelKelasTugas,
                'isi_jawabantugas' => $request->isi_jawabantugas,
                'lampiran_jawabantugas' => $upload->getClientOriginalName(),
                'path' => $path
            ]);
        } else{
            JawabanTugas::create([
                'id_siswa' => $idAkun,
                'id_gurumapelkelastugas' => $idGuruMapelKelasTugas,
                'isi_jawabantugas' => $request->isi_jawabantugas
            ]);
        }
        
        $idJawabanTugas = JawabanTugas::latest('created_at')->first();
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Menambah jawaban tugas ID ".$idJawabanTugas->id,
            'date' => $timestamp
        ]);
        
        return redirect()->route('siswajawabantugas', [
            'gurumapelkelas' => $idGuruMapelKelas,
            'gurumapelkelastugas' => $idGuruMapelKelasTugas
        ]);
    }

    public function download($idJawabanTugas){
        $dl = JawabanTugas::find($idJawabanTugas);
        return Storage::download($dl->path, $dl->lampiran_jawabantugas);
    }

    public function destroy($idGuruMapelKelas, $idGuruMapelKelasTugas, $idJawabanTugas){
        JawabanTugas::where('id', $idJawabanTugas)->firstorfail()->delete();

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Menghapus jawaban tugas ID ".$idJawabanTugas,
            'date' => $timestamp
        ]);
        
        return redirect()->route('siswajawabantugas', [
            'gurumapelkelas' => $idGuruMapelKelas,
            'gurumapelkelastugas' => $idGuruMapelKelasTugas
        ]);
    }
}

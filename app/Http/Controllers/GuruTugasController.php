<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GuruMapelKelasTugasDetail;
use App\Models\GuruMapelKelasMateriDetail;

class GuruTugasController extends Controller
{
    public function store(Request $request, $idGuruMapel, $idGuruMapelKelas){
        $this->validate($request, [
            'judul_tugas' => 'required',
            'isi_tugas' => 'required',
            'lampiran_tugas' => 'file'
        ]);
        
        if($request->file('lampiran_tugas')!=NULL){
            $upload = $request->file('lampiran_tugas');
            $path = $upload->store('public/storage');
            Tugas::create([
                'judul_tugas' => $request->judul_tugas,
                'isi_tugas' => $request->isi_tugas,
                'lampiran_tugas' => $upload->getClientOriginalName(),
                'path' => $path
            ]);
        } else{
            Tugas::create([
                'judul_tugas' => $request->judul_tugas,
                'isi_tugas' => $request->isi_tugas
            ]);
        }
        
        $idTugas = Tugas::latest('created_at')->first();

        GuruMapelKelasTugasDetail::create([
            'id_gurumapelkelas' => $idGuruMapelKelas,
            'id_tugas' => $idTugas->id
        ]);

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Menambahkan tugas ID ".$idTugas->id,
            'date' => $timestamp
        ]);

        return redirect()->route('gurumapelkelasdetail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ]);
    }

    public function update(Request $request, $idGuruMapel, $idGuruMapelKelas, $idTugas){
        $this->validate($request, [
            'judul_tugas' => 'required',
            'isi_tugas' => 'required',
            'lampiran_tugas' => 'file'
        ]);
        
        if($request->file('lampiran_materi')!=NULL){
            $upload = $request->file('lampiran_tugas');
            $path = $upload->store('public/storage');
            Tugas::where('id', $idTugas)
                ->update([
                'judul_tugas' => $request->judul_tugas,
                'isi_tugas' => $request->isi_tugas,
                'lampiran_tugas' => $upload->getClientOriginalName(),
                'path' => $path
            ]);
        } else{
            Tugas::where('id', $idTugas)
                ->update([
                'judul_tugas' => $request->judul_tugas,
                'isi_tugas' => $request->isi_tugas
            ]);
        }

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Mengedit tugas ID ".$idTugas,
            'date' => $timestamp
        ]);

        return redirect()->route('gurumapelkelasdetail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ]);
    }

    public function download($idGuruMapel, $idGuruMapelKelas, $idTugas){
        $dl = Tugas::find($idTugas);
        return Storage::download($dl->path, $dl->lampiran_tugas);
    }

    public function destroy($idGuruMapel, $idGuruMapelKelas, $idGuruMapelKelasTugas){
        $idTugas = GuruMapelKelasTugasDetail::where('id', $idGuruMapelKelasTugas)->value('id_tugas');
        GuruMapelKelasTugasDetail::where('id', $idGuruMapelKelasTugas)->firstorfail()->delete();
        Tugas::where('id', $idTugas)->firstorfail()->delete();
        //$user->delete();

        $id_admin = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_admin,
            'function' => "Menghapus materi ID ".$idTugas,
            'date' => $timestamp
        ]);
        
        return redirect()->route('gurumapelkelasdetail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ]);
    }
}

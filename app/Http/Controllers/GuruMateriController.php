<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GuruMapelKelasMateriDetail;

class GuruMateriController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function store(Request $request, $idGuruMapel, $idGuruMapelKelas){
        $this->validate($request, [
            'judul_materi' => 'required',
            'isi_materi' => 'required',
            'lampiran_materi' => 'file'
        ]);
        
        if($request->file('lampiran_materi')!=NULL){
            $upload = $request->file('lampiran_materi');
            $path = $upload->store('public/storage');
            Materi::create([
                'judul_materi' => $request->judul_materi,
                'isi_materi' => $request->isi_materi,
                'lampiran_materi' => $upload->getClientOriginalName(),
                'path' => $path
            ]);
        } else{
            Materi::create([
                'judul_materi' => $request->judul_materi,
                'isi_materi' => $request->isi_materi
            ]);
        }
        
        $idMateri = Materi::latest('created_at')->first();

        GuruMapelKelasMateriDetail::create([
            'id_gurumapelkelas' => $idGuruMapelKelas,
            'id_materi' => $idMateri->id
        ]);

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Menambahkan materi ID ".$idMateri->id,
            'date' => $timestamp
        ]);

        return redirect()->route('gurumapelkelasdetail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ]);
    }

    public function update(Request $request, $idGuruMapel, $idGuruMapelKelas, $idMateri){
        $this->validate($request, [
            'judul_materi' => 'required',
            'isi_materi' => 'required',
            'lampiran_materi' => 'file'
        ]);
        
        if($request->file('lampiran_materi')!=NULL){
            $upload = $request->file('lampiran_materi');
            $path = $upload->store('public/storage');
            Materi::where('id', $idMateri)
                ->update([
                'judul_materi' => $request->judul_materi,
                'isi_materi' => $request->isi_materi,
                'lampiran_materi' => $upload->getClientOriginalName(),
                'path' => $path
            ]);
        } else{
            Materi::where('id', $idMateri)
                ->update([
                'judul_materi' => $request->judul_materi,
                'isi_materi' => $request->isi_materi
            ]);
        }

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Mengedit materi ID ".$idMateri,
            'date' => $timestamp
        ]);

        return redirect()->route('gurumapelkelasdetail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ]);
    }

    public function download($idMateri){
        $dl = Materi::find($idMateri);
        return Storage::download($dl->path, $dl->lampiran_materi);
    }

    public function destroy($idGuruMapel, $idGuruMapelKelas, $idGuruMapelKelasMateri){
        $idMateri = GuruMapelKelasMateriDetail::where('id', $idGuruMapelKelasMateri)->value('id_materi');
        GuruMapelKelasMateriDetail::where('id', $idGuruMapelKelasMateri)->firstorfail()->delete();
        Materi::where('id', $idMateri)->firstorfail()->delete();

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Menghapus materi ID ".$idMateri,
            'date' => $timestamp
        ]);
        
        return redirect()->route('gurumapelkelasdetail', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas
        ]);
    }
}

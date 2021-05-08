<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\ProfilSiswa;
use App\Models\JawabanTugas;
use Illuminate\Http\Request;
use App\Models\GuruMapelKelasDetail;
use App\Models\GuruMapelKelasTugasDetail;

class GuruJawabanTugasController extends Controller
{
    public function index($idGuruMapel, $idGuruMapelKelas, $idGuruMapelKelasTugas){
        $idKelas = GuruMapelKelasDetail::where('id', $idGuruMapelKelas)->value('id_kelas');

        $noSiswa = 1;
        $siswas = ProfilSiswa::leftjoin('jawaban_tugas', 'profil_siswas.id_siswa', '=', 'jawaban_tugas.id_siswa')
                    ->where([
                        'profil_siswas.id_kelas' => $idKelas,
                        'jawaban_tugas.id_gurumapelkelastugas' => $idGuruMapelKelasTugas
                    ])
                    ->select(
                        'profil_siswas.nisn',
                        'profil_siswas.nama',
                        'profil_siswas.jenis_kelamin',
                        'profil_siswas.tgl_lahir',
                        'profil_siswas.kontak',
                        'profil_siswas.email',
                        'profil_siswas.id_kelas',
                        'jawaban_tugas.*',
                    )
                    ->get();

        $idTugas = GuruMapelKelasTugasDetail::where('id', $idGuruMapelKelasTugas)->value('id_tugas');
        $tugas = Tugas::where('id', $idTugas)->first();
        //dd($siswas);
        
        return view('guru_jawabantugas', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas,
            'gurumapelkelastugas' => $idGuruMapelKelasTugas
        ], compact('noSiswa', 'siswas', 'tugas', 'idGuruMapel', 'idGuruMapelKelas', 'idGuruMapelKelasTugas'));
    }

    public function update(Request $request, $idGuruMapel, $idGuruMapelKelas, $idGuruMapelKelasTugas, $idJawabanTugas){
        JawabanTugas::where('id', $idJawabanTugas)
                    ->update([
                        'nilai_jawabantugas' => $request->nilai_jawabantugas,
                        'evaluasi_jawabantugas' => $request->evaluasi_jawabantugas
                    ]);

        $idAkun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $idAkun,
            'function' => "Menilai jawaban tugas ID ".$idJawabanTugas,
            'date' => $timestamp
        ]);

        return redirect()->route('guruJawabanTugas', [
            'gurumapel' => $idGuruMapel,
            'gurumapelkelas' => $idGuruMapelKelas,
            'gurumapelkelastugas' => $idGuruMapelKelasTugas
        ]);
    }
}

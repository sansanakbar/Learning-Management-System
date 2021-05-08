<?php

namespace App\Http\Controllers;

use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use App\Models\GuruMapelKelasDetail;
use App\Models\GuruMapelKelasTugasDetail;
use App\Models\GuruMapelKelasMateriDetail;

class SiswaDashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index(){
        $idUser = auth()->user()->id;
        $idKelas = ProfilSiswa::where('id_siswa', $idUser)->value('id_kelas');

        $mapels = GuruMapelKelasDetail::where('gurumapel_kelas_details.id_kelas', $idKelas)
                ->get();
        $mapelsCount = $mapels->count();

        $materis = GuruMapelKelasMateriDetail::where('gurumapel_kelas_details.id_kelas', $idKelas)
                ->join('gurumapel_kelas_details', 'gurumapelkelas_materi_details.id_gurumapelkelas', '=', 'gurumapel_kelas_details.id')
                ->get();
        $materisCount = $materis->count();

        $tugass = GuruMapelKelasTugasDetail::where('gurumapel_kelas_details.id_kelas', $idKelas)
                ->join('gurumapel_kelas_details', 'gurumapelkelas_tugas_details.id_gurumapelkelas', '=', 'gurumapel_kelas_details.id')
                ->get();
        $tugassCount = $tugass->count();

        return view('siswa_dashboard', compact('mapelsCount', 'materisCount', 'tugassCount'));
    }
}

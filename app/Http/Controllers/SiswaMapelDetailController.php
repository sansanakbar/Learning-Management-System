<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelKelasMateriDetail;
use App\Models\GuruMapelKelasTugasDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaMapelDetailController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($idGuruMapelKelas){
        $noMateri = 1;
        $materis = GuruMapelKelasMateriDetail::join('materis', 'gurumapelkelas_materi_details.id_materi', '=', 'materis.id')
                    ->where('id_gurumapelkelas', $idGuruMapelKelas)
                    ->select('gurumapelkelas_materi_details.*', 'materis.judul_materi', 'materis.isi_materi', 'materis.lampiran_materi')
                    ->get();
        
        $noTugas = 1;
        $tugass = GuruMapelKelasTugasDetail::join('tugas', 'gurumapelkelas_tugas_details.id_tugas', '=', 'tugas.id')
                    ->where('id_gurumapelkelas', $idGuruMapelKelas)
                    ->select('gurumapelkelas_tugas_details.*', 'tugas.judul_tugas', 'tugas.isi_tugas', 'tugas.lampiran_tugas')
                    ->get();
        
        return view('siswamapel_detail', compact('noMateri', 'materis', 'noTugas', 'tugass'));
    }
}

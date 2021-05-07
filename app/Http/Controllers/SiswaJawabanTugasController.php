<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaJawabanTugasController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index($idGuruMapelKelas, $idTugas){
        $tugas = Tugas::where('id', $idTugas)
                ->first();
        //dd($tugas);
        return view('siswa_jawabantugas', compact('tugas'));
    }
}

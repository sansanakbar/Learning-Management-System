<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelKelasDetail;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaMapelController extends Controller
{
    public function index(){
        //id user dari auth
        $idUser = auth()->user()->id;
        //cari id kelas dari id user profil
        $idKelas = ProfilSiswa::where('id_siswa', $idUser)->value('id_kelas');
        //cari id gurumapel dari id kelas
        //$idGuruMapel = DB::table('gurumapel_kelas_detail')->where('id_kelas', $idKelas)->value('id_gurumapel');
        //cari guru dan mapel dari id gurumapel
        $noMapel = 1;
        /*$mapels = DB::table('guru_mapel_detail')
                ->join('mapels', 'guru_mapel_detail.id_mapel', '=', 'mapels.id')
                ->join('profil_guru', 'guru_mapel_detail.id_guru', '=', 'profil_guru.id_guru')
                ->where('guru_mapel_detail.id', $idGuruMapel)
                ->select('guru_mapel_detail.*', 'mapels.kode_mapel', 'mapels.nama_mapel', 'profil_guru.nama')
                ->get();*/
        $mapels = GuruMapelKelasDetail::join('guru_mapel_details', 'gurumapel_kelas_details.id_gurumapel', '=', 'guru_mapel_details.id') 
                ->join('mapels', 'guru_mapel_details.id_mapel', '=', 'mapels.id')
                ->join('profil_gurus', 'guru_mapel_details.id_guru', '=', 'profil_gurus.id_guru')
                ->where('gurumapel_kelas_details.id_kelas', $idKelas)
                ->select(
                    'gurumapel_kelas_details.*', 
                    'guru_mapel_details.id_guru', 
                    'guru_mapel_details.id_mapel', 
                    'mapels.kode_mapel', 
                    'mapels.nama_mapel', 
                    'profil_gurus.nama'
                    )
                ->get();
        return view('siswa_mapel', compact('noMapel', 'mapels'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminOlahAkunController extends Controller
{
    public function index(){
        $gurus = User::leftjoin('profil_guru', 'users.id', '=', 'profil_guru.id_guru')->where('jenis_akun', 1)->paginate(10);
        $siswas = User::leftjoin('profil_siswa', 'users.id', '=', 'profil_siswa.id_siswa')->where('jenis_akun', 2)->paginate(10);
        $noguru = 1;
        $nosiswa = 1;
        return view('admin_olahakun', compact('gurus', 'siswas', 'noguru', 'nosiswa'));
    }
}

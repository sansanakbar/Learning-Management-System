<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\ProfilGuru;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminOlahAkunController extends Controller
{
    public function index(){
        $gurus = User::leftjoin('profil_gurus', 'users.id', '=', 'profil_gurus.id_guru')->where('jenis_akun', 1)->paginate(10);
        $siswas = User::leftjoin('profil_siswas', 'users.id', '=', 'profil_siswas.id_siswa')->where('jenis_akun', 2)->paginate(10);
        $noguru = 1;
        $nosiswa = 1;
        $mapels = Mapel::get();
        $kelass = Kelas::orderBy('no_kelas')->orderBy('tahun_kelas')->get();
        return view('admin_olahakun', compact('gurus', 'siswas', 'noguru', 'nosiswa', 'mapels', 'kelass'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'jenis_akun' => 'required'
        ]);
        
        //dd($request);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jenis_akun' => $request->jenis_akun
        ]);

        $idakun = User::where('username', $request->only('username'))->value('id');
        $jenisakun = User::where('username', $request->only('username'))->value('jenis_akun');
        
        switch($jenisakun){
            case 0:
                break;
            case 1:
                ProfilGuru::insert([
                    'id_guru' => $idakun,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak
                ]);
                break;
            case 2:
                ProfilSiswa::insert([
                    'id_siswa' => $idakun,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak
                ]);
                break;
        }

        $id_admin = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_admin,
            'function' => "Membuat akun ID ".$idakun,
            'date' => $timestamp
        ]);
        
        return redirect()->route('adminolahakun');
    }

    public function delete(){
        
        return redirect()->route('adminolahakun');
    }
}

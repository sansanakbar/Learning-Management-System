<?php

namespace App\Http\Controllers;

use App\Models\GuruMapelDetail;
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
    public function __construct(){
        $this->middleware(['auth']);
    } 

    public function index(){
        $gurus = User::leftjoin('profil_gurus', 'users.id', '=', 'profil_gurus.id_guru')
                ->where('jenis_akun', 1)
                ->select(
                    'users.id', 
                    'users.username', 
                    'profil_gurus.nip',
                    'profil_gurus.nama',
                    'profil_gurus.jenis_kelamin',
                    'profil_gurus.tgl_lahir',
                    'profil_gurus.kontak',
                    'profil_gurus.email'
                    )
                ->paginate(10);
        $siswas = User::leftjoin('profil_siswas', 'users.id', '=', 'profil_siswas.id_siswa')
                ->where('jenis_akun', 2)
                ->select(
                    'users.id', 
                    'users.username', 
                    'profil_siswas.nisn',
                    'profil_siswas.nama',
                    'profil_siswas.jenis_kelamin',
                    'profil_siswas.tgl_lahir',
                    'profil_siswas.kontak',
                    'profil_siswas.email',
                    'profil_siswas.id_kelas'
                    )
                ->paginate(10);
        //dd($siswas);
        $noguru = 1;
        $nosiswa = 1;
        $mapels = Mapel::get();
        $kelass = Kelas::orderBy('no_kelas')->orderBy('tahun_kelas')->get();
        return view('admin_olahakun', compact('gurus', 'siswas', 'noguru', 'nosiswa', 'mapels', 'kelass'));
    }

    public function store(Request $request){
        /*$mapels = $request->mapel;
        foreach($mapels as $mapel){
            dd($mapel);
        }
        dd($mapels);*/

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
        $mapels = $request->mapel;
        
        
        switch($jenisakun){
            case 0:
                break;
            case 1:
                ProfilGuru::create([
                    'id_guru' => $idakun,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak,
                    'nip' => $request->nip
                ]);
                foreach($mapels as $mapel){
                    GuruMapelDetail::create([
                        'id_guru' => $idakun,
                        'id_mapel' => $mapel
                    ]);
                }
                break;
            case 2:
                ProfilSiswa::create([
                    'id_siswa' => $idakun,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak,
                    'nisn' => $request->nisn,
                    'id_kelas' => $request->kelas
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

    public function update(Request $request, $idAkun){
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$idAkun,
            'password' => 'required',
            'jenis_akun' => 'required'
        ]);

        User::where('id', $request->id)
            ->update([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $idAkun = User::where('username', $request->only('username'))->value('id');
        $jenisakun = User::where('username', $request->only('username'))->value('jenis_akun');

        switch($jenisakun){
            case 0:
                break;
            case 1:
                ProfilGuru::where('id_guru', $idAkun)
                    ->update([
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak,
                    'nip' => $request->nip
                ]);
                break;
            case 2:
                ProfilSiswa::where('id_siswa', $idAkun)
                    ->update([
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak,
                    'nisn' => $request->nisn,
                    'id_kelas' => $request->kelas
                ]);
                break;
        }

        $id_admin = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_admin,
            'function' => "Mengedit akun ID ".$idAkun,
            'date' => $timestamp
        ]);
        
        return redirect()->route('adminolahakun');
    }

    public function destroy($id){
        $user = User::where('id', $id)->firstorfail()->delete();
        //$user->delete();

        $id_admin = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_admin,
            'function' => "Menghapus akun ID ".$id,
            'date' => $timestamp
        ]);
        
        return redirect()->route('adminolahakun');
    }
}

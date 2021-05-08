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
        
        $noguru = 1;
        $nosiswa = 1;
        $mapels = Mapel::get();
        $kelass = Kelas::orderBy('no_kelas')->orderBy('tahun_kelas')->get();
        return view('admin_olahakun', compact('gurus', 'siswas', 'noguru', 'nosiswa', 'mapels', 'kelass'));
    }

    public function store(Request $request){
        $this->validate($request, [
            //'username' => 'required|unique:users,username',
            'password' => 'required',
            'jenis_akun' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required',
            'kontak' => 'required',

        ]);

        switch($request->jenis_akun){
            case 1:
                $this->validate($request, [
                    'nip' => 'required',
                    'mapel' => 'required'
                ]);
                break;
            case 2: 
                $this->validate($request, [
                    'nisn' => 'required',
                    'kelas' => 'required'
                ]);
                break;
        }

        User::create([
            'username' => 'NULL',
            'password' => Hash::make($request->password),
            'jenis_akun' => $request->jenis_akun
        ]);

        //$idakun = User::where('username', $request->only('username'))->value('id');
        //$jenisakun = User::where('username', $request->only('username'))->value('jenis_akun');

        $idakun = User::latest('created_at')->first();
        $jenisakun = User::latest('created_at')->first();

        $varJenisAkun = sprintf("%02d", $jenisakun->jenis_akun);
        $varIdAkun = sprintf("%04d", $idakun->id);
        $username = $varJenisAkun."".$varIdAkun;

        //dd($idakun, $jenisakun, $username);
        
        User::where('id', $idakun->id)
            ->update(['username' => $username]);
        

        $mapels = $request->mapel;
        
        switch($jenisakun->jenis_akun){
            case 0:
                break;
            case 1:
                ProfilGuru::create([
                    'id_guru' => $idakun->id,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email' => $request->email,
                    'kontak' => $request->kontak,
                    'nip' => $request->nip
                ]);
                foreach($mapels as $mapel){
                    GuruMapelDetail::create([
                        'id_guru' => $idakun->id,
                        'id_mapel' => $mapel
                    ]);
                }
                break;
            case 2:
                ProfilSiswa::create([
                    'id_siswa' => $idakun->id,
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
            'function' => "Membuat akun ID ".$idakun->id,
            'date' => $timestamp
        ]);
        
        return redirect()->route('adminolahakun');
    }

    public function update(Request $request, $idAkun){
        //dd($idAkun);
        $this->validate($request, [
            //'username' => 'required|unique:users,username,'.$idAkun,
            'password' => 'required',
            'jenis_akun' => 'required'
        ]);

        User::where('id', $idAkun)
            ->update([
            //'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $idAkun = User::where('id', $idAkun)->value('id');
        $jenisakun = User::where('id', $idAkun)->value('jenis_akun');

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
        User::where('id', $id)->firstorfail()->delete();

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

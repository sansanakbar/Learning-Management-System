<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        //dd($request);

        if(!Auth::attempt($request->only('username', 'password'), $request->remember)){
            return back()->with('status', 'Username atau password salah');
        }

        $jenis_akun = DB::table('users')->where('username', $request->only('username'))->value('jenis_akun');
        $id_akun = DB::table('users')->where('username', $request->only('username'))->value('id');
        $timestamp = Carbon::now()->toDateTimeString();

        Log::create([
            'user_id' => $id_akun,
            'function' => "Login",
            'date' => $timestamp
        ]);

        switch($jenis_akun){
            case 0:
                return redirect()->route('admindashboard');
                break;
            case 1:
                return redirect()->route('gurudashboard');
                break;
            case 2:
                return redirect()->route('siswadashboard');
                break;
        }

        //return redirect()->route('admindashboard');
    }
}

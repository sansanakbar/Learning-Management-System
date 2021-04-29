<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function store(){
        $id_akun = auth()->user()->id;
        $timestamp = Carbon::now()->toDateTimeString();
        
        Log::create([
            'user_id' => $id_akun,
            'function' => "Logout",
            'date' => $timestamp
        ]);
        
        Auth::logout();

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    } 
    
    public function index(){
        $users = User::get();
        $usersCount = $users->count();
        
        $admins = User::where('jenis_akun', 0)->get();
        $adminsCount = $admins->count();

        $gurus = User::where('jenis_akun', 1)->get();
        $gurusCount = $gurus->count();

        $siswas = User::where('jenis_akun', 2)->get();
        $siswasCount = $siswas->count();
        
        return view('admin_dashboard', compact('usersCount', 'adminsCount', 'gurusCount', 'siswasCount'));
    }
}

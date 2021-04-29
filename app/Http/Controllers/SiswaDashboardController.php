<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index(){
        return view('siswa_dashboard');
    }
}

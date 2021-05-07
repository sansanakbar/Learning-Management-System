<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function index(){
        $logs = Log::orderby('date', 'desc')->paginate(20);
        $no = 1;
        return view('admin_log', compact('logs', 'no'));
    }
}

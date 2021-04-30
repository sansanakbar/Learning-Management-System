<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminLogController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SiswaDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admindashboard');

Route::get('/adminlog', [AdminLogController::class, 'index'])->name('adminlog');

Route::get('/gurudashboard', [GuruDashboardController::class, 'index'])->name('gurudashboard');

Route::get('/siswadashboard', [SiswaDashboardController::class, 'index'])->name('siswadashboard');
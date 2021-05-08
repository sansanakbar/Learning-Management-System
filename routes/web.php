<?php

use App\Models\GuruMapelKelasDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminLogController;
use App\Http\Controllers\GuruMapelController;
use App\Http\Controllers\GuruTugasController;
use App\Http\Controllers\GuruMateriController;
use App\Http\Controllers\SiswaMapelController;
use App\Http\Controllers\SiswaNilaiController;
use App\Http\Controllers\AdminOlahAkunController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GuruMapelKelasController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\GuruJawabanTugasController;
use App\Http\Controllers\SiswaMapelDetailController;
use App\Http\Controllers\SiswaJawabanTugasController;
use App\Http\Controllers\GuruMapelKelasDetailController;
use App\Http\Controllers\SiswaLaporanController;

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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admindashboard');

Route::get('/adminolahakun', [AdminOlahAkunController::class, 'index'])->name('adminolahakun');
Route::post('/adminolahakun', [AdminOlahAkunController::class, 'store'])->name('buatakun');
Route::post('/adminolahakun/update/{idAkun}', [AdminOlahAkunController::class, 'update'])->name('editAkun');
Route::get('/adminolahakun/destroy/{idakun}', [AdminOlahAkunController::class, 'destroy'])->name('hapusakun');

Route::get('/adminlog', [AdminLogController::class, 'index'])->name('adminlog');

Route::get('/gurudashboard', [GuruDashboardController::class, 'index'])->name('gurudashboard');

Route::get('/gurumapel', [GuruMapelController::class, 'index'])->name('gurumapel');
Route::post('/gurumapel', [GuruMapelController::class, 'store'])->name('tambahGuruMapel');
Route::get('/gurumapel/destroy/{idGuruMapel}', [GuruMapelController::class, 'destroy'])->name('hapusGuruMapel');

Route::get('/gurumapel/{gurumapel}', [GuruMapelKelasController::class, 'index'])->name('gurumapelkelas');
Route::post('/gurumapel/{gurumapel}', [GuruMapelKelasController::class, 'store'])->name('tambahGuruMapelKelas');
Route::get('/gurumapel/{gurumapel}/destroy/{idGuruMapelKelas}', [GuruMapelKelasController::class, 'destroy'])->name('hapusGuruMapelKelas');

Route::get('/gurumapel/{gurumapel}/{gurumapelkelas}', [GuruMapelKelasDetailController::class, 'index'])->name('gurumapelkelasdetail');

Route::post('/gurumapel/{gurumapel}/{gurumapelkelas}/tambah/materi', [GuruMateriController::class, 'store'])->name('tambahMateri');
Route::post('/gurumapel/{gurumapel}/{gurumapelkelas}/update/materi/{idMateri}', [GuruMateriController::class, 'update'])->name('editMateri');
Route::get('download/materi/{idMateri}', [GuruMateriController::class, 'download'])->name('downloadMateri');
Route::get('/gurumapel/{gurumapel}/{gurumapelkelas}/destroy/materi/{gurumapelkelasmateri}', [GuruMateriController::class, 'destroy'])->name('hapusMateri');

Route::post('/gurumapel/{gurumapel}/{gurumapelkelas}/tambah/tugas', [GuruTugasController::class, 'store'])->name('tambahTugas');
Route::post('/gurumapel/{gurumapel}/{gurumapelkelas}/update/tugas/{idTugas}', [GuruTugasController::class, 'update'])->name('editTugas');
Route::get('/download/tugas/{idTugas}', [GuruTugasController::class, 'download'])->name('downloadTugas');
Route::get('/gurumapel/{gurumapel}/{gurumapelkelas}/destroy/tugas/{gurumapelkelastugas}', [GuruTugasController::class, 'destroy'])->name('hapusTugas');

Route::get('/gurumapel/{gurumapel}/{gurumapelkelas}/{gurumapelkelastugas}', [GuruJawabanTugasController::class, 'index'])->name('guruJawabanTugas');
Route::post('/gurumapel/{gurumapel}/{gurumapelkelas}/{gurumapelkelastugas}/nilai/{idJawabanTugas}', [GuruJawabanTugasController::class, 'update'])->name('nilaiJawabanTugas');

Route::get('/siswadashboard', [SiswaDashboardController::class, 'index'])->name('siswadashboard');

Route::get('/siswamapel', [SiswaMapelController::class, 'index'])->name('siswamapel');

Route::get('/siswamapel/{gurumapelkelas}', [SiswaMapelDetailController::class, 'index'])->name('siswamapeldetail');

Route::get('/siswamapel/{gurumapelkelas}/tugas/{gurumapelkelastugas}', [SiswaJawabanTugasController::class, 'index'])->name('siswajawabantugas');
Route::post('/siswamapel/{gurumapelkelas}/tugas/{gurumapelkelastugas}', [SiswaJawabanTugasController::class, 'store'])->name('tambahJawabanTugas');
Route::get('download/jawabantugas/{idJawabanTugas}', [SiswaJawabanTugasController::class, 'download'])->name('downloadJawabanTugas');
Route::get('/siswamapel/{gurumapelkelas}/tugas/{gurumapelkelastugas}/destroy/jawabantugas/{idJawabanTugas}', [SiswaJawabanTugasController::class, 'destroy'])->name('hapusJawabanTugas');

Route::get('/siswanilai', [SiswaNilaiController::class, 'index'])->name('siswanilai');

Route::get('/siswalaporan', [SiswaLaporanController::class, 'index'])->name('siswalaporan');
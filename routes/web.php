<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\HasilAkhirController;
use App\Http\Controllers\D_SiswaController;
use App\Http\Controllers\M_KriteriaController;
use App\Http\Controllers\M_Sub_KriteriaController;
use App\Http\Controllers\M_JurusanController;
use App\Http\Controllers\T_Profile_JurusanController;
use App\Http\Controllers\T_Nilai_SiswaController;
use App\Http\Controllers\T_Hasil_AkhirController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])
-> name('viewlogin');

Route::post('login', [AuthController::class, 'login'])
-> name('login');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('dashboard', [DashboardController::class, 'index'])
->name('dashboard');


Route::get('perhitungan', [PerhitunganController::class, 'index'])
->name('perhitungan');


//d_siswa
Route::resource('d_siswa', D_SiswaController::class);

//m_kriteria
Route::resource('m_kriteria', M_KriteriaController::class);

//m_sub_kriteria
Route::resource('m_sub_kriteria', M_Sub_KriteriaController::class);

//m_jurusan
Route::resource('m_jurusan', M_JurusanController::class);


Route::resource('t_profile_jurusan', T_Profile_JurusanController::class);

Route::resource('t_nilai_siswa', T_Nilai_SiswaController::class);

Route::resource('t_hasil_akhir', T_Hasil_AkhirController::class)->except(['show']);;
Route::get('/t_hasil_akhir/print', [T_Hasil_AkhirController::class, 'print'])->name('t_hasil_akhir.print');






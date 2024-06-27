<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    UserController,
    PeriodeController,
    MhsMendaftarController,
    UnggahBerkasController,
    JadwalController,
    PendaftaranController,
    UnggahLaporanController,
    LaporanAdminController
};

// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','auth_admin']], function(){

    Route::resource('/mahasiswa', UserController::class);
    Route::get('datatable-mahasiswa', [UserController::class, 'datatable'])->name('user.datatable');

    Route::resource('/periode', PeriodeController::class);
    Route::get('datatable-periode', [PeriodeController::class, 'datatable'])->name('periode.datatable');

    Route::get('jadwal/periode', [JadwalController::class, 'daftarPeriode'])->name('daftar-periode.index');
    Route::get('jadwal/periode/{id}', [JadwalController::class, 'index'])->name('jadwal-periode.index');
    Route::post('jadwal/periode', [JadwalController::class, 'store'])->name('jadwal-periode.store');
    Route::patch('jadwal/periode/{id}', [JadwalController::class, 'update'])->name('jadwal-periode.update');
    Route::delete('jadwal/periode/{id}', [JadwalController::class, 'destroy'])->name('jadwal-periode.destroy');
    Route::get('datatable-jadwal-periode/{id}', [JadwalController::class, 'datatable'])->name('jadwal-periode.datatable');

    Route::resource('/pendaftaran', PendaftaranController::class);    
    Route::resource('/laporan-kp', LaporanAdminController::class);    
});

Route::group(['middleware' => ['auth','auth_mhs']], function(){
    Route::resource('/mendaftar', MhsMendaftarController::class);

    Route::resource('/unggah-berkas', UnggahBerkasController::class);
    Route::post('/unggah-balasan-instansi', [UnggahBerkasController::class, 'unggahBalasanInstansi'])->name('unggah-balasan-instansi');

    Route::resource('/unggah-laporan', UnggahLaporanController::class);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/permohonan-kp', [MhsMendaftarController::class, 'cetakPermohonanKp'])->name('permohonan-kp');
    Route::get('/pengantar-instansi', [MhsMendaftarController::class, 'cetakPengantarInstansi'])->name('pengantar-instansi');
});




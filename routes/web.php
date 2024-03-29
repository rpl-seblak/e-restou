<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;


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
    return redirect()->route('login');
});
Route::view('kasir2/index','kasir.index')->name('kasir.index2');
Route::view('/menu','admin.menu.index');
Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Route::middleware(['role:admin'])->group(function () {
    //     Route::prefix('admin')->group(function () {
    //         Route::view('/menu','menu.index');
    //     });
    // });
    // Route::view('/dashboard','layouts.dashboard-pegawai')->middleware(['role:kasir','role:pelayan','role:koki']);
    Route::middleware(['role:kasir'])->group(function () {
        Route::prefix('kasir')->group(function () {
            Route::get('/dashboard',[DashboardController::class , 'dashboardKasir'])->name('kasir.index');
            Route::get('/pembayaran',[PembayaranController::class,'listPembayaran'])->name('kasir.pembayaran');
            Route::get('/pembayaran/{id}',[PembayaranController::class,'showPembayaran'])->name('kasir.form-pembayaran');
            Route::put('/pembayaran/{id}',[PembayaranController::class,'prosesPembayaran'])->name('kasir.proses-pembayaran');
            Route::get('/laporan',[PembayaranController::class,'laporan'])->name('kasir.laporan');
            Route::get('/filter-laporan',[PembayaranController::class,'filter'])->name('kasir.laporan-filter');
        });
    });

    Route::middleware(['role:koki'])->group(function () {
        Route::prefix('koki')->group(function () {
            Route::get('/dashboard',[DashboardController::class , 'dashboardKoki'])->name('koki.index');
            Route::resource('menu', MenuController::class);
            Route::get('/pesanan',[PesananController::class,'listPesananKoki'])->name('koki-pesanan.index');
            Route::get('/pesanan/{id}',[PesananController::class,'detailPesananKoki'])->name('koki.detail-pesanan');
            Route::put('/pesanan/{id}',[PesananController::class,'updateStatusPesanan'])->name('koki-pesanan.masak');
        });
    });

    Route::middleware(['role:pelayan'])->group(function () {
        Route::prefix('pelayan')->group(function () {
            Route::get('/dashboard',[DashboardController::class , 'dashboardPelayan'])->name('pelayan.index');
            Route::get('/meja',[MejaController::class , 'tampilMeja'])->name('pelayan.meja');
            Route::put('/meja/{id}',[MejaController::class,'ubahStatusMeja'])->name('pelayan-meja.selesai');

            Route::get('/pesanan',[PesananController::class,'listPesananPelayan'])->name('pelayan-pesanan.index');
            Route::get('/pesanan/{meja}',[PesananController::class,'createPesanan'])->name('pelayan-pesanan.create');
            Route::post('/pesanan',[PesananController::class,'storePesanan'])->name('pelayan-pesanan.store');
            Route::put('/pesanan/{id}',[PesananController::class,'updateStatusPesanan'])->name('pelayan-pesanan.served');
        });
    });
    Route::get('/pesanan/{id}',[PesananController::class,'detailPesanan'])->name('detail-pesanan');
    // Route::view('/menu','menu.index')->name('kasir.index');
});

//Route::resource('menu', MenuController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/struk/{id}',[PembayaranController::class,'cetakStruk'])->name('struk');
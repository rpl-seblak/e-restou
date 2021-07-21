<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
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
            Route::view('/dashboard','kasir.index')->name('kasir.index');
        });
    });

    Route::middleware(['role:koki'])->group(function () {
        Route::prefix('koki')->group(function () {
            Route::view('/dashboard','koki.index')->name('koki.index');
        });
    });

    Route::middleware(['role:pelayan'])->group(function () {
        Route::prefix('pelayan')->group(function () {
            Route::view('/dashboard','pelayan.index')->name('pelayan.index');
            Route::get('/meja',[PesananController::class , 'tampilMeja'])->name('pelayan.meja');
        });
    });
    // Route::view('/menu','menu.index')->name('kasir.index');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

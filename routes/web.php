<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\CalonpenyewaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Penyewa
route::get('/penyewa',[\App\Http\Controllers\PenyewaController::class,'index']);
route::post('/penyewa',[\App\Http\Controllers\PenyewaController::class,'store']);
route::get('/penyewa/create',[\App\Http\Controllers\PenyewaController::class,'create']);
route::get('/penyewa/{id}/edit',[\App\Http\Controllers\PenyewaController::class,'edit']);
route::put('/penyewa/{id}',[\App\Http\Controllers\PenyewaController::class,'update']);
route::delete('/penyewa/{id}',[\App\Http\Controllers\PenyewaController::class,'destroy']);
route::get('/penyewa/{id}',[\App\Http\Controllers\PenyewaController::class,'show'])->name('penyewa.show');


//calonPenyewa
route::get('/calonpenyewa',[\App\Http\Controllers\CalonpenyewaController::class,'index']);
route::post('/calonpenyewa',[\App\Http\Controllers\CalonpenyewaController::class,'store']);
route::get('/calonpenyewa/create',[\App\Http\Controllers\CalonpenyewaController::class,'create']);
route::get('/calonpenyewa/{id}/edit',[\App\Http\Controllers\CalonpenyewaController::class,'edit']);
route::put('/calonpenyewa/{id}',[\App\Http\Controllers\CalonpenyewaController::class,'update']);
route::delete('/calonpenyewa/{id}',[\App\Http\Controllers\CalonpenyewaController::class,'destroy']);

//calonpenyewa-transfer

Route::get('/transfer', [\App\Http\Controllers\CalonpenyewaController::class, 'index'])->name('transfer.index');
Route::post('/transfer', [\App\Http\Controllers\CalonpenyewaController::class, 'transferCalonPenyewaToPenyewa'])->name('transferCalonPenyewaToPenyewa');

//kamar
route::get('/kamars',[\App\Http\Controllers\KamarController::class,'index'])->name('kamars.index');
route::post('/kamars',[\App\Http\Controllers\KamarController::class,'store'])->name('kamars.store');
route::get('/kamars/create',[\App\Http\Controllers\KamarController::class,'create'])->name('kamars.create');
route::get('/kamars/{id}',[\App\Http\Controllers\KamarController::class,'show'])->name('kamars.show');
route::get('/kamars/{id}/edit',[\App\Http\Controllers\KamarController::class,'edit'])->name('kamars.edit');
route::put('/kamars/{id}',[\App\Http\Controllers\KamarController::class,'update'])->name('kamars.update');
route::delete('/kamars/{id}',[\App\Http\Controllers\KamarController::class,'destroy'])->name('kamars.destroy');
Route::delete('kamars/{id}/delete-pictures', [\App\Http\Controllers\KamarController::class,'deletePictures'])->name('kamars.deletePictures');


//keluhan
route::get('/keluhans',[\App\Http\Controllers\KeluhanController::class,'index'])->name('keluhans.index');
route::get('/keluhans/create',[\App\Http\Controllers\KeluhanController::class,'create'])->name('keluhans.create');
route::post('/keluhans',[\App\Http\Controllers\KeluhanController::class,'store'])->name('keluhans.store');
route::get('/keluhans/{id}',[\App\Http\Controllers\KeluhanController::class,'show'])->name('keluhans.show');
Route::put('/keluhans/{id}',[\App\Http\Controllers\KeluhanController::class,'update'])->name('keluhans.update');
route::delete('/keluhans/{id}',[\App\Http\Controllers\KeluhanController::class,'destroy'])->name('keluhans.destroy');

//inventaris
route::get('/inventaris',[\App\Http\Controllers\InventarisController::class,'index'])->name('inventaris.index');
route::get('/inventaris/create',[\App\Http\Controllers\InventarisController::class,'create'])->name('inventaris.create');
route::post('/inventaris',[\App\Http\Controllers\InventarisController::class,'store'])->name('inventaris.store');
route::get('/inventaris/{id}/edit',[\App\Http\Controllers\InventarisController::class,'edit'])->name('inventaris.edit');
route::put('/inventaris/{id}',[\App\Http\Controllers\InventarisController::class,'update'])->name('inventaris.update');
route::delete('/inventaris/{id}',[\App\Http\Controllers\InventarisController::class,'destroy'])->name('inventaris.destroy');

Route::post('/penyewa/{penyewaId}/payment', [\App\Http\Controllers\PenyewaController::class,'store'])->name('payment.store');
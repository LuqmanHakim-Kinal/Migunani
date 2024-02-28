<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\CalonpenyewaController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Penyewa
Route::get('/penyewa',[\App\Http\Controllers\PenyewaController::class,'index'])->name('penyewa.index');
Route::post('/penyewa',[\App\Http\Controllers\PenyewaController::class,'store'])->name('penyewa.store');
Route::get('/penyewa/create',[\App\Http\Controllers\PenyewaController::class,'create'])->name('penyewa.create');
Route::get('/penyewa/{id}/edit',[\App\Http\Controllers\PenyewaController::class,'edit'])->name('penyewa.edit');
Route::put('/penyewa/{id}',[\App\Http\Controllers\PenyewaController::class,'update'])->name('penyewa.update');
Route::delete('/penyewa/{id}',[\App\Http\Controllers\PenyewaController::class,'destroy'])->name('penyewa.show');
Route::get('/penyewa/{id}',[\App\Http\Controllers\PenyewaController::class,'show'])->name('penyewa.show');
    


//calonPenyewa
Route::get('/calonpenyewa',[\App\Http\Controllers\CalonpenyewaController::class,'index']);
Route::post('/calonpenyewa',[\App\Http\Controllers\CalonpenyewaController::class,'store']);
Route::get('/calonpenyewa/create',[\App\Http\Controllers\CalonpenyewaController::class,'create']);
Route::get('/calonpenyewa/{id}/edit',[\App\Http\Controllers\CalonpenyewaController::class,'edit']);
Route::put('/calonpenyewa/{id}',[\App\Http\Controllers\CalonpenyewaController::class,'update']);
Route::delete('/calonpenyewa/{id}',[\App\Http\Controllers\CalonpenyewaController::class,'destroy']);

//calonpenyewa-transfer

Route::get('/transfer', [\App\Http\Controllers\CalonpenyewaController::class, 'index'])->name('transfer.index');
Route::post('/transfer', [\App\Http\Controllers\CalonpenyewaController::class, 'transferCalonPenyewaToPenyewa'])->name('transferCalonPenyewaToPenyewa');

//kamar
Route::get('/kamars',[\App\Http\Controllers\KamarController::class,'index'])->name('kamars.index');
Route::post('/kamars',[\App\Http\Controllers\KamarController::class,'store'])->name('kamars.store');
Route::get('/kamars/create',[\App\Http\Controllers\KamarController::class,'create'])->name('kamars.create');
Route::get('/kamars/{id}',[\App\Http\Controllers\KamarController::class,'show'])->name('kamars.show');
Route::get('/kamars/{id}/edit',[\App\Http\Controllers\KamarController::class,'edit'])->name('kamars.edit');
Route::put('/kamars/{id}',[\App\Http\Controllers\KamarController::class,'update'])->name('kamars.update');
Route::delete('/kamars/{id}',[\App\Http\Controllers\KamarController::class,'destroy'])->name('kamars.destroy');
Route::delete('kamars/{id}/delete-pictures', [\App\Http\Controllers\KamarController::class,'deletePictures'])->name('kamars.deletePictures');


//keluhan
Route::get('/keluhans',[\App\Http\Controllers\KeluhanController::class,'index'])->name('keluhans.index');
Route::get('/keluhans/create',[\App\Http\Controllers\KeluhanController::class,'create'])->name('keluhans.create');
Route::post('/keluhans',[\App\Http\Controllers\KeluhanController::class,'store'])->name('keluhans.store');
Route::get('/keluhans/{id}',[\App\Http\Controllers\KeluhanController::class,'show'])->name('keluhans.show');
Route::put('/keluhans/{id}',[\App\Http\Controllers\KeluhanController::class,'update'])->name('keluhans.update');
Route::delete('/keluhans/{id}',[\App\Http\Controllers\KeluhanController::class,'destroy'])->name('keluhans.destroy');

//inventaris
Route::get('/inventaris',[\App\Http\Controllers\InventarisController::class,'index'])->name('inventaris.index');
Route::get('/inventaris/create',[\App\Http\Controllers\InventarisController::class,'create'])->name('inventaris.create');
Route::post('/inventaris',[\App\Http\Controllers\InventarisController::class,'store'])->name('inventaris.store');
Route::get('/inventaris/{id}/edit',[\App\Http\Controllers\InventarisController::class,'edit'])->name('inventaris.edit');
Route::put('/inventaris/{id}',[\App\Http\Controllers\InventarisController::class,'update'])->name('inventaris.update');
Route::delete('/inventaris/{id}',[\App\Http\Controllers\InventarisController::class,'destroy'])->name('inventaris.destroy');

Route::post('/penyewa/{penyewaId}/payment', [\App\Http\Controllers\PenyewaController::class,'store'])->name('payment.store');

Route::get('/pembayaran',[\App\Http\Controllers\PaymentController::class,'index'])->name('pembayaran.index');
Route::get('/pembayaran/create',[\App\Http\Controllers\PaymentController::class,'create'])->name('pembayaran.create');
Route::post('/pembayaran',[\App\Http\Controllers\PaymentController::class,'store'])->name('pembayaran.store');
Route::get('/pembayaran/{id}/edit',[\App\Http\Controllers\PaymentController::class,'edit'])->name('pembayaran.edit');
Route::put('/pembayaran/{id}',[\App\Http\Controllers\PaymentController::class,'update'])->name('pembayaran.update');
Route::delete('/pembayaran/{id}',[\App\Http\Controllers\PaymentController::class,'destroy'])->name('pembayaran.destroy');


Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard.index');

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganOfController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;



//PERBAIKAN
Route::get('/', [PelangganController::class, 'home'])->name('index');
Route::get('/login', [PerbaikanController::class, 'login'])->name('auth.login');

//unutk teknisi
Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
//untuk admin
Route::get('/perbaikan/create', [PerbaikanController::class, 'create'])->name('perbaikan.create');
Route::post('/perbaikan/store', [PerbaikanController::class, 'store'])->name('perbaikan.store');
Route::get('/perbaikan/edit/{id}', [PerbaikanController::class, 'edit'])->name('perbaikan.edit');
Route::post('/perbaikan/update/{id}', [PerbaikanController::class, 'update'])->name('perbaikan.update');
Route::post('/perbaikan/hapus/{id}', [PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');

Route::get('/perbaikan/export-pdf', [PerbaikanController::class, 'exportPdf'])->name('perbaikan.exportPdf');
Route::get('/perbaikan/export-excel', [PerbaikanController::class, 'exportExcel'])->name('perbaikan.exportExcel');

//PELANGGAN
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::post('/pelanggan/hapus/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

//Detail
Route::get('/pelanggan/{id}/detail', [PelangganController::class, 'detail'])->name('pelanggan.detail');
Route::get('/pelanggan/off/{id}', [PelangganController::class, 'pelanggan_off'])->name('pelanggan.off');

//Pelangan Off
Route::get('/pelangganof', [PelangganOfController::class, 'index'])->name('pelangganof.index');
Route::get('/pelangganof/edit/{id}', [PelangganOfController::class, 'edit'])->name('pelangganof.edit');
Route::post('/pelangganof/update/{id}', [PelangganOfController::class, 'update'])->name('pelangganof.update');
Route::delete('/pelangganof/delete/{id}', [PelangganOfController::class, 'destroy'])->name('pelangganof.destroy');
Route::get('/pelangganof/{id}/detail', [PelangganOfController::class, 'detail'])->name('pelangganof.detail');

Route::get('/pelanggan/aktifkan/{id}', [PelangganController::class, 'aktifkan_pelanggan'])->name('aktifkan_pelanggan');


Route::post('/pelanggan/{id}/pembayaran', [PelangganController::class, 'pembayaran'])->name('pelanggan.pembayaran');

Route::patch('/pelanggan/{id}/toggle-visibility', [PelangganController::class, 'toggleVisibility'])->name('pelanggan.toggleVisibility');
Route::get('/pelanggan/{id}/history', [PelangganController::class, 'history'])->name('pelanggan.history');

Route::get('/pelanggan/{id}/bayar', [PelangganController::class, 'bayar'])->name('pelanggan.bayar');
Route::get('/pelanggan/{id}/historypembayaran', [PelangganController::class, 'historypembayaran'])->name('pelanggan.historypembayaran');
Route::get('/bayar-pelanggan', [PelangganController::class, 'index_bayar'])->name('pembayaran.index');


Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast.index');
Route::post('/broadcast/send', [BroadcastController::class, 'send'])->name('broadcast.send');

//Whatsapp Brodcast
Route::get('/send-message', [MessageController::class, 'create'])->name('whatsapp.send-message');
Route::post('/send-message', [MessageController::class, 'store'])->name('message.store');

//blum bayar
Route::get('/pembayaran', [PelangganController::class, 'index'])->name('pembayaran.blm_byr');
//chart bulanan
Route::get('/dashboard', [PelangganController::class, 'getMonthlyPayments']);


//midleware
Route::middleware(['guest'])->group(function () {
    //SesiLogin
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('admin');
});

Route::middleware(['auth'])->group(function () {
    //alamat login akhir
    Route::get('/admin', [AdminController::class, 'index']);
     //alamat login akhir
     Route::get('/admin/teknisi', [AdminController::class, 'teknisi'])->middleware('userAkses:teknisi');
      //alamat login akhir
    Route::get('/admin/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
     //alamat login akhir
     Route::get('/admin/superadmin', [AdminController::class, 'superadmin'])->middleware('userAkses:superadmin');
    //Logout
    Route::get('/logout', [SesiController::class, 'logout']);
});

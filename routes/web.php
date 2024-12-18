
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutomatisPaymentController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IsolirController;
use App\Http\Controllers\JumlahLainLainController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PelangganBayarSendiriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganOfController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranMudahController;
use App\Http\Controllers\PemberitahuanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\PSBController;
use App\Http\Controllers\RekapMutasiHarianController;
use App\Http\Controllers\RekapPemasanganController;
use App\Http\Controllers\RekapPemasanganControlller;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\UserController;
use App\Models\Pelanggan;
use App\Models\Pelangganof;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;




//PERBAIKAN
Route::get('/home', [PelangganController::class, 'home'])->name('index');
//Route::get('/login', [PerbaikanController::class, 'login'])->name('auth.login');

//unutk teknisi
Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
//untukadmin
Route::get('/psb/create', [PerbaikanController::class, 'create_psb'])->name('psb.create');
Route::get('/perbaikan/create', [PerbaikanController::class, 'create'])->name('perbaikan.create');
Route::post('/psb/store', [PerbaikanController::class, 'store_psb'])->name('perbaikan.store');
Route::post('/perbaikan/store', [PerbaikanController::class, 'store'])->name('psb.store');
Route::get('/perbaikan/edit/{id}', [PerbaikanController::class, 'edit'])->name('perbaikan.edit');
Route::post('/perbaikan/update/{id}', [PerbaikanController::class, 'update'])->name('perbaikan.update');
Route::post('/perbaikan/hapus/{id}', [PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');

Route::get('/perbaikan/export-pdf', [PerbaikanController::class, 'exportPdf'])->name('perbaikan.exportPdf');
Route::get('/perbaikan/export-excel', [PerbaikanController::class, 'exportExcel'])->name('perbaikan.exportExcel');

//coba
//Route::get('/pelanggancoba', [PelangganController::class, 'indexcoba'])->name('pelanggan.index');
//PELANGGAN
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/reactivasi', [PelangganController::class, 'reactivasi'])->name('pelanggan.reactivasi');
Route::get('/pelanggan/isolir', [PelangganController::class, 'isolir'])->name('pelanggan.isolir');
Route::get('/pelanggan/unblock', [PelangganController::class, 'unblock'])->name('pelanggan.unblock');
Route::get('/pelanggan/block', [PelangganController::class, 'block'])->name('pelanggan.block');
Route::get('/pelanggan/psb', [PelangganController::class, 'psb'])->name('pelanggan.psb');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::post('/pelanggan/hapus/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
Route::post('/pelanggan/{id}/isolir', [PelangganController::class, 'toIsolir'])->name('pelanggan.toIsolir');
Route::post('/pelanggan/{id}/unblock', [PelangganController::class, 'toUnblock'])->name('pelanggan.toUnblock');
Route::post('/pelanggan/{id}/toggle-status', [PelangganController::class, 'toggleStatus'])->name('pelanggan.toggleStatus');


Route::get('/pelanggan/offkan/{id}', [PelangganController::class, 'offkan'])->name('pelanggan.offkan');


//PSB
Route::get('/pasangbaru/', [PSBController::class, 'index'])->name('pasangbaru.index');
Route::get('/pasangbaru/create', [PSBController::class, 'create'])->name('pasangbaru.create');
Route::post('/pasangbaru/store', [PSBController::class, 'store'])->name('pasangbaru.store');
Route::get('/pasangbaru/edit/{id}', [PSBController::class, 'edit'])->name('pasangbaru.edit');
Route::post('/pasangbaru/update/{id}', [PSBController::class, 'update'])->name('pasangbaru.update');
Route::post('/pasangbaru/hapus/{id}', [PSBController::class, 'destroy'])->name('pasangbaru.destroy');

//Detail
Route::get('/pelanggan/{id}/detail', [PelangganController::class, 'detail'])->name('pelanggan.detail');
Route::get('/pelanggan/off/{id}', [PelangganController::class, 'pelanggan_off'])->name('pelanggan.off');

//Pelangan Off
Route::get('/pelangganof', [PelangganOfController::class, 'index'])->name('pelangganof.index');
Route::get('/pelangganof/edit/{id}', [PelangganOfController::class, 'edit'])->name('pelangganof.edit');
Route::post('/pelangganof/update/{id}', [PelangganOfController::class, 'update'])->name('pelangganof.update');
Route::delete('/pelangganof/delete/{id}', [PelangganOfController::class, 'destroy'])->name('pelangganof.destroy');
Route::get('/pelangganof/{id}/detail', [PelangganOfController::class, 'detail'])->name('pelangganof.detail');
Route::get('/pelanggan/aktifkan/{id}', [PelangganOfController::class, 'aktifkan_pelanggan'])->name('aktifkan_pelanggan');


Route::post('/pelanggan/{id}/pembayaran', [PelangganController::class, 'pembayaran'])->name('pelanggan.pembayaran');

Route::patch('/pelanggan/{id}/toggle-visibility', [PelangganController::class, 'toggleVisibility'])->name('pelanggan.toggleVisibility');
Route::get('/pelanggan/{id}/history', [PelangganController::class, 'history'])->name('pelanggan.history');

//===========ini untuk pembayaran pelanggan sendiri sendiri =====================
Route::post('isolir/{id}/reactivate', [IsolirController::class, 'reactivatePelanggan'])->name('isolir.bayar');

//Aktifkan
Route::post('pelanggan/{id}/aktifkanPSB', [PelangganController::class, 'aktifkanPSB'])->name('pelanggan.aktifkanPSB');

Route::post('pelanggan/{id}/bayar', [PelangganController::class, 'bayar'])->name('pelanggan.bayar');
Route::post('pelanggan/{id}/bayar2', [PelangganController::class, 'bayar2'])->name('pelanggan.bayar2');
//Route::post('isolir/{id}/bayar', [IsolirController::class, 'bayar'])->name('isolir.bayar');
Route::get('/pelanggan/{id}/historypembayaran', [PelangganController::class, 'historypembayaran'])->name('pelanggan.historypembayaran');
Route::get('/isolir/{id}/historypembayaran', [IsolirController::class, 'historypembayaran'])->name('isolir.historypembayaran');

//index pembayaran semua user  atau global
Route::get('/bayar-pelanggan/export/{format}', [PembayaranController::class, 'export'])->name('pembayaran.export');
Route::get('/pelanggan/export/{format}', [PembayaranController::class, 'export'])->name('pelanggan.export');
Route::post('/pembayaran/hapus/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');


Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast.index');
Route::post('/broadcast/send', [BroadcastController::class, 'send'])->name('broadcast.send');

// Rute untuk menampilkan halaman pengiriman pesan
Route::get('/send-message', [MessageController::class, 'create'])->name('message.create');
// Rute untuk menyimpan pesan
Route::post('/send-message', [MessageController::class, 'store'])->name('message.store');
//Peringatan whatsaap
Route::get('/peringatan', [MessageController::class, 'create2'])->name('peringatan.create');
// Rute untuk menyimpan pesan
Route::post('/peringatan', [MessageController::class, 'store2'])->name('peringatan.store');



//PEMBAYARAN GLOBAL
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
//chart bulanan
Route::get('/dashboard', [PelangganController::class, 'getMonthlyPayments']);

//midleware
Route::middleware(['guest'])->group(function () {
    // Rute untuk halaman login
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    // Redirect berdasarkan role
    Route::get('/redirect', [SesiController::class, 'redirectUser'])->name('redirect');

    // Logout
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});


Route::get('/home', function () {
    return redirect('/masuk/admin');
});
Route::get('/teknisi/baru', [TeknisiController::class, 'index'])->name('teknisi');
Route::get('/homebaru', [PelangganController::class, 'home'])->name('index');

Route::middleware(['auth'])->group(function () {
    // Rute teknisi
    Route::get('/masuk/teknisi', [TeknisiController::class, 'index'])
        ->middleware('userAkses:teknisi,superadmin') // Superadmin bisa akses teknisi
        ->name('teknisi.index');

    // Rute admin
    Route::get('/masuk/admin', [PelangganController::class, 'home'])
        ->middleware('userAkses:admin,superadmin'); // Superadmin bisa akses admin

    // Rute superadmin
    Route::get('/masuk/superadmin', [SuperAdminController::class, 'home'])
        ->middleware('userAkses:superadmin');

    // Logout
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});

Route::get('/masuk/teknisi', [TeknisiController::class, 'index'])->name('teknisi.index');

Route::get('coba', [TeknisiController::class, 'coba']);

Route::get('/pelanggan/belum_bayar', [PelangganController::class, 'belumBayar'])->name('pelanggan.belum_bayar');


Route::get('/cekdulu', [CobaController::class, 'create']);
//landing page
Route::get('/home2', [PerbaikanController::class, 'home2']);

Route::get('/search-pelanggan', [PerbaikanController::class, 'searchPelanggan'])->name('pelanggan.search');
Route::get('/get-pelanggan/{id}', [PerbaikanController::class, 'getPelanggan'])->name('pelanggan.get');



Route::get('/rekap-teknisi', [PerbaikanController::class, 'rekapTeknisi'])->name('perbaikan.rekapTeknisi');

Route::get('/teknisi/rekap-teknisi', [TeknisiController::class, 'rekapTeknisi'])->name('teknisi.rekap_teknisi');
Route::post('/rekap-teknisi/print', [PerbaikanController::class, 'printRekapTeknisi'])->name('perbaikan.printRekapTeknisi');

Route::post('/perbaikan/{id}/selesai', [PerbaikanController::class, 'selesai'])->name('perbaikan.selesai');

//Alamat Karyawan
Route::get('/masuk/superadmin/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/masuk/superadmin/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('/masuk/superadmin/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/masuk/superadmin/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::post('/masuk/superadmin/karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('/masuk/superadmin/karyawan/delete/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
Route::get('/masuk/superadmin/karyawan/{id}/detail', [KaryawanController::class, 'detail'])->name('karyawan.detail');
Route::get('/masuk/superadmin/karyawan/aktifkan/{id}', [KaryawanController::class, 'showOff'])->name('karyawan.non_aktifkan');

//Alamat Kasbon
Route::get('/masuk/superadmin/karyawan/kasbon', [KasbonController::class, 'index'])->name('kasbon.index');
Route::get('/masuk/superadmin/karyawan/{id}/kasbon/create', [KasbonController::class, 'create'])->name('kasbon.create');
Route::post('/masuk/superadmin/karyawan/kasbon/store', [KasbonController::class, 'store'])->name('kasbon.store');
Route::get('/masuk/superadmin/karyawan/kasbon/edit/{id}', [KasbonController::class, 'edit'])->name('kasbon.edit');
Route::post('/masuk/superadmin/karyawan/kasbon/update/{id}', [KasbonController::class, 'update'])->name('kasbon.update');
Route::delete('/masuk/superadmin/karyawan/kasbon/delete/{id}', [KasbonController::class, 'destroy'])->name('kasbon.destroy');

//pengeluaran lainya
Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
Route::post('/pengeluaran/update/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::post('/pengeluaran/hapus/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

//Rekap Pemasangan
Route::get('/rekap_pemasangan', [RekapPemasanganController::class, 'index'])->name('rekap_pemasangan.index');
Route::get('/rekap_pemasangan/create', [RekapPemasanganController::class, 'create'])->name('rekap_pemasangan.create');
Route::get('/rekap_pemasangan/aktivasi/{id}', [RekapPemasanganController::class, 'aktivasi'])->name('rekap_pemasangan.aktivasi');
Route::post('/rekap_pemasangan/store', [RekapPemasanganController::class, 'store'])->name('rekap_pemasangan.store');
Route::get('/rekap_pemasangan/edit/{id}', [RekapPemasanganController::class, 'edit'])->name('rekap_pemasangan.edit');
Route::post('/rekap_pemasangan/update/{id}', [RekapPemasanganController::class, 'update'])->name('rekap_pemasangan.update');
Route::post('/rekap_pemasangan/hapus/{id}', [RekapPemasanganController::class, 'destroy'])->name('rekap_pemasangan.destroy');

//pemasukan lainya
Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
Route::post('/pemasukan/store', [PemasukanController::class, 'store'])->name('pemasukan.store');
Route::get('/pemasukan/edit/{id}', [PemasukanController::class, 'edit'])->name('pemasukan.edit');
Route::post('/pemasukan/update/{id}', [PemasukanController::class, 'update'])->name('pemasukan.update');
Route::post('/pemasukan/hapus/{id}', [PemasukanController::class, 'destroy'])->name('pemasukan.destroy');





// Routes untuk isolir

//Isolir
Route::get('/isolir', [IsolirController::class, 'index'])->name('isolir.index');
Route::get('/isolir/edit/{id}', [IsolirController::class, 'edit'])->name('isolir.edit');
Route::post('/isolir/update/{id}', [IsolirController::class, 'update'])->name('isolir.update');
Route::delete('/isolir/delete/{id}', [IsolirController::class, 'destroy'])->name('isolir.destroy');
Route::get('/isolir/{id}/detail', [IsolirController::class, 'detail'])->name('isolir.detail');
Route::get('/isolir/aktifkan/{id}', [IsolirController::class, 'showOff'])->name('isolir.aktifkan_pelanggan');

// web.php
//Route::post('/isolir/reactivate/{id}', [IsolirController::class, 'reactivatePelanggan'])->name('pelanggan.reactivate');




Route::post('/isolir/{id}/activate', [IsolirController::class, 'activate'])->name('isolir.activate');
Route::get('/isolir/cleanup', [IsolirController::class, 'cleanUp'])->name('isolir.cleanup');

// web.php
Route::post('pelanggan/to-isolir/{id}', [PelangganController::class, 'toIsolir'])->name('pelanggan.toIsolir1');
// web.php
Route::post('pelanggan/to-off/{id}', [IsolirController::class, 'toOff'])->name('pelanggan.toOff');




//rekap mutasi harian
Route::get('/rekap-mutasi-harian', [RekapMutasiHarianController::class, 'index'])->name('rekap.mutasi.harian');


Route::post('pelanggan/{id}/update-status', [PelangganController::class, 'updateStatus'])->name('pelanggan.updateStatus');

Route::get('/rekap-harian', [JumlahLainLainController::class, 'lihatRekapHarian'])->name('rekap-harian');

//filter pelanggan harian tgl_tagih_plg
Route::get('/pelanggan/tagihan', [PelangganController::class, 'filterByTanggalTagih'])->name('pelanggan.filterTagih');
//filter di index  pelanggan
Route::get('/pelanggan/filter-tagih', [PelangganController::class, 'filterByTanggalTagihindex'])->name('pelanggan.filterTagihindex');


Route::get('/pelanggan/tagihan/index', [PelangganController::class, 'filterByTanggalTagihindex'])->name('pelanggan.filterTagihindex');
//filter di pembayaran
Route::get('/pembayaran/filter/', [PembayaranController::class, 'index'])->name('pembayaran.filter');
//filter di isolir
Route::get('/isolir/tagihan/index', [IsolirController::class, 'filterByTanggalTagihindex'])->name('isolir.filterTagihindex');
//filter pelanggan Off
Route::get('/pelanggan/tagihan/index', [PelangganOfController::class, 'filterByTanggalTagihindex'])->name('pelangganof.filterTagihindex');
//isolir asli
Route::get('/check-isolir', [PelangganController::class, 'checkAndMoveToIsolir'])->name('check.isolir');
//cek payment asli
Route::get('/update-payment-status', [PelangganController::class, 'updatePaymentStatus'])->name('update.payment.status');
//reactive bayar
Route::post('/reactivate-bayar', [IsolirController::class, 'reactivateAndBayar'])->name('pelanggan.reactivateAndBayar');

//pelanggan bayar
Route::get('/pembayaran/csbayar', [PelangganBayarSendiriController::class, 'index'])->name('pembayaran.csbayar');
Route::get('/costumer', [PelangganBayarSendiriController::class, 'index'])->name('costumer.index');


// Route untuk admin
// Route::middleware(['role:admin'])->group(function () {
//   Route::get('/masuk/admin', [AdminController::class, 'index']);
//   Route::get('/masuk/admin/karyawan', [AdminController::class, 'karyawan']);
// });

// Route untuk superadmin dengan akses hanya ke sub-route tertentu
// Route::middleware(['role:superadmin,masuk/superadmin/karyawan'])->group(function () {
//  Route::get('/masuk/superadmin/karyawan', [SuperAdminController::class, 'karyawan']);
// });

// Route untuk teknisi
// Route::middleware(['role:teknisi'])->group(function () {
//   Route::get('/masuk/teknisi', [TeknisiController::class, 'index']);
//});

Route::get('/pindahroute', function () {
    return view('pindahroute');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/pembayaran/edit/{id}', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');

//redirect ketika btn / data di klik di home index
Route::get('/pelanggan/redirect', [HomeController::class, 'redirectToPelanggan'])->name('pelanggan.redirect');
Route::get('/pelanggan/sudahbayar', [HomeController::class, 'showPelangganBelumBayar'])->name('pelanggan.belumbayar');
Route::get('/pelanggan/belumbayar', [HomeController::class, 'showPelangganSudahBayar'])->name('pelanggan.sudahbayar');
Route::get('/pelanggan/historyhariini', [HomeController::class, 'historyhariini'])->name('pelanggan.historyhariini');


Route::get('/target', [TargetController::class, 'index'])->name('target.index');
Route::post('/simpan-target', [TargetController::class, 'store'])->name('target.store');
Route::post('/target/update/{id}', [TargetController::class, 'update'])->name('target.update');
Route::delete('/target/{id}', [TargetController::class, 'destroy'])->name('target.destroy');


//file Storage
Route::get('/file/index', [FileController::class, 'index'])->name('file.index');
Route::get('/file/create', [FileController::class, 'create'])->name('file.create');
Route::post('/file/store', [FileController::class, 'store'])->name('file.store');
Route::get('/file/edit/{id}', [FileController::class, 'edit'])->name('file.edit');
Route::post('/file/update/{id}', [FileController::class, 'update'])->name('file.update');
Route::post('/file/hapus/{id}', [FileController::class, 'destroy'])->name('file.destroy');
Route::get('/file/download/{id}', [FileController::class, 'download'])->name('file.download');
//Route::get('/file/{path?}', [FileController::class, 'index'])->name('file.index')->where('path', '.*');

//Pemberitahuan
Route::get('/pemberitahuan', [PemberitahuanController::class, 'index'])->name('pemberitahuan.index');
Route::get('/pemberitahuan/create', [PemberitahuanController::class, 'create'])->name('pemberitahuan.create');
Route::post('/pemberitahuan/store', [PemberitahuanController::class, 'store'])->name('pemberitahuan.store');
Route::get('/pemberitahuan/edit/{id}', [PemberitahuanController::class, 'edit'])->name('pemberitahuan.edit');
Route::post('/pemberitahuan/update/{id}', [PemberitahuanController::class, 'update'])->name('pemberitahuan.update');
Route::post('/pemberitahuan/hapus/{id}', [PemberitahuanController::class, 'destroy'])->name('pemberitahuan.destroy');

//Automatis Bayar
Route::get('/pelanggan/automatispayment', [AutomatisPaymentController::class, 'index'])->name('automatispayment.index');
Route::get('/pelanggan/{id}/payment', [AutomatisPaymentController::class, 'payment'])->name('pelanggan.payment');
Route::post('/pelanggan/{id}/process-payment', [AutomatisPaymentController::class, 'processPayment'])->name('pelanggan.processPayment');

//Pemabayaran Mudah
Route::get('/pembayaran/mudah', [PembayaranMudahController::class, 'index'])->name('pembayaran_mudah.index');

Route::get('/pembayaran/mudah/coba', [PembayaranMudahController::class, 'coba'])->name('pembayaran_mudah.coba');
Route::get('/pembayaran/mudah/bayar_hp', [PembayaranMudahController::class, 'bayar_hp'])->name(name: 'pembayaran_mudah.bayar_hp');


//absensi
Route::post('/absensi', [AbsensiController::class, 'store']);
Route::get('/hitung-gaji/{user_id}', [AbsensiController::class, 'hitungGaji']);
Route::get('/form-absensi', [AbsensiController::class, 'showAbsensiForm']);
Route::get('/form-gaji', [AbsensiController::class, 'showGajiForm']);

Route::get('/absensi/splash', [AbsensiController::class, 'splash'])->name('absensi.splash');
//Route::get('/absensi/login', [AbsensiController::class,   'login'])->name('absensi.login');
Route::get('/absensi/absen', [AbsensiController::class, 'absen'])->name('absensi.absen');

Route::get('/absensi/dashboard', [AbsensiController::class, 'getAbsensiData'])->name('absensi.dashboard');


//midleware
Route::middleware(['guest'])->group(function () {
    // Rute untuk halaman login
    Route::get('/absensi/index', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/index', [AbsensiController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/absensi/masuk', [AbsensiController::class, 'store']);
    Route::post('/absensi/pulang', [AbsensiController::class, 'updatePulang']);
});


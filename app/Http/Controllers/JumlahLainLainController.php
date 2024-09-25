<?php

namespace App\Http\Controllers;

use App\Models\BayarPelanggan;
use App\Models\PemasukanModel;
use App\Models\PengeluaranModel;
use App\Models\RekapPemasanganModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JumlahLainLainController extends Controller
{
    public function tambahPemasukan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Menyimpan data pemasukan ke dalam tabel
        $pemasukan = new PemasukanModel();
        $pemasukan->jumlah = $validated['jumlah'];
        $pemasukan->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    // Fungsi untuk menambahkan pengeluaran
    public function tambahPengeluaran(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Menyimpan data pengeluaran ke dalam tabel
        $pengeluaran = new PengeluaranModel();
        $pengeluaran->jumlah = $validated['jumlah'];
        $pengeluaran->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    // Fungsi untuk menambahkan pengeluaran
    public function RekapPemasangan(Request $request)
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Menyimpan data pemasukan ke dalam tabel
        $pemasukan = new RekapPemasanganModel();
        $pemasukan->jumlah = $validated['registrasi'];
        $pemasukan->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pemasukan berhasil ditambahkan.');
    }


    // Fungsi untuk mendapatkan total pemasukan, pengeluaran, dan pembayaran harian
    public function lihatRekapHarian()
    {
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        // Mengambil total pemasukan dan pengeluaran untuk hari ini
        $totalPemasukan = PemasukanModel::whereDate('created_at', $tanggalHariIni)->sum('jumlah');
        $totalPengeluaran = PengeluaranModel::whereDate('created_at', $tanggalHariIni)->sum('jumlah');
        $totalRegistrasi = RekapPemasanganModel::whereDate('created_at', $tanggalHariIni)->sum('registrasi');

        //$pembayaranHarian = BayarPelanggan::whereDate('tanggal_pembayaran', $tanggalHariIni)->get();

        // Ambil data pembayaran harian kecuali yang metode transaksinya adalah 'TF'
        // Ambil data pembayaran yang dilakukan hari ini, kecuali metode 'TF'
        $pembayaranHarian = BayarPelanggan::whereDate('tanggal_pembayaran', Carbon::today())
            ->where('metode_transaksi', '!=', 'TF') // Kecualikan metode transaksi 'TF'
            ->get();

        // Hitung total pendapatan harian dari pembayaran
        $totalPendapatanHarian = $pembayaranHarian->sum('jumlah_pembayaran');

        $pemasukantotal = $totalPemasukan - $totalPengeluaran;

        $totalsaldo = $totalPendapatanHarian + $pemasukantotal;

        $totaljumlahsaldo = $totalRegistrasi + $totalsaldo;

        // Hitung total user yang membayar hari ini
        $totalUserHarian = $pembayaranHarian->count();

        return view('rekap_harian.index', compact('totalRegistrasi', 'totalsaldo', 'totaljumlahsaldo', 'totalPemasukan', 'totalPengeluaran', 'totalPendapatanHarian', 'totalUserHarian', 'tanggalHariIni'));
    }
}

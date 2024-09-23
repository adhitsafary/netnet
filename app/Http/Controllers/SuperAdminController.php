<?php

namespace App\Http\Controllers;

use App\Models\BayarPelanggan;
use App\Models\IsolirModel;
use App\Models\Netnet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Pelangganof;
use App\Models\PemasukanModel;
use App\Models\PembayaranPelanggan;
use App\Models\PengeluaranModel;
use App\Models\Perbaikan;
use App\Models\RekapPemasanganModel;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuperAdminController extends Controller
{
    public function home(Request $request)
    {
        // Ambil data pelanggan dan pelanggan off
        $pelanggan = Pelanggan::all();
        $pelangganof = Pelangganof::all();

        // Hitung total pendapatan bulanan
        $totalPendapatanBulanan = $pelanggan->sum('harga_paket');

        // Hitung total jumlah pengguna
        $totalJumlahPengguna = $pelanggan->count();

        // Hitung total pengurangan pendapatan dari pelanggan off bulanan
        $pelangganofuang = $pelangganof->sum('harga_paket');

        // Hitung total jumlah pengguna pelanggan off
        $pelangganoforang = $pelangganof->count();

        $pelanggan_of = $pelangganof->count();
        $pelanggan_of_uang = $pelangganof->sum('harga_paket');

        $totalpendapatanakhir = $totalPendapatanBulanan + $pelangganofuang;
        $totaluser = $totalJumlahPengguna + $pelangganoforang;

        // Penjualan harga paket
        $paketData = DB::table('pelanggan')
            ->select('harga_paket', DB::raw('count(*) as total_user'))
            ->groupBy('harga_paket')
            ->orderBy('total_user', 'desc')
            ->get();

        // Menghitung total user di semua paket
        $totalUsers = $paketData->sum('total_user');

        // Membagi data menjadi dua: 5 teratas dan sisanya
        $paketTop5 = $paketData->take(3); // Mengambil 5 teratas
        $paketRemaining = $paketData->skip(3);

        // Perbaikan dashboard
        $perbaikans = Perbaikan::all();

        // Pembayaran harian


        // Pendapatan bulanan
        $pendapatanBulanan = BayarPelanggan::selectRaw('MONTH(tanggal_pembayaran) as bulan, SUM(jumlah_pembayaran) as total_pendapatan')
            ->whereYear('tanggal_pembayaran', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Format data untuk dikirim ke view
        $dataPendapatan = array_fill(0, 12, 0); // Isi awal dengan 0 untuk 12 bulan
        foreach ($pendapatanBulanan as $pendapatan) {
            if ($pendapatan->bulan >= 9 && $pendapatan->bulan <= 12) {
                $dataPendapatan[$pendapatan->bulan - 1] = $pendapatan->total_pendapatan; // Sesuaikan indeks bulan
            }
        }

        // Ambil data chart untuk laporan
        $pembayaranPerBulan = BayarPelanggan::selectRaw('MONTH(tanggal_pembayaran) as bulan, SUM(jumlah_pembayaran) as total')
            ->whereYear('tanggal_pembayaran', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan array untuk data chart
        $dataChart = [
            'labels' => [],
            'data' => []
        ];

        // Pastikan data dimulai dari September
        $startMonth = 9; // September
        $endMonth = 12; // Desember

        foreach ($pembayaranPerBulan as $pembayaran) {
            $bulan = $pembayaran->bulan;
            if ($bulan >= $startMonth && $bulan <= $endMonth) {
                $dataChart['labels'][] = $this->getBulan($bulan);
                $dataChart['data'][] = $pembayaran->total;
            }
        }

        // Isi bulan-bulan sebelum September dengan 0
        for ($i = 1; $i < $startMonth; $i++) {
            $dataChart['labels'][] = $this->getBulan($i);
            $dataChart['data'][] = 0;
        }

        // Ambil total jumlah_pembayaran dari tabel berdasarkan bulan September (atau bulan lain dari tanggal saat ini)
        $bulanSekarang = now()->format('m'); // Mendapatkan bulan dari sistem (sekarang)
        $dataPendapatanbulan = DB::table('bayar_pelanggan')
            ->whereMonth('tanggal_pembayaran', $bulanSekarang)
            ->sum('jumlah_pembayaran'); // Menjumlahkan total pembayaran di bulan yang sama


        //======================FILTER hari bln taun
        // Ambil filter hari, bulan, dan tahun dari request, default ke tanggal sekarang jika kosong
        // $filterTanggal = $request->input('tanggal') ?? now()->format('Y-m-d');
        // $filterBulan = $request->input('bulan') ?? now()->format('m');
        // $filterTahun = $request->input('tahun') ?? now()->format('Y');

        // Pembayaran harian
        //$pembayaranHarian = BayarPelanggan::whereDate('tanggal_pembayaran', $filterTanggal)->get();

        // Hitung total pendapatan dan jumlah user yang membayar pada hari yang difilter
        // $totalPendapatanharian = $pembayaranHarian->sum('jumlah_pembayaran');
        // $totalUserHarian = $pembayaranHarian->count();

        // Ambil tanggal mulai dan akhir dari request atau default ke hari ini
        $tanggalMulai = $request->input('tanggal_mulai', now()->format('Y-m-d')); // Default ke hari ini
        $tanggalAkhir = $request->input('tanggal_akhir', now()->format('Y-m-d')); // Default ke hari ini
        // Ambil data pembayaran yang dilakukan antara tanggal mulai dan akhir (default hari ini)
        $pembayaranHarian = BayarPelanggan::whereBetween('tanggal_pembayaran', [$tanggalMulai, $tanggalAkhir])->get();
        // Hitung total pendapatan harian
        $totalPendapatanharian = $pembayaranHarian->sum('jumlah_pembayaran');
        // Hitung total user yang membayar hari ini
        $totalUserHarian = $pembayaranHarian->count();

        //INI BARU TOTAL HARIAN
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        // Mengambil total pemasukan dan pengeluaran untuk hari ini
        $totalPemasukan = PemasukanModel::whereDate('created_at', $tanggalHariIni)->sum('jumlah');
        $totalPengeluaran = PengeluaranModel::whereDate('created_at', $tanggalHariIni)->sum('jumlah');
        $totalRegistrasi = RekapPemasanganModel::whereDate('created_at', $tanggalHariIni)->sum('registrasi');
        //$pembayaranHarian = BayarPelanggan::whereDate('tanggal_pembayaran', $tanggalHariIni)->get();
        // Ambil data pembayaran harian kecuali yang metode transaksinya adalah 'TF'
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





        // Kirim data ke view
        return view('index', compact(
            'tanggalMulai',
            'tanggalAkhir',
            'dataPendapatanbulan',
            'totalJumlahPengguna',
            'dataPendapatan',
            'totalUserHarian',
            'totalPendapatanharian',
            'perbaikans',
            'totalUsers',
            'paketTop5',
            'paketRemaining',
            'paketData',
            'pelanggan',
            'pelanggan_of',
            'pelanggan_of_uang',
            'totalpendapatanakhir',
            'totaluser',
            'pelangganofuang',
            'pelangganoforang',
            'totalPendapatanBulanan',
            'totalJumlahPengguna',
            'dataChart',
            // HARIAN BARU
            'totalRegistrasi',
            'totalsaldo',
            'totaljumlahsaldo',
            'totalPemasukan',
            'totalPengeluaran',
            'totalPendapatanHarian',
            'totalUserHarian',
            'tanggalHariIni'
        ));
    }
    private function getBulan($bulan)
    {
        $bulanArray = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];
        return $bulanArray[$bulan];
    }
}

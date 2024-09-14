<?php

namespace App\Http\Controllers;

use App\Models\BayarPelanggan;
use App\Models\Netnet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Pelangganof;
use App\Models\PembayaranPelanggan;
use App\Models\Perbaikan;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;





class PelangganController extends Controller
{

    public function home()
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
        $pembayaranHarian = BayarPelanggan::whereDate('tanggal_pembayaran', now()->format('Y-m-d'))->get();

        // Hitung total pendapatan dan jumlah user yang membayar hari ini
        $totalPendapatan = $pembayaranHarian->sum('jumlah_pembayaran');
        $totalUserHarian = $pembayaranHarian->count();

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

        // Kirim data ke view
        return view('index', compact(
            'dataPendapatan',
            'totalUserHarian',
            'totalPendapatan',
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
            'dataChart' // Tambahkan data chart di sini
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

    public function detail($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.detail', compact('pelanggan'));
    }



    public function index(Request $request)
    {
        $query = Pelanggan::query();

        // Pengecekan status pembayaran otomatis berdasarkan tanggal tagihan
        $pelanggan_all = Pelanggan::all();
        foreach ($pelanggan_all as $pelanggan) {
            // Ambil tanggal tagih (hari saja)
            $hari_tagih = intval($pelanggan->aktivasi_plg);  // Misal: "25"

            // Ambil bulan dan tahun saat ini
            $currentMonth = now()->month;
            $currentYear = now()->year;

            // Validasi hari tagih agar nilainya valid (antara 1 dan 31)
            if ($hari_tagih >= 1 && $hari_tagih <= 31) {
                // Buat tanggal tagih lengkap (menggabungkan hari, bulan, dan tahun)
                $tgl_tagih = Carbon::createFromDate($currentYear, $currentMonth, $hari_tagih);

                // Jika tanggal tagih sudah lewat di bulan ini, pindahkan ke bulan berikutnya
                if (now()->gt($tgl_tagih)) {
                    $tgl_tagih = $tgl_tagih->addMonth();
                }

                // Bandingkan tgl_tagih dengan waktu sekarang
                if (now()->gt($tgl_tagih) && $pelanggan->status_pembayaran === 'sudah bayar') {
                    $pelanggan->status_pembayaran = 'belum bayar';
                    $pelanggan->save();
                }
            } else {
                // Log error jika hari tidak valid
                Log::error("Hari tagih tidak valid untuk pelanggan ID: " . $pelanggan->id_plg);
            }
        }

        $query = Pelanggan::query();

        // Mapping status URL ke status database
        $statusMapping = [
            'belum_bayar' => 'Belum Bayar',
            'sudah_bayar' => 'Sudah Bayar'
        ];

        // Mapping status database ke URL
        $reverseStatusMapping = array_flip($statusMapping);

        // Filter berdasarkan pencarian jika tombol Cari diklik
        if ($request->input('action') === 'search' && $request->filled('search')) {
            $query->where('nama_plg', 'LIKE', '%' . $request->search . '%')
                ->orWhere('alamat_plg', 'LIKE', '%' . $request->search . '%')
                ->orWhere('harga_paket', 'LIKE', '%' . $request->search . '%');
        }

        // Filter berdasarkan status pembayaran jika tombol Filter diklik
        if ($request->input('action') === 'filter' && $request->filled('status_pembayaran')) {
            $status = $request->status_pembayaran;
            if (array_key_exists($status, $statusMapping)) {
                // Konversi status URL ke format database
                $status_db = $statusMapping[$status];
                $query->where('status_pembayaran', $status_db);
            }
        }

        $pelanggan = $query->get();
        $status_pembayaran_display = $request->input('status_pembayaran', '');

        return view('pelanggan.index', compact('pelanggan', 'status_pembayaran_display'));
    }







    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_plg' => 'required',
            'nama_plg' => 'required',
            'alamat_plg' => 'required',
            'no_telepon_plg' => 'required',
            'paket_plg' => 'required',
            'odp' => 'required',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->id_plg = $request->id_plg;
        $pelanggan->nama_plg = $request->nama_plg;
        $pelanggan->alamat_plg = $request->alamat_plg;
        $pelanggan->no_telepon_plg = $request->no_telepon_plg;
        $pelanggan->aktivasi_plg = $request->aktivasi_plg;
        $pelanggan->paket_plg = $request->paket_plg;
        $pelanggan->harga_paket = $request->harga_paket;
        $pelanggan->keterangan_plg = $request->keterangan_plg;
        $pelanggan->odp = $request->odp;
        $pelanggan->longitude = $request->longitude;
        $pelanggan->latitude = $request->latitude;

        // Set status pembayaran awal sebagai 'belum bayar'
        $pelanggan->status_pembayaran = 'belum bayar';

        $pelanggan->save();

        return redirect()->route('pelanggan.index');
    }

    public function show(string $id) {}


    public function edit(string $id_plg)
    {
        $pelanggan = Pelanggan::findOrFail($id_plg);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, string $id_plg)
    {
        // Ambil data pelanggan yang sudah ada
        $pelanggan = Pelanggan::findOrFail($id_plg);

        // Update data pelanggan yang sudah ada
        $pelanggan->id_plg = $request->id_plg;
        $pelanggan->nama_plg = $request->nama_plg;
        $pelanggan->alamat_plg = $request->alamat_plg;
        $pelanggan->no_telepon_plg = $request->no_telepon_plg;
        $pelanggan->aktivasi_plg = $request->aktivasi_plg;
        $pelanggan->paket_plg = $request->paket_plg;
        $pelanggan->harga_paket = $request->harga_paket;
        $pelanggan->keterangan_plg = $request->keterangan_plg ?? null;
        $pelanggan->odp = $request->odp;
        $pelanggan->longitude = $request->longitude;
        $pelanggan->latitude = $request->latitude;

        // Simpan data yang sudah diperbarui
        $pelanggan->save();

        return redirect()->route('pelanggan.index');
    }





    public function destroy(string $id_plg)
    {
        $pelanggan = Pelanggan::findOrFail($id_plg);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index');
    }

    public function pelanggan_off($id)
    {
        // Ambil data pelanggan dari tabel pelanggan
        $pelanggan = Pelanggan::find($id);

        if ($pelanggan) {
            // Pastikan tanggal tagih diubah ke format yang sesuai jika perlu
            $tglTagih = \Carbon\Carbon::createFromFormat('d/m/Y', $pelanggan->aktivasi_plg)->format('Y-m-d');

            // Masukkan data ke tabel plg_off
            DB::table('plg_off')->insert([
                'id_plg' => $pelanggan->id_plg,
                'nama_plg' => $pelanggan->nama_plg,
                'alamat_plg' => $pelanggan->alamat_plg,
                'no_telepon_plg' => $pelanggan->no_telepon_plg,
                'aktivasi_plg' => $pelanggan->aktivasi_plg,
                'paket_plg' => $pelanggan->paket_plg,
                'harga_paket' => $pelanggan->harga_paket,
                'odp' => $pelanggan->odp,
                'keterangan_plg' => $pelanggan->keterangan_plg,
                'longitude' => $pelanggan->longitude,
                'latitude' => $pelanggan->latitude,
                'status_pembayaran' => $pelanggan->status_pembayaran,
                'created_at' => now(),
                'updated_at' => now(),
            ]);



            // Hapus data dari tabel pelanggan
            $pelanggan->delete();

            // Redirect ke halaman pelanggan dengan pesan sukses
            return redirect()->route('pelangganof.index')->with('success', 'Pelanggan berhasil dipindahkan ke tabel pelanggan off.');
        } else {
            return redirect()->route('pelangganof.index')->with('error', 'Pelanggan tidak ditemukan.');
        }
    }



    public function toggleVisibility($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->is_visible = !$pelanggan->is_visible;
        $pelanggan->last_payment_date = now();
        $pelanggan->save();

        return redirect()->route('pelanggan.detail', $id)->with('status', 'Status visibilitas diubah.');
    }

    public function bayar($id)
    {
        // Ambil data pelanggan berdasarkan id
        $pelanggan = Pelanggan::findOrFail($id);

        // Pastikan id_plg tidak kosong
        if (is_null($pelanggan->id_plg)) {
            return redirect()->route('pelanggan.detail', $id)->with('error', 'ID pelanggan tidak valid.');
        }

        // Format tanggal tagih pelanggan dari format yang ada ke format yang sesuai
        $tglTagih = \Carbon\Carbon::createFromFormat('d/m/Y', $pelanggan->aktivasi_plg)->format('Y-m-d');

        // Simpan data ke tabel bayar_pelanggan
        BayarPelanggan::create([
            'pelanggan_id' => $pelanggan->id,        // ID pelanggan
            'nama_plg' => $pelanggan->nama_plg,      // Nama pelanggan
            'alamat_plg' => $pelanggan->alamat_plg,
            'alamat_plg' => $pelanggan->alamat_plg,  // Alamat pelanggan
            'aktivasi_plg' => $pelanggan->aktivasi_plg,
            'tanggal_pembayaran' => now(),           // Tanggal pembayaran saat ini
            'jumlah_pembayaran' => $pelanggan->harga_paket,  // Jumlah yang dibayarkan
        ]);

        // Update status pembayaran pelanggan menjadi 'sudah bayar'
        $pelanggan->status_pembayaran = 'sudah bayar';
        $pelanggan->save();

        // Redirect ke halaman detail pelanggan dengan pesan sukses
        return redirect()->route('pelanggan.historypembayaran', $id)->with('success', 'Pembayaran berhasil dilakukan.');
    }




    public function historypembayaran($id_plg)
    {
        $pelanggan = Pelanggan::findOrFail($id_plg);
        $pembayaran = BayarPelanggan::where('pelanggan_id', $id_plg)->get();

        return view('pelanggan.historypembayaran', compact('pelanggan', 'pembayaran'));
    }


    public function index_bayar(Request $request)
    {
        $search = $request->input('search');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        $pembayaran = BayarPelanggan::when($search, function ($query, $search) {
            return $query->where('id', $search)
                ->orWhere('nama_plg', 'like', "%{$search}%");
        })
            ->when($date_start && $date_end, function ($query) use ($date_start, $date_end) {
                return $query->whereBetween('created_at', [$date_start, $date_end]);
            })
            ->get();

        return view('pembayaran.index', compact('pembayaran', 'search', 'date_start', 'date_end'));
    }

    public function export(Request $request, $format)
    {
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        $pembayaran = BayarPelanggan::when($date_start && $date_end, function ($query) use ($date_start, $date_end) {
            return $query->whereBetween('created_at', [$date_start, $date_end]);
        })->get();

        if ($format === 'pdf') {
            $pdf = PDF::loadView('pembayaran.pdf', ['pembayaran' => $pembayaran]);
            return $pdf->download('bayar_pelanggan_' . now()->format('Y-m-d') . '.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new PelangganController($pembayaran), 'bayar_pelanggan_' . now()->format('Y-m-d') . '.xlsx');
        }
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        $pembayaran = BayarPelanggan::when($search, function ($query, $search) {
            return $query->where('id', $search)
                ->orWhere('nama_plg', 'like', "%{$search}%");
        })
            ->when($date_start && $date_end, function ($query) use ($date_start, $date_end) {
                return $query->whereBetween('created_at', [$date_start, $date_end]);
            })
            ->get();

        return Excel::download(new PelangganController($pembayaran), 'pembayaran.xlsx');
    }






    public function plg_blm_byr(Request $request)
    {
        $search = $request->input('search');

        // Query untuk mendapatkan pelanggan yang belum membayar di bulan ini
        $pembayaran = DB::table('pelanggan')
            ->leftJoin('pembayaran', 'pelanggan.id_plg', '=', 'pembayaran.pelanggan_id')
            ->whereMonth('pembayaran.tanggal_pembayaran', '!=', now()->month)
            ->whereYear('pembayaran.tanggal_pembayaran', '=', now()->year)
            ->orWhereNull('pembayaran.tanggal_pembayaran')
            ->when($search, function ($query, $search) {
                return $query->where('pelanggan.id_plg', 'like', "%{$search}%")
                    ->orWhere('pelanggan.nama_plg', 'like', "%{$search}%");
            })
            ->select('pelanggan.id_plg', 'pelanggan.nama_plg', 'pelanggan.alamat_plg', 'pembayaran.tanggal_pembayaran', 'pembayaran.jumlah_pembayaran')
            ->get();

        return view('pembayaran.blm_byr', compact('pembayaran'));
    }


    public function getMonthlyPayments()
    {
        // Mengambil data jumlah pembayaran per bulan di tahun ini
        $monthlyPayments = DB::table('bayar_pelanggan')
            ->select(DB::raw('MONTH(tanggal_pembayaran) as month'), DB::raw('SUM(jumlah_pembayaran) as total_pendapatan'))
            ->whereYear('tanggal_pembayaran', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(tanggal_pembayaran)'))
            ->pluck('total_pendapatan', 'month')
            ->toArray();

        // Buat array dengan 12 bulan, isi 0 jika tidak ada data
        $dataPendapatan = array_fill(1, 12, 0);
        foreach ($monthlyPayments as $month => $total) {
            $dataPendapatan[$month] = $total;
        }

        // Kirim data ke view
        return view('chart', [
            'dataPendapatan' => $dataPendapatan,
        ]);
    }

    function teknisi(Request $request)
    {
        $query = Perbaikan::query();

        // Filtering
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where('id_plg', 'like', '%' . $request->search . '%')
                ->orWhere('nama_plg', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'asc');
        $query->orderBy('created_at', $sort);

        $perbaikan = $query->get();

        // Data for charts
        $weeklyData = $query->selectRaw('WEEK(created_at) as week, COUNT(*) as total')
            ->groupBy('week')
            ->pluck('total', 'week');

        $monthlyData = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $yearlyData = $query->selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->pluck('total', 'year');

        return view('perbaikan.index', compact('perbaikan', 'sort', 'weeklyData', 'monthlyData', 'yearlyData'));
    }

    function admin()
    {
        return view('index');
    }

    function superadmin()
    {
        return view('index');
    }

    public function belumBayar()
    {
        $pelanggan = Pelanggan::where('status_pembayaran', 'belum bayar')->get();
        return view('pelanggan.belum_bayar', compact('pelanggan'));
    }
}

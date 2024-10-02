<?php

namespace App\Http\Controllers;

use App\Models\BayarPelanggan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Pelangganof;
use App\Models\PembayaranPelanggan;
use App\Models\Perbaikan;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan data berdasarkan ID otomatis
        $bayarPelanggan = BayarPelanggan::findOrFail($id);

        // Ambil id otomatis dan id_bawan (pelanggan_id)
        $idOtomatis = $bayarPelanggan->id;
        $pelangganId = $bayarPelanggan->pelanggan_id; // Asumsikan kolom ini adalah id_bawan dari tabel pelanggan

        // Hapus data
        $bayarPelanggan->delete();

        // (Opsional) Lakukan sesuatu dengan $idOtomatis dan $pelangganId
        // Misalnya, menambah log atau mengalihkan halaman dengan pesan khusus

        // Redirect ke halaman index pembayaran dengan pesan sukses
        return redirect()->route('pembayaran.index')->with('success', "Data dengan ID: $idOtomatis dan Pelanggan ID: $pelangganId telah dihapus.");
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

    public function index(Request $request)
    {
        // Ambil nilai filter status pembayaran dari request
        $status_pembayaran_display = $request->input('status_pembayaran', '');

        // Ambil tanggal tagih, paket, harga_paket, tanggal pembayaran, bulan, tanggal mulai dan tanggal akhir dari request
        $tanggal = $request->input('tgl_tagih_plg');
        $paket_plg = $request->input('paket_plg');
        $jumlah_pembayaran = $request->input('jumlah_pembayaran');
        $tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $created_at = $request->input('created_at');
        $bulan = $request->input('bulan'); // Ambil bulan dari request
        $date_start = $request->input('date_start'); // Ambil tanggal mulai dari request
        $date_end = $request->input('date_end'); // Ambil tanggal akhir dari request
        $search = $request->input('search'); // Ambil input pencarian dari request

        // Mulai query
        $query = BayarPelanggan::query(); // Ganti Pelanggan dengan BayarPelanggan

        // Filter berdasarkan status pembayaran jika ada
        if ($status_pembayaran_display) {
            $query->where('status_pembayaran', $status_pembayaran_display);
        }

        // Filter berdasarkan tanggal tagih jika ada
        if ($tanggal) {
            $query->where('tgl_tagih_plg', $tanggal);
        }

        // Filter berdasarkan paket pelanggan jika ada
        if ($paket_plg) {
            $query->where('paket_plg', $paket_plg);
        }

        // Filter berdasarkan harga paket jika ada
        if ($jumlah_pembayaran) {
            $query->where('jumlah_pembayaran', $jumlah_pembayaran);
        }

        // Filter berdasarkan tanggal pembayaran (format Y-m-d) jika ada
        if ($created_at) {
            $query->whereDate('created_at', $created_at);
        }

        // Filter berdasarkan bulan jika ada
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        // Filter berdasarkan tanggal mulai dan tanggal akhir jika ada
        if ($date_start && $date_end) {
            $query->whereBetween('created_at', [$date_start, $date_end]);
        }

        // Filter berdasarkan pencarian jika ada
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('id_plg', $search)
                    ->orWhere('nama_plg', 'like', "%{$search}%")
                    ->orWhere('alamat_plg', 'like', "%{$search}%")
                    ->orWhere('no_telepon_plg', 'like', "%{$search}%")
                    ->orWhere('metode_transaksi', 'like', "%{$search}%");
            });
        }

        // Ambil hasil query
        $pembayaran = $query->paginate(100); // Ambil data yang telah difilter

        // Hitung total jumlah pembayaran yang telah difilter
        $totalJumlahPembayaran = $query->sum('jumlah_pembayaran');

        // Hitung total jumlah pelanggan yang telah difilter
        $totalPelanggan = $query->count(); // Menghitung jumlah pelanggan

        // Kembalikan data pembayaran ke view
        return view('pembayaran.index', compact(
            'pembayaran',
            'totalJumlahPembayaran',
            'totalPelanggan',
            'jumlah_pembayaran',
            'paket_plg',
            'tanggal',
            'status_pembayaran_display',
            'tanggal_pembayaran',
            'bulan',
            'date_start',
            'date_end',
            'search',
            'created_at'
        ));
    }
}

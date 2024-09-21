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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        $pembayaran = BayarPelanggan::when($search, function ($query, $search) {
            return $query->where('id', $search)
                ->orWhere('nama_plg', 'like', "%{$search}%");
        })
            ->when($date_start && $date_end, function ($query) use ($date_start, $date_end) {
                return $query->whereBetween('tanggal_pembayaran', [$date_start, $date_end]);
            })
            ->get();

        return view('pembayaran.index', compact('pembayaran', 'search', 'date_start', 'date_end'));
    }

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
            return $query->whereBetween('tanggal_pembayaran', [$date_start, $date_end]);
        })->get();

        if ($format === 'pdf') {
            $pdf = PDF::loadView('pembayaran.pdf', ['pembayaran' => $pembayaran]);
            return $pdf->download('bayar_pelanggan_' . now()->format('Y-m-d') . '.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new PelangganController($pembayaran), 'bayar_pelanggan_' . now()->format('Y-m-d') . '.xlsx');
        }
    }
}

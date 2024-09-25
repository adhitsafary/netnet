<?php

namespace App\Http\Controllers;

use App\Models\BayarPelanggan;
use App\Models\IsolirModel;
use App\Models\Netnet;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelangganof;
use App\Models\PembayaranPelanggan;
use App\Models\Perbaikan;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsolirController extends Controller
{
    // Tampilkan daftar pelanggan yang diisolir
    public function index()
    {
        $isolir = IsolirModel::all();
        return view('isolir.index', compact('isolir'));
    }


    // Hapus pelanggan yang tidak aktif selama lebih dari 60 hari
    public function cleanUp()
    {
        $expired = IsolirModel::where('created_at', '<', now()->subDays(60))->get();

        foreach ($expired as $pelanggan) {
            $pelanggan->delete();
        }

        return redirect()->route('isolir.index')->with('success', 'Pelanggan yang tidak aktif selama lebih dari 60 hari berhasil dihapus.');
    }


    public function checkIsolirStatus()
    {
        // Ambil data pelanggan yang tgl_tagih_plg sudah lewat dan status pembayaran "belum bayar"
        $pelangganBelumBayar = Pelanggan::where('tgl_tagih_plg', '<', Carbon::now())
            ->where('status_pembayaran', 'belum bayar')
            ->get();

        foreach ($pelangganBelumBayar as $pelanggan) {
            // Pindahkan data ke tabel 'isolir'
            IsolirModel::create([
                'id_plg' => $pelanggan->id_plg,
                'nama_plg' => $pelanggan->nama_plg,
                'alamat_plg' => $pelanggan->alamat_plg,
                'no_telepon_plg' => $pelanggan->no_telepon_plg,
                'aktivasi_plg' => $pelanggan->aktivasi_plg,
                'paket_plg' => $pelanggan->paket_plg,
                'harga_paket' => $pelanggan->harga_paket,
                'tgl_tagih_plg' => $pelanggan->tgl_tagih_plg,
                'keterangan_plg' => $pelanggan->keterangan_plg,
                'odp' => $pelanggan->odp,
                'longitude' => $pelanggan->longitude,
                'latitude' => $pelanggan->latitude,
                'status_pembayaran' => $pelanggan->status_pembayaran,
            ]);

            // Hapus data dari tabel 'pelanggan'
            $pelanggan->delete();
        }
    }

    public function pindahKeIsolir($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Pindahkan data ke tabel 'isolir'
        IsolirModel::create([
            'id_plg' => $pelanggan->id_plg,
            'nama_plg' => $pelanggan->nama_plg,
            'alamat_plg' => $pelanggan->alamat_plg,
            'no_telepon_plg' => $pelanggan->no_telepon_plg,
            'aktivasi_plg' => $pelanggan->aktivasi_plg,
            'paket_plg' => $pelanggan->paket_plg,
            'harga_paket' => $pelanggan->harga_paket,
            'tgl_tagih_plg' => $pelanggan->tgl_tagih_plg,
            'keterangan_plg' => $pelanggan->keterangan_plg,
            'odp' => $pelanggan->odp,
            'longitude' => $pelanggan->longitude,
            'latitude' => $pelanggan->latitude,
            'status_pembayaran' => $pelanggan->status_pembayaran,
        ]);

        // Hapus dari tabel pelanggan
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dipindahkan ke Isolir.');
    }

    public function reactivatePelanggan($id)
    {
        $isolir = IsolirModel::findOrFail($id);

        // Pindahkan data ke tabel pelanggan
        Pelanggan::create([
            'id_plg' => $isolir->id_plg,
            'nama_plg' => $isolir->nama_plg,
            'alamat_plg' => $isolir->alamat_plg,
            'no_telepon_plg' => $isolir->no_telepon_plg,
            'aktivasi_plg' => $isolir->aktivasi_plg,
            'paket_plg' => $isolir->paket_plg,
            'harga_paket' => $isolir->harga_paket,
            'tgl_tagih_plg' => $isolir->tgl_tagih_plg,
            'keterangan_plg' => $isolir->keterangan_plg,
            'odp' => $isolir->odp,
            'longitude' => $isolir->longitude,
            'latitude' => $isolir->latitude,
            'status_pembayaran' => $isolir->status_pembayaran,
        ]);

        // Hapus dari tabel isolir
        $isolir->delete();

        return redirect()->route('isolir.index')->with('success', 'Pelanggan Isolir berhasil diaktifkan kembali.');
    }


    public function checkPlgOffStatus()
    {
        $pelangganIsolir = IsolirModel::where('created_at', '<', Carbon::now()->subDays(60))->get();

        foreach ($pelangganIsolir as $pelanggan) {
            // Pindahkan data ke tabel 'plg_off'
            Pelangganof::create([
                'id_plg' => $pelanggan->id_plg,
                'nama_plg' => $pelanggan->nama_plg,
                // Tambahkan semua kolom yang diperlukan
            ]);

            // Hapus dari tabel isolir
            $pelanggan->delete();
        }
    }
}

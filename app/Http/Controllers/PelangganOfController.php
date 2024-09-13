<?php

namespace App\Http\Controllers;

use App\Models\Netnet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Pelangganof;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PelangganOfController extends Controller
{

    public function home()
    {

        $pelangganof = Pelangganof::all();

        // Hitung total pendapatan bulanan
        $totalPendapatanBulanan = $pelangganof->sum('harga_paket');

        // Hitung total jumlah pengguna
        $totalJumlahPengguna = $pelangganof->count();

        // Kirim data ke view
        return view('index', compact('pelangganof', 'totalPendapatanBulanan', 'totalJumlahPengguna'));
    }


    public function detail($id)
    {
        $pelangganof = Pelangganof::findOrFail($id);
        return view('pelangganof.detail', compact('pelangganof'));
    }


    public function index(Request $request)
    {
        $query = Pelangganof::query();

        if ($request->has('search')) {
            $query->where('nama_plg', 'LIKE', '%' . $request->search . '%')
                ->orWhere('alamat_plg', 'LIKE', '%' . $request->search . '%')
                ->orWhere('no_telepon_plg', 'LIKE', '%' . $request->search . '%');
        }

        $pelangganof = $query->get();


        return view('pelangganof.index', compact('pelangganof'));
    }



    public function create()
    {
        return view('pelangganof.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_plg' => 'required',
            'nama_plg' => 'required',
            'alamat_plg' => 'required',
            'no_telepon_plg' => 'required',
            'paket_plg' => 'required',
            'odp' => 'required',
            'maps' => 'required',
        ]);

        $pelangganof = new Pelangganof();
        $pelangganof->id_plg = $request->id_plg;
        $pelangganof->nama_plg = $request->nama_plg;
        $pelangganof->alamat_plg = $request->alamat_plg;
        $pelangganof->no_telepon_plg = $request->no_telepon_plg;
        $pelangganof->aktivasi_plg = $request->aktivasi_plg;
        $pelangganof->paket_plg = $request->paket_plg;
        $pelangganof->harga_paket = $request->harga_paket;
        $pelangganof->tgl_tagih_plg = $request->tgl_tagih_plg;

        $pelangganof->keterangan_plg = $request->keterangan_plg;
        $pelangganof->odp = $request->odp;
        $pelangganof->maps = $request->maps;

        $pelangganof->save();

        return redirect()->route('pelangganof.index');
    }


    public function show(string $id) {}


    public function edit(string $id_plg)
    {
        $pelangganof = Pelangganof::findOrFail($id_plg);
        return view('pelangganof.edit', compact('pelangganof'));
    }


    public function update(Request $request, string $id_plg)
    {
        $pelangganof = Pelangganof::findOrFail($id_plg);
        $pelangganof->id_plg = $request->id_plg;
        $pelangganof->nama_plg = $request->nama_plg;
        $pelangganof->alamat_plg = $request->alamat_plg;
        $pelangganof->no_telepon_plg = $request->no_telepon_plg;
        $pelangganof->aktivasi_plg = $request->aktivasi_plg;
        $pelangganof->paket_plg = $request->paket_plg;
        $pelangganof->harga_paket = $request->harga_paket;
        $pelangganof->keterangan_plg = $request->keterangan_plg;
        $pelangganof->odp = $request->odp;

        $pelangganof->save();

        return redirect()->route('pelangganof.index');
    }


    public function destroy(string $id_plg)
    {
        $pelangganof = Pelangganof::findOrFail($id_plg);
        $pelangganof->delete();

        return redirect()->route('pelangganof.index');
    }

    public function showOff($id)
    {
        // Ambil data pelangganof dari tabel pelangganof
        $pelangganof = Pelangganof::find($id);

        if ($pelangganof) {
            // Masukkan data ke tabel plg_of
            DB::table('pelanggan')->insert([
                'id_plg' => $pelangganof->id_plg,
                'nama_plg' => $pelangganof->nama_plg,
                'alamat_plg' => $pelangganof->alamat_plg,
                'no_telepon_plg' => $pelangganof->no_telepon_plg,
                'paket_plg' => $pelangganof->paket_plg,
                'harga_paket' => $pelangganof->harga_paket,
                'odp' => $pelangganof->odp,
                'keterangan_plg' => $pelangganof->keterangan_plg,
                'longitude' => $pelangganof->longitude,
                'latitude' => $pelangganof->latitude,
                'aktivasi_plg' => $pelangganof->aktivasi_plg,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Hapus data dari tabel pelangganof
            $pelangganof->delete();

            // Redirect ke halaman pelangganof dengan pesan sukses
            return redirect()->route('pelangganof.index')->with('success', 'Pelangganof berhasil dipindahkan ke tabel pelangganof off.');
        } else {
            return redirect()->route('pelangganof.index')->with('error', 'Pelangganof tidak ditemukan.');
        }
    }

    public function aktifkan_pelanggan($id)
    {
        // Ambil data pelanggan dari tabel pelangganof
        $pelangganof = Pelangganof::find($id);

        if ($pelangganof) {
            try {
                // Pastikan tanggal tagih diubah ke format yang sesuai jika perlu
                $tglTagih = Carbon::createFromFormat('d/m/Y', $pelangganof->aktivasi_plg)->format('Y-m-d');

                // Masukkan data ke tabel pelanggan
                DB::table('pelanggan')->insert([
                    'id_plg' => $pelangganof->id_plg,
                    'nama_plg' => $pelangganof->nama_plg,
                    'alamat_plg' => $pelangganof->alamat_plg,
                    'no_telepon_plg' => $pelangganof->no_telepon_plg,
                    'aktivasi_plg' => $tglTagih,  // Pastikan format tanggal sesuai
                    'paket_plg' => $pelangganof->paket_plg,
                    'harga_paket' => $pelangganof->harga_paket,
                    'odp' => $pelangganof->odp,
                    'keterangan_plg' => $pelangganof->keterangan_plg,
                    'longitude' => $pelangganof->longitude,
                    'latitude' => $pelangganof->latitude,
                    'last_payment_date' => $pelangganof->last_payment_date,
                    'tgl_tagih_plg' => $tglTagih,  // Menambahkan kolom yang hilang
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Hapus data dari tabel pelangganof
                $pelangganof->delete();

                // Redirect ke halaman pelanggan dengan pesan sukses
                return redirect()->route('pelangganof.index')->with('success', 'Pelanggan berhasil dipindahkan ke tabel pelanggan.');
            } catch (\Exception $e) {
                // Log error dan kembalikan pesan error jika terjadi masalah
                Log::error('Error aktifkan_pelanggan: ' . $e->getMessage());
                return redirect()->route('pelangganof.index')->with('error', 'Terjadi kesalahan saat memindahkan pelanggan.');
            }
        } else {
            return redirect()->route('pelangganof.index')->with('error', 'Pelanggan tidak ditemukan.');
        }
    }
}

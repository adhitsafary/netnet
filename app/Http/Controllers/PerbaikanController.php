<?php

namespace App\Http\Controllers;

use App\Models\Netnet;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Export\PerbaikanExport;
use App\Models\Pelanggan;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()
    {
        return view('auth.login');
    }



    public function index(Request $request)
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



    public function exportPdf(Request $request)
    {
        $query = Perbaikan::query();

        // Tambahkan filter jika perlu

        $perbaikan = $query->get();

        $pdf = Pdf::loadView('perbaikan.pdf', compact('perbaikan'));

        return $pdf->download('perbaikan.pdf');
    }

    /* public function exportExcel(Request $request)
    {
        return Excel::download(new PerbaikanExport($request), 'perbaikan.xlsx');
    } */


    public function create()
    {
        return view('perbaikan.create');
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
            'keterangan' => 'required',
        ]);

        // Pilih tim teknisi secara acak
        $teknisiTim = rand(1, 3); // Menghasilkan angka antara 1 hingga 3

        $perbaikan = new Perbaikan();
        $perbaikan->id_plg = $request->id_plg;
        $perbaikan->nama_plg = $request->nama_plg;
        $perbaikan->alamat_plg = $request->alamat_plg;
        $perbaikan->no_telepon_plg = $request->no_telepon_plg;
        $perbaikan->paket_plg = $request->paket_plg;
        $perbaikan->odp = $request->odp ?? null; // Menangani jika tidak diisi
        $perbaikan->maps = $request->maps ?? null; // Menangani jika tidak diisi
        $perbaikan->keterangan = $request->keterangan;
        $perbaikan->teknisi = $teknisiTim; // Menyimpan tim teknisi yang dipilih secara acak
        $perbaikan->save();

        return redirect()->route('perbaikan.index')->with('success', 'Data perbaikan berhasil ditambahkan');
    }





    public function getPelanggan($input)
    {
        // Coba cari pelanggan berdasarkan ID atau Nama Pelanggan
        $pelanggan = Pelanggan::where('id_plg', $input)
            ->orWhere('nama_plg', 'LIKE', '%' . $input . '%')
            ->first();

        if ($pelanggan) {
            return response()->json([
                'id_plg' => $pelanggan->id_plg,
                'nama_plg' => $pelanggan->nama_plg,
                'alamat_plg' => $pelanggan->alamat_plg,
                'no_telepon_plg' => $pelanggan->no_telepon_plg,
                'paket_plg' => $pelanggan->paket_plg,
                'odp' => $pelanggan->odp,
                'maps' => $pelanggan->maps
            ]);
        } else {
            return response()->json(null);
        }
    }

    public function searchPelanggan(Request $request)
    {
        $search = $request->input('search');

        $pelanggan = Pelanggan::where('nama_plg', 'like', '%' . $search . '%')
            ->get(['id_plg', 'nama_plg']); // Pilih kolom yang diperlukan untuk select2

        $results = [];

        foreach ($pelanggan as $p) {
            $results[] = [
                'id' => $p->id_plg,  // Ini yang akan menjadi value dari option
                'text' => $p->nama_plg  // Ini yang akan tampil di dropdown
            ];
        }

        return response()->json($results);
    }





    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('perbaikan.edit', compact('perbaikan'));
    }


    public function update(Request $request, string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->id_plg = $request->id_plg;
        $perbaikan->nama_plg = $request->nama_plg;
        $perbaikan->alamat_plg = $request->alamat_plg;
        $perbaikan->no_telepon_plg = $request->no_telepon_plg;
        $perbaikan->paket_plg = $request->paket_plg;
        $perbaikan->odp = $request->odp;
        $perbaikan->maps = $request->maps;
        $perbaikan->teknisi = $request->teknisi; // Biarkan user memilih teknisi saat update
        $perbaikan->keterangan = $request->keterangan;
        $perbaikan->update();

        return redirect()->route('perbaikan.index');
    }



    public function destroy(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->delete();

        return redirect()->route('perbaikan.index');
    }



    public function teknisi(Request $request)
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

        return view('perbaikan.teknisi', compact('perbaikan', 'sort', 'weeklyData', 'monthlyData', 'yearlyData'));
    }


    function home2()
    {
        return view('home2');
    }

    public function rekapTeknisi()
    {
        $today = Carbon::now();
        $startDate = $today->copy()->startOfMonth();
        $endDate = $today->copy()->endOfMonth();

        $rekap = Perbaikan::selectRaw('teknisi, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('teknisi')
            ->get();

        // Reset rekap pada tanggal 25
        if ($today->day == 25) {
            // Hapus atau reset data rekap jika perlu
            // Misalnya dengan menambahkan kode reset di sini
        }

        return view('perbaikan.rekap_teknisi', compact('rekap'));
    }

    // Menambahkan schedule untuk reset data setiap tanggal 25
    public function resetTeknisiData()
    {
        $today = Carbon::now();

        if ($today->day == 25) {
            // Reset data teknisi
            // Misalnya menghapus atau mereset data tertentu jika diperlukan
            // Bisa menggunakan query builder atau model untuk mereset data
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use App\Models\KasbonModel;
use App\Models\Netnet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\RekapPemasanganModel;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RekapPemasanganController extends Controller
{

    public function home()
    {

        $rekap_pemasangan = RekapPemasanganModel::all();

        // Kirim data ke view
        return view('rekap_pemasangan.index', compact('rekap_pemasangan'));
    }


    public function detail($id)
    {
        $rekap_pemasangan = RekapPemasanganModel::findOrFail($id);
        return view('rekap_pemasangan.detail', compact('rekap_pemasangan'));
    }


    public function index(Request $request)
    {
        $query = RekapPemasanganModel::query();

        if ($request->has('search')) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%')
                ->orWhere('alamat', 'LIKE', '%' . $request->search . '%')
                ->orWhere('marketing', 'LIKE', '%' . $request->search . '%');
        }

        $rekap_pemasangan = $query->get();


        return view('rekap_pemasangan.index', compact('rekap_pemasangan'));
    }

    public function create()
    {


        return view('rekap_pemasangan.create');
    }



    public function store(Request $request)
    {

        $rekap_pemasangan = new RekapPemasanganModel();

        // Isi data rekap_pemasangan
        $rekap_pemasangan->nik = $request->nik; // Nama dari form input
        $rekap_pemasangan->nama = $request->nama;
        $rekap_pemasangan->alamat = $request->alamat;
        $rekap_pemasangan->no_telpon = $request->no_telpon; // Nama dari form input
        $rekap_pemasangan->tgl_aktivasi = $request->tgl_aktivasi;
        $rekap_pemasangan->paket_plg = $request->paket_plg;
        $rekap_pemasangan->nominal = $request->nominal; // Nama dari form input
        $rekap_pemasangan->jt = $request->jt;
        $rekap_pemasangan->status = $request->status;
        $rekap_pemasangan->tgl_pengajuan = $request->tgl_pengajuan; // Nama dari form input
        $rekap_pemasangan->registrasi = $request->registrasi;
        $rekap_pemasangan->marketing = $request->marketing;


        // Simpan data rekap_pemasangan ke database
        $rekap_pemasangan->save();

        // Redirect ke halaman rekap_pemasangan index setelah penyimpanan berhasil
        return redirect()->route('rekap_pemasangan.index')->with('success', 'Data rekap_pemasangan berhasil disimpan.');
    }



    public function show(string $id) {}


    public function edit(string $id_plg)
    {
        $rekap_pemasangan = RekapPemasanganModel::findOrFail($id_plg);
        return view('rekap_pemasangan.edit', compact('rekap_pemasangan'));
    }


    public function update(Request $request, string $id_plg)
    {
        $rekap_pemasangan = RekapPemasanganModel::findOrFail($id_plg);

        $rekap_pemasangan->nik = $request->nik; // Nama dari form input
        $rekap_pemasangan->nama = $request->nama;
        $rekap_pemasangan->alamat = $request->alamat;
        $rekap_pemasangan->no_telpon = $request->no_telpon; // Nama dari form input
        $rekap_pemasangan->tgl_aktivasi = $request->tgl_aktivasi;
        $rekap_pemasangan->paket_plg = $request->paket_plg;
        $rekap_pemasangan->nominal = $request->nominal; // Nama dari form input
        $rekap_pemasangan->jt = $request->jt;
        $rekap_pemasangan->status = $request->status;
        $rekap_pemasangan->tgl_pengajuan = $request->tgl_pengajuan; // Nama dari form input
        $rekap_pemasangan->registrasi = $request->registrasi;
        $rekap_pemasangan->marketing = $request->marketing;


        $rekap_pemasangan->save();

        return redirect()->route('rekap_pemasangan.index');
    }


    public function destroy(string $id_plg)
    {
        $rekap_pemasangan = RekapPemasanganModel::findOrFail($id_plg);
        $rekap_pemasangan->delete();

        return redirect()->route('rekap_pemasangan.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Absensi;
use App\Models\Karyawan;


class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status_hadir' => 'required|in:hadir,tidak hadir',
        ]);
    
        Absensi::create($request->all());
    
        return response()->json(['message' => 'Absensi berhasil ditambahkan']);
    }

    public function hitungGaji($user_id)
    {
        $user = User::findOrFail($user_id); // Ambil data user
        $nama_user = $user->name; // Ambil nama dari tabel user
    
        $total_absensi = Absensi::where('user_id', $user_id)->count();
        $tidak_hadir = Absensi::where('user_id', $user_id)->where('status_hadir', 'tidak hadir')->count();
    
        // Misalnya pengurangan gaji per hari absen
        $potongan_per_hari = 50000; // Sesuaikan
        $gaji_bersih = $user->karyawan->gaji - ($tidak_hadir * $potongan_per_hari); // Ambil gaji dari relasi Karyawan
    
        return response()->json([
            'karyawan' => $nama_user, // Menggunakan nama dari tabel user
            'total_hadir' => $total_absensi - $tidak_hadir,
            'total_tidak_hadir' => $tidak_hadir,
            'gaji_bersih' => $gaji_bersih,
        ]);
    }
    

    public function showAbsensiForm()
    {
        $users = User::with('karyawan')->get();
        return view('absensi.index', compact('users'));
    }


    public function showGajiForm(Request $request)
    {
        $users = User::with('karyawan')->get();
        $gaji = null;

        if ($request->has('user_id')) {
            $karyawan = Karyawan::where('id', $request->user_id)->firstOrFail();
            $tidak_hadir = Absensi::where('user_id', $request->user_id)->where('status_hadir', 'tidak hadir')->count();
            $potongan_per_hari = 50000; // Sesuaikan
            $gaji = [
                'karyawan' => $karyawan->nama,
                'total_hadir' => Absensi::where('user_id', $request->user_id)->count() - $tidak_hadir,
                'total_tidak_hadir' => $tidak_hadir,
                'gaji_bersih' => $karyawan->gaji - ($tidak_hadir * $potongan_per_hari),
            ];
        }

        return view('gaji', compact('users', 'gaji'));
    }

}

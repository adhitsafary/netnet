<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AutomatisPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q'); // Input dari pencarian

        // Jika tidak ada input pencarian, kembalikan koleksi kosong
        $pelanggan = collect();

        // Jika ada input pencarian, lakukan query ke database
        if ($query) {
            $pelanggan = Pelanggan::with('pembayaran')
                ->where('id_plg', $query)
                ->orWhere('nama_plg', 'LIKE', "%$query%")
                ->paginate(10);
        }

        return view('automatispayment.index', compact('pelanggan', 'query'));
    }
}

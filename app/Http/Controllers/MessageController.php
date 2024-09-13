<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function create()
    {
        $pelanggan = Pelanggan::all(['id_plg', 'nama_plg', 'no_telepon_plg']);
        return view('whatsapp.send-message', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'target' => 'required|array'
        ]);

        $token = "PTcL7Rhv+Bc6fSBnb55U"; 
        $targets = implode(',', $request->input('target'));
        $message = $request->input('message');

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asForm()->post('https://api.fonnte.com/send', [+
                'target' => $targets,
                'message' => $message,
                'delay' => '5',
            ]);

            // Debugging response
            if ($response->successful()) {
                return back()->with('status', 'Pesan berhasil dikirim!');
            } else {
                return back()->withErrors('Gagal mengirim pesan: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Handle exception and provide error message
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

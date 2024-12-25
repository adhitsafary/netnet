<?php

namespace App\Http\Controllers;

use App\Models\BayarPelanggan;
use Illuminate\Http\Request;
use GuzzleHttp\Client;



class NotificationController extends Controller
{
    private function sendTelegramNotification($message)
    {
        $token = '7085351448:AAErPRbIkJJOwkDTIMFUlwNU3AN_UQ1cRkY'; // Bot token
        $chat_id = '5985430823'; // Chat ID penerima

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $client = new Client();

        try {
            $client->post($url, [
                'form_params' => [
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'parse_mode' => 'Markdown', // Untuk format Markdown
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error("Telegram Notification Error: " . $e->getMessage());
        }
    }

    // Fungsi untuk mengambil data terbaru dan mengirim notifikasi
    public function notifyLatestPayment()
    {
        // Ambil pembayaran terbaru dari tabel 'bayar_pelanggan'
        $latestPayment = BayarPelanggan::latest()->first();

        if ($latestPayment) {
            // Format pesan
            $message = "💰 *Notifikasi Pembayaran Baru*\n\n" .
                "👤 *Nama Pelanggan:* {$latestPayment->nama_plg}\n" .
                "💵 *Jumlah Pembayaran:* Rp " . number_format($latestPayment->jumlah_pembayaran, 0, ',', '.') . "\n" .
                "📅 *Tanggal Pembayaran:* {$latestPayment->tanggal_pembayaran}\n" .
                "💳 *Metode Transaksi:* {$latestPayment->metode_transaksi}\n" .
                "📝 *Untuk Pembayaran:* {$latestPayment->untuk_pembayaran}";

            // Kirim notifikasi ke Telegram
            $this->sendTelegramNotification($message);

            return response()->json(['success' => 'Notifikasi berhasil dikirim!']);
        }

        return response()->json(['error' => 'Tidak ada data pembayaran ditemukan.']);
    }

    // Fungsi untuk menyimpan data pembayaran baru dan mengirim notifikasi
    public function storePayment(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_plg' => 'required|string|max:255',
            'jumlah_pembayaran' => 'required|numeric',
            'tanggal_pembayaran' => 'required|date',
            'metode_transaksi' => 'required|string|max:255',
            'untuk_pembayaran' => 'required|string|max:255',
        ]);

        // Simpan data pembayaran baru
        $payment = BayarPelanggan::create($request->all());

        // Kirim notifikasi ke Telegram
        $this->notifyLatestPayment();

        return redirect()->back()->with('success', 'Pembayaran berhasil ditambahkan dan notifikasi dikirim!');
    }
}

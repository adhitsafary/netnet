<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayarPelanggan extends Model
{
    use HasFactory;

    protected $table = 'bayar_pelanggan';

    protected $fillable = [
        'pelanggan_id',
        'nama_plg',
        'alamat_plg',
        'tgl_tagih_plg',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}

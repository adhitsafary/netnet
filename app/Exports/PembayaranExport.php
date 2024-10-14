namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromArray, WithHeadings
{
protected $pembayaran;

public function __construct($pembayaran)
{
$this->pembayaran = $pembayaran;
}

public function array(): array
{
// Map data pembayaran untuk ditampilkan dalam array Excel
return $this->pembayaran->map(function ($item, $key) {
return [
$key + 1,
$item->nama_plg,
$item->alamat_plg,
$item->created_at->format('d-m-Y'),
number_format($item->jumlah_pembayaran, 0, ',', '.')
];
})->toArray();
}

public function headings(): array
{
return [
'No',
'Nama Pelanggan',
'Alamat',
'Tanggal Pembayaran',
'Jumlah Pembayaran'
];
}
}

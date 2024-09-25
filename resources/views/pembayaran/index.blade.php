@extends('layout')

@section('konten')
    <div class=" p-5 mt-4">
        <div class="row mb-4">
            <div class="col-md-9">
                <form action="{{ route('pembayaran.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Pencarian">
                        <input type="date" name="date_start" id="date_start" class="form-control ml-2"
                            value="{{ request('date_start') }}" placeholder="Tanggal Mulai">
                        <input type="date" name="date_end" id="date_end" class="form-control ml-2"
                            value="{{ request('date_end') }}" placeholder="Tanggal Akhir">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 text-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Ekspor
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('pembayaran.export', ['format' => 'pdf', 'date_start' => request('date_start'), 'date_end' => request('date_end')]) }}"
                            class="dropdown-item">PDF</a>
                        <a href="{{ route('pembayaran.export', ['format' => 'excel', 'date_start' => request('date_start'), 'date_end' => request('date_end')]) }}"
                            class="dropdown-item">Excel</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pembayaran -->
        <table class="table table-bordered">
            <thead class="table table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Hapus</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ $item->metode_transaksi }}</td>
                        <td>{{ $item->keterangan_plg }}</td>
                        <td>
                            <form action="{{ route('pembayaran.destroy', $item->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm"
                                onclick="printPayment({{ $no + 1 }}, '{{ $item->nama_plg }}')">Print</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pembayaran ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function printPayment(rowNumber, namaPelanggan) {
            var row = document.querySelectorAll('table tbody tr')[rowNumber - 1];
            var nama = row.cells[1].innerText;
            var alamat = row.cells[2].innerText;
            var tglBayar = row.cells[3].innerText;
            var jumlahBayar = row.cells[4].innerText;

            var printContent = `
        <div style="border: 1px solid #000; padding: 20px; width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
            <div style="border-bottom: 2px solid #000; text-align: center; padding-bottom: 10px; margin-bottom: 10px;">
                <h2 style="font-size: 16px; margin: 0;">KWITANSI PEMBAYARAN INTERNET BULANAN</h2>
            </div>
            <p><strong>Nama Pelanggan:</strong> ${nama}</p>
            <p><strong>Alamat:</strong> ${alamat}</p>
            <p><strong>Tanggal Pembayaran:</strong> ${tglBayar}</p>
            <p><strong>Jumlah Pembayaran:</strong> Rp ${jumlahBayar}</p>
        </div>
        `;

            var printWindow = window.open('', '', 'height=600,width=400');
            printWindow.document.write('<html><head><title>Struk Pembayaran</title></head><body>');
            printWindow.document.write(printContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endsection

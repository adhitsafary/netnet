@extends('layout')

@section('konten')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-9">
                <form action="{{ route('pembayaran.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Pencarian">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 text-right">
                <a href="" class="btn btn-primary btn-sm" >Data Pembayaran</a>
            </div>
        </div>

        <!-- Tabel Pembayaran -->
        <table class="table table-striped">
            <thead class="table table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Tanggal Tagih</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $no => $item)
                    <tr>
                        <td>{{ $no +1 }}</td> <!-- ID pelanggan dari tabel pelanggan -->
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="printPayment({{ $no + 1 }}, '{{ $item->nama_plg }}')">Print</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pembayaran ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

      <!-- QRCode.js -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

      <script>
          function printPayment(rowNumber, namaPelanggan) {
              // Ambil data dari baris yang sesuai
              var row = document.querySelectorAll('table tbody tr')[rowNumber - 1];
              var nama = row.cells[1].innerText;
              var alamat = row.cells[2].innerText;
              var tglTagih = row.cells[3].innerText;
              var tglBayar = row.cells[4].innerText;
              var jumlahBayar = row.cells[5].innerText;

              // Format teks untuk dicetak menyerupai struk pembayaran dengan border dan tata letak di tengah
              var printContent = `
                  <div style="border: 1px solid #000; padding: 20px; width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
                      <!-- Bagian Header -->
                      <div style="border-bottom: 2px solid #000; text-align: center; padding-bottom: 10px; margin-bottom: 10px;">
                          <h2 style="font-size: 16px; margin: 0;">KWITANSI PEMBAYARAN INTERNET BULANAN</h2>
                      </div>

                      <!-- Bagian untuk logo dan teks "NetNet Digital" -->
                      <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                          <!-- Logo di sebelah kiri -->
                          <img src="{{ asset('asset/img/netnet.jpg') }}" height="50" width="50">

                          <!-- Teks "NetNet Digital" di tengah -->
                          <h2 style="font-size: 18px; margin: 0; text-align: center;">NetNet Digital</h2>

                          <!-- Logo di sebelah kanan -->
                          <img src="{{ asset('asset/img/logo_hayat.png') }}" height="50" width="100">
                      </div>

                      <!-- Informasi pelanggan -->
                      <p><strong>Nama Pelanggan:</strong> ${nama}</p>
                      <p><strong>Alamat:</strong> ${alamat}</p>
                      <p><strong>Tanggal Tagih:</strong> ${tglTagih}</p>

                      <p><strong>Tanggal Pembayaran:</strong> ${tglBayar}</p>
                      <p><strong>Jumlah Pembayaran:</strong> Rp ${jumlahBayar}</p>

                      <!-- QR Code -->
                      <div class="text-center" id="qrcode" style="text-align: center; margin: 20px 0;"></div>

                      <!-- Ucapan terima kasih -->
                      <div style="text-align: center; font-size: 12px;">
                          <p>Terima kasih telah melakukan pembayaran</p>
                          <p>--- NetNet Digital ---</p>
                      </div>
                  </div>
              `;

              // Membuat jendela baru untuk mencetak
              var printWindow = window.open('', '', 'height=600,width=400');
              printWindow.document.write('<html><head><title>Struk Pembayaran</title>');
              printWindow.document.write('<style>body { font-family: Arial, sans-serif; }</style>');
              printWindow.document.write('</head><body>');
              printWindow.document.write(printContent);
              printWindow.document.write('</body></html>');
              printWindow.document.close();

              // Tunggu sampai jendela selesai memuat
              printWindow.onload = function() {
                  // Generate QR Code menggunakan nama pelanggan
                  var qrCodeElement = printWindow.document.getElementById('qrcode');
                  new QRCode(qrCodeElement, {
                      text: namaPelanggan,
                      width: 100,
                      height: 100
                  });

                  // Panggil print setelah QR Code dibuat
                  printWindow.print();
              }
          }
      </script>
@endsection

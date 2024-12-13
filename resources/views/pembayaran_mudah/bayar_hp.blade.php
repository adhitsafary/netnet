@extends($layout)

@section('konten')
<div class="container">
    <h4 class="mb-4 text-center">Bayar Tagihan Pelanggan</h4>

    <!-- Informasi Total -->
    <div class="row g-3">
        <div class="col-6 col-md-3 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body text-center font-weight-bold">
                <p class="card-title">Total Pembayaran : <br> Rp {{ number_format($total_user_bayar, 0, ',', '.') }}</p>
                 
                    <p > User: {{ $total_jml_user }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-dark bg-warning">
                <div class="card-body font-weight-bold">
                    <p class="card-title">Tagihan Hari Ini</p>
                    <a href="{{ route('pelanggan.redirect') }}" class="card-text"> Rp {{ number_format($totalTagihanHariIni, 0, ',', '.') }} </a>
                    <p>User: {{ $jumlahPelangganMembayarHariIni }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body font-weight-bold">
                    <p class="card-title">Tertagih</p>
                    <a href="{{ route('pelanggan.sudahbayar') }}" class="card-text">{{ number_format($totalPendapatanharian_semua, 0, ',', '.') }}</a>
                    <p> User: {{ $totalUserHarian_semua }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body font-weight-bold">
                    <p class="card-title">Sisa Tagihan</p>
                    <a href="{{ route('pelanggan.belumbayar') }}" class="card-text">Rp
                    {{ number_format($totalTagihanTertagih, 0, ',', '.') }} </a>
                    <p>User: {{ $totalUserTertagih }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('pembayaran_mudah.bayar_hp') }}" method="GET" class="mt-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari berdasarkan ID atau Nama" value="{{ $query ?? '' }}">
           
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
     @endif


    <!-- Tabel Pembayaran -->
    <div class="mt-4">
            @if (!$query_cari)
                <p class="text-muted">Silakan masukkan ID atau Nama untuk mencari data pelanggan.</p>

                    <div>
                <!-- Tabel Pembayaran -->
        <table class="table table-bordered table-responsive" style="color: black;">
            <thead class="table table-primary " style="color: black;">
                <tr>
                    <th style="width: 1%; padding: 1px;">No</th>
                    <th style="width: 1%; padding: 1px;">Nama Pelanggan</th>
                    <th style="width: 1%; padding: 1px;">Alamat</th>
                    <th style="width: 1%; padding: 1px;">Tanggal Tagih </th>
                    <th style="width: 1%; padding: 1px;">Harga</th>
                    <th style="width: 1%; padding: 1px;">Metode Pembayaran</th>
                    <th style="width: 1%; padding: 1px;">Tanggal Pembayaran</th>
                    <th style="width: 1%; padding: 1px;">Keterangan</th>
                    <th style="width: 1%; padding: 1px;">Admin</th>
                    <th style="width: 1%; padding: 1px;">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $no => $item)
                    <tr class="">
                        <td  style="padding: 1px;">{{ ($pembayaran->currentPage() - 1) * $pembayaran->perPage() + $loop->iteration }}</td>
                        <td  style="padding: 1px;">{{ $item->nama_plg }}</td>
                        <td  style="padding: 1px;">{{ $item->alamat_plg }}</td>
                        <td  style="padding: 1px;">{{ $item->tgl_tagih_plg }}</td>
                        <td  style="padding: 1px;">{{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td  style="padding: 1px;">{{ $item->metode_transaksi }}</td>
                        <td  style="padding: 1px;">{{ $item->created_at }}</td>
                        <td  style="padding: 1px;">{{ $item->untuk_pembayaran }}</td>
                        <td  style="padding: 1px;">{{ $item->admin_name }}</td>
                        <td  style="padding: 1px;">
                            <form action="{{ route('pembayaran.destroy', $item->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
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
         <div>
            @elseif($pelanggan->isEmpty())
                <p class="text-muted">Tidak ditemukan hasil untuk "{{ $query_cari }}"</p>
            @else

            <div class="row">
    @foreach ($pelanggan as $no => $item)
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pelanggan {{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $loop->iteration }}</h5>
                <p class="card-text">
                    <strong>ID Pelanggan:</strong> {{ $item->id_plg }}<br>
                    <strong>Nama:</strong> {{ $item->nama_plg }}<br>
                    <strong>Alamat:</strong> {{ $item->alamat_plg }}<br>
                    <strong>Harga:</strong> Rp {{ number_format($item->harga_paket, 0, ',', '.') }}<br>
                    <strong>Tanggal Tagih:</strong> {{ $item->tgl_tagih_plg }}<br>
                    <strong>Status Pembayaran:</strong> 
                    {{ optional($item->pembayaranTerakhir)->tanggal_pembayaran 
                        ? \Carbon\Carbon::parse($item->pembayaranTerakhir->tanggal_pembayaran)->locale('id')->isoFormat('MMMM Y') 
                        : '-' }}
                </p>
                <td style="padding: 1px;">
                <a href="#" class="btn btn-success btn-sm"
                    onclick="showBayarModal({{ $item->id }}, '{{ $item->nama_plg }}', {{ $item->harga_paket }})">Bayar</a>
            </td>


                              <!-- Modal Bayar -->
                            <div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="bayarModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="bayarModalLabel">Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Form -->
                                        <form id="bayarForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" id="pelangganId">
                                            <div class="modal-body">
                                                <!-- Input Tanggal Pembayaran -->

                                                <div class="mb-3">
                                                    <label for="tanggal_pembayaran" class="form-label">Untuk Pembayaran
                                                    <label for="tanggal_pembayaran" class="form-label">Untuk Pembayaran
                                                        Bulan</label>
                                                    <input type="month" class="form-select" id="tanggal_pembayaran"
                                                        name="tanggal_pembayaran" placeholder="Pilih bulan">
                                                </div>



                                                <div class="mb-3">
                                                    <label for="metodeTransaksi" class="form-label">Metode
                                                        Transaksi</label>
                                                    <select class="form-select" id="metodeTransaksi"
                                                        name="metode_transaksi" required>
                                                        <option value="">Pilih metode</option>
                                                        <option value="TF">TF</option>
                                                        <option value="CASH">KANTOR</option>

                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="untuk_pembayaran" class="form-label">Status
                                                        Pembayaran</label>
                                                    <select class="form-select" id="untuk_pembayaran"
                                                        name="untuk_pembayaran" required>
                                                        <option value="">Pilih Pembayaran</option>
                                                        <option value="tagihan">Tagihan </option>
                                                        <option value="piutang">Piutang </option>
                                                        <option value="PSB">PSB </option>

                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="keterangan_plg" class="form-label">Keterangan
                                                        Pembayaran Pelanggan</label>
                                                    <input type="text" class="form-control" id="keterangan_plg"
                                                        name="keterangan_plg">
                                                </div>

                                                <!-- Detail Pembayaran -->
                                                <div class="mb-3">
                                                    <p id="pembayaranDetails"></p>
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Bayar</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                     </div>
              </div>
         </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>


@endsection

  <script>
        function showBayarModal(id, namaPlg, hargaPaket) {
            document.getElementById('pelangganId').value = id;
            document.getElementById('pembayaranDetails').innerText =
                `Nama Pelanggan: ${namaPlg}\nHarga Paket: Rp. ${hargaPaket}`;

            var form = document.getElementById('bayarForm');
            form.action = `/pelanggan/${id}/bayar2`; // Set action URL with the ID

            var bayarModal = new bootstrap.Modal(document.getElementById('bayarModal'));
            bayarModal.show();
        }
    </script>


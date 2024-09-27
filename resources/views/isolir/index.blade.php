@extends('layout')

@section('konten')
    <div class="p-5 mb-4">
        <!-- Form Filter dan Pencarian -->
        <div class="row mb-2 align-items-center">
            <div class="col-md-3">
                <!-- Form Pencarian -->
                <form action="{{ route('isolir.index') }}" method="GET" class="form-inline">
                    <!-- Input Pencarian -->
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Pencarian">
                    </div>
                    <!-- Tombol Cari -->
                    <button type="submit" name="action" value="search" class="btn btn-primary ml-2">Cari</button>
                </form>
            </div>

            <div class="col-md-6 text-center">
                <!-- Teks Data isolir -->
                <div class="btn btn-primary btn-lg mt-2"
                    style="cursor: default; background: linear-gradient(45deg, #007bff, #00b4db); color: #ffffff;">
                    Data isolir
                </div>
            </div>


        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Aktivasi</th>
                    <th>Paket</th>
                    <th>Harga Paket</th>
                    <th>Tanggal Tagih</th>
                    <th>Keterangan</th>
                    <th>Status orang</th>
                    <th>ODP</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Tanggal Isolir</th>
                    <th>Status Pembayaran</th>
                    <th>Bayar / Aktivkan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($isolir as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->id_plg }}</td>
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->no_telepon_plg }}</td>
                        <td>{{ $item->aktivasi_plg }}</td>
                        <td>{{ $item->paket_plg }}</td>
                        <td>{{ $item->harga_paket }}</td>
                        <td>{{ $item->tgl_tagih_plg }}</td>
                        <td>{{ $item->keterangan_plg }}</td>
                        <td>{{ $item->keterangan_plg }}</td>
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->longitude }}</td>
                        <td>{{ $item->latitude }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if ($item->status_pembayaran === 'Sudah Bayar')
                                <span class="badge badge-success p-3">Sudah Bayar</span>
                            @else
                                <span class="badge badge-danger p-3">Belum Bayar</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('pelanggan.reactivate', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Aktifkan Kembali</button>
                            </form>
                        </td>

                        <td>
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
                                                <label for="tanggalPembayaran" class="form-label">Tanggal
                                                    Pembayaran</label>
                                                <input type="date" class="form-control" id="tanggalPembayaran"
                                                    name="tanggal_pembayaran" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="metodeTransaksi" class="form-label">Metode
                                                    Transaksi</label>
                                                <select class="form-select" id="metodeTransaksi" name="metode_transaksi"
                                                    required>
                                                    <option value="">Pilih metode</option>
                                                    <option value="CASH">Cash</option>
                                                    <option value="TF">Transfer</option>
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

                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endsection

    <script>
        function showBayarModal(id, namaPlg, hargaPaket) {
            document.getElementById('pelangganId').value = id;
            document.getElementById('pembayaranDetails').innerText =
                `Nama Pelanggan: ${namaPlg}\nHarga Paket: Rp. ${hargaPaket}`;

            var form = document.getElementById('bayarForm');
            form.action = `/isolir/${id}/bayar`; // Set action URL with the ID

            var bayarModal = new bootstrap.Modal(document.getElementById('bayarModal'));
            bayarModal.show();
        }
    </script>

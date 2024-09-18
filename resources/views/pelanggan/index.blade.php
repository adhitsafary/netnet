@extends('layout')

@section('konten')
    <div class="mb-4">
        <!-- Form Filter dan Pencarian -->
        <div class="row mb-2 align-items-center">
            <div class="col-md-3">
                <!-- Form Pencarian -->
                <form action="{{ route('pelanggan.index') }}" method="GET" class="form-inline">
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
                <!-- Teks Data Pelanggan -->
                <div class="btn btn-primary btn-lg mt-2"
                    style="cursor: default; background: linear-gradient(45deg, #007bff, #00b4db); color: #ffffff;">
                    Data Pelanggan
                </div>
            </div>

            <div class="col-md-3 text-right">
                <!-- Form Filter -->
                <form action="{{ route('pelanggan.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                            <option value="">Semua</option>
                            <option value="belum_bayar" {{ $status_pembayaran_display == 'belum_bayar' ? 'selected' : '' }}>
                                Belum Bayar</option>
                            <option value="sudah_bayar" {{ $status_pembayaran_display == 'sudah_bayar' ? 'selected' : '' }}>
                                Sudah Bayar</option>
                        </select>
                    </div>
                    <!-- Tombol Filter -->
                    <button type="submit" name="action" value="filter" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>
        </div>

        <div class="">
            <table class="table table-bordered ">
                <thead class="table table-primary">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>
                            <a
                                href="{{ route('pelanggan.index', [
                                    'sort_by' => 'nama_plg',
                                    'sort_direction' => $sortBy == 'nama_plg' && $sortDirection == 'asc' ? 'desc' : 'asc',
                                ]) }}">
                                Nama
                                @if ($sortBy == 'nama_plg')
                                    @if ($sortDirection == 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>`
                        </th>


                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>Aktivasi</th>
                        <th>Paket</th>
                        <th>Harga Paket</th>
                        <th>Tanggal Tagih</th>
                        <th>ODP</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Keterangan</th>
                        <th>Status Pembayaran</th>
                        <th>Detail</th>
                        <th>Riwayat pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggan as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->id_plg }}</td>
                            <td>{{ $item->nama_plg }}</td>
                            <td>{{ $item->alamat_plg }}</td>
                            <td>{{ $item->no_telepon_plg }}</td>
                            <td>{{ $item->aktivasi_plg }}</td>
                            <td>{{ $item->paket_plg }}</td>
                            <td>{{ number_format($item->harga_paket, 0, ',', '.') }}</td>
                            <td>{{ $item->tgl_tagih_plg }}</td>

                            <td>{{ $item->odp }}</td>

                            <td>{{ $item->longitude }}</td>
                            <td>{{ $item->latitude }}</td>

                            <td>{{ $item->keterangan_plg }}</td>
                            <td>{{ $item->status_pembayaran }}</td>
                            <td>
                                <a href="{{ route('pelanggan.detail', $item->id) }}"
                                    class="btn btn-warning btn-sm">Detail</a>
                            </td>
                            <!-- Tombol Bayar -->
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
                                                    <label for="metodeTransaksi" class="form-label">Metode Transaksi</label>
                                                    <select class="form-select" id="metodeTransaksi" name="metode_transaksi"
                                                        required>
                                                        <option value="">Pilih metode</option>
                                                        <option value="Cash Kantor">Cash Kantor</option>
                                                        <option value="Cash Pickup">Cash Pickup</option>
                                                        <option value="Transfer Bca">Transfer Via BCA</option>
                                                        <option value="Transfer Dana">Transfer Via Dana</option>
                                                    </select>
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
                            <td colspan="19" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    @endsection
    <script>
        function showBayarModal(id, namaPlg, hargaPaket) {
            document.getElementById('pelangganId').value = id;
            document.getElementById('pembayaranDetails').innerText =
                `Nama Pelanggan: ${namaPlg}\nHarga Paket: Rp. ${hargaPaket}`;

            var form = document.getElementById('bayarForm');
            form.action = `/pelanggan/${id}/bayar`; // Set action URL with the ID

            var bayarModal = new bootstrap.Modal(document.getElementById('bayarModal'));
            bayarModal.show();
        }
    </script>

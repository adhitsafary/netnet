@extends('layout')

@section('konten')
    <div class="  pl-5 pr-5 mb-4">
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
                <div class="btn btn-primary btn-lg mt-2" data-toggle="modal" data-target="#filterModal"
                    style="cursor: default; background: linear-gradient(45deg, #007bff, #00b4db); color: #ffffff;">
                    Data Isolir
                </div>
                <!-- Modal -->
                <!-- Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filter Isolir</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="filterForm" method="GET" action="{{ route('isolir.filterTagihindex') }}">
                                    <div class="form-group">
                                        <label for="paket_plg">Paket</label>
                                        <select name="paket_plg" id="paket_plg">
                                            <option value="">Pilih Paket</option>
                                            @for ($i = 1; $i <= 7; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('paket_plg') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                            <option value="vcr" {{ request('paket_plg') == 'vcr' ? 'selected' : '' }}>
                                                vcr
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_tagih_plg">Tanggal Tagih</label>
                                        <select name="tgl_tagih_plg" id="tgl_tagih_plg">
                                            <option value="">Pilih Tanggal Tagih</option>
                                            @for ($i = 1; $i <= 32; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('tgl_tagih_plg') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="document.querySelector('.filterForm').submit();">Terapkan Filter</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        <div class="">
            <table class="table table-bordered " style="color: black;">
                <thead class="table table-primary " style="color: black;">
                    <tr>
                        <th class="">No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>Aktivasi</th>
                        <th>
                            <form class="filterForm" method="GET" action="{{ route('isolir.filterTagihindex') }}">
                                <div class="form-group">
                                    <select name="paket_plg" id="paket_plg" onchange="this.form.submit();">
                                        <option value="">Paket</option>
                                        @for ($i = 1; $i <= 7; $i++)
                                            <option value="{{ $i }}"
                                                {{ request('paket_plg') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                        <option value="vcr" {{ request('paket_plg') == 'vcr' ? 'selected' : '' }}>
                                            vcr
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </th>

                        <th>
                            <form class="filterForm" method="GET" action="{{ route('isolir.filterTagihindex') }}">
                                <div class="form-group">
                                    <select name="harga_paket" id="harga_paket" onchange="this.form.submit();">
                                        <option value="">Harga</option>
                                        <option value="125000" {{ request('harga_paket') == '125000' ? 'selected' : '' }}>
                                            125000
                                        </option>
                                        <option value="150000" {{ request('harga_paket') == '150000' ? 'selected' : '' }}>
                                            150000
                                        </option>
                                        <option value="175000" {{ request('harga_paket') == '175000' ? 'selected' : '' }}>
                                            175000
                                        </option>
                                        <option value="225000" {{ request('harga_paket') == '225000' ? 'selected' : '' }}>
                                            225000
                                        </option>
                                        <option value="250000" {{ request('harga_paket') == '250000' ? 'selected' : '' }}>
                                            250000
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </th>

                        <th>
                            <form class="filterForm" method="GET" action="{{ route('isolir.filterTagihindex') }}">
                                <div class="form-group">
                                    <select name="tgl_tagih_plg" id="tgl_tagih_plg" onchange="this.form.submit();">
                                        <option value="">Tanggal Tagih</option>
                                        @for ($i = 1; $i <= 32; $i++)
                                            <option value="{{ $i }}"
                                                {{ request('tgl_tagih_plg') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </form>
                        </th>

                        <th>ODP</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Keterangan</th>
                        <th>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Label Status -->
                                <span>Status</span>

                                <!-- Form Filter -->
                                <div class="col-md-3 text-right" style="margin-left: 10px;">
                                    <form action="{{ route('isolir.index') }}" method="GET" class="form-inline"
                                        id="filterForm">
                                        <div class="input-group">
                                            <select name="status_pembayaran" id="status_pembayaran" class="form-control"
                                                onchange="document.getElementById('filterForm').submit();">
                                                <option value="">Semua</option>
                                                <option value="belum_bayar"
                                                    {{ request('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>
                                                    Belum
                                                    Bayar</option>
                                                <option value="sudah_bayar"
                                                    {{ request('status_pembayaran') == 'sudah_bayar' ? 'selected' : '' }}>
                                                    Sudah
                                                    Bayar</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </th>
                        <th>Bayar</th>
                        <th>Aktivkan Kembali</th>

                        <!-- <th>Riwayat pembayaran</th> -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($isolir as $no => $item)
                        <tr>
                            <td>{{ ($isolir->currentPage() - 1) * $isolir->perPage() + $loop->iteration }}</td>
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
                            <td>
                                @if ($item->status_pembayaran === 'Sudah Bayar')
                                    <span class="badge badge-success p-3">Sudah Bayar</span>
                                @else
                                    <span class="badge badge-danger p-3">Belum Bayar</span>
                                @endif
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
                                                    <label for="metodeTransaksi" class="form-label">Metode
                                                        Transaksi</label>
                                                    <select class="form-select" id="metodeTransaksi"
                                                        name="metode_transaksi" required>
                                                        <option value="">Pilih metode</option>
                                                        <option value="CASH">Cash</option>
                                                        <option value="TF">Transfer</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="keterangan_plg" class="form-label">Keterangan
                                                        Pembayaran isolir</label>
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

                            <td>
                                <form action="{{ route('pelanggan.reactivate', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Pelanggan Atas Nama : {{ $item->nama_plg }} Akan di  Aktifkan Kembali?')">Aktifkan
                                        Kembali</button>
                                </form>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="19" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
        <div class="d-flex justify-content-center">
            {{ $isolir->links('pagination::bootstrap-4') }}
        </div>
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

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
                    <button type="submit" name="action" value="search" class="btn btn-danger ml-2">Cari</button>
                </form>
            </div>

            <div class="col-md-6 text-center">
                <!-- Teks Data isolir -->
                <a href="/pelanggan" class="btn btn-primary btn-lg mt-2"
                    style="cursor: default; background: linear-gradient(45deg, #007bff, #00b4db); color: #ffffff;">
                    Data Pelanggan</a>
                <div class="btn btn-primary btn-lg mt-2" data-toggle="modal" data-target="#filterModal"
                    style="cursor: default; background: linear-gradient(45deg, #ff0000, #ff8c00); color: #ffffff;">
                    Data Isolir
                </div>
                <a href="/pelangganof" class="btn btn-primary btn-lg mt-2"
                    style="cursor: default; background: linear-gradient(45deg, #007bff, #00b4db); color: #ffffff;">
                    Data Pelanggan Off</a>
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



        <div class="">
            <table class="table table-bordered table-responsive " style="color: black;">
                <thead class="table table-danger " style="color: black;">
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
                                        <option value="50000"
                                            {{ request('jumlah_pembayaran') == '50000' ? 'selected' : '' }}>
                                            {{ number_format(50000, 0, ',', '.') }}
                                        </option>
                                        <option value="75000"
                                            {{ request('jumlah_pembayaran') == '75000' ? 'selected' : '' }}>
                                            {{ number_format(75000, 0, ',', '.') }}
                                        </option>
                                        <option value="100000"
                                            {{ request('jumlah_pembayaran') == '100000' ? 'selected' : '' }}>
                                            {{ number_format(100000, 0, ',', '.') }}
                                        </option>
                                        <option value="105000"
                                            {{ request('jumlah_pembayaran') == '105000' ? 'selected' : '' }}>
                                            {{ number_format(105000, 0, ',', '.') }}
                                        </option>
                                        <option value="115000"
                                            {{ request('jumlah_pembayaran') == '115000' ? 'selected' : '' }}>
                                            {{ number_format(115000, 0, ',', '.') }}
                                        </option>

                                        <option value="120000"
                                            {{ request('jumlah_pembayaran') == '120000' ? 'selected' : '' }}>
                                            {{ number_format(120000, 0, ',', '.') }}
                                        </option>
                                        <option value="125000"
                                            {{ request('jumlah_pembayaran') == '125000' ? 'selected' : '' }}>
                                            {{ number_format(125000, 0, ',', '.') }}
                                        </option>
                                        <option value="150000"
                                            {{ request('jumlah_pembayaran') == '150000' ? 'selected' : '' }}>
                                            {{ number_format(150000, 0, ',', '.') }}
                                        </option>
                                        <option value="165000"
                                            {{ request('jumlah_pembayaran') == '165000' ? 'selected' : '' }}>
                                            {{ number_format(165000, 0, ',', '.') }}
                                        </option>
                                        <option value="175000"
                                            {{ request('jumlah_pembayaran') == '175000' ? 'selected' : '' }}>
                                            {{ number_format(175000, 0, ',', '.') }}
                                        </option>
                                        <option value="205000"
                                            {{ request('jumlah_pembayaran') == '205000' ? 'selected' : '' }}>
                                            {{ number_format(205000, 0, ',', '.') }}
                                        </option>
                                        <option value="250000"
                                            {{ request('jumlah_pembayaran') == '250000' ? 'selected' : '' }}>
                                            {{ number_format(250000, 0, ',', '.') }}
                                        </option>
                                        <option value="265000"
                                            {{ request('jumlah_pembayaran') == '265000' ? 'selected' : '' }}>
                                            {{ number_format(265000, 0, ',', '.') }}
                                        </option>
                                        <option value="305000"
                                            {{ request('jumlah_pembayaran') == '305000' ? 'selected' : '' }}>
                                            {{ number_format(305000, 0, ',', '.') }}
                                        </option>
                                        <option value="750000"
                                            {{ request('jumlah_pembayaran') == '750000' ? 'selected' : '' }}>
                                            {{ number_format(750000, 0, ',', '.') }}
                                        </option>
                                        <option value="vcr"
                                            {{ request('jumlah_pembayaran') == 'vcr' ? 'selected' : '' }}>
                                            vcr
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
                        <th>Tanggal Isolir</th>
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
                        <th>Aktivkan Kembali</th>

                        <!-- <th>Riwayat pembayaran</th> -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($isolir as $no => $item)
                    <tr class="font-weight-bold">
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
                            <td>{{$item ->created_at}}</td>
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

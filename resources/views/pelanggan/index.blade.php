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
            <table class="table table-striped ">
                <thead class="table table-primary">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
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
                            <td>
                                @if (!empty($item->aktivasi_plg))
                                    @php
                                        $dateString = trim($item->aktivasi_plg);
                                        $date = null;

                                        // Try parsing the date in 'Y-m-d' format first
                                        try {
                                            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $dateString);
                                        } catch (\Exception $e) {
                                            // If parsing fails, try 'd/m/Y' format
                                            try {
                                                $date = \Carbon\Carbon::createFromFormat('d/m/Y', $dateString);
                                            } catch (\Exception $e) {
                                                $date = null;
                                            }
                                        }

                                        // Display the date if successfully parsed, otherwise show an error message
                                        if ($date) {
                                            echo $date->format('d'); // You can change this to any format you prefer
                                        } else {
                                            echo '<em>Invalid date format</em>';
                                        }
                                    @endphp
                                @else
                                    <em>No date available</em>
                                @endif
                            </td>

                            <td>{{ $item->odp }}</td>

                            <td>{{ $item->longitude }}</td>
                            <td>{{ $item->latitude }}</td>

                            <td>{{ $item->keterangan_plg }}</td>
                            <td>{{ $item->status_pembayaran }}</td>
                            <td>
                                <a href="{{ route('pelanggan.detail', $item->id) }}"
                                    class="btn btn-warning btn-sm">Detail</a>
                            </td>
                            <td>
                                <a href="{{ route('pelanggan.historypembayaran', $item->id) }}"
                                    class="btn btn-info btn-sm">Riwayat Pembayaran</a>
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
    @endsection

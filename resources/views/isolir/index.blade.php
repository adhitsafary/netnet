@extends('layout')

@section('konten')
    <div class="mb-4">
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
                    <th>ODP</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
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
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->longitude }}</td>
                        <td>{{ $item->latitude }}</td>
                        <td>
                            @if ($item->status_pembayaran === 'Sudah Bayar')
                                <span class="badge badge-success">Sudah Bayar</span>
                            @else
                                <span class="badge badge-danger">Belum Bayar</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('pelanggan.reactivate', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Aktifkan Kembali</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endsection

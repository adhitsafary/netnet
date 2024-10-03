@extends('layout')

@section('konten')
    <div class="container mb-4">
        <!-- Form Filter dan Pencarian -->
        <form action="{{ route('rekap_pemasangan.index') }}" method="GET" class="form-inline mb-4 ">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                    placeholder="Pencarian">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <a href="/rekap_pemasangan/create" class="btn btn-success">Buat Rekap pemasangan</a>

        <div style="display: flex; justify-content: center;" class="mb-3">

            <h5 style="color: black;" class="font font-weight-bold">Data Rekap pemasangan</h5>
        </div>
        
        <table class="table table-bordered  table-responsive" style="color: black;">
            <thead class="table table-primary " style="color: black;">
                <tr>
                    <th>No</th>
                    <th>Identitas</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Tanggal Aktifasi</th>
                    <th>Paket</th>
                    <th>Nominal</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Registrasi</th>
                    <th>Marketing</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekap_pemasangan as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>

                        <td>{{ $item->no_telpon }}</td>
                        <td>{{ $item->tgl_aktivasi }}</td>
                        <td>{{ $item->paket_plg }}</td>

                        <td>{{ $item->nominal }}</td>
                        <td>{{ $item->jt }}</td>
                        <td>{{ $item->status }}</td>

                        <td>{{ $item->tgl_pengajuan }}</td>
                        <td>{{ $item->registrasi }}</td>
                        <td>{{ $item->marketing }}</td>
                        <td>
                            <a href="{{ route('rekap_pemasangan.edit', $item->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('rekap_pemasangan.destroy', $item->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

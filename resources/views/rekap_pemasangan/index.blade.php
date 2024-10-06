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
        <h5>Data rekap pemasangan</h5>
        <table class="table table-bordered " style="color: black;">
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

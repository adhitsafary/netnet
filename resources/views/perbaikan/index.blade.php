@extends('layout')

@section('konten')
    <div class="mb-4">
        <!-- Form Filter dan Pencarian -->
        <div class="row mb-4">
            <div class="col-md-9">
                <form action="{{ route('perbaikan.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Pencarian">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-3 text-right">
                <a href="/rekap-teknisi" class="btn btn-primary btn-sm">Rekap Bulanan Teknisi</a>
            </div>
        </div>

        <!-- Tabel Perbaikan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pel</th>
                    <th>Nama Pel</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Paket</th>
                    <th>Odp</th>
                    <th>Maps</th>
                    <th>Teknisi</th>
                    <th>Keterangan</th>
                    <th>
                        <!-- Link untuk sorting -->
                        <a
                            href="{{ route('perbaikan.index', array_merge(request()->except('sort'), ['sort' => $sort === 'asc' ? 'desc' : 'asc'])) }}">
                            Tanggal
                            @if ($sort === 'asc')
                                &uarr; <!-- Icon untuk sorting ascending -->
                            @else
                                &darr; <!-- Icon untuk sorting descending -->
                            @endif
                        </a>
                    </th>
                    <th>Aksi</th>
                    <th>Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perbaikan as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->id_plg }}</td>
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->no_telepon_plg }}</td>
                        <td>{{ $item->paket_plg }}</td>
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->maps }}</td>
                        <td>Tim {{ $item->teknisi }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('perbaikan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('perbaikan.destroy', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                        <td>{{ ucfirst($item->status) }}</td> <!-- Menampilkan status -->
                        <td>
                            @if ($item->status == 'pending')
                                <!-- Hanya tampilkan tombol jika statusnya pending -->
                                <form action="{{ route('perbaikan.selesai', $item->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

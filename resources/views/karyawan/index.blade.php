@extends('layout')

@section('konten')
    <div class="mb-4">
        <!-- Form Filter dan Pencarian -->
        <form action="{{ route('karyawan.index') }}" method="GET" class="form-inline mb-4 ">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                    placeholder="Pencarian">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead class="table table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telpon</th>
                    <th>Posisi</th>
                    <th>Mulai Kerja</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($karyawan as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->no_telepon }}</td>
                        <td>{{ $item->posisi }}</td>
                        <td>{{ $item->mulai_kerja }}</td>
                        <td>{{ $item->keterangan}}</td>

                        <td>
                            <a href="{{ route('karyawan.detail', $item->id) }}" class="btn btn-warning btn-sm">Detail
                            </a>
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

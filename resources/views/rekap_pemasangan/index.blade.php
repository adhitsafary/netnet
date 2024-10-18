@extends('layout')

@section('konten')
    <div class="  pl-5 pr-5 mb-4">
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

            <h3 style="color: black;" class="font font-weight-bold">Data Rekap pemasangan</h3>
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
                    <th>Aktivasi</th>
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

                        <td>{{ $item->harga_paket }}</td>
                        <td>{{ $item->jt }}</td>
                        <td>{{ $item->status }}</td>

                        <td>{{ $item->tgl_pengajuan }}</td>
                        <td>{{ $item->registrasi }}</td>
                        <td>{{ $item->marketing }}</td>
                        <td>
                            @php
                                // Cek apakah pelanggan sudah diaktivasi
                                $isActivated = \App\Models\Pelanggan::where('id_plg', $item->id_plg)->exists();
                            @endphp

                            @if ($isActivated)
                                <!-- Jika sudah diaktivasi, tampilkan ikon ceklis tidak bisa diklik -->
                                <img src="{{ asset('asset/img/ceklis2.png') }}" alt="Sudah Aktivasi"
                                    style="width:45px; height:45px;">
                            @else
                                <!-- Jika belum diaktivasi, tampilkan gambar x dan tombol ceklis untuk aktivasi -->
                                <a href="{{ route('rekap_pemasangan.aktivasi', $item->id) }}"
                                    onclick="return confirm('Apakah Pelanggan Sudah Selesai Pasang?')">
                                    <img src="{{ asset('asset/img/x.png') }}" alt="Belum Aktivasi"
                                        style="width:40px; height:40px;">
                                </a>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('rekap_pemasangan.edit', $item->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('rekap_pemasangan.destroy', $item->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button class="btn btn-danger btn-sm"

                                    onclick="return confirm('Yakin ingin menghapus data ini?')" >Hapus</button>
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

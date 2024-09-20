@extends('superadmin.layout_superadmin')

@section('konten')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Detail Karyawan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Informasi Karyawan</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Nama :</strong> {{ $karyawan->nama }}
                            </li>
                            <li class="list-group-item">
                                <strong>Alamat :</strong> {{ $karyawan->alamat }}
                            </li>
                            <li class="list-group-item">
                                <strong>No Telepon :</strong> {{ $karyawan->no_telpon }}
                            </li>
                            <li class="list-group-item">
                                <strong>Gaji :</strong>{{ number_format($karyawan->gaji, 0, ',', '.') }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Detail Karyawan</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Posisi :</strong> {{ $karyawan->posisi }}
                            </li>
                            <li class="list-group-item">
                                <strong>Mulai Kerja :</strong> {{ $karyawan->mulai_kerja }}
                            </li>
                            <li class="list-group-item">
                                <strong>Keterangan :</strong> {{ $karyawan->keterangan }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tanggal Gajihan :</strong> {{ $karyawan->tgl_gajihan }}
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tabel Riwayat Kasbon -->
                <h5 class="mt-4">Riwayat Kasbon</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Kasbon</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kasbon as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Total Kasbon -->
                <div class="mt-3">
                    <strong>Total Kasbon:</strong> Rp {{ number_format($totalKasbon, 0, ',', '.') }}
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('kasbon.create', $karyawan->id) }}" class="btn btn-sm btn-primary">Tambah
                            Kasbon</a>
                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST"
                            class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </div>
                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

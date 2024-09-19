@extends('layout')

@section('konten')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Detail Pelanggan Off</h4>
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



                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Detail Karyawan</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Posisi :</strong> {{ $karyawan->posisi }}
                            </li>
                            <li class="list-group-item">
                                <strong>Mulai Kerja :</strong>{{$karyawan->mulai_kerja}}
                            </li>

                            <li class="list-group-item">
                                <strong>Keterangan :</strong> {{ $karyawan->keterangan }}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('karyawan.non_aktifkan', $karyawan->id) }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah {{ $karyawan->nama_plg }} Akan di Aktifkan kembali?')">Non Aktifkan Karyawan</a>
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

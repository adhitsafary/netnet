@extends('layout')

@section('konten')
    <div class="container mt-4">
        <h6 class="text text-center text-black mt-3"> Tambah Data Karyawan</h6>
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf
            <label for="">Nama Karyawan</label>
            <input type="text" name="nama" class="form-control mt-2">
            <label for="">Alamat</label>
            <input type="text" name="alamat" class="form-control mt-2">
            <label for="">No Telpon</label>
            <input type="text" name="no_telepon" class="form-control mt-2">
            <label for="">Posisi</label>
            <input type="text" name="posisi" class="form-control mt-2">
            <label for="">Mulai Kerja</label>
            <input type="text" name="mulai_kerja" class="form-control mt-2">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" class="form-control mt-2"> <br>

            <button class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>

@endsection

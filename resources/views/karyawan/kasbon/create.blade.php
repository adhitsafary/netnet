@extends('layout')

@section('konten')
    <div class="container mt-4">
        <h6 class="text text-center text-black mt-3"> Tambah Data Karyawan</h6>
        <form action="{{ route('kasbon.store') }}" method="POST">
            @csrf
            <label for="">Nama </label>
            <input type="text" name="nama" class="form-control mt-2">
            <label for="">Jumlah</label>
            <input type="text" name="jumlah" class="form-control mt-2">
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" class="form-control mt-2">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" class="form-control mt-2"> <br>

            <button class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>

@endsection

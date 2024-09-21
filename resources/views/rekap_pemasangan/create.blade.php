@extends('layout')

@section('konten')
    <div class="container mt-4">
        <h6 class="text text-center text-black mt-3"> Tambah Data rekap pemasangan</h6>
        <form action="{{ route('rekap_pemasangan.store') }}" method="POST">
            @csrf
            <!-- Input jumlah -->
            <label for="nik" class=" mt-2">ID :</label>
            <input type="text" name="nik" required class="form-control">

            <!-- Input keterangan -->
            <label for="nama" class=" mt-2">Nama :</label>
            <input type="text" name="nama" required class="form-control">

            <!-- Input jumlah -->
            <label for="alamat" class=" mt-2">Alamat :</label>
            <input type="text" name="alamat" required class="form-control">

            <!-- Input keterangan -->
            <label for="no_telpon" class=" mt-2">NO Telepon:</label>
            <input type="text" name="no_telpon" required class="form-control">

            <!-- Input jumlah -->
            <label for="tgl_aktivasi" class=" mt-2">Tanggal Aktivasi :</label>
            <input type="date" name="tgl_aktivasi" required class="form-control">

            <!-- Input keterangan -->
            <label for="paket_plg" class=" mt-2">Paket:</label>
            <input type="text" name="paket_plg" required class="form-control">

            <!-- Input jumlah -->
            <label for="nominal" class=" mt-2">Nominal :</label>
            <input type="text" name="nominal" required class="form-control">

            <!-- Input keterangan -->
            <label for="jt" class=" mt-2">Jatu Tempo :</label>
            <input type="text" name="jt" required class="form-control">

            <!-- Input jumlah -->
            <label for="status" class=" mt-2">Status :</label>
            <input type="text" name="status" required class="form-control">

            <!-- Input keterangan -->
            <label for="tgl_pengajuan" class=" mt-2">Tanggal Pengajuan:</label>
            <input type="date" name="tgl_pengajuan" required class="form-control">

            <!-- Input jumlah -->
            <label for="registrasi" class=" mt-2">Registrasi :</label>
            <input type="text" name="registrasi" required class="form-control">

            <!-- Input keterangan -->
            <label for="marketing" class=" mt-2">Marketing:</label>
            <input type="text" name="marketing" required class="form-control"> <br>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> <br><br>
        </form>


    </div>
@endsection

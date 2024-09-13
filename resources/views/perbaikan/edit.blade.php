@extends('layout')

@section('konten')  
    <div class="container mt-4">
        <form action="{{ route('perbaikan.update', $perbaikan->id) }}" method="POST">
            @csrf<br>
            <h6>Edit Data Perbaikan</h6><br>
            <label for="">ID</label>
            <input type="text" name="id_plg" value="{{ $perbaikan->id_plg }}" class="form-control mt-2">
            <label for="">Nama Pelanggan</label>
            <input type="text" name="nama_plg" value="{{ $perbaikan->nama_plg }}" class="form-control mt-2">
            <label for="">Alamat</label>
            <input type="text" name="alamat_plg" value="{{ $perbaikan->alamat_plg }}" class="form-control mt-2">
            <label for="">No Telpon</label>
            <input type="text" name="no_telepon_plg" value="{{ $perbaikan->no_telepon_plg }}" class="form-control mt-2">
            <label for="">Paket</label>
            <input type="text" name="paket_plg" value="{{ $perbaikan->paket_plg }}" class="form-control mt-2">
            <label for="">ODP</label>
            <input type="text" name="odp" value="{{ $perbaikan->no_telepon_plg }}" class="form-control mt-2">
            <label for="">Maps</label>
            <input type="text" name="maps" value="{{ $perbaikan->maps }}" class="form-control mt-2">
            <label for="">Teknisi</label>
            <input type="text" name="teknisi" value="{{ $perbaikan->teknisi }}" class="form-control mt-2">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" value="{{ $perbaikan->keterangan }}" class="form-control mt-2"> <br> 
            <button class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>
@endsection

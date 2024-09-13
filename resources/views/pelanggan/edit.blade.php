@extends('layout')

@section('konten')
    <div class="container mt-4">
        <h4 class="mt-2">Edit Data Pelanggan</h4><br>
        <form id="editPelangganForm" action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            <label for="">ID</label>
            <input type="text" name="id_plg" value="{{ $pelanggan->id_plg }}" class="form-control mt-2" readonly>
            <div class="invalid-feedback" id="id_plgError">Field ID tidak boleh kosong.</div>

            <label for="">Nama Pelanggan</label>
            <input type="text" name="nama_plg" value="{{ $pelanggan->nama_plg }}" class="form-control mt-2"
                id="nama_plg">
            <div class="invalid-feedback" id="nama_plgError">Field Nama Pelanggan tidak boleh kosong.</div>

            <label for="">Alamat</label>
            <input type="text" name="alamat_plg" value="{{ $pelanggan->alamat_plg }}" class="form-control mt-2"
                id="alamat_plg">
            <div class="invalid-feedback" id="alamat_plgError">Field Alamat tidak boleh kosong.</div>

            <label for="">No Telpon</label>
            <input type="text" name="no_telepon_plg" value="{{ $pelanggan->no_telepon_plg }}" class="form-control mt-2"
                id="no_telepon_plg">
            <div class="invalid-feedback" id="no_telepon_plgError">Field No Telpon tidak boleh kosong.</div>

            <label for="">Aktivasi</label>
            <input type="text" name="aktivasi_plg" value="{{ $pelanggan->aktivasi_plg }}" class="form-control mt-2"
                id="aktivasi_plg">
            <div class="invalid-feedback" id="aktivasi_plgError">Field Aktivasi tidak boleh kosong.</div>

            <label for="">Paket</label>
            <input type="text" name="paket_plg" value="{{ $pelanggan->paket_plg }}" class="form-control mt-2"
                id="paket_plg">
            <div class="invalid-feedback" id="paket_plgError">Field Paket tidak boleh kosong.</div>

            <label for="">Harga Paket</label>
            <input type="text" name="harga_paket" value="{{ $pelanggan->harga_paket }}" class="form-control mt-2"
                id="harga_paket">
            <div class="invalid-feedback" id="harga_paketError">Field Harga Paket tidak boleh kosong.</div>

            <label for="">ODP</label>
            <input type="text" name="odp" value="{{ $pelanggan->odp }}" class="form-control mt-2" id="odp">
            <div class="invalid-feedback" id="odpError">Field ODP tidak boleh kosong. Jika tidak ada, tulis "0".</div>

            <label for="">Latitude</label>
            <input type="text" name="latitude" value="{{ $pelanggan->latitude }}" class="form-control mt-2"
                id="latitude">
            <div class="invalid-feedback" id="latitudeError">Field Latitude tidak boleh kosong.</div>

            <label for="">Longitude</label>
            <input type="text" name="longitude" value="{{ $pelanggan->longitude }}" class="form-control mt-2"
                id="longitude">
            <div class="invalid-feedback" id="longitudeError">Field Longitude tidak boleh kosong.</div>

            <label for="">Keterangan</label>
            <input type="text" name="keterangan_plg" value="{{ $pelanggan->keterangan_plg }}" class="form-control mt-2"
                id="keterangan_plg">
            <div class="invalid-feedback" id="keterangan_plgError">Field Keterangan tidak boleh kosong.</div> <br>

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> <br> <br> <br>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('editPelangganForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Function to check field and show error
            function checkField(id) {
                const field = document.getElementById(id);
                const error = document.getElementById(id + 'Error');
                if (field.value.trim() === "") {
                    field.classList.add('is-invalid');
                    error.style.display = 'block';
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                    error.style.display = 'none';
                }
            }

            // Check each field
            checkField('nama_plg');
            checkField('alamat_plg');
            checkField('no_telepon_plg');
            checkField('aktivasi_plg');
            checkField('paket_plg');
            checkField('harga_paket');

            // Special case for ODP
            const odp = document.getElementById('odp');
            if (odp.value.trim() === "") {
                odp.value = '0'; // Set default value "0"
            }
            checkField('odp');

            checkField('latitude');
            checkField('longitude');
            checkField('keterangan_plg');

            // Prevent form submission if any field is invalid
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
@endsection

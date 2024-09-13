@extends('layout')

@section('konten')
    <div class="container mt-4">
        <h6 class="text text-center text-black mt-3">Tambah Data Pelanggan</h6>
        <form id="pelangganForm" action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <label for="">ID</label>
            <input type="text" name="id_plg" class="form-control mt-2" id="id_plg">
            <div class="invalid-feedback" id="id_plgError">Field ID tidak boleh kosong.</div>

            <label for="">Nama Pelanggan</label>
            <input type="text" name="nama_plg" class="form-control mt-2" id="nama_plg">
            <div class="invalid-feedback" id="nama_plgError">Field Nama Pelanggan tidak boleh kosong.</div>

            <label for="">Alamat</label>
            <input type="text" name="alamat_plg" class="form-control mt-2" id="alamat_plg">
            <div class="invalid-feedback" id="alamat_plgError">Field Alamat tidak boleh kosong.</div>

            <label for="">No Telpon</label>
            <input type="text" name="no_telepon_plg" class="form-control mt-2" id="no_telepon_plg">
            <div class="invalid-feedback" id="no_telepon_plgError">Field No Telpon tidak boleh kosong.</div>

            <label for="">Aktivasi</label>
            <input type="date" name="aktivasi_plg" class="form-control mt-2" id="aktivasi_plg">
            <div class="invalid-feedback" id="aktivasi_plgError">Field Aktivasi tidak boleh kosong.</div>

            <label for="">Paket</label>
            <select name="paket_plg" id="paket_plg" class="form-control mt-2" onchange="setHargaPaket()">
                <option value="" disabled selected>Pilih Paket</option>
                <option value="paket 1">Paket 1 - Rp 125.000</option>
                <option value="paket 2">Paket 2 - Rp 165.000</option>
                <option value="paket 3">Paket 3 - Rp 205.000</option>
                <option value="paket 4">Paket 4 - Rp 305.000</option>
                <option value="paket 5">Paket 5 - Rp 120.000</option>
                <option value="paket 6">Paket 6 - Rp 175.000</option>
            </select>
            <div class="invalid-feedback" id="paket_plgError">Field Paket tidak boleh kosong.</div>

            <label for="">Harga Paket</label>
            <input type="text" name="harga_paket" id="harga_paket" class="form-control mt-2" readonly>

            <label for="">ODP</label>
            <input type="text" name="odp" class="form-control mt-2" id="odp">
            <div class="invalid-feedback" id="odpError">Field ODP tidak boleh kosong.</div>

            <label for="">Latitude</label>
            <input type="text" name="latitude" class="form-control mt-2" id="latitude">
            <div class="invalid-feedback" id="latitudeError">Field Latitude tidak boleh kosong.</div>

            <label for="">Longitude</label>
            <input type="text" name="longitude" class="form-control mt-2" id="longitude">
            <div class="invalid-feedback" id="longitudeError">Field Longitude tidak boleh kosong.</div>

            <label for="">Keterangan</label>
            <input type="text" name="keterangan_plg" class="form-control mt-2" id="keterangan_plg">
            <div class="invalid-feedback" id="keterangan_plgError">Field Keterangan tidak boleh kosong.</div>
            <br>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button><br><br>
        </form>
    </div>

    <script>
        function setHargaPaket() {
            const paketPlg = document.getElementById('paket_plg').value;
            const hargaPaket = document.getElementById('harga_paket');

            const hargaList = {
                'paket 1': '125.000',
                'paket 2': '165.000',
                'paket 3': '205.000',
                'paket 4': '305.000',
                'paket 5': '120.000',
                'paket 6': '175.000'
            };

            // Set harga sesuai pilihan paket
            if (paketPlg in hargaList) {
                hargaPaket.value = hargaList[paketPlg];
            } else {
                hargaPaket.value = ''; // Kosongkan jika tidak ada paket yang dipilih
            }
        }

        document.getElementById('pelangganForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Validasi field ID
            const idPlg = document.getElementById('id_plg').value;
            if (idPlg === "") {
                document.getElementById('id_plg').classList.add('is-invalid');
                document.getElementById('id_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('id_plg').classList.remove('is-invalid');
                document.getElementById('id_plgError').style.display = 'none';
            }

            // Validasi field Nama Pelanggan
            const namaPlg = document.getElementById('nama_plg').value;
            if (namaPlg === "") {
                document.getElementById('nama_plg').classList.add('is-invalid');
                document.getElementById('nama_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('nama_plg').classList.remove('is-invalid');
                document.getElementById('nama_plgError').style.display = 'none';
            }

            // Validasi field Alamat
            const alamatPlg = document.getElementById('alamat_plg').value;
            if (alamatPlg === "") {
                document.getElementById('alamat_plg').classList.add('is-invalid');
                document.getElementById('alamat_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('alamat_plg').classList.remove('is-invalid');
                document.getElementById('alamat_plgError').style.display = 'none';
            }

            // Validasi field No Telpon
            const noTelponPlg = document.getElementById('no_telepon_plg').value;
            if (noTelponPlg === "") {
                document.getElementById('no_telepon_plg').classList.add('is-invalid');
                document.getElementById('no_telepon_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('no_telepon_plg').classList.remove('is-invalid');
                document.getElementById('no_telepon_plgError').style.display = 'none';
            }

            // Validasi field Aktivasi
            const aktivasiPlg = document.getElementById('aktivasi_plg').value;
            if (aktivasiPlg === "") {
                document.getElementById('aktivasi_plg').classList.add('is-invalid');
                document.getElementById('aktivasi_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('aktivasi_plg').classList.remove('is-invalid');
                document.getElementById('aktivasi_plgError').style.display = 'none';
            }

            // Validasi field Paket
            const paketPlg = document.getElementById('paket_plg').value;
            if (paketPlg === "") {
                document.getElementById('paket_plg').classList.add('is-invalid');
                document.getElementById('paket_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('paket_plg').classList.remove('is-invalid');
                document.getElementById('paket_plgError').style.display = 'none';
            }

            // Validasi field ODP
            const odp = document.getElementById('odp').value;
            if (odp === "") {
                document.getElementById('odp').classList.add('is-invalid');
                document.getElementById('odpError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('odp').classList.remove('is-invalid');
                document.getElementById('odpError').style.display = 'none';
            }

            // Validasi field Latitude
            const latitude = document.getElementById('latitude').value;
            if (latitude === "") {
                document.getElementById('latitude').classList.add('is-invalid');
                document.getElementById('latitudeError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('latitude').classList.remove('is-invalid');
                document.getElementById('latitudeError').style.display = 'none';
            }

            // Validasi field Longitude
            const longitude = document.getElementById('longitude').value;
            if (longitude === "") {
                document.getElementById('longitude').classList.add('is-invalid');
                document.getElementById('longitudeError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('longitude').classList.remove('is-invalid');
                document.getElementById('longitudeError').style.display = 'none';
            }

            // Validasi field Keterangan
            const keteranganPlg = document.getElementById('keterangan_plg').value;
            if (keteranganPlg === "") {
                document.getElementById('keterangan_plg').classList.add('is-invalid');
                document.getElementById('keterangan_plgError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('keterangan_plg').classList.remove('is-invalid');
                document.getElementById('keterangan_plgError').style.display = 'none';
            }

            if (!isValid) {
                e.preventDefault(); // Mencegah pengiriman form jika tidak valid
            }
        });
    </script>
@endsection

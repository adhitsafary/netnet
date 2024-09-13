@extends('layout')

@section('konten')
    <div class="mb-4">
        <!-- Form Filter dan Pencarian -->
        <form action="{{ route('pelangganof.index') }}" method="GET" class="form-inline mb-4 ">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                    placeholder="Pencarian">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead class="table table-primary">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telpon</th>
                    <th>Aktivasi</th>
                    <th>Paket</th>
                    <th>Harga Paket</th>
                    <th>Tanggal Tagih</th>
                    <th>Status </th>
                    <th>ODP</th>
                    <th>Jumlah Port</th>
                    <th>Sisa Port</th>
                    <th>Longitude</th>
                    <th>Atitude</th>
                    <th>MAPS</th>
                    <th>Keterangan</th>
                    <th>Status Pembayaran</th>
                    <th>Detail</th>
                    <th>Pembayaran</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($pelangganof as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->id_plg }}</td>
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->no_telepon_plg }}</td>
                        <td>{{ $item->aktivasi_plg }}</td>
                        <td>{{ $item->paket_plg }}</td>
                        <td>{{ $item->harga_paket }}</td>
                        <td>{{ $item->aktivasi_plg }}</td>
                        <td>{{ $item->status_plg }}</td>
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->jml_port}}</td>
                        <td>{{ $item->sisa_port}}</td>
                        <td>{{ $item->longitude }}</td>
                        <td>{{ $item->latitude }}</td>
                        <td>{{ $item->maps }}</td>
                        <td>{{ $item->keterangan_plg }}</td>
                        <td>{{ $item->status_pembayaran }}</td>

                        <td>
                            <a href="{{ route('pelangganof.detail', $item->id) }}" class="btn btn-warning btn-sm">Detail
                            </a>
                        </td>

                        <td>

                            <form action="{{ route('pelanggan.store') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id_plg" value="{{ $item->id_plg }}">
                                <input type="hidden" name="nama_plg" value="{{ $item->nama_plg }}">
                                <input type="hidden" name="alamat_plg" value="{{ $item->alamat_plg }}">
                                <input type="hidden" name="no_telepon_plg" value="{{ $item->no_telepon_plg }}">
                                <input type="hidden" name="aktivasi_plg" value="{{ $item->aktivasi_plg }}">
                                <input type="hidden" name="paket_plg" value="{{ $item->paket_plg }}">
                                <input type="hidden" name="harga_paket" value="{{ $item->harga_paket }}">
                                <input type="hidden" name="tgl_tagih_plg" value="{{ $item->tgl_tagih_plg }}">
                                <input type="hidden" name="status_plg" value="{{ $item->status_plg }}">
                                <input type="hidden" name="keterangan_plg" value="{{ $item->keterangan_plg }}">
                                <input type="hidden" name="odp" value="{{ $item->odp }}">
                                <input type="hidden" name="maps" value="{{ $item->maps }}">
                                
                                <button type="submit" class="btn btn-warning btn-sm"
                                    onclick="return validateForm(this.form)">Perbaikan</button>
                            </form>
                        </td>

                        <script>
                            function validateForm(form) {
                                let requiredFields = ['id_plg', 'nama_plg', 'alamat_plg', 'no_telepon_plg', 'paket_plg', 'odp', 'maps'];
                                for (let field of requiredFields) {
                                    if (!form[field].value) {
                                        alert('Form ' + field + ' tidak boleh kosong!');
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>

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

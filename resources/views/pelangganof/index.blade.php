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
                    <th>ODP</th>
                    <th>Longitude</th>
                    <th>Atitude</th>
                    <th>Keterangan</th>
                    <th>Tanggal Off</th>
                    <th>Status Pembayaran</th>
                    <th>Detail</th>


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
                        <td>{{ number_format($item->harga_paket, 0, ',', '.') }}</td>
                        <td>
                            @if (!empty($item->aktivasi_plg))
                                @php
                                    $dateString = trim($item->aktivasi_plg);
                                    $date = null;

                                    // Try parsing the date in 'Y-m-d' format first
                                    try {
                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $dateString);
                                    } catch (\Exception $e) {
                                        // If parsing fails, try 'd/m/Y' format
                                        try {
                                            $date = \Carbon\Carbon::createFromFormat('d/m/Y', $dateString);
                                        } catch (\Exception $e) {
                                            $date = null;
                                        }
                                    }

                                    // Display the date if successfully parsed, otherwise show an error message
                                    if ($date) {
                                        echo $date->format('d'); // You can change this to any format you prefer
                                    } else {
                                        echo '<em>Data tidak Ada </em>';
                                    }
                                @endphp
                            @else
                                <em>No date available</em>
                            @endif
                        </td>
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->longitude }}</td>
                        <td>{{ $item->latitude }}</td>
                        <td>{{ $item->keterangan_plg }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->status_pembayaran }}</td>

                        <td>
                            <a href="{{ route('pelangganof.detail', $item->id) }}" class="btn btn-warning btn-sm">Detail
                            </a>
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

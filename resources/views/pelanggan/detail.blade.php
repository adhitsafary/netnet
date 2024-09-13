@extends('layout')

@section('konten')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Detail Pelanggan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Informasi Pelanggan</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>ID:</strong> {{ $pelanggan->id_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Nama:</strong> {{ $pelanggan->nama_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Alamat:</strong> {{ $pelanggan->alamat_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>No Telepon:</strong> {{ $pelanggan->no_telepon_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Aktivasi:</strong> {{ $pelanggan->aktivasi_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Longitude :</strong> {{ $pelanggan->longitude }}
                            </li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Detail Paket</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Paket:</strong> {{ $pelanggan->paket_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Harga Paket:</strong> {{ number_format($pelanggan->harga_paket, 0, ',', '.') }}

                            </li>
                            <li class="list-group-item">
                                <strong>Tanggal Tagih:</strong>
                                @if (!empty($pelanggan->aktivasi_plg))
                                    @php
                                        $dateString = trim($pelanggan->aktivasi_plg);
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
                                            echo '<em>Invalid date format</em>';
                                        }
                                    @endphp
                                @else
                                    <em>No date available</em>
                                @endif
                            </li>

                            <li class="list-group-item">
                                <strong>Keterangan :</strong> {{ $pelanggan->keterangan_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>ODP :</strong> {{ $pelanggan->odp }}
                            </li>
                            <li class="list-group-item">
                                <strong>Latitude:</strong> {{ $pelanggan->Latitude }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST"
                            class="d-inline-block">
                            @csrf

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                        <a href="{{ route('pelanggan.off', $pelanggan->id) }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Pelanggan Atas Nama {{ $pelanggan->nama_plg }} Akan di Non Aktifkan?')">Pelanggan
                            Off</a>
                        <a href="{{ route('pelanggan.bayar', $pelanggan->id) }}" class="btn btn-success btn-sm"
                            onclick="return confirm('Apakah {{ $pelanggan->nama_plg }} Sudah Membayar sebesar Rp.{{ $pelanggan->harga_paket }}?')">Bayar</a>
                        <a href="{{ route('pelanggan.historypembayaran', $pelanggan->id) }}"
                            class="btn btn-info btn-sm">Riwayat Pembayaran</a>

                    </div>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

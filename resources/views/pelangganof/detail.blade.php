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
                        <h5>Informasi Pelanggan</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>ID:</strong> {{ $pelangganof->id_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Nama:</strong> {{ $pelangganof->nama_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Alamat:</strong> {{ $pelangganof->alamat_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>No Telepon:</strong> {{ $pelangganof->no_telepon_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Aktivasi:</strong> {{ $pelangganof->aktivasi_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Longitude :</strong> {{ $pelangganof->longitude }}
                            </li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Detail Paket</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Paket:</strong> {{ $pelangganof->paket_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>Harga Paket:</strong>{{ number_format($pelangganof->harga_paket, 0, ',', '.') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tanggal Tagih:</strong>
                                @if (!empty($pelangganof->aktivasi_plg))
                                    @php
                                        try {
                                            // Parsing the date from the format 'd/m/Y'
                                            $date = \Carbon\Carbon::createFromFormat(
                                                'd/m/Y',
                                                $pelangganof->aktivasi_plg,
                                            );
                                            echo $date->format('d'); // Format it to the same format or any other format you prefer
                                        } catch (\Exception $e) {
                                            echo '<em>Invalid date format</em>'; // Handle any parsing errors
                                        }
                                    @endphp
                                @else
                                    <em>No date available</em>
                                @endif
                            </li>

                            <li class="list-group-item">
                                <strong>Keterangan :</strong> {{ $pelangganof->keterangan_plg }}
                            </li>
                            <li class="list-group-item">
                                <strong>ODP :</strong> {{ $pelangganof->odp }}
                            </li>
                            <li class="list-group-item">
                                <strong>Latitude:</strong> {{ $pelangganof->Latitude }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('aktifkan_pelanggan', $pelangganof->id) }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah {{ $pelangganof->nama_plg }} Akan di Aktifkan kembali?')">Aktifkan</a>
                        <a href="{{ route('pelangganof.edit', $pelangganof->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pelangganof.destroy', $pelangganof->id) }}" method="POST"
                            class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </div>
                    <a href="{{ route('pelangganof.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

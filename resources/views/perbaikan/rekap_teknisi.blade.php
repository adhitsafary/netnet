@extends('layout')

@section('konten')
    <div class="container mt-4">
        <!-- Filter Tanggal -->
        <form action="{{ route('perbaikan.rekapTeknisi') }}" method="GET" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date', $startDate->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date', $endDate->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filter_button">&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Menampilkan Total Perbaikan -->
        <div class="mb-3">
            <h5>Total Perbaikan: {{ $totalPerbaikan }}</h5>
        </div>

        <!-- Tabel Rekap Data Teknisi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Teknisi</th>
                    <th class="text text-black">Total Perbaikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekap as $data)
                    <tr>
                        <td>Tim {{ $data->teknisi }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol Cetak PDF -->
        <div class="text-center mt-4">
            <form action="{{ route('perbaikan.printRekapTeknisi') }}" method="POST">
                @csrf
                <input type="hidden" name="start_date" value="{{ request('start_date', $startDate->format('Y-m-d')) }}">
                <input type="hidden" name="end_date" value="{{ request('end_date', $endDate->format('Y-m-d')) }}">
                <button type="submit" class="btn btn-danger">Cetak PDF</button>
            </form>
        </div>
    </div>
@endsection

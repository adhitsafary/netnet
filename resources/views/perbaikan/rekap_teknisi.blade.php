@extends('layout')

@section('konten')
    <div class="container mt-4">
        <h6 class="text-center text-black mt-3">Rekap Data Teknisi Bulanan</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Teknisi</th>
                    <th>Total Perbaikan</th>
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
    </div>
@endsection

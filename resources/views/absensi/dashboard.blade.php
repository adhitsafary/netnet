@extends($layout)

@section('konten')
<div class="container">
    <h1 class="my-4">Data Absensi</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <table class="table table-bordered table-responsive" style="color: black;">
        <thead class="table table-primary " style="color: black;">
            <tr>
                <th>No</th>
                <th>id</th>
                <th>Nama User</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Titik Lokasi</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_pulang }}</td>
                <td>{{ $item->titik_lokasi }}</td>
                <td>
                    @if($item->foto)
                    <img src="{{ asset($item->foto) }}" alt="Foto Absensi" width="50">
                    @else
                    <span>No Foto</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
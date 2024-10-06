@extends('layout2')

@section('konten')
    <div class="mb-4 mt-5 text-right">

       <div>
            <div class="ml-2 d-none d-lg-inline text-white small text-right">
                <ul class="list-group list-group-flush">
                @if (Auth::user() -> role == 'teknisi')
                <li class="list-group-item">Menu Teknisi</li>
                @endif
                @if (Auth::user() -> role == 'admin')
                <li class="list-group-item">Menu Admin</li>
                @endif
                @if (Auth::user() -> role == 'superadmin')
                <li class="list-group-item">Menu SuperAdmin</li>
                @endif
                </ul>
            </div>
       </div>



        <!-- Form Filter dan Pencarian -->
        <div class="row mb-4">
            <div class="col-md-9">
                <form action="{{ route('perbaikan.teknisi') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Pencarian">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-3 text-right">
                <div class="d-flex justify-content-end gap-2" >
                    <button class="btn btn-primary btn-sm" width="500" >Pemasangan dan Perbaikan</button>
                    <a class="btn btn-danger btn-sm mb-2" href="/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>

                </div>
            </div>


        </div>


        <table class="table table-bordered" style="color: black;">
            <thead>
                <tr>
                    <th>No</th>
                    <!--<th>ID Pel</th> -->
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Paket</th>
                    <th>Odp</th>
                    <th>Maps</th>
                    <th>Teknisi</th>
                    <th>Keterangan</th>
                    <th>
                        <!-- Link untuk sorting -->
                        <a
                            href="{{ route('perbaikan.teknisi', array_merge(request()->except('sort'), ['sort' => $sort === 'asc' ? 'desc' : 'asc'])) }}">
                            Tanggal
                            @if ($sort === 'asc')
                                &uarr; <!-- Icon untuk sorting ascending -->
                            @else
                                &darr; <!-- Icon untuk sorting descending -->
                            @endif
                        </a>
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($perbaikan as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                       <!-- <td>{{ $item->id_plg }}</td> -->
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->no_telepon_plg }}</td>
                        <td>{{ $item->paket_plg }}</td>
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->maps }}</td>
                        <td>Tim {{ $item->teknisi }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->created_at }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection

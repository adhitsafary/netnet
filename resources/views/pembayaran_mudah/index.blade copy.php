@extends($layout)

@section('konten')
    <div class="container">
        <h4 class="mb-4">Bayar Tagihan Pelanggan</h4>


        <div class="row align-items-center">
            <table class="table table-bordered mt-2">
                <thead class="custom-cell head">
                    <tr>
                        <th>hari Ini</th>
                        <th>Pembayaran</th>
                        <th>Pembayaran</th>
                        <th>Pembayaran</th>
                        
                 

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="custom-cell info"
                            onclick="">
                           
                        </td>
                        <td class="custom-cell info"
                            onclick="">
                           
                        </td>
                        <td class="custom-cell info"
                            onclick="">
                           
                        </td>
                         <td class="custom-cell info"
                            onclick="">
                           
                        </td>



                    </tr>
                </tbody>
            </table>

            <style>
                .custom-cell {
                    padding: 10px;
                    text-align: center;
                    font-size: 1.0em;
                    font-weight: bold;
                    cursor: pointer;
                    color: white;
                }

                .custom-cell.head {
                    background: #530096;
                    /* Biru */
                }

                .custom-cell.info {
                    background: #17a2b8;
                    /* Biru */
                }

                .custom-cell.warning {
                    background: #ffc107;
                    /* Kuning */
                    color: black;
                }

                .custom-cell.danger {
                    background: #dc3545;
                    /* Merah */
                }

                .custom-cell.success {
                    background: #28a745;
                    /* Hijau */
                }

                .custom-cell.primary {
                    background: #007bff;
                    /* Biru tua */
                }

                .custom-cell.primary-yellow {
                    background: #ecc100;
                    /* Kuning terang */
                    color: black;
                }

                .custom-cell.primary-red {
                    background: #ff0000;
                    /* Merah terang */
                }

                .custom-cell.primary-green {
                    background: rgb(32, 190, 0);
                    /* Hijau terang */
                }

                .table-bordered {
                    border: 1px solid #dee2e6;
                    width: 100%;
                }

                .table th,
                .table td {
                    border: 1px solid #dee2e6;
                    vertical-align: middle;
                }

                .table {
                    width: 100%;
                    table-layout: fixed;
                    /* Membuat lebar kolom rata */
                }

                a {
                    color: white;
                    text-decoration: none;
                }

                a:hover {
                    text-decoration: underline;
                }
            </style>

        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pembayaran_mudah.index') }}" method="GET">
            <div class="form-group d-flex">
                <input type="text" name="q" class="form-control me-2 mr-3" placeholder="Cari berdasarkan ID atau Nama"
                    value="{{ $query ?? '' }}">
              <button type="submit" class="btn btn-primary w-50">Cari / Refresh</button>

            </div>
        </form>

        


        <div class="mt-4">
            @if (!$query_cari)
                <p class="text-muted">Silakan masukkan ID atau Nama untuk mencari data pelanggan.</p>

                    <div>
                <!-- Tabel Pembayaran -->
        <table class="table table-bordered table-responsive" style="color: black;">
            <thead class="table table-primary " style="color: black;">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                  
                  

                  
                    <th>
                        <form class="filterForm" method="GET" action="{{ route('pembayaran.filter') }}">
                            <div class="form-group">
                                <select name="tgl_tagih_plg" id="tgl_tagih_plg" onchange="this.form.submit();">
                                    <option value="">Tanggal Tagih</option>
                                    @for ($i = 1; $i <= 33; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('tgl_tagih_plg') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                        Tanggal Tagih
                    </th>
                    <th>
                        <form class="filterForm" method="GET" action="{{ route('pembayaran.filter') }}">
                            <div class="form-group">
                                <select name="jumlah_pembayaran" id="jumlah_pembayaran" onchange="this.form.submit();">
                                    <option value="">Harga</option>

                                    <option value="50000"
                                        {{ request('jumlah_pembayaran') == '50000' ? 'selected' : '' }}>
                                        {{ number_format(50000, 0, ',', '.') }}
                                    </option>
                                    <option value="75000"
                                        {{ request('jumlah_pembayaran') == '75000' ? 'selected' : '' }}>
                                        {{ number_format(75000, 0, ',', '.') }}
                                    </option>
                                    <option value="100000"
                                        {{ request('jumlah_pembayaran') == '100000' ? 'selected' : '' }}>
                                        {{ number_format(100000, 0, ',', '.') }}
                                    </option>
                                    <option value="105000"
                                        {{ request('jumlah_pembayaran') == '105000' ? 'selected' : '' }}>
                                        {{ number_format(105000, 0, ',', '.') }}
                                    </option>
                                    <option value="115000"
                                        {{ request('jumlah_pembayaran') == '115000' ? 'selected' : '' }}>
                                        {{ number_format(115000, 0, ',', '.') }}
                                    </option>

                                    <option value="120000"
                                        {{ request('jumlah_pembayaran') == '120000' ? 'selected' : '' }}>
                                        {{ number_format(120000, 0, ',', '.') }}
                                    </option>
                                    <option value="125000"
                                        {{ request('jumlah_pembayaran') == '125000' ? 'selected' : '' }}>
                                        {{ number_format(125000, 0, ',', '.') }}
                                    </option>
                                    <option value="150000"
                                        {{ request('jumlah_pembayaran') == '150000' ? 'selected' : '' }}>
                                        {{ number_format(150000, 0, ',', '.') }}
                                    </option>
                                    <option value="165000"
                                        {{ request('jumlah_pembayaran') == '165000' ? 'selected' : '' }}>
                                        {{ number_format(165000, 0, ',', '.') }}
                                    </option>
                                    <option value="175000"
                                        {{ request('jumlah_pembayaran') == '175000' ? 'selected' : '' }}>
                                        {{ number_format(175000, 0, ',', '.') }}
                                    </option>
                                    <option value="205000"
                                        {{ request('jumlah_pembayaran') == '205000' ? 'selected' : '' }}>
                                        {{ number_format(205000, 0, ',', '.') }}
                                    </option>
                                    <option value="250000"
                                        {{ request('jumlah_pembayaran') == '250000' ? 'selected' : '' }}>
                                        {{ number_format(250000, 0, ',', '.') }}
                                    </option>
                                    <option value="265000"
                                        {{ request('jumlah_pembayaran') == '265000' ? 'selected' : '' }}>
                                        {{ number_format(265000, 0, ',', '.') }}
                                    </option>
                                    <option value="305000"
                                        {{ request('jumlah_pembayaran') == '305000' ? 'selected' : '' }}>
                                        {{ number_format(305000, 0, ',', '.') }}
                                    </option>
                                    <option value="750000"
                                        {{ request('jumlah_pembayaran') == '750000' ? 'selected' : '' }}>
                                        {{ number_format(750000, 0, ',', '.') }}
                                    </option>
                                    <option value="vcr" {{ request('jumlah_pembayaran') == 'vcr' ? 'selected' : '' }}>
                                        vcr
                                    </option>

                                </select>
                            </div>
                        </form>
                        Jumlah Pembayaran
                    </th>
                    <th>Metode Pembayaran</th>
                    
                    <th>

                        <form class="filterForm" method="GET" action="{{ route('pembayaran.filter') }}">
                            <div class="form-group">
                                <input type="date" name="created_at" id="created_at" value="{{ request('created_at') }}"
                                    onchange="this.form.submit();">
                            </div>
                        </form>
                        Tanggal Pembayaran
                    </th>
               
              
                    <th>Admin</th>
                    <th>Edit</th>
                    <th>Hapus</th>
        
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $no => $item)
                    <tr class="font-weight-bold">
                        <td>{{ ($pembayaran->currentPage() - 1) * $pembayaran->perPage() + $loop->iteration }}</td>
                        <td>{{ $item->nama_plg }}</td>
                
                        <td>{{ $item->alamat_plg }}</td>
            
                      
                     
                        <td>{{ $item->tgl_tagih_plg }}</td>
                        <td>{{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ $item->metode_transaksi }}</td>
                        <td>{{ $item->created_at }}</td>
                        
                       
                        <td>{{ $item->admin_name }}</td>
                        <td>
                            <a href="{{ route('pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('pembayaran.destroy', $item->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                     
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pembayaran ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


            @elseif($pelanggan->isEmpty())
                <p class="text-muted">Tidak ditemukan hasil untuk "{{ $query_cari }}"</p>
            @else
            <table class="table table-bordered table-responsive" style="color: black;">
                    <thead class="table table-primary " style="color: black;">
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                    
                            <th>Harga</th>
                            <th>Tanggal Tagih</th>
            
                            <th>Status Pembayaran</th>
                            <th>bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $no => $item)
                        <tr class="font-weight-bold">
                                <td>{{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->id_plg }}</td>
                                <td>{{ $item->nama_plg }}</td>
                                <td>{{ $item->alamat_plg }}</td>
                        
                                <td>{{ number_format($item->harga_paket, 0, ',', '.') }}</td>
                                <td>{{ $item->tgl_tagih_plg }}</td>
                
                                <td>
                                {{ optional($item->pembayaranTerakhir)->tanggal_pembayaran
                                    ? \Carbon\Carbon::parse($item->pembayaranTerakhir->tanggal_pembayaran)->locale('id')->isoFormat('MMMM Y')
                                    : '-' }}
                            </td>
                               <td>
                                <a href="#" class="btn btn-success btn-sm"
                                    onclick="showBayarModal({{ $item->id }}, '{{ $item->nama_plg }}', {{ $item->harga_paket }})">Bayar</a>
                            </td>

                              <!-- Modal Bayar -->
                            <div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="bayarModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="bayarModalLabel">Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Form -->
                                        <form id="bayarForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" id="pelangganId">
                                            <div class="modal-body">
                                                <!-- Input Tanggal Pembayaran -->

                                                <div class="mb-3">
                                                    <label for="tanggal_pembayaran" class="form-label">Untuk Pembayaran
                                                        Bulan</label>
                                                    <input type="month" class="form-select" id="tanggal_pembayaran"
                                                        name="tanggal_pembayaran" placeholder="Pilih bulan">
                                                </div>



                                                <div class="mb-3">
                                                    <label for="metodeTransaksi" class="form-label">Metode
                                                        Transaksi</label>
                                                    <select class="form-select" id="metodeTransaksi"
                                                        name="metode_transaksi" required>
                                                        <option value="">Pilih metode</option>
                                                        <option value="TF">TF</option>
                                                        <option value="CASH">KANTOR</option>

                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="keterangan_plg" class="form-label">Keterangan
                                                        Pembayaran Pelanggan</label>
                                                    <input type="text" class="form-control" id="keterangan_plg"
                                                        name="keterangan_plg">
                                                </div>

                                                <!-- Detail Pembayaran -->
                                                <div class="mb-3">
                                                    <p id="pembayaranDetails"></p>
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Bayar</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $pelanggan->links() }}
            @endif
        </div>
    </div>


@endsection

  <script>
        function showBayarModal(id, namaPlg, hargaPaket) {
            document.getElementById('pelangganId').value = id;
            document.getElementById('pembayaranDetails').innerText =
                `Nama Pelanggan: ${namaPlg}\nHarga Paket: Rp. ${hargaPaket}`;

            var form = document.getElementById('bayarForm');
            form.action = `/pelanggan/${id}/bayar`; // Set action URL with the ID

            var bayarModal = new bootstrap.Modal(document.getElementById('bayarModal'));
            bayarModal.show();
        }
    </script>


@extends('layout')

@section('konten')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan Total Harian
                                </div>
                                <div class="h5 mb-0 mr-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totaljumlahsaldo, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2 text-xs font-weight-bold text-uppercase"><i
                                            class="fas fa-arrow-up"></i>
                                        {{ $totalUserHarian }}</span>
                                    <span class="text-xs font-weight-bold text-uppercase">Total User</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total USer Membayar harian
                                    </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalPendapatanharian, 0, ',', '.') }}</div>
                                <!-- Menampilkan pendapatan dengan format rupiah -->
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2 text-xs font-weight-bold text-uppercase"><i
                                            class="fa fa-arrow-up"></i>
                                        {{ $totalJumlahPengguna }}</span>
                                    <span class="text-xs font-weight-bold text-uppercase">Jumlah
                                        Pelanggan</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total
                                    Registrasi Baru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalRegistrasi, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2 text-xs font-weight-bold text-uppercase"><i
                                            class="fas fa-arrow-up"></i>
                                        {{ $pelangganoforang }}</span>
                                    <span class="text-xs font-weight-bold text-uppercase">Jumlah Pelanggan
                                        Off</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Pemasukan Lain-lain
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2 text-xs font-weight-bold text-uppercase"><i
                                            class="fas fa-arrow-down"></i>
                                        {{ $pelanggan_of }}</span>
                                    <span class="text-xs font-weight-bold text-uppercase ">Pelanggan
                                        Off</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-8">
                <div class="card mb-20">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Pendapatan Perbulan</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>

                            <script>
                                // Fungsi untuk format angka (misalnya untuk Rupiah)
                                function number_format(number, decimals, dec_point, thousands_sep) {
                                    number = (number + '').replace(',', '').replace(' ', '');
                                    var n = !isFinite(+number) ? 0 : +number,
                                        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                                        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                                        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                                        s = '',
                                        toFixedFix = function(n, prec) {
                                            var k = Math.pow(10, prec);
                                            return '' + Math.round(n * k) / k;
                                        };
                                    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                                    if (s[0].length > 3) {
                                        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                                    }
                                    if ((s[1] || '').length < prec) {
                                        s[1] = s[1] || '';
                                        s[1] += new Array(prec - s[1].length + 1).join('0');
                                    }
                                    return s.join(dec);
                                }

                                // Data pendapatan bulanan dari PHP yang di-convert ke JavaScript
                                var dataPendapatan = @json($dataPendapatan);

                                // Inisialisasi chart
                                var ctx = document.getElementById("myAreaChart");
                                var myLineChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                        datasets: [{
                                            label: "Pendapatan",
                                            lineTension: 0.3,
                                            backgroundColor: "rgb(255,255,255)",
                                            borderColor: "rgba(78, 115, 223, 1)",
                                            pointRadius: 3,
                                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                            pointBorderColor: "rgba(78, 115, 223, 1)",
                                            pointHoverRadius: 3,
                                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                            pointHitRadius: 10,
                                            pointBorderWidth: 2,
                                            data: Object.values(dataPendapatan), // Data dari controller
                                        }],
                                    },
                                    options: {
                                        maintainAspectRatio: false,
                                        layout: {
                                            padding: {
                                                left: 10,
                                                right: 25,
                                                top: 25,
                                                bottom: 0
                                            }
                                        },
                                        scales: {
                                            xAxes: [{
                                                time: {
                                                    unit: 'date'
                                                },
                                                gridLines: {
                                                    display: false,
                                                    drawBorder: false
                                                },
                                                ticks: {
                                                    maxTicksLimit: 12
                                                }
                                            }],
                                            yAxes: [{
                                                ticks: {
                                                    maxTicksLimit: 5,
                                                    padding: 10,
                                                    // Format Rupiah di axis Y
                                                    callback: function(value, index, values) {
                                                        return 'Rp' + number_format(value);
                                                    }
                                                },
                                                gridLines: {
                                                    color: "rgb(234, 236, 244)",
                                                    zeroLineColor: "rgb(234, 236, 244)",
                                                    drawBorder: false,
                                                    borderDash: [2],
                                                    zeroLineBorderDash: [2]
                                                }
                                            }],
                                        },
                                        legend: {
                                            display: false
                                        },
                                        tooltips: {
                                            backgroundColor: "rgb(255,255,255)",
                                            bodyFontColor: "#858796",
                                            titleMarginBottom: 10,
                                            titleFontColor: '#6e707e',
                                            titleFontSize: 14,
                                            borderColor: '#dddfeb',
                                            borderWidth: 1,
                                            xPadding: 15,
                                            yPadding: 15,
                                            displayColors: false,
                                            intersect: false,
                                            mode: 'index',
                                            caretPadding: 10,
                                            callbacks: {
                                                label: function(tooltipItem, chart) {
                                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                                    return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div> <br>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-8">
                <div class="card p-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Pendapatan Harian</h6>
                    </div>
                    <div class="card-body">
                        <!-- Form filter tanggal mulai dan akhir -->
                        <form action="{{ route('index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                        value="{{ request('tanggal_mulai') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_akhir">Tanggal Akhir:</label>
                                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                        value="{{ request('tanggal_akhir') }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <br>

                        <!-- Informasi pendapatan harian -->
                        <div class="">
                            <div class="text font-weight-bold text-black">Total Pendapatan :
                                <div class="h6 float-right"><b>Rp
                                        {{ number_format($totalPendapatanharian, 0, ',', '.') }}</b></div>
                            </div>
                            <div class="text font-weight-bold mt-2">Jumlah User Yang Membayar :
                                <div class="h6 float-right"><b>{{ $totalUserHarian }} User</b></div>
                            </div>
                        </div>
                        <br>
                    </div><br>
                </div>
            </div>



            <script>
                document.getElementById('showMoreBtn').addEventListener('click', function(event) {
                    event.preventDefault();
                    var extraPaket = document.getElementById('extraPaket');
                    if (extraPaket.style.display === "none") {
                        extraPaket.style.display = "block";
                        this.textContent = "Sembunyikan Data";
                    } else {
                        extraPaket.style.display = "none";
                        this.textContent = "Lihat Lebih Banyak";
                    }
                });
            </script>




            <!-- Teknisi Perbaikan -->
            <div class="col-xl-12 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">TEKNISI - Pemasangan dan Perbaikan
                        </h6>
                        <a class="m-0 float-right btn btn-danger btn-sm" href="/perbaikan">Lihat Semua <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <!-- Tabel Perbaikan -->
                        <table class="table table-bordered">
                            <thead class="table table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>ID Pel</th>
                                    <th>Nama Pel</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Paket</th>
                                    <th>Odp</th>
                                    <th>Maps</th>
                                    <th>Teknisi</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($perbaikans as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $item->id_plg }}</td>
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
                                        <td colspan="12" class="text-center">Tidak ada data ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <!--Row-->


            <!-- Modal Logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to logout?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            <a href="/logout" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!---Container Fluid-->
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> - developed by
                    <b><a href="" target="_blank">NetNet Digital Group</a></b>
                </span>
            </div>
        </div>
    </footer>
@endsection

@extends('layout')

@section('konten')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h4 class="h2\ mb-0 text-black">Dashboard</h4>
            <ol class="breadcrumb">
                <!-- Jam Berjalan -->
                <div class="h5 text font-weight-bold">
                    JAM : <span id="liveClock"></span>
                </div>

            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-biru h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text text-white font-weight-bold text-uppercase mb-1">Pendapatan Total Harian
                                </div>
                                <div class=" h5 mb-0 mr-0 font-weight-bold text-white font-bold">Rp
                                    {{ number_format($totaljumlahsaldo, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="mr-2 text-bold font-bold text-white text-uppercase"><i
                                            class="text text-white text-bold fas fa-arrow-up"></i>
                                        {{ $totalUserHarian }}</span>
                                    <span class="text text-white font-weight-bold text-uppercase">Total User</span>
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
                <div class="card-hijau h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" text text-white font-weight-bold text-uppercase mb-1">Total Semua USer yang
                                    Membayar
                                    hari ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text text-white">Rp
                                    {{ number_format($totalPendapatanharian_semua, 0, ',', '.') }}</div>
                                <!-- Menampilkan pendapatan dengan format rupiah -->
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text text-white mr-2 font-weight-bold text-uppercase"><i
                                            class="text text-white fa fa-arrow-up"></i>
                                        {{ $totalUserHarian_semua }}</span>
                                    <span class="text text-white  font-weight-bold text-uppercase">Jumlah
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
                <div class="card-kuning h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-white font-weight-bold text-uppercase mb-1">Total
                                    Registrasi Baru</div>
                                <div class="h5 mb-0 font-weight-bold text-white">Rp
                                    {{ number_format($totalRegistrasi, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted text-white">
                                    <span class=" mr-2 text-white font-weight-bold text-uppercase"><i
                                            class="fas fa-arrow-up"></i>
                                        {{ $pelangganoforang }}</span>
                                    <span class="text-white font-weight-bold text-uppercase">Jumlah Pelanggan
                                        Off</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-merah h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-white font-weight-bold text-uppercase mb-1">
                                    Pemasukan Lain-lain
                                </div>
                                <div class="text-white h5 mb-0 font-weight-bold">
                                    {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted text-white">
                                    <span class="text-white mr-2  font-weight-bold text-uppercase"><i
                                            class="text-white fas fa-arrow-down"></i>
                                        {{ $pelanggan_of }}</span>
                                    <span class="text-white font-weight-bold text-uppercase ">Pelanggan
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
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Pendapatan Harian</h6>
                    </div>
                    <div class="card-body">
                        <!-- Form filter tanggal dan jam mulai serta akhir -->
                        <div class="col mr-2">
                            <div class="text text-white font-weight-bold text-uppercase mb-1">Total Pendapatan Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text text-white">Rp
                                {{ number_format($totalPendapatan, 0, ',', '.') }}</div>

                            <div class="mt-2 mb-0 text-muted">
                                <span class="text text-white mr-2 font-weight-bold text-uppercase">
                                    <i class="text text-white fa fa-arrow-up"></i>
                                    {{ $jumlahUserMembayarHariIni }} Pembayaran Hari Ini
                                </span>
                                <span class="text text-white font-weight-bold text-uppercase">Jumlah Pelanggan:
                                    {{ $totalPendapatanharian_semua }}</span>
                            </div>

                            <div>
                                <canvas id="persentaseLingkaran"></canvas>
                            </div>
                        </div>

                        <script>
                            var ctx = document.getElementById('persentaseLingkaran').getContext('2d');
                            var persentase = {{ $persentasePembayaran }};
                            var chart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Pembayaran', 'Belum Pembayaran'],
                                    datasets: [{
                                        label: 'Persentase Pembayaran',
                                        data: [persentase, 100 - persentase],
                                        backgroundColor: ['#36A2EB', '#FF6384'],
                                        borderColor: ['#FFFFFF', '#FFFFFF'],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });
                        </script>

                        <br>

                        <!-- Informasi pendapatan harian -->
                        <div class="">
                            <div class="text font-weight-bold">
                                Tanggal: {{ now()->format('d/m/Y') }}
                            </div>



                            <div class="text font-weight-bold text-black">Total Pendapatan:
                                <div class="h6 float-right"><b>Rp
                                        {{ number_format($totalPendapatanharian, 0, ',', '.') }}</b></div>
                            </div>
                            <div class="text font-weight-bold mt-2">Jumlah User Yang Membayar:
                                <div class="h6 float-right"><b>{{ $totaluserhasilfilter }} User</b></div>
                            </div>
                        </div>

                        <!-- JavaScript untuk Jam Berjalan -->
                        <script>
                            function updateClock() {
                                const now = new Date();
                                const hours = String(now.getHours()).padStart(2, '0');
                                const minutes = String(now.getMinutes()).padStart(2, '0');
                                const seconds = String(now.getSeconds()).padStart(2, '0');
                                const currentTime = hours + ':' + minutes + ':' + seconds;
                                document.getElementById('liveClock').textContent = currentTime;
                            }

                            setInterval(updateClock, 1000); // Update setiap 1 detik
                            updateClock(); // Panggil fungsi saat halaman dimuat
                        </script>


                        <br>
                    </div><br>
                </div>
            </div>







            <!-- Teknisi Perbaikan -->
            <div class="col-xl-8 col-lg-3">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Persentase Pembayaran
                        </h6>
                        <a class="m-0 float-right btn btn-danger btn-sm" href="/bayar-pelanggan">Lihat Semua <i
                                class="fas fa-chevron-right"></i></a>
                    </div>

                    <div class="p-3">
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
                                <div class="col-md-6">
                                    <label for="jam_mulai">Jam Mulai:</label>
                                    <input type="time" id="jam_mulai" name="jam_mulai" class="form-control"
                                        value="{{ request('jam_mulai') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="jam_akhir">Jam Akhir:</label>
                                    <input type="time" id="jam_akhir" name="jam_akhir" class="form-control"
                                        value="{{ request('jam_akhir') }}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>



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

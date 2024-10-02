@extends('superadmin.layout_superadmin')

@section('konten')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">


        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-biru h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text text-white font-weight-bold text-uppercase mb-1">Pendapatan Total Harian -
                                    Pengeluaran
                                </div>
                                <div class=" h5 mb-0 mr-0 font-weight-bold text-white font-bold">Rp
                                    {{ number_format($totaljumlahsaldo, 0, ',', '.') }}</div>
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text text-white font-weight-bold text-uppercase">Cash :</span>
                                    <span
                                        class="text text-white font-weight-bold text-uppercase">{{ $totalUserHarian }}</span>

                                    <span class="text text-white font-weight-bold text-uppercase"> User</span>
                                </div>
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
                                <div class=" text text-white font-weight-bold text-uppercase mb-1">Total Semua User yang
                                    Membayar
                                    hari ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text text-white">Rp
                                    {{ number_format($totalPendapatanharian_semua, 0, ',', '.') }}</div>
                                <!-- Menampilkan pendapatan dengan format rupiah -->
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text text-white font-weight-bold text-uppercase">Semua :</span>
                                    <span class="text text-white mr-2 font-weight-bold text-uppercase"><i
                                            class="text text-white"></i>
                                        {{ $totalUserHarian_semua }}</span>
                                    <span class="text text-white  font-weight-bold text-uppercase">User
                                    </span>
                                </div>
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
                                <div class="text-white font-weight-bold text-uppercase mb-1">
                                    Total Tagihan Hari ini
                                </div>
                                <!-- Menampilkan total tagihan hari ini dengan format rupiah -->
                                <div class="text-white h5 mb-0 font-weight-bold">
                                    Rp {{ number_format($totalTagihanHariIni, 0, ',', '.') }}
                                </div>

                                <div class="mt-2 mb-0 text-muted text-white">
                                    <span class="mr-2 text-white font-weight-bold text-uppercase">
                                        <span class="text text-white font-weight-bold text-uppercase">Total :</span>
                                        {{ $jumlahPelangganMembayarHariIni }}
                                    </span>
                                    <span class="text-white font-weight-bold text-uppercase">User
                                    </span>
                                </div>
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
                                <div class="text-white font-weight-bold text-uppercase mb-1">Total
                                    Jumlah yang belum tertagih</div>
                                <div class="h5 mb-0 font-weight-bold text-white">Rp
                                    {{ number_format($totalTagihanTertagih, 0, ',', '.') }}
                                </div>

                                <div class="mt-2 mb-0 text-muted text-white">
                                    <span class="text text-white font-weight-bold text-uppercase">Belum Tertagih :</span>
                                    <span class="mr-2 text-white font-weight-bold text-uppercase">

                                        {{ $totalUserTertagih }}
                                    </span>
                                    <span class="text-white font-weight-bold text-uppercase">User
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Area Chart -->
            <!-- Chart Bar dan Line -->
            <div class="col-xl-8 col-lg-8">
                <div class="pt-5  pb-5 card mb-20">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Pendapatan Harian</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="pendapatanChart" width="1000" height="500"></canvas>
                            <!-- Untuk Bar/Line Chart -->
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <br> <br> <br>
            <!-- Pie Chart -->
            <div class="card-biru col-xl-4 col-lg-8 ">
                <div class="p-3 mb-2">
                    <div class="card-kuning py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 pl-3 font-weight-bold text-white">Persentase Pembayaran</h6>
                    </div>
                    <div class="chart-area">
                        <canvas id="myPieChart"></canvas> <!-- Untuk Pie Chart -->
                    </div>
                    <div class="mt-3 ml-2 card-kuning py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 pl-3 font-weight-bold text-white">Total Tagihan <div
                                class="text-white h5 mb-0 font-weight-bold">
                                Rp {{ number_format($totalTagihanHariIni, 0, ',', '.') }}
                            </div>
                        </h6>
                        <h6 class="mr-4 pl-3 font-weight-bold text-white">Baru Terbayar <div
                                class="text-white h5 mb-0 font-weight-bold">
                                Rp {{ number_format($totalPendapatanharian_semua, 0, ',', '.') }}
                            </div>


                    </div>

                </div>
            </div>


            <!-- Script untuk Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                // Data dari backend (controller Laravel) untuk chart batang/garis
                const labels = @json($labels); // Label untuk tanggal (1-30)
                const totalUsers = @json($totalUsers); // Jumlah user per tanggal
                const totalPembayaran = @json($totalPembayaran); // Total pembayaran per tanggal

                // Inisialisasi Bar dan Line Chart
                const ctx1 = document.getElementById('pendapatanChart').getContext('2d');
                const pendapatanChart = new Chart(ctx1, {
                    type: 'bar', // Tipe chart batang (bar)
                    data: {
                        labels: labels, // Label (Tanggal 1-30)
                        datasets: [{
                                label: 'Jumlah Pengguna Bayar',
                                data: totalUsers, // Data jumlah pengguna per hari
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna batang
                                borderColor: 'rgba(75, 192, 192, 1)', // Warna border batang
                                borderWidth: 1
                            },
                            {
                                label: 'Total Pembayaran (Rp)',
                                data: totalPembayaran, // Data total pembayaran per hari
                                backgroundColor: 'rgba(153, 102, 255, 0.2)', // Warna grafik garis
                                borderColor: 'rgba(153, 102, 255, 1)', // Warna border garis
                                borderWidth: 1,
                                type: 'line' // Grafik tipe garis (line)
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Memulai grafik dari 0 pada sumbu Y
                            }
                        }
                    }
                });

                // Data untuk Pie Chart
                var totalTagihanHariIni = @json($totalTagihanHariIni); // Total tagihan hari ini
                var totalPendapatanharian_semua = @json($totalPendapatanharian_semua); // Total pendapatan harian semua

                // Inisialisasi Pie Chart
                var ctx2 = document.getElementById("myPieChart").getContext('2d');
                var myPieChart = new Chart(ctx2, {
                    type: 'doughnut', // Menggunakan tipe doughnut untuk lingkaran persentase
                    data: {
                        labels: ["Belum Tertagih", "Sudah Tertagih"], // Label untuk chart
                        datasets: [{
                            data: [totalTagihanHariIni - totalPendapatanharian_semua,
                                totalPendapatanharian_semua
                            ], // Data dari controller
                            backgroundColor: ['#e74c3c', '#4e73df'], // Warna untuk bagian chart
                            hoverBackgroundColor: ['#c0392b', '#2e59d9'], // Warna saat di-hover
                            hoverBorderColor: "rgba(234, 236, 244, 1)", // Border saat di-hover
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                    var total = dataset.data.reduce(function(previousValue, currentValue) {
                                        return previousValue + currentValue;
                                    });
                                    var currentValue = dataset.data[tooltipItem.index];
                                    var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                    return data.labels[tooltipItem.index] + ': ' + percentage + '%';
                                }
                            }
                        },
                        legend: {
                            display: true, // Tampilkan legenda untuk menjelaskan chart
                            position: 'bottom' // Posisi legenda di bawah chart
                        },
                        cutoutPercentage: 70, // Persentase ruang di tengah lingkaran (untuk tipe doughnut)
                    }
                });
            </script>



            <!-- Teknisi Perbaikan -->
            <div class="col-xl-8 col-lg-3 ">
                <div class="mt-3 p-4 card-kuning">
                    <div class="card-kuning py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-white"> Filter Pendapatan
                        </h6>
                        <a class="m-0 float-right btn btn-danger btn-sm" href="/bayar-pelanggan">Lihat Semua <i
                                class="fas fa-chevron-right"></i></a>
                    </div>

                    <div class="">
                        <form action="{{ route('index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tanggal_mulai" class="text-white">Tanggal Mulai:</label>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                        value="{{ request('tanggal_mulai') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_akhir" class="text-white">Tanggal Akhir:</label>
                                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                        value="{{ request('tanggal_akhir') }}">
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form> <br>

                        <!-- Informasi pendapatan harian -->
                        <div class="">




                            <div class="text font-weight-bold text-white">Total Pendapatan :
                                <div class="h6 float-right"><b>Rp
                                        {{ number_format($totalPendapatanharian, 0, ',', '.') }}</b></div>
                            </div>
                            <div class="text font-weight-bold mt-2 text-white">Jumlah User Yang Membayar :
                                <div class="h6 float-right text-white"><b>{{ $totaluserhasilfilter }} User</b></div>
                            </div>
                        </div>

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
    <br><br>
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

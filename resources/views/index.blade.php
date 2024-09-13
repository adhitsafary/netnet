<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('template2/img/logo/logo.png') }}" rel="icon">
    <title>NetNet - Blank Page</title>
    <link href="{{ asset('template2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template2/css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('template2/img/logo/logo2.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">NetNet Digital</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Pelanggan
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                    aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Pelanggan</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pelanggan</h6>
                        <a class="collapse-item" href="/pelanggan">Pelanggan</a>
                        <a class="collapse-item" href="/pelangganof">Pelanggan OFF</a>
                        <a class="collapse-item" href="{{ route('pelanggan.create') }}">Tambah Pelanggan Baru</a>

                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Perbaikan
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
                    aria-expanded="true" aria-controls="collapseBootstrap1">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Perbaikan</span>
                </a>
                <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap1"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{ route('perbaikan.create') }}">Buat Pemasangan / Perbaikan</a>
                        <a class="collapse-item" href="/perbaikan/">Pemasangan / Perbaikan</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Pembayaran
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-columns"></i>
                    <span>History Pembayaran</span>
                </a>
                <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="/bayar-pelanggan">Riwayat Pembayaran</a>
                        <a class="collapse-item" href="/send-message">Peringatan Chat</a>
                        <!-- <a class="collapse-item" href="/pembayaran">Belum bayar</a> -->

                    </div>
                </div>
            </li>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small"
                                            placeholder="What do you want to look for?" aria-label="Search"
                                            aria-describedby="basic-addon2" style="border-color: #b53f3f;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">November 12, 2024 </div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">November 12, 2024 9</div>
                                        Spending Alert: We've noticed unusually high
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">November 12, 2024 </div>
                                        Spending Alert: We've noticed unusually high
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-warning badge-counter">2</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{ asset('template2/img/man.png') }}"
                                            style="max-width: 60px" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been
                                            having.</div>
                                        <div class="small text-gray-500">Udin Cilok · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/girl.png" style="max-width: 60px"
                                            alt="">
                                        <div class="status-indicator bg-default"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people
                                            say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Jaenab · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-tasks fa-fw"></i>
                                <span class="badge badge-success badge-counter">3</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Pekerjaan Team
                                </h6>
                                <a class="dropdown-item align-items-center" href="#">
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Develope Frontend
                                            <div class="small float-right"><b>50%</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="#">Lihat
                                    Semua</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{ asset('/template2/img/boy.png') }}"
                                    style="max-width: 60px">
                                <div class="ml-2 d-none d-lg-inline text-white small">
                                    <ul class="list-group list-group-flush" style="background-color: transparent;">
                                        @if (Auth::user()->role == 'teknisi')
                                            <li class="list-group-item"
                                                style="background-color: transparent; border: none; color: white; font-weight: bold;">
                                                Menu Teknisi</li>
                                        @endif
                                        @if (Auth::user()->role == 'admin')
                                            <li class="list-group-item"
                                                style="background-color: transparent; border: none; color: white; font-weight: bold;">
                                                Menu Admin</li>
                                        @endif
                                        @if (Auth::user()->role == 'superadmin')
                                            <li class="list-group-item"
                                                style="background-color: transparent; border: none; color: white; font-weight: bold;">
                                                Menu SuperAdmin</li>
                                        @endif
                                    </ul>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
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
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan Total
                                            </div>
                                            <div class="h5 mb-0 mr-0 font-weight-bold text-gray-800">Rp
                                                {{ number_format($totalpendapatanakhir, 0, ',', '.') }}</div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span
                                                    class="text-success mr-2 text-xs font-weight-bold text-uppercase"><i
                                                        class="fas fa-arrow-up"></i>
                                                    {{ $totaluser }}</span>
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
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan
                                                (Bulanan)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                                {{ number_format($totalPendapatanBulanan, 0, ',', '.') }}</div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span
                                                    class="text-success mr-2 text-xs font-weight-bold text-uppercase"><i
                                                        class="fa fa-arrow-up "></i>
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
                                                Pelanggan off</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                                {{ number_format($pelangganofuang, 0, ',', '.') }}</div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span
                                                    class="text-success mr-2 text-xs font-weight-bold text-uppercase"><i
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
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pelanggan Off
                                                Bulan Kemarin
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($pelanggan_of_uang, 0, ',', '.') }}</div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span
                                                    class="text-danger mr-2 text-xs font-weight-bold text-uppercase"><i
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
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan Perbulan</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
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
                            </div>
                        </div>
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card mb-3">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan Harian</h6>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <div class="small text-gray-500">Total Pendapatan Hari Ini:
                                            <div class="small float-right"><b>Rp
                                                    {{ number_format($totalPendapatan, 0, ',', '.') }}</b></div>
                                        </div>
                                        <div class="small text-gray-500">Jumlah User Membayar Hari Ini:
                                            <div class="small float-right"><b>{{ $totalUserHarian }} User</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Paket Terjual</h6>
                                </div>
                                <div class="card-body">
                                    @foreach ($paketTop5 as $paket)
                                        @php
                                            // Hitung persentase user dari total user
                                            $percentage = ($paket->total_user / $totalUsers) * 100;
                                        @endphp
                                        <div class="mb-3">
                                            <div class="small text-gray-500">Harga
                                                {{ number_format($paket->harga_paket, 0, ',', '.') }}
                                                <div class="small float-right"><b>{{ $paket->total_user }} User</b>
                                                </div>
                                            </div>
                                            <div class="progress" style="height: 12px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $percentage }}%"
                                                    aria-valuenow="{{ $paket->total_user }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div id="extraPaket" style="display:none;">
                                        @foreach ($paketRemaining as $paket)
                                            @php
                                                // Hitung persentase user dari total user
                                                $percentage = ($paket->total_user / $totalUsers) * 100;
                                            @endphp
                                            <div class="mb-3">
                                                <div class="small text-gray-500">Paket {{ $paket->harga_paket }}
                                                    <div class="small float-right"><b>{{ $paket->total_user }}
                                                            User</b></div>
                                                </div>
                                                <div class="progress" style="height: 12px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: {{ $percentage }}%"
                                                        aria-valuenow="{{ $paket->total_user }}" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="m-0 small text-primary card-link" href="#" id="showMoreBtn">Lihat
                                        Lebih Banyak <i class="fas fa-chevron-right"></i></a>
                                </div>
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
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">TEKNISI - Pemasangan dan Perbaikan
                                    </h6>
                                    <a class="m-0 float-right btn btn-danger btn-sm" href="/perbaikan">Lihat Semua <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Pelanggan</th>
                                                <th>No Telpon</th>
                                                <th>Kasus</th>
                                                <th>Teknisi</th>
                                                <th>Alamat</th>
                                                <th>ODP</th>
                                                <th>maps</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perbaikans as $perbaikan)
                                                <tr>
                                                    <td>{{ $perbaikan->id_plg }}</td>
                                                    <td>{{ $perbaikan->nama_plg }}</td>
                                                    <td>{{ $perbaikan->no_telepon_plg }}</td>
                                                    <td>{{ $perbaikan->keterangan }}</td>
                                                    <td>{{ $perbaikan->teknisi }}</td>
                                                    <td>{{ $perbaikan->alamat_plg }}</td>
                                                    <td>{{ $perbaikan->odp }}</td>
                                                    <td>{{ $perbaikan->maps }}</td>

                                                </tr>
                                            @endforeach
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
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to logout?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary"
                                            data-dismiss="modal">Cancel</button>
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
                                <b><a href="" target="_blank">Adit Safari</a></b>
                            </span>
                        </div>
                    </div>
                </footer>

                <!-- Footer -->
            </div>
        </div>

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="{{ asset('template2/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('template2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('template2/js/ruang-admin.min.js') }}"></script>
        <script src="{{ asset('template2/vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('template2/js/demo/chart-area-demo.js') }}"></script>
</body>

</html>

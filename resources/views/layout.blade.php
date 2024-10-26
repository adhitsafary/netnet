<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('template2/img/logo/logo.png') }}" rel="icon">
    <title>NetDigitalGroup</title>
    <link href="{{ asset('template2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template2/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template2/css/ruang-admin.min.css') }}">

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/masuk/admin">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('template2/img/logo/logo2.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">Net Digital Group</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="/masuk/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                    aria-expanded="true" aria-controls="collapseBootstrap1">
                    <img src="{{ asset('asset/img/pelanggan.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class="font-weight-bold " style="color: black">PELANGGAN</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap1"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded font-weight-bold" style="color: black">
                        <a class="collapse-item" href="/pelanggan">PELANGGAN AKTIF</a>
                        <a class="collapse-item" href="/pelanggan/isolir/">PELANGGAN ISOLIR</a>
                        <a class="collapse-item" href="/pelanggan/unblock/">PELANGGAN Unblock</a>
                        <a class="collapse-item" href="/pelanggan/block/">PELANGGAN Block</a>
                        <a class="collapse-item" href="/pelanggan/psb/">PELANGGAN PSB</a>
                        <a class="collapse-item" href="/pelanggan/reactivasi/">PELANGGAN Reactivasi</a>
                        <a class="collapse-item" href="/pelangganof/">PELANGGAN OFF</a>
                        <a class="collapse-item" href="pelanggan/bayar">Pelanggan Bayar sendiri</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap13"
                    aria-expanded="true" aria-controls="collapseBootstrap13">
                    <img src="{{ asset('asset/img/baru.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">Rekap Pemasangan</span>
                </a>
                <div id="collapseBootstrap13" class="collapse" aria-labelledby="headingBootstrap13"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded font-weight-bold" style="color: black">
                        <a class="collapse-item" href="/rekap_pemasangan/">Riwayat Pemasangan</a>
                        <a class="collapse-item" href="/rekap_pemasangan/create">Buat Form Pemasangan</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
                    aria-expanded="true" aria-controls="collapseBootstrap1">
                    <img src="{{ asset('asset/img/perbaikan.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">PSB dan Perbaikan</span>
                </a>
                <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap1"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded font-weight-bold" style="color: black">

                        <a class="collapse-item" href="/perbaikan/">Pemasangan - Perbaikan</a>
                        <a class="collapse-item" href="{{ route('perbaikan.create') }}">Buat PSB dan PERBAIKAN</a>
                        <a class="collapse-item" href="{{ route('psb.create') }}">Buat PSB dan Perbaikan Costume</a>


                    </div>
                </div>
            </li>





            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseBootstrap12" aria-expanded="true" aria-controls="collapseBootstrap12">
                    <img src="{{ asset('asset/img/pengeluaran.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">Pmsukan Pgeluarn</span>
                </a>
                <div id="collapseBootstrap12" class="collapse" aria-labelledby="headingBootstrap12"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded font-weight-bold" style="color: black">
                        <a class="collapse-item" href="/pemasukan/">Riwayat Pemasukan</a>
                        <a class="collapse-item" href="/pengeluaran/">Riwayat Pengeluaran</a>
                        <a class="collapse-item" href="/pemasukan/create">Buat Pemasukan</a>
                        <a class="collapse-item" href="/pengeluaran/create">Buat Pengeluaran</a>


                    </div>
                </div>
            </li>




            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <img src="{{ asset('asset/img/pembayaran.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">RIWAYAT</span>
                </a>
                <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded font-weight-bold" style="color: black">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="/pembayaran">Riwayat Pembayaran</a>

                        <a class="collapse-item" href="/rekap-harian/">Rekap harian</a>

                        <!-- <a class="collapse-item" href="/pembayaran">Belum bayar</a> -->

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseBootstrap17" aria-expanded="true" aria-controls="collapseBootstrap17">
                    <img src="{{ asset('asset/img/update.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">Update DATA</span>
                </a>
                <div id="collapseBootstrap17" class="collapse" aria-labelledby="headingBootstrap17"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded  font-weight-bold" style="color: black">

                        <a class="collapse-item" href="/update-payment-status">UPDATE STATUS PEMBAYARAN</a>
                    </div>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseBootstrap18" aria-expanded="true" aria-controls="collapseBootstrap18">
                    <img src="{{ asset('asset/img/target.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">Target Perusahaan</span>
                </a>
                <div id="collapseBootstrap18" class="collapse" aria-labelledby="headingBootstrap17"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded  font-weight-bold" style="color: black">

                        <a class="collapse-item" href="/target">Target</a>
                    </div>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseBootstrap19" aria-expanded="true" aria-controls="collapseBootstrap19">
                    <img src="{{ asset('asset/img/wa.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">BOT Whatsapp</span>
                </a>
                <div id="collapseBootstrap19" class="collapse" aria-labelledby="headingBootstrap17"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded  font-weight-bold" style="color: black">

                        <a class="collapse-item" href="/send-message">Tagihan WA BOT</a>
                        <a class="collapse-item" href="/peringatan">Reminder WA BOT</a>
                    </div>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseBootstrap20" aria-expanded="true" aria-controls="collapseBootstrap20">
                    <img src="{{ asset('asset/img/folder.png') }}" alt="Gambar Pelanggan"
                        style="width: 30px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">File</span>
                </a>
                <div id="collapseBootstrap20" class="collapse" aria-labelledby="headingBootstrap17"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded  font-weight-bold" style="color: black">
                        <a class="collapse-item" href="/file/index">File</a>
                    </div>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseBootstrap21" aria-expanded="true" aria-controls="collapseBootstrap21">
                    <img src="{{ asset('asset/img/pemberitahuan.png') }}" alt="Gambar Pelanggan"
                        style="width: 50px; height: auto; margin-left: 10px;" class="mr-2">
                    <span class=" font-weight-bold">Pemberitahuan</span>
                </a>
                <div id="collapseBootstrap21" class="collapse" aria-labelledby="headingBootstrap17"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded  font-weight-bold" style="color: black">
                        <a class="collapse-item" href="/pemberitahuan">Pemberitahuan</a>
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
                            <div class="dropdown-menu dropdown-menu-right  shadow animated--grow-in"
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
                                        <div class="small text-gray-500">NET DIGITAL GROUP </div>
                                        <span class="font-weight-bold">NET DIGITAL GROUP</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">NET DIGITAL GROUP</div>
                                        NET DIGITAL GROUP
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">NET DIGITAL GROUP</div>
                                        NET DIGITAL GROUP
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">NET DIGITAL
                                    GROUP</a>
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
                                        <div class="text-truncate">NET DIGITAL GROUP.</div>
                                        <div class="small text-gray-500">NET DIGITAL GROUP</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/girl.png" style="max-width: 60px"
                                            alt="">
                                        <div class="status-indicator bg-default"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">NET DIGITAL GROUP</div>
                                        <div class="small text-gray-500">JNET DIGITAL GROUP</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                </a>
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
                                <div class="ml-2 mt-4 d-none d-lg-inline text-white small">
                                    @if (Auth::check())
                                        {{-- Mengecek apakah pengguna sudah login --}}
                                        <span style="font-weight: bold; color: white;">{{ Auth::user()->name }}</span>
                                        {{-- Tampilkan nama pengguna --}}
                                        <ul class="list-group list-group-flush"
                                            style="background-color: transparent;">
                                            @if (Auth::user()->role == 'teknisi')
                                                <li class="list-group-item"
                                                    style="background-color: transparent; border: none; color: white; font-weight: bold;">

                                                </li>
                                            @endif

                                            @if (Auth::user()->role == 'admin')
                                                <li class="list-group-item"
                                                    style="background-color: transparent; border: none; color: white; font-weight: bold;">

                                                </li>
                                            @endif

                                            @if (Auth::user()->role == 'superadmin')
                                                <li class="list-group-item"
                                                    style="background-color: transparent; border: none; color: white; font-weight: bold;">

                                                </li>
                                            @endif
                                        </ul>
                                    @else
                                        {{-- Pengalihan atau pesan error jika pengguna belum login --}}
                        <li class="list-group-item" style="background-color: transparent; border: none; color: red;">
                            Silakan login untuk melihat menu.
                        </li>
                        {{-- Bisa juga dialihkan ke halaman login --}}
                        <script>
                            window.location.href = "{{ route('login') }}";
                            {{-- Mengalihkan ke halaman login --}}
                        </script>
                        @endif
            </div>
            </a>


            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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



            <div class="mr-4 d-sm-flex align-items-center justify-content-between">
                <h4 class="h2" style="color: black;"></h4>
                <ol class="breadcrumb">
                    <!-- Jam Berjalan -->
                    <div class="h4 font-weight-bold mr-3" style="color: black;">
                        <span id="liveClock"></span>
                    </div>
                    <div class="h4 font-weight-bold" style="color: black;">
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </div>


                    <script>
                        function updateClock() {
                            const now = new Date();
                            const hours = String(now.getHours()).padStart(2, '0');
                            const minutes = String(now.getMinutes()).padStart(2, '0');
                            const seconds = String(now.getSeconds()).padStart(2, '0');
                            const formattedTime = `${hours}:${minutes}:${seconds}`;
                            document.getElementById('liveClock').textContent = formattedTime;
                        }

                        // Update jam setiap detik
                        setInterval(updateClock, 1000);
                        updateClock(); // Panggil fungsi segera untuk menampilkan waktu saat ini tanpa menunggu 1 detik
                    </script>
                </ol>
            </div>

            <!-- Topbar -->

            <!-- Container Fluid-->
            @yield('konten')
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Bootstrap 5 CSS -->

    <!-- Bootstrap 5 JS Bundle (termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    </div>


</body>

</html>

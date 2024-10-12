<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPK Rekomendasi Jurusan - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-database"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Profile Matching<sup>SPK</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            @if(auth()->user()->level == 0)
            <!-- Nav Item - Data Siswa -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('d_siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Data Siswa</span>
                </a>
            </li>

            <!-- Nav Item - m_kriteria -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('m_kriteria.index') }}">
                    <i class="fas fa-cube"></i>
                    <span>Data Kriteria</span>
                </a>
            </li>

            <!-- Nav Item - m_sub_kriteria -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('m_sub_kriteria.index') }}">
                    <i class="fas fa-cube"></i>
                    <span>Data Sub Kriteria</span>
                </a>
            </li>

            <!-- Nav Item - m_jurusan -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('m_jurusan.index') }}">
                    <i class="fas fa-cube"></i>
                    <span>Data Jurusan</span>
                </a>
            </li>

            <!-- Nav Item - Data Alternatif -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('t_profile_jurusan.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Data Profile Jurusan</span>
                </a>
            </li>

            <!-- Nav Item - Data Penilaian -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('t_nilai_siswa.index') }}">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Data Nilai siswa</span>
                </a>
            </li>

            <!-- Nav Item - Data Perhitungan -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('perhitungan') }}">
                    <i class="fas fa-calculator"></i>
                    <span>Data Perhitungan</span>
                </a>
            </li>

            <!-- Nav Item - Data Hasil Akhir -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('t_hasil_akhir.index') }}">
                    <i class="fa fa-bar-chart"></i>
                    <span>Data Hasil Akhir</span>
                </a>
            </li>
            @else
            <!-- Nav Item - Data Siswa -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('d_siswa.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Data Siswa</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('t_nilai_siswa.index') }}">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Data Nilai siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('t_hasil_akhir.index') }}">
                    <i class="fa fa-bar-chart"></i>
                    <span>Data Hasil Akhir</span>
                </a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @else
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guest</span>
                                @endif
                                <i class="fa fa-user-circle"></i>
                            </a>
                           
                            <!-- Dropdown - User Information -->
                            @include('modal.logout')
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item" href="#"
                                    data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    @yield('content')


                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->



            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SPK Profile Matching 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->

    <script src="../assets/vendor/chart.js/Chart.min.js"></script>
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->

    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>
    <script src="../assets/js/demo/datatables-demo.js"></script>
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    


</body>

</html>

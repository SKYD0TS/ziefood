<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="aaa/favicon.ico" type="image/ico" />
    <title>Ziefood</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('assets') }}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets') }}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets') }}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets') }}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('sweetalert') }}/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('css') }}/style.css">
    <link rel="stylesheet" href="{{ asset('css') }}/sweet-alert4-bootstrap4.css">
    <!-- Custom Theme Style -->
    <link href="{{ asset('assets') }}/build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    @stack('style')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-coffee"></i> <span>Zie Caffe</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('assets') }}\35.png" alt="{{ asset('assets') }}."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @if (Auth::user()->role == 'admin')
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Admin</h3>
                                <ul class="nav side-menu">
                                    <li><a href="{{ url('/') }}" class="nav-link"><i class="fa fa-home"></i> Home
                                        </a>
                                        <!-- <li><a href="{{ url('/absensi') }}"><i class="fa fa-users"></i> Absensi </a> -->
                                    <li><a href="{{ url('/jenis') }}" class="nav-link"><i class="fa fa-archive"></i>
                                            Jenis </a>
                                    <li><a href="{{ url('/kategori') }}" class="nav-link"><i class="fa fa-list"></i>
                                            Kategori </a>
                                    <li><a href="{{ url('/menu') }}"><i class="fa fa-list-ul"></i> Menu </a>
                                    <li><a href="{{ url('/stok') }}" class="nav-link"><i class="fa fa-archive"></i>
                                            Stok </a>
                                    <li><a href="{{ url('/pelanggan') }}"><i class="fa fa-users"></i> Pelanggan </a>
                                    <li><a href="{{ url('/meja') }}"><i class="fa fa-list-alt"></i> Meja </a>
                                    <li><a href="{{ url('/det_transaksi') }}"><i class="fa fa-list-alt"></i> History
                                            Transaksi </a>

                                        <ul class="nav child_menu">
                                            <!-- <li><a href="{{ url('/jenis') }}">jenis</a></li>
                                    <li><a href="{{ url('/menu') }}">Menu</a></li> -->
                                        </ul>
                                    </li>
                                    <!-- <li><a>Produk Titipan<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                    <li><a href="{{ url('/titipan') }}"><i class="fa fa-list-ul"></i> Produk Titipan </a>
                                    </li>
                                    <li><a href="{{ url('/history_titipan') }}"><i class="fa fa-list-alt"></i> History Titipan</a>
                                    </li>
                                </ul>
                            </li> -->
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->role == 'kasir')
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Kasir</h3>
                                <ul class="nav side-menu">
                                    <li><a href="{{ url('/') }}" class="nav-link"><i class="fa fa-home"></i> Home
                                        </a>
                                        <!-- <li><a href="{{ url('/absensi') }}"><i class="fa fa-users"></i> Absensi </a> -->
                                    <li><a href="{{ url('/transaksi') }}"><i class="fa fa-money"></i> Transaksi </a>
                                    <li><a href="{{ url('/det_transaksi') }}"><i class="fa fa-list-alt"></i> History
                                            Transaksi </a>
                                    <li><a href="{{ url('/pelanggan') }}"><i class="fa fa-users"></i> Pelanggan </a>
                                        <ul class="nav child_menu">

                                            <!-- <li><a href="{{ url('/jenis') }}">jenis</a></li>
                                        <li><a href="{{ url('/menu') }}">Menu</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->role == 'owner')
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Kasir</h3>
                                <ul class="nav side-menu">
                                    <li><a href="{{ url('/') }}" class="nav-link"><i class="fa fa-home"></i>
                                            Home </a>
                                        <!-- <li><a href="{{ url('/absensi') }}"><i class="fa fa-users"></i> Absensi </a> -->
                                    <li><a href="{{ url('/det_transaksi') }}"><i class="fa fa-list-alt"></i> History
                                            Transaksi </a>
                                        <ul class="nav child_menu">

                                            <!-- <li><a href="{{ url('/jenis') }}">jenis</a></li>
                                        <li><a href="{{ url('/menu') }}">Menu</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="{{ url('tentang-aplikasi') }}">Tentang Aplikasi</a></li>
                                <li><a href="{{ url('/contact') }}" class="nav-link"> Contact Us </a>
                            </ul>
                        </div>
                    </div>

                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">

                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="fa fa-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="fa fa-arrows-alt" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="fa fa-eye-slash" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
                            <span class="fa fa-power-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets') }}\35.png"
                                        alt="{{ asset('assets') }}.">{{ Auth::user()->name }}
                                </a>
                                <div class=" dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;"> Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row" style="display: inline-block;">
                    <div class="tile_count">
                    </div>
                </div>
                <!-- /top tiles -->

                <br />
                @yield('content')


            </div>
            <!-- /page content -->


            @include('templates/footer')

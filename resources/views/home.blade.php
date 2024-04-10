<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Dashboard</title>
    <link rel="icon" href="{{asset('public/favicon.ico ')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.1.0/simple-lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{
        asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}>
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Ionicons -->
    <link rel="stylesheet" href={{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href={{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}>
    <!-- iCheck -->
    <link rel="stylesheet" href={{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- JQVMap -->
    <link rel="stylesheet" href={{ asset('plugins/jqvmap/jqvmap.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
    <!-- summernote -->
    <link rel="stylesheet" href={{ asset('plugins/summernote/summernote-bs4.min.css') }}>
    <!-- Fonts -->
    <link rel="dns-prefetch" href={{ asset('//fonts.bunny.net') }}>
    <link href={{ asset('https://fonts.bunny.net/css?family=Nunito') }} rel="stylesheet">
    @yield('styles')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src={{asset('dist/img/AdminLTELogo.png')}} alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light bg-white shadow-sm">
            <div class="container justify-content-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Back to main
                            </a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link" data-widget="pushmenu" href="#" role="button">
                <span class="brand-text font-weight-light">ROLL UP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src={{asset('dist/img/user2-icon-160x160.jpg ')}} class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info nav-item">
                        @auth
                        <p class="d-block text-white" style="font-size: 20px;">{{ auth()->user()->login}}</p>
                        <p class="d-block text-white" style="font-size: 14px;">role: {{ auth()->user()->user_type}}</p>
                        @endauth
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('api-docs') }}">
                                <i class=" nav-icon fa-solid fa-list"></i>
                                <p>
                                    api-docs
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('image.all') }}" class="nav-link">
                                {{-- <i class="nav-icon fas fa-th"></i> --}}
                                <i class="nav-icon fa-solid fa-images"></i>
                                <p>
                                    list images
                                </p>
                            </a>
                        </li>
                        @if(auth()->check()&& auth()->user()->user_type==="admin")
                        <li class="nav-header">Admin functions</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Options
                                    <i class="fas fa-angle-left right"></i>
                                    {{-- <span class="badge badge-info right">6</span> --}}
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('image.upload.view') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Upload images</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('image.all') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delete images</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    @yield('main.content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src={{asset('plugins/jquery/jquery.min.js ')}}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{asset(' plugins/jquery-ui/jquery-ui.min.js')}}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
    <!-- ChartJS -->
    <script src={{asset('plugins/chart.js/Chart.min.js')}}></script>
    <!-- Sparkline -->
    <script src={{asset('plugins/sparklines/sparkline.js')}}></script>
    <!-- JQVMap -->
    <script src={{asset('plugins/jqvmap/jquery.vmap.min.js')}}></script>
    <script src={{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}></script>
    <!-- jQuery Knob Chart -->
    <script src={{asset('plugins/jquery-knob/jquery.knob.min.js')}}></script>
    <!-- daterangepicker -->
    <script src={{asset('plugins/moment/moment.min.js')}}></script>
    <script src={{asset('plugins/daterangepicker/daterangepicker.js')}}></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src={{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}></script>
    <!-- Summernote -->
    <script src={{asset('plugins/summernote/summernote-bs4.min.js')}}></script>
    <!-- overlayScrollbars -->
    <script src={{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}></script>
    <!-- AdminLTE App -->
    <script src={{asset('dist/js/adminlte.js')}}></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src={{asset('dist/js/pages/dashboard.js')}}></script>

    @yield('scripts')
</body>

</html>

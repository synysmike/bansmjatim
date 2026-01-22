<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle }} - BAN-PDM Jatim</title>
    <link rel="icon" type="image/png" href="{{ asset('ban.png') }}">
    <meta property="og:image" content="{{ asset('ban.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('ban.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin_theme/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    @stack('css-custom')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin_theme/library/prismjs/themes/prism.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin_theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_theme/css/components.css') }}">
    
    <!-- Custom Sidebar Styles -->
    <style>
        .sidebar-menu .menu-header {
            padding: 10px 20px 5px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #98a6ad;
            margin-top: 10px;
        }
        
        .sidebar-menu .nav-item {
            margin: 0;
        }
        
        .sidebar-menu .nav-link {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .sidebar-menu .nav-link i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
            font-size: 16px;
        }
        
        .sidebar-menu .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 25px;
        }
        
        .sidebar-menu .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.1);
            border: none;
            padding: 0;
        }
        
        .sidebar-menu .dropdown-menu .nav-link {
            padding-left: 50px;
            font-size: 14px;
        }
        
        .sidebar-menu .dropdown-menu .nav-link:hover {
            padding-left: 55px;
        }
        
        .sidebar-menu .nav-item.active > .nav-link {
            background-color: rgba(255, 255, 255, 0.15);
            font-weight: 600;
        }
    </style>

    <!-- Start GA -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> --}}
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper">
            @include('ad_layout.nav')
            @include('ad_layout.side')
            <!-- Content -->
            <div class="main-content">

                @yield('admin-container')
            </div>
            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> <a href="https://bansmprovjatim.com">
                        BAN-PDM Provinsi Jawa Timur </a>
                </div>
                <div class="footer-right">
                    ir.teguh IT BANPDMJATIM
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('admin_theme/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('admin_theme/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('admin_theme/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin_theme/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin_theme/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    {{-- <script src="{{ asset('admin_theme/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin_theme/library/summernote/dist/summernote-bs4.js') }}"></script> --}}
    <!-- JS Libraies -->
    <script src="{{ asset('admin_theme/library/prismjs/prism.js') }}"></script>


    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('admin_theme/js/scripts.js') }}"></script>
    <script src="{{ asset('admin_theme/js/custom.js') }}"></script>
    @stack('js-custom')
</body>

</html>

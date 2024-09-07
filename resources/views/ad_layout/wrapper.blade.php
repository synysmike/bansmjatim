<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle }} - BAN-PDM Jatim</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/admin_theme/library/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    @stack('css-custom')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/admin_theme/library/prismjs/themes/prism.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="/admin_theme/css/style.css">
    <link rel="stylesheet" href="/admin_theme/css/components.css">

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
        <div class="main-wrapper container">
            {{-- @include('ad_layout.nav')
            @include('ad_layout.side') --}}
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
    <script src="/admin_theme/library/popper.js/dist/umd/popper.js"></script>
    <script src="/admin_theme/library/tooltip.js/dist/umd/tooltip.js"></script>
    <script src="/admin_theme/library/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/admin_theme/library/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="/admin_theme/library/moment/min/moment.min.js"></script>
    <script src="/admin_theme/js/stisla.js"></script>

    <!-- JS Libraies -->
    {{-- <script src="/admin_theme/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/admin_theme/library/summernote/dist/summernote-bs4.js"></script> --}}
    <!-- JS Libraies -->
    <script src="/admin_theme/library/prismjs/prism.js"></script>


    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="/admin_theme/js/scripts.js"></script>
    <script src="/admin_theme/js/custom.js"></script>
    @stack('js-custom')
</body>

</html>

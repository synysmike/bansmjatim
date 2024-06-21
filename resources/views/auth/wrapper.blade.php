<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('tittle')

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/admin_theme/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('cssform-custom')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/admin_theme/library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/admin_theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_theme/css/components.css') }}">
</head>

<body>
    <div id="app">

        @yield('form')

    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('/admin_theme/library/jquery/dist/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('/admin_theme/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('/admin_theme/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('/admin_theme/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    {{-- <script src="/admin_theme/js/scripts.js"></script> --}}
    {{-- <script src="/admin_theme/js/custom.js"></script> --}}

    @stack('jsform-custom')
    <script>
        // for background
        $("[data-background]").each(function() {
            var me = $(this);
            me.css({
                backgroundImage: 'url(' + me.data('background') + ')'
            });
        });
    </script>

</body>

</html>

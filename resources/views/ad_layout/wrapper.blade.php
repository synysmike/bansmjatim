<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle }} - BAN-PDM Jatim</title>
    <link rel="icon" type="image/png" href="{{ asset('ban.png') }}">
    <meta property="og:image" content="{{ asset('ban.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('ban.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts - Elegant Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Source+Sans+Pro:wght@300;400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    @stack('css-custom')
    
    <!-- Modern Elegant Styles -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #1e293b;
            --light-color: #f1f5f9;
            --border-color: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans Pro', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-primary);
            line-height: 1.7;
            font-weight: 400;
            font-size: 15px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            letter-spacing: -0.01em;
            min-height: 100vh;
        }
        
        /* Typography Hierarchy */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', 'Poppins', serif;
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }
        
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }
        
        h2 {
            font-size: 2rem;
            font-weight: 600;
        }
        
        h3 {
            font-size: 1.75rem;
            font-weight: 600;
        }
        
        h4 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        h5 {
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        h6 {
            font-size: 1rem;
            font-weight: 600;
        }
        
        p {
            font-size: 15px;
            line-height: 1.75;
            margin-bottom: 1rem;
            color: var(--text-primary);
            font-weight: 400;
        }
        
        /* Elegant Text Styling */
        .text-elegant {
            font-family: 'Playfair Display', serif;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        
        .text-refined {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
            letter-spacing: 0.01em;
        }
        
        /* Better link styling */
        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Button text */
        .btn {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 600;
            letter-spacing: 0.02em;
            text-transform: none;
        }
        
        /* Table text */
        .table {
            font-family: 'Source Sans Pro', sans-serif;
        }
        
        .table th {
            font-weight: 600;
            letter-spacing: 0.01em;
        }
        
        .table td {
            font-weight: 400;
        }
        
        /* Form elements */
        .form-control, .form-select, input, textarea, select {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 15px;
            font-weight: 400;
            letter-spacing: 0.01em;
        }
        
        label {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.01em;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        
        /* Card text */
        .card-body {
            font-family: 'Source Sans Pro', sans-serif;
        }
        
        /* Small text */
        small, .small {
            font-size: 13px;
            font-weight: 400;
            line-height: 1.6;
            letter-spacing: 0.01em;
        }
        
        /* Muted text */
        .text-muted {
            color: var(--text-secondary);
            font-weight: 400;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 200px);
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
        }

        /* Modern Card Styles */
        .card {
            background: #ffffff;
            border-radius: 16px;
            border: none;
            box-shadow: var(--shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            font-family: 'Source Sans Pro', sans-serif;
            letter-spacing: -0.01em;
        }

        /* Card Statistic Styles (merged icon into header) */
        .card-statistic-1 {
            position: relative;
        }

        .card-statistic-1 .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-statistic-1 .card-header i {
            font-size: 1.5rem;
            opacity: 0.9;
        }

        .card-statistic-1 .card-wrap {
            position: relative;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            background-color: var(--light-color);
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        /* Section Styles */
        .section-header {
            margin-bottom: 2rem;
        }

        .section-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .section-header-breadcrumb {
            display: flex;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .breadcrumb-item {
            color: var(--text-secondary);
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-color) 100%);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* Table Styles */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: var(--light-color);
        }

        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            box-shadow: var(--shadow);
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        /* Footer */
        .main-footer {
            background: white;
            padding: 2rem 0;
            margin-top: 3rem;
            border-top: 1px solid var(--border-color);
            box-shadow: 0 -4px 6px -1px rgb(0 0 0 / 0.05);
        }

        .main-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s;
        }

        .main-footer a:hover {
            color: var(--primary-dark);
        }

        /* Smooth Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-content {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsive improvements */
        @media (max-width: 992px) {
            .section-header h1 {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 768px) {
            .section-header h1 {
                font-size: 1.5rem;
            }
            
            .card-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        @include('ad_layout.nav')
        
        <!-- Content -->
        <div class="main-content">
            @yield('admin-container')
        </div>
        
        <!-- Footer -->
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        Copyright &copy; 2022 <span class="mx-1">•</span> 
                        <a href="https://bansmprovjatim.com" class="text-decoration-none">BAN-PDM Provinsi Jawa Timur</a>
                    </div>
                    <div class="col-md-6 text-md-end">
                        ir.teguh IT BANPDMJATIM
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (if needed for other scripts) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Page Specific JS -->
    @stack('js-custom')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle ?? 'Form' }} - BAN-PDM Jatim</title>
    <link rel="icon" type="image/png" href="{{ asset('ban.png') }}">
    <meta property="og:image" content="{{ asset('ban.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('ban.png') }}">

    <!-- Tailwind CSS (Compiled) -->
    <link rel="stylesheet" href="{{ asset('public_assets/css/tailwind.css') }}" type="text/css" />

    <!-- Font Awesome 6 (use all.min.css for full icon set) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts - Admin UI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    @stack('css-custom')
    
    <!-- Same theme styles as wrapper (modals, forms, buttons, toasts) -->
    @include('ad_layout.partials.theme_styles')
</head>

<body class="min-h-screen">
    <div id="app" class="flex flex-col min-h-screen">
        <!-- No navbar - plain page -->

        <!-- Main Content -->
        <main class="flex-1 pt-8 pb-8 px-4 lg:px-8 fade-in min-w-0">
            <div class="max-w-4xl mx-auto">
                @yield('admin-container')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-admin-border shadow-admin-sm mt-auto flex-shrink-0">
            <div class="max-w-4xl mx-auto px-4 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-2">
                    <div class="text-admin-text-secondary text-sm text-center md:text-left">
                        Copyright &copy; 2022 <span class="mx-1">•</span>
                        <a href="https://bansmprovjatim.com" class="text-admin-primary hover:text-admin-primary-dark transition-colors">BAN-PDM Provinsi Jawa Timur</a>
                    </div>
                    <div class="text-admin-text-secondary text-sm">ir.teguh IT BANPDMJATIM</div>
                </div>
            </div>
        </footer>
    </div>

    <!-- jQuery (needed for DataTables and other plugins) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Page Specific JS -->
    @stack('js-custom')
    
    <!-- Modals Stack -->
    @stack('modals')
    
    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-[60] space-y-2" style="display: none;"></div>
    
    <script>
        // Tailwind Toast Notification System
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;
            container.style.display = 'block';
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-admin-success' : type === 'error' ? 'bg-admin-danger' : type === 'warning' ? 'bg-admin-warning' : 'bg-admin-info';
            const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle';
            toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-admin-lg flex items-center space-x-3 min-w-[300px] max-w-md animate-slide-in-right`;
            toast.innerHTML = `<i class="fas ${icon} admin-icon-lg"></i><span class="flex-1">${message}</span><button onclick="this.parentElement.remove(); checkToastContainer();" class="text-white hover:text-gray-200 transition-colors" aria-label="Close"><i class="fas fa-times admin-icon"></i></button>`;
            container.appendChild(toast);
            setTimeout(() => { toast.style.transition = 'all 0.3s ease-out'; toast.style.opacity = '0'; toast.style.transform = 'translateX(100%)'; setTimeout(() => { toast.remove(); checkToastContainer(); }, 300); }, 5000);
        }
        function checkToastContainer() {
            const container = document.getElementById('toast-container');
            if (container && container.children.length === 0) container.style.display = 'none';
        }
        const style = document.createElement('style');
        style.textContent = `@keyframes slide-in-right{from{opacity:0;transform:translateX(100%)}to{opacity:1;transform:translateX(0)}}.animate-slide-in-right{animation:slide-in-right 0.3s ease-out}`;
        document.head.appendChild(style);
        window.modalManager = {
            open: function(modalId) { const m = document.getElementById(modalId); if (m) { m.setAttribute('data-open', 'true'); document.body.style.overflow = 'hidden'; document.body.style.position = 'fixed'; document.body.style.width = '100%'; } },
            close: function(modalId) { const m = document.getElementById(modalId); if (m) { m.setAttribute('data-open', 'false'); document.body.style.overflow = ''; document.body.style.position = ''; document.body.style.width = ''; } },
            closeAll: function() { document.querySelectorAll('.modal-wrapper').forEach(function(m) { m.setAttribute('data-open', 'false'); }); document.body.style.overflow = ''; document.body.style.position = ''; document.body.style.width = ''; }
        };
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') modalManager.closeAll(); });
        document.addEventListener('DOMContentLoaded', function() { document.querySelectorAll('.modal-wrapper').forEach(function(m) { m.setAttribute('data-open', 'false'); }); });
    </script>
</body>

</html>

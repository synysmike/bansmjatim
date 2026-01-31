    <style>
        /* Admin font stack: Ubuntu */
        /* Exclude icon elements so Font Awesome can display */
        #app, body, input, textarea, select, button,
        .form-input, .form-control, .form-select, .form-textarea,
        .modal-content, .modal-content *, .btn,
        .dataTables_wrapper input, .dataTables_wrapper select,
        table, th, td, label, span, p, a, small {
            font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        #app h1, #app h2, #app h3, #app h4, #app h5, #app h6 {
            font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #0f172a;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: -0.02em;
            color: #0f172a;
        }
        
        /* Admin icons - MUST override global font so Font Awesome displays */
        #app .fa, #app .fas, #app .far, #app .fab,
        #app .fa-solid, #app .fa-regular, #app .fa-brands,
        #app i[class*="fa-"] {
            display: inline-block;
            vertical-align: middle;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-style: normal;
            font-variant: normal;
            line-height: 1;
        }
        /* Override global Inter font so icon font loads (sidebar, nav, modals) */
        #app .fas, #app .fa-solid, #app i.fas {
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free" !important;
            font-weight: 900 !important;
        }
        #app .far, #app .fa-regular, #app i.far {
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free" !important;
            font-weight: 400 !important;
        }
        /* Icons outside #app (modals, toasts) - must override body font */
        .modal-wrapper .fa, .modal-wrapper .fas, .modal-wrapper .far, .modal-wrapper .fab,
        .modal-wrapper .fa-solid, .modal-wrapper .fa-regular, .modal-wrapper i[class*="fa-"],
        #toast-container .fa, #toast-container .fas, #toast-container .far, #toast-container i[class*="fa-"] {
            display: inline-block;
            vertical-align: middle;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-style: normal;
            font-variant: normal;
            line-height: 1;
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free" !important;
            font-weight: 900 !important;
        }
        .modal-wrapper .far, .modal-wrapper .fa-regular, #toast-container .far, #toast-container .fa-regular {
            font-weight: 400 !important;
        }
        #app .admin-icon { font-size: 1rem; }
        #app .admin-icon-sm { font-size: 0.875rem; }
        #app .admin-icon-lg { font-size: 1.25rem; }
        #app .admin-icon-xl { font-size: 1.5rem; }
        #app .admin-icon-2xl { font-size: 2rem; }
        
        /* Alpine.js x-cloak */
        [x-cloak] {
            display: none !important;
        }
        
        /* Modal System - Completely hidden by default */
        .modal-wrapper {
            display: none !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 50;
            overflow-y: auto;
            padding: 1rem;
        }
        
        .modal-wrapper[data-open="true"] {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
        
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
            display: none !important;
        }
        
        .modal-wrapper[data-open="true"] .modal-backdrop {
            display: block !important;
        }
        
        .modal-content-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 90vw;
            max-height: calc(90vh - 2rem);
            margin: auto;
            display: none !important;
        }
        
        .modal-wrapper[data-open="true"] .modal-content-wrapper {
            display: block !important;
        }
        
        .modal-content {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-height: calc(90vh - 2rem);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        /* Modal Size Variants */
        .modal-sm .modal-content-wrapper {
            max-width: 28rem; /* 448px */
        }
        
        .modal-md .modal-content-wrapper {
            max-width: 42rem; /* 672px */
        }
        
        .modal-lg .modal-content-wrapper {
            max-width: 56rem; /* 896px */
        }
        
        .modal-xl .modal-content-wrapper {
            max-width: 72rem; /* 1152px */
        }
        
        /* Responsive */
        @media (max-width: 640px) {
            .modal-wrapper {
                padding: 0.5rem;
            }
            .modal-content-wrapper {
                max-width: 100%;
                max-height: calc(100vh - 1rem);
            }
            .modal-content {
                max-height: calc(100vh - 1rem);
                border-radius: 0.5rem;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Form Styles - All inputs in admin & modals */
        .form-input, .form-control, .form-textarea, .form-select,
        input[type="text"], input[type="email"], input[type="password"], input[type="number"],
        input[type="url"], input[type="tel"], input[type="search"],
        textarea, select {
            width: 100%;
            padding: 0.625rem 1rem;
            font-size: 0.9375rem;
            line-height: 1.5;
            color: #0f172a;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        
        .form-input:focus, .form-control:focus, .form-textarea:focus, .form-select:focus,
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus,
        input[type="number"]:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        .form-input::placeholder, .form-control::placeholder, .form-textarea::placeholder {
            color: #94a3b8;
        }
        
        .form-textarea, textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-label, .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-group .form-text, .form-group small.text-muted {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.8125rem;
            color: #64748b;
        }
        
        .invalid-feedback {
            font-size: 0.8125rem;
            color: #ef4444;
            margin-top: 0.25rem;
        }
        
        .form-control.is-invalid, .form-input.border-red-500,
        input.is-invalid {
            border-color: #ef4444;
        }
        
        /* Modal form fields - consistent spacing */
        .modal-content .form-group,
        .modal-content .mb-4,
        .modal-content .mb-6 {
            margin-bottom: 1.25rem;
        }
        
        .modal-content .form-label,
        .modal-content .form-group label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
        }
        
        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-size: 0.9375rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.15s ease;
            cursor: pointer;
            border: none;
            outline: none;
        }
        
        .btn:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
        }
        
        .btn-primary {
            background-color: #6366f1;
            color: white;
        }
        .btn-primary:hover {
            background-color: #4f46e5;
        }
        
        .btn-success {
            background-color: #10b981;
            color: white;
        }
        .btn-success:hover {
            background-color: #059669;
        }
        
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background-color: #dc2626;
        }
        
        .btn-info {
            background-color: #3b82f6;
            color: white;
        }
        .btn-info:hover {
            background-color: #2563eb;
        }
        
        .btn-secondary {
            background-color: #e2e8f0;
            color: #1e293b;
        }
        .btn-secondary:hover {
            background-color: #cbd5e1;
        }
        
        /* Select2 in admin */
        .select2-container--default .select2-selection--single {
            height: auto !important;
            padding: 0.5rem 1rem !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            background: #fff !important;
            font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #0f172a !important;
            font-size: 0.9375rem !important;
        }
        
        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1) !important;
            font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        .select2-results__option {
            padding: 0.5rem 1rem !important;
            font-size: 0.9375rem !important;
        }
        
        .select2-results__option--highlighted {
            background: #6366f1 !important;
            color: white !important;
        }
        
        /* Quill / rich editor in modals */
        .ql-editor, .note-editable {
            font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.9375rem;
        }
        
        /* DataTables in admin */
        .dataTables_wrapper {
            width: 100%;
        }
        
        .dataTables_filter input,
        .dataTables_length select {
            padding: 0.5rem 1rem;
            font-size: 0.9375rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            margin-left: 0.5rem;
        }
        
        .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
        }
        
        .dataTables_paginate .paginate_button.current {
            background: #6366f1;
            color: white;
            border: none;
        }
        
        .dataTables_info {
            font-size: 0.875rem;
            color: #64748b;
        }
        
        /* Loading Spinner */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Sidebar Animation */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        
        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
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
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Action dropdown (DataTables / admin tables) */
        .action-dropdown {
            position: relative;
            display: inline-block;
        }
        .action-dropdown-toggle {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #0f172a;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }
        .action-dropdown-toggle:hover {
            background: #f1f5f9;
            color: #6366f1;
        }
        .action-dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.25rem;
            min-width: 10rem;
            padding: 0.25rem 0;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            border: 1px solid #e2e8f0;
            z-index: 50;
        }
        .action-dropdown-menu.hidden {
            display: none !important;
        }
        .action-dropdown-menu a,
        .action-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            text-align: left;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #0f172a;
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }
        .action-dropdown-menu a:hover,
        .action-dropdown-menu button:hover {
            background: #f1f5f9;
        }
        .action-dropdown-menu .text-red-600:hover,
        .action-dropdown-menu button.text-red-600:hover {
            background: #fef2f2;
        }

        /* Navbar: show mobile toggle only in mobile mode (below 768px) */
        @media (min-width: 768px) {
            .nav-mobile-toggle {
                display: none !important;
            }
        }

<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-compact layout-menu-fixed" dir="ltr" data-skin="default"
    data-assets-path="{{ asset('admin') }}" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Deliverywala | Admin</title>

    <!-- SEO -->
    <meta name="description" content="Deliverywala Dashboard">
    <meta name="keywords" content="Deliverywala dashboard">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="#">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('admin/css/css2.css') }}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/css/iconify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/apex-charts.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">

    <!-- Helper JS -->
    <script src="{{ asset('admin/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>

    <!-- Vite config for Tailwind v4 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .layout-menu-fixed .layout-navbar-full .layout-menu,
        .layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
            top: 64px !important;
        }

        .layout-page {
            padding-top: 64px !important;
        }

        .content-wrapper {
            padding-bottom: 54px !important;
        }

        .icon-primary {
            color: #f97316;
        }

        .card {
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.15);
        }

        .form-select:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 0.15rem rgba(249, 115, 22, 0.25);
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Layout page -->
            <div class="layout-page">

                <!-- Header -->
                @include('layouts.header')

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    {{ $slot ?? '' }}
                    @yield('content')

                    <!-- Footer -->
                    @include('layouts.footer')

                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/popper.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/js/menu.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('admin/js/apexcharts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Page specific scripts -->
    @stack('scripts')

    <style>
        /* Container should be transparent and non-intrusive */
        .swal2-container.swal2-top-end.swal2-backdrop-show {
            background: rgba(0, 0, 0, 0) !important;
        }

        /* Apply styling ONLY to the card (popup) */
        .swal2-toast-popup-custom {
            margin-top: 70px !important;
            margin-right: 20px !important;
            padding: 0.75rem 1rem !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            background: #fff !important;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        .swal2-toast-icon-custom {
            margin: 0 12px 0 0 !important;
            padding: 0 !important;
            width: 24px !important;
            height: 24px !important;
            font-size: 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .swal2-toast-title-custom {
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin-bottom: 2px !important;
        }

        .swal2-toast-html-custom {
            font-size: 0.8rem !important;
            color: #666 !important;
            line-height: 1.4 !important;
        }

        /* Select2 Premium Modern UI Overhaul */
        .select2-container--bootstrap-5 .select2-selection--multiple {
            min-height: 42px !important;
            max-height: 120px !important;
            overflow-y: auto !important;
            border: 1px solid #e6e9ed !important;
            border-radius: 10px !important;
            /* Modern rounded corners */
            padding: 4px 8px !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease-in-out !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection--multiple {
            border-color: #7367f0 !important;
            box-shadow: 0 0 10px rgba(115, 103, 240, 0.15) !important;
        }

        .select2-container--bootstrap-5 .select2-selection__rendered {
            padding: 0 !important;
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            /* More breathing room */
            align-items: center !important;
            width: 100% !important;
        }

        /* Pill-shaped Tags */
        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(115, 103, 240, 0.08) !important;
            /* Soft Primary Tint */
            border: 1px solid rgba(115, 103, 240, 0.15) !important;
            border-radius: 50px !important;
            /* Pill shape */
            padding: 2px 12px !important;
            margin: 0 !important;
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            color: #7367f0 !important;
            display: flex !important;
            align-items: center !important;
            transition: background-color 0.2s !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice:hover {
            background-color: rgba(115, 103, 240, 0.15) !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove {
            margin-right: 6px !important;
            color: rgba(115, 103, 240, 0.6) !important;
            border: none !important;
            font-weight: bold !important;
            font-size: 14px !important;
            transition: color 0.2s !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ff4d49 !important;
            background: none !important;
        }

        .select2-container--bootstrap-5 .select2-search__field {
            margin: 0 !important;
            height: 32px !important;
            font-size: 0.875rem !important;
            width: auto !important;
            flex-grow: 1 !important;
            background: transparent !important;
        }

        /* Clean Dropdown */
        .select2-dropdown {
            border: 1px solid #e6e9ed !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            overflow: hidden !important;
            margin-top: 5px !important;
        }

        .select2-results__option {
            padding: 8px 12px !important;
            font-size: 0.875rem !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted[aria-selected] {
            background-color: #7367f0 !important;
            color: #fff !important;
        }

        /* Custom Discreet Scrollbar */
        .select2-selection--multiple::-webkit-scrollbar {
            width: 4px !important;
        }

        .select2-selection--multiple::-webkit-scrollbar-track {
            background: transparent !important;
        }

        .select2-selection--multiple::-webkit-scrollbar-thumb {
            background: #e0e0e0 !important;
            border-radius: 10px !important;
        }

        .select2-selection--multiple::-webkit-scrollbar-thumb:hover {
            background: #cdcdcd !important;
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('new-notification', (event) => {
                const data = event[0];
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'swal2-toast-popup-custom',
                        title: 'swal2-toast-title-custom',
                        icon: 'swal2-toast-icon-custom',
                        htmlContainer: 'swal2-toast-html-custom'
                    },
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                let icon = 'info';
                if (data.level === 'success') icon = 'success';
                if (data.level === 'error') icon = 'error';
                if (data.level === 'warning') icon = 'warning';

                Toast.fire({
                    icon: icon,
                    title: data.title || (data.docket_number ? `Docket: ${data.docket_number}` :
                        'New Notification'),
                    html: `<div style="text-align: left;">${data.message}</div>`
                });
            });
        });
    </script>

</body>

</html>
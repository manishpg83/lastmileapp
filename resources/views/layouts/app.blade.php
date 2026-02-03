<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-compact layout-menu-fixed" dir="ltr" data-skin="default"
    data-assets-path="{{ asset('admin') }}" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard | Admin</title>

    <!-- SEO -->
    <meta name="description" content="Admin Dashboard">
    <meta name="keywords" content="admin dashboard">

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

    <!-- Helper JS -->
    <script src="{{ asset('admin/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page specific scripts -->
    @stack('scripts')

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
                    title: data.docket_number ? `Docket: ${data.docket_number}` :
                        'New Notification',
                    text: data.message
                });
            });
        });
    </script>

</body>

</html>

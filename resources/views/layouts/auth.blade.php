<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin') }}" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Deliverywala') | Admin</title>
    <meta name="description" content="Admin Deliverywala" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="{{ asset('admin/css/css2.css') }}" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/css/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('admin/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>

    @livewireStyles
</head>

<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">

            <!-- Left Section - Image -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset('admin/img/illustrations/auth-cover.png') }}" class="img-fluid" alt="Auth Cover"
                        style="max-width: 700px;">
                </div>
            </div>

            <!-- Right Section - Form -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                <div class="w-px-400 mx-auto">

                    <!-- Logo -->
                    <div class="app-brand mb-5">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('frontend/images/delivery_wale.png') }}" alt="Delivery Wale"
                                    style="max-width: 200px; height: auto;">
                            </span>
                        </a>
                    </div>

                    {{ $slot }}

                </div>
            </div>

        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/popper.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
    @livewireScripts
</body>

</html>

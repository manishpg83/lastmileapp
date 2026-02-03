<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin') }}/" data-template="front-pages">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Last Mile Delivery - Efficient & Reliable</title>

    <meta name="description" content="Streamline your delivery operations with our advanced last mile solution." />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('admin/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}" />

    <style>
        .landing-hero {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 5rem 0;
            border-bottom-right-radius: 5rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .footer-bg {
            background-color: #2b2c40;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="layout-navbar shadow-none py-0">
        <div class="container">
            <div class="navbar navbar-expand-lg landing-navbar px-3 px-lg-4">
                <!-- Menu logo wrapper: Start -->
                <div class="navbar-brand app-brand demo d-flex py-0 me-4">
                    <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="tf-icons bx bx-menu bx-sm align-middle"></i>
                    </button>
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo -->
                            <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path
                                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                        id="path-1"></path>
                                    <path
                                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                        id="path-3"></path>
                                    <path
                                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                        id="path-4"></path>
                                    <path
                                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                        id="path-5"></path>
                                </defs>
                                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                <mask id="mask-2" fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <use fill="#696cff" xlink:href="#path-1"></use>
                                                <g id="Path-3" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-3"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                                </g>
                                                <g id="Path-4" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-4"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                                </g>
                                            </g>
                                            <g id="Triangle"
                                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                <use fill="#696cff" xlink:href="#path-5"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">LastMileApp</span>
                    </a>
                </div>
                <!-- Menu logo wrapper: End -->

                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item me-2">
                                    <a href="{{ route('login') }}" class="btn btn-label-primary">Log in</a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Sections:Start -->
    <div data-bs-spy="scroll" class="scrollspy-example">

        <!-- Hero: Start -->
        <section id="hero-animation" class="landing-hero position-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-start">
                        <h1 class="display-3 fw-bold mb-4">Master Your <br><span class="text-primary">Last Mile
                                Delivery</span></h1>
                        <p class="fs-5 mb-5 text-muted">
                            Optimize routes, track shipments in real-time, and ensure timely deliveries with our
                            comprehensive logistics solution.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
                    </div>
                    <div class="col-lg-6 text-center mt-5 mt-lg-0">
                        <img src="https://images.unsplash.com/photo-1586880244406-556ebe35f282?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="hero" class="img-fluid rounded shadow-lg"
                            style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <!-- Features: Start -->
        <section id="landingFeatures" class="section-py landing-features">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-label-primary">Features</span>
                    <h2 class="h3 mt-2">Everything you need</h2>
                    <p class="text-muted">Manage your logistics operations from a single dashboard.</p>
                </div>
                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-none border">
                            <div class="card-body text-center">
                                <div class="feature-icon bg-label-primary mx-auto">
                                    <i class='bx bx-map-pin'></i>
                                </div>
                                <h5 class="mb-3">Real-time Tracking</h5>
                                <p class="text-muted">Monitor your fleet and shipments in real-time with precise GPS
                                    tracking data.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-none border">
                            <div class="card-body text-center">
                                <div class="feature-icon bg-label-success mx-auto">
                                    <i class='bx bx-check-shield'></i>
                                </div>
                                <h5 class="mb-3">Proof of Delivery</h5>
                                <p class="text-muted">Capture digital signatures and photos to ensure secure and
                                    verified deliveries.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-none border">
                            <div class="card-body text-center">
                                <div class="feature-icon bg-label-info mx-auto">
                                    <i class='bx bx-bar-chart-alt-2'></i>
                                </div>
                                <h5 class="mb-3">Analytics & Reports</h5>
                                <p class="text-muted">Gain insights into performance with detailed reports and
                                    actionable analytics.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Features: End -->

    </div>
    <!-- Sections:End -->

    <!-- Footer: Start -->
    <footer class="footer-bg text-center py-4">
        <div class="container text-center">
            <div class="mb-2">
                <a href="#" class="footer-link text-white fw-bold">LastMileApp</a>
            </div>
            <div>
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>, Made with ❤️ by <a href="#" target="_blank"
                    class="footer-link text-white fw-bolder">BriskBrain</a>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <!-- Core JS -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/popper.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
</body>

</html>

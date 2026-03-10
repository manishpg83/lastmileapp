<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Wale - Fast & Reliable Last-Mile Delivery</title>
    <meta name="description"
        content="Delivery Wale provides fast, reliable, pincode-based delivery services for businesses and e-commerce.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @livewireStyles
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container nav-container">
            <a href="#home" class="logo">
                <i class="fa-solid fa-truck-fast"></i>

                <img src="{{ asset('frontend/images/delivery_wale.png') }}" alt="Delivery Wale"
                    style="max-height: 48px; width: auto; margin-left: -13px;">
            </a>
            <div class="nav-links">
                <a href="#services">Services</a>
                <a href="#about">About</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#partner">Partner</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="mobile-menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero" id="home">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="hero-title">Fast & Reliable Last-Mile Delivery Across Your City</h1>
            <p class="hero-subtitle">Delivery Wale provides pincode-based delivery services for businesses and
                e-commerce.</p>
            <div class="hero-buttons">
                <a href="#contact" class="btn btn-primary">Book Delivery</a>
                <a href="#partner" class="btn btn-outline">Become a Delivery Partner</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section class="services section-padding" id="services">
        <div class="container">
            <div class="section-title text-center">
                <h2>Our Services</h2>
                <div class="divider"></div>
                <p>Tailored logistics solutions to meet your business needs.</p>
            </div>
            <div class="cards-grid">
                <div class="card service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3>Pincode Delivery</h3>
                    <p>Dedicated and optimized delivery across specific pincodes for maximum efficiency.</p>
                </div>
                <div class="card service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3>Business Parcel Delivery</h3>
                    <p>Secure and timely delivery of critical business parcels, documents, and supplies.</p>
                </div>
                <div class="card service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <h3>E-commerce Delivery</h3>
                    <p>Seamless last-mile fulfillment for online stores with cash-on-delivery options.</p>
                </div>
                <div class="card service-card">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <h3>Local Courier Solutions</h3>
                    <p>Express local courier services for urgent, same-day delivery requirements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about section-padding bg-light" id="about">
        <div class="container about-container">
            <div class="about-content">
                <h2>About Delivery Wale</h2>
                <div class="divider"></div>
                <p>Delivery Wale was founded with a clear mission: to simplify local logistics through the power of
                    technology and a network of highly reliable delivery partners.</p>
                <p>We understand that the "last mile" is often the most critical part of the supply chain. That's
                    why we
                    have built a robust, pincode-based framework that ensures every parcel reaches its destination
                    quickly, safely, and affordably.</p>
                <a href="#contact" class="btn btn-secondary mt-4">Learn More</a>
            </div>
            <div class="about-image">
                <div class="image-placeholder">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works section-padding" id="how-it-works">
        <div class="container">
            <div class="section-title text-center">
                <h2>How It Works</h2>
                <div class="divider"></div>
                <p>A simple, transparent, and technology-driven process.</p>
            </div>
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="fa-solid fa-boxes-packing"></i></div>
                    <h3>Pickup from Hub</h3>
                    <p>Packages are collected directly from your warehouse or designated hubs.</p>
                </div>
                <div class="step-arrow"><i class="fa-solid fa-chevron-right"></i></div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="fa-solid fa-dolly"></i></div>
                    <h3>Parcel Sorting</h3>
                    <p>Smart sorting systems organize parcels by pincode for optimized routing.</p>
                </div>
                <div class="step-arrow"><i class="fa-solid fa-chevron-right"></i></div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="fa-solid fa-truck-fast"></i></div>
                    <h3>Local Delivery</h3>
                    <p>Our fleet of trusted delivery partners handles the last-mile transit.</p>
                </div>
                <div class="step-arrow"><i class="fa-solid fa-chevron-right"></i></div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-icon"><i class="fa-solid fa-check-circle"></i></div>
                    <h3>Successful Drop-off</h3>
                    <p>Package delivered securely with real-time updates and proof of delivery.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-us section-padding bg-dark text-white" id="why-us">
        <div class="container">
            <div class="section-title text-center">
                <h2>Why Choose Us</h2>
                <div class="divider"></div>
                <p>The smartest choice for your last-mile logistics.</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <i class="fa-solid fa-bolt"></i>
                    <h4>Fast Delivery</h4>
                    <p>Speedy turnaround times.</p>
                </div>
                <div class="benefit-item">
                    <i class="fa-solid fa-map-pin"></i>
                    <h4>Fixed Pincode Network</h4>
                    <p>Specialized zonal operations.</p>
                </div>
                <div class="benefit-item">
                    <i class="fa-solid fa-handshake"></i>
                    <h4>Reliable Partners</h4>
                    <p>Vetted and trained staff.</p>
                </div>
                <div class="benefit-item">
                    <i class="fa-solid fa-location-crosshairs"></i>
                    <h4>Real-Time Tracking</h4>
                    <p>Complete visibility.</p>
                </div>
                <div class="benefit-item">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <h4>Affordable Pricing</h4>
                    <p>Cost-effective solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="statistics bg-accent">
        <div class="container stats-container">
            <div class="stat-box">
                <div class="stat-number">5M+</div>
                <div class="stat-label">Parcels Delivered</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">2,500+</div>
                <div class="stat-label">Active Delivery Partners</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">10+</div>
                <div class="stat-label">Service Areas (Pincodes)</div>
            </div>
        </div>
    </section>

    <!-- Delivery Partner Opportunity -->
    <section class="partner section-padding" id="partner">
        <div class="container partner-container">
            <div class="partner-image">
                <div class="image-placeholder"><i class="fa-solid fa-truck-pickup"></i></div>
            </div>
            <div class="partner-content">
                <h2>Become a Delivery Partner</h2>
                <div class="divider"></div>
                <p>Are you an independent driver with a Tata Ace, Pickup, or Mini Truck? Join the Delivery Wale network
                    today!</p>
                <ul class="partner-benefits">
                    <li><i class="fa-solid fa-check"></i> Earn a stable monthly income</li>
                    <li><i class="fa-solid fa-check"></i> Flexible working hours</li>
                    <li><i class="fa-solid fa-check"></i> Weekly payouts & incentives</li>
                    <li><i class="fa-solid fa-check"></i> Dedicated fixed routes</li>
                </ul>
                <a href="#contact" class="btn btn-primary mt-4">Join Now</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact section-padding bg-light" id="contact">
        <div class="container">
            <div class="section-title text-center">
                <h2>Get In Touch</h2>
                <div class="divider"></div>
                <p>Have questions or ready to get started? Contact us today.</p>
            </div>
            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-card">
                        <i class="fa-solid fa-phone"></i>
                        <h3>Phone</h3>
                        <p><a href="tel:+919723230260">+91 9723230260</a></p>
                    </div>
                    <div class="contact-card">
                        <i class="fa-solid fa-envelope"></i>
                        <h3>Email</h3>
                        <p><a href="mailto:info@deliverywale.co.in">info@deliverywale.co.in</a></p>
                    </div>
                </div>
                @livewire('contact-form')
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="#" class="logo footer-logo"
                        style="background-color: white; padding: 4px 4px 4px 8px; border-radius: 4px;">
                        <i class="fa-solid fa-truck-fast"></i>
                        <img src="{{ asset('frontend/images/delivery_wale.png') }}" alt="Delivery Wale"
                            style="max-height: 48px; width: auto; margin-left: -13px;">
                    </a>
                    <p>Your trusted partner for fast and reliable last-mile logistics solutions across the city.</p>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="#partner">Careers / Partners</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Delivery Wale. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('frontend/js/script.js') }}"></script>
    @livewireScripts
</body>

</html>

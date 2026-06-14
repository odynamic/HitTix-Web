{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'TixConcert - Premium Concert Tickets')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .main-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff6b6b;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
        }

        .logo:hover {
            color: #ee5a52;
            text-decoration: none;
        }

        .main-nav {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
        }

        .nav-link {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: #ff6b6b;
            text-decoration: none;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ff6b6b;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-btn, .cart-btn, .user-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #2c3e50;
            cursor: pointer;
            transition: color 0.3s ease;
            position: relative;
        }

        .search-btn:hover, .cart-btn:hover, .user-btn:hover {
            color: #ff6b6b;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff6b6b;
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #2c3e50;
            cursor: pointer;
        }

        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .mobile-nav.active {
            display: block;
        }

        .mobile-nav .nav-link {
            display: block;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        /* Footer Styles */
        .main-footer {
            background: #2c3e50;
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            color: #4ecdc4;
            font-size: 1.2rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #4ecdc4;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #34495e;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #4ecdc4;
            color: white;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 20px;
            text-align: center;
            color: #bdc3c7;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-nav {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .header-actions {
                gap: 10px;
            }

            .main-content {
                margin-top: 70px;
            }
        }

        /* Scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ff6b6b;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ee5a52;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <a href="{{ route('home') }}" class="logo">
                    🎵 TixConcert
                </a>
                
                <nav class="main-nav">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('concerts.index') }}" class="nav-link {{ request()->routeIs('concerts.*') ? 'active' : '' }}">Concerts</a>
                    <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}">Events</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                
                </nav>
                
                <div class="header-actions">
                    <button class="search-btn" title="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="cart-btn" title="Cart">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge">3</span>
                    </button>
                    <button class="user-btn" title="Account">
                        <i class="fas fa-user"></i>
                    </button>
                    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="mobile-nav" id="mobileNav">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('concerts.index') }}" class="nav-link">Concerts</a>
                <a href="{{ route('events.index') }}" class="nav-link">Events</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
            
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>TixConcert</h3>
                    <p>Your ultimate destination for premium concert experiences. We bring you closer to your favorite artists.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('concerts.index') }}">Concerts</a></li>
                        <li><a href="{{ route('events.index') }}">Events</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Newsletter</h3>
                    <p>Subscribe to get updates on new concerts and exclusive offers.</p>
                    <form class="newsletter-form" style="margin-top: 15px;">
                        <input type="email" placeholder="Enter your email" style="width: 100%; padding: 10px; border: none; border-radius: 5px; margin-bottom: 10px;">
                        <button type="submit" style="width: 100%; padding: 10px; background: #4ecdc4; color: white; border: none; border-radius: 5px; cursor: pointer;">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} TixConcert. All rights reserved. Made with ❤️ for music lovers.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            mobileNav.classList.toggle('active');
        }

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.main-header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.backdropFilter = 'blur(15px)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileNav = document.getElementById('mobileNav');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (!mobileNav.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                mobileNav.classList.remove('active');
            }
        });

        // Newsletter form submission
        document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                alert('Thank you for subscribing! 🎵');
                this.reset();
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
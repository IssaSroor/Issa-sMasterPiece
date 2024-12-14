<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    <!-- Add your CSS files -->
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="custom-navbar">
            <div class="container">
                <a href="#" class="logo">Sofra</a>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('all') }}">Kitchens</a></li>
                    <li><a href="#popular-kitchens">About Us</a></li>
                    <li><a href={{ route('show') }}>Contact Us</a></li>
                    <li><a href="{{ route('owner.register') }}">Join us as kitchen</a></li>
                </ul>
                <div class="nav-icons">
                    <a href="#" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                    <a href="#" class="user-icon"><i class="fas fa-user"></i></a>
                </div>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <h3>Sofra</h3>
                <p>Delicious home made deshies, delivered to you!</p>
            </div>

            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="all">Kitchens</a></li>
                    <li><a href="about">About Us</a></li>
                    <li><a href="contact">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Contact Us</h4>
                <ul>
                    <li><a href="tel:+1234567890">Phone: +962 772 486 291</a></li>
                    <li><a href="mailto:info@sofra.com">Email: sofra@gmail.com</a></li>
                </ul>
            </div>

            <div class="footer-social">
                <h4>Follow Us</h4>
                <ul>
                    <li><a href="#" target="_blank">Facebook</a></li>
                    <li><a href="#" target="_blank">Instagram</a></li>
                    <li><a href="#" target="_blank">Twitter</a></li>
                    <li><a href="#" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} Sofra. All Rights Reserved.</p>
            </div>
        </div>

    </footer>


    <!-- Add your JS files -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select elements
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            // Toggle the menu visibility on click
            menuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('show');
            });
        });
    </script>
    
    </script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>

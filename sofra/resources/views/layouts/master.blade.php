<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    <!-- Add your CSS files -->
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="container">
                <!-- Logo -->
                <p class="logo">Sofra</p>
            </div>
            <div class="container respon">
                <!-- Navigation Links -->
                <ul class="navbar-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('all') }}">Kitchens</a></li>
                    <li><a href="#popular-kitchens">About Us</a></li>
                    <li><a href={{ route('show') }}>Contact Us</a></li>
                    <li><a href="#contact">Join us as kitchen</a></li>
                </ul>
            </div>
                <div class="dropdown-menu">
                    <form class="dropdown-form">
                        <select name="nav-links" id="nav-links">
                            <option value="" disabled selected class="menu-icon">&#9776; Menu</option>
                            <option value="home">Home</option>
                            <option value="about">Kitchens</option>
                            <option value="services">About Us</option>
                            <option value="contact">Contact Us</option>
                            <option value="join">Join us as kitchen</option>
                        </select>
                    </form>
                </div>
            <div class="container2">
            <div class="navbar-cart">
                <a href="" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    @if (session()->has('cart') && count(session('cart')) > 0)
                        <span class="cart-count">{{ count(session('cart')) }}</span>
                    @else
                        <span class="cart-count">0</span>
                    @endif
                </a>
            </div>

            <!-- User Links -->
            <div class="navbar-user">
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Kitchens</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
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
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>

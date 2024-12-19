<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home')</title>
    <!-- Add your CSS files -->
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('show') }}">Contact Us</a></li>
                    <li><a href="{{ route('owner.register') }}">Join us as kitchen</a></li>
                </ul>
                <div class="nav-icons">
                    <!-- Updated cart icon -->
                    <a href="{{ route('cart.view') }}" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                    <a href="#" class="user-icon" onclick="redirectToUserPage(event)"><i
                            class="fas fa-user"></i></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Add your JS files -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>

    <script>
        function redirectToUserPage(event) {
            event.preventDefault();

            // Replace with your logic to check if the user is logged in
            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            if (isLoggedIn) {
                // Redirect to user profile
                window.location.href = '/dashboard'; // Replace with the actual user profile URL
            } else {
                // Redirect to login page
                window.location.href = '/login'; // Replace with the actual login URL
            }
        }
    </script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateNavCartCount() {
            const cart = getCookie('cart');
            let itemCount = 0;

            if (cart.length > 0) {
                cart.forEach(item => {
                    itemCount += item.quantity; // Sum up the quantity of all items in the cart
                });
            }

            // Update the cart count in the nav
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = itemCount; // Set the count dynamically
            }
        }

        function getCookie(name) {
            const cookies = document.cookie.split('; ');
            for (let cookie of cookies) {
                const [key, value] = cookie.split('=');
                if (key === name) {
                    return JSON.parse(value || '[]');
                }
            }
            return [];
        }

        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 24 * 60 * 60 * 1000).toUTCString();
            document.cookie = `${name}=${JSON.stringify(value)}; path=/; expires=${expires}`;
        }

        function addToCart(itemId, kitchenId, productName, productPrice, productImage) {
            let cart = getCookie('cart');
            if (cart.length > 0) {
                const existingKitchenId = cart[0].kitchenId;
                if (existingKitchenId !== kitchenId) {
                    Swal.fire({
                        title: 'Different Kitchen Detected',
                        text: 'Adding items from different kitchens is not allowed. Do you want to replace the current cart items?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Continue',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Clear the cart and add the new item
                            cart = [{
                                productId: itemId,
                                kitchenId: kitchenId,
                                productName: productName,
                                productPrice: productPrice,
                                productImage: productImage,
                                quantity: 1,
                            }, ];
                            setCookie('cart', cart, 7);
                            Swal.fire('Cart Updated', 'Your cart has been replaced.', 'success');
                            updateNavCartCount(); // Update the nav count

                        }
                    });
                    return;
                }
            }

            // Add the item to the cart
            const existingItem = cart.find(item => item.productId === itemId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    productId: itemId,
                    kitchenId: kitchenId,
                    productName: productName,
                    productPrice: productPrice,
                    productImage: productImage,
                    quantity: 1,
                });
            }

            setCookie('cart', cart, 7);
            Swal.fire('Added to Cart', `${productName} has been added to your cart.`, 'success');
            updateNavCartCount(); // Update the nav count

        }


        document.addEventListener('DOMContentLoaded', () => {
            updateNavCartCount();
        });
    </script>
    <script>
        function removeFromCart(productId) {
            let cart = getCookie('cart');
            const updatedCart = cart.filter(item => item.productId != productId);

            setCookie('cart', updatedCart, 7); // Update cart in cookies
            updateCartUI(); // Update the UI without reloading the page
        }

        function updateCartQuantity(productId, newQuantity) {
            let cart = getCookie('cart');

            // Update quantity for the specific product
            cart = cart.map(item => {
                if (item.productId === productId) {
                    item.productQuantity = newQuantity;
                }
                return item;
            });

            setCookie('cart', cart, 7); // Update cart in cookies
            updateCartUI(); // Refresh the UI
        }

        // Update the cart UI dynamically
        function updateCartUI() {
            const cartTable = document.querySelector('.cart-table tbody');
            const cart = getCookie('cart');

            if (cartTable) {
                // Clear the current table content
                cartTable.innerHTML = '';

                if (cart.length > 0) {
                    cart.forEach(item => {
                        const row = `
                    <tr>
                        <td><img src="${item.productImage}" alt="${item.productName}" width="50"></td>
                        <td>${item.productName}</td>
                        <td>${item.productPrice} JD</td>
                        <td>${item.quantity}</td>
                        <td>
                            <button onclick="removeFromCart(${item.productId})" class="btn-remove"><i class="fa fa-multiply"></i></button>
                        </td>
                    </tr>
                `;
                        cartTable.innerHTML += row;
                    });
                } else {
                    cartTable.innerHTML = '<tr><td colspan="5">Your cart is empty.</td></tr>';
                }
            }

            updateCartSummary(cart); // Update cart totals
            updateNavCartCount(); // Update cart count in the navigation bar
        }

        // Update the cart summary dynamically
        function updateCartSummary(cart) {
            const subtotalElement = document.querySelector('.cart-summary .subtotal');
            const totalElement = document.querySelector('.cart-summary .total');

            const subtotal = cart.reduce(
                (sum, item) => sum + item.productPrice * item.productQuantity,
                0
            );
            const shipping = 2; // Fixed shipping rate
            const total = subtotal + shipping;

            if (subtotalElement) subtotalElement.textContent = `${subtotal.toFixed(2)} JD`;
            if (totalElement) totalElement.textContent = `${total.toFixed(2)} JD`;
        }

        // Ensure cart is updated on page load and back navigation
        document.addEventListener('DOMContentLoaded', () => {
            updateCartUI();

            // Prevent stale state when navigating back
            window.addEventListener('popstate', () => {
                updateCartUI();
            });
        });
    </script>

    <script>
        // Utility to get cookie data
        function getCookie(name) {
            const cookies = document.cookie.split('; ');
            for (let cookie of cookies) {
                const [key, value] = cookie.split('=');
                if (key === name) {
                    return JSON.parse(value || '[]');
                }
            }
            return [];
        }

        function calculateCartTotals() {
            const cart = getCookie('cart');
            let subtotal = 0;

            // Calculate subtotal
            cart.forEach(item => {
                subtotal += item.productPrice * item.quantity;
            });

            // Update subtotal and total in the UI
            const shipping = 2; // Fixed shipping cost
            const total = subtotal + shipping;

            document.getElementById('subtotal').textContent = `${subtotal.toFixed(2)} JD`;
            document.getElementById('total').textContent = `${total.toFixed(2)} JD`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            calculateCartTotals(); // Update totals on page load
        });
    </script>

    <script>
        function showLoginAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'You need to log in',
                text: 'Please log in to send a message.',
                confirmButtonText: 'Log In',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}"; // Redirect to the login page
                }
            });
        }
    </script>

    <script>
        function showReviewForm(kitchenId) {
            console.log('Checking if user has purchased from kitchen ID:', kitchenId); // Debug log

            fetch('/reviews/check-purchased', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        kitchen_id: kitchenId
                    }),
                })
                .then(response => {
                    console.log('Response status:', response.status); // Debug log
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data); // Debug log

                    if (data.status === 'success') {
                        // Show the review form
                        console.log('Review form will be displayed');
                        document.getElementById('reviewForm').style.display = 'block';
                    } else {
                        // Show SweetAlert for error messages
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error); // Debug log for fetch errors
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating .star');
            const reviewRatingInput = document.getElementById('review_rating');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-value');

                    // Update hidden input value
                    reviewRatingInput.value = rating;

                    // Update selected stars
                    stars.forEach(s => {
                        s.classList.remove('selected');
                        if (s.getAttribute('data-value') <= rating) {
                            s.classList.add('selected');
                        }
                    });
                });
            });
        });
    </script>

    </script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>

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
    <link rel="stylesheet" href="{{ asset('css/new.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <style>
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
        }
    </style>
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
                    <li><a href="{{ route('owner.login') }}">Join us as kitchen</a></li>
                </ul>
                <div class="nav-icons">
                    <!-- Updated cart icon -->
                    <a href="{{ route('cart.view') }}" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                    <!-- User Icon -->
                    @if (auth()->check())
                        <!-- If User is Logged In -->
                        <div class="dropdown user-dropdown">
                            <a href="#" class="user-icon dropdown-toggle" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item profile-link"
                                        onclick="redirectToUserPage(event)">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-button">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- If User is Not Logged In -->
                        <a href="{{ route('login') }}" class="user-icon">
                            <i class="fas fa-sign-in-alt"></i> <!-- Login Icon -->
                        </a>
                    @endif

                </div>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </nav>

    </header>
    @php
        use Diglactic\Breadcrumbs\Breadcrumbs;
    @endphp

    @if (
        !Route::is('home') &&
            !Route::is('owner.register') &&
            !Route::is('owner.login') &&
            !Route::is('cart.view') &&
            !Route::is('checkout.index') &&
            !Route::is('kitchen.show') &&
            !Route::is('menu') &&
            !Route::is('thankyou.page'))
        <!-- Check if the current route is not the home page -->
        <div class="breadcrumb-container">
            <h1 class="breadcrumb-title">
                {{ Breadcrumbs::current() ? Breadcrumbs::current()->title : '' }}
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach (Breadcrumbs::generate() as $breadcrumb)
                        @if ($breadcrumb->url && !$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    @endif

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

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `
                <ul style="text-align: left; margin: 0; padding: 0; list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                showConfirmButton: false,
                timer: 5000
            });
        @endif
    </script>

    <script>
        document.getElementById('questionForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(error => {
                error.textContent = '';
                error.classList.remove('show');
            });
            document.querySelectorAll('input, textarea').forEach(input => {
                input.classList.remove('error');
            });

            // Validate Name
            const name = document.getElementById('client_name');
            if (!name.value.trim()) {
                document.getElementById('nameError').textContent = 'Name is required';
                document.getElementById('nameError').classList.add('show');
                name.classList.add('error');
                isValid = false;
            } else if (!isNaN(name.value)) {
                document.getElementById('nameError').textContent = "Name must contain only letters and spaces.";
                document.getElementById('nameError').classList.add('show');
                name.classList.add('error');
                isValid = false;
            }

            // Validate Email
            const email = document.getElementById('client_email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim() || !emailRegex.test(email.value)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                document.getElementById('emailError').classList.add('show');
                email.classList.add('error');
                isValid = false;
            }

            // Validate Subject
            const subject = document.getElementById('subject');
            if (!subject.value.trim()) {
                document.getElementById('subjectError').textContent = 'Subject is required';
                document.getElementById('subjectError').classList.add('show');
                subject.classList.add('error');
                isValid = false;
            }

            // Validate Message
            const message = document.getElementById('question');
            if (!message.value.trim()) {
                document.getElementById('messageError').textContent = 'Message is required';
                document.getElementById('messageError').classList.add('show');
                message.classList.add('error');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Validate Name
            const name = document.getElementById("name");
            const nameError = document.getElementById("nameError");
            if (!name.value.trim()) {
                nameError.textContent = "Name is required.";
                isValid = false;
            } else if (!isNaN(name.value)) {
                nameError.textContent = "Name must contain only letters and spaces.";
                isValid = false;
            } else {
                nameError.textContent = "";
            }

            // Validate Email
            const email = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim()) {
                emailError.textContent = "Email is required.";
                isValid = false;
            } else if (!emailPattern.test(email.value)) {
                emailError.textContent = "A valid email address is required.";
                isValid = false;
            } else {
                emailError.textContent = "";
            }

            // Validate Password
            const password = document.getElementById("password");
            const passwordError = document.getElementById("passwordError");
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;

            if (!password.value.trim()) {
                passwordError.textContent = "Password is required.";
                isValid = false;
            } else if (!passwordPattern.test(password.value)) {
                passwordError.textContent =
                    "Password must be at least 8 characters, include one uppercase letter, one lowercase letter, and one special character.";
                isValid = false;
            } else {
                passwordError.textContent = "";
            }


            // Validate Password Confirmation
            const passwordConfirmation = document.getElementById("password_confirmation");
            const passwordConfirmationError = document.getElementById("passwordConfirmationError");
            if (!passwordConfirmation.value.trim()) {
                passwordConfirmationError.textContent = "Password confirmation is required.";
                isValid = false;
            } else if (password.value !== passwordConfirmation.value) {
                passwordConfirmationError.textContent = "Passwords do not match.";
                isValid = false;
            } else {
                passwordConfirmationError.textContent = "";
            }

            // Validate Address
            const address = document.getElementById("address");
            const addressError = document.getElementById("addressError");
            if (!address.value.trim()) {
                addressError.textContent = "Address is required.";
                isValid = false;
            } else if (!isNaN(address.value)) {
                addressError.textContent = "Address must contain only letters and spaces.";
                isValid = false;
            } else {
                addressError.textContent = "";
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Validate Email
            const emailField = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailField.value.trim()) {
                emailError.textContent = "Email is required.";
                isValid = false;
            } else if (!emailPattern.test(emailField.value)) {
                emailError.textContent = "Please enter a valid email.";
                isValid = false;
            } else {
                emailError.textContent = "";
            }

            // Validate Password
            const passwordField = document.getElementById("password");
            const passwordError = document.getElementById("passwordError");
            if (!passwordField.value.trim()) {
                passwordError.textContent = "Password is required.";
                isValid = false;
            } else {
                passwordError.textContent = "";
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

    <script>
        function viewOrderDetails(button) {
            const orderId = button.getAttribute('data-order-id');

            // Fetch order details using an AJAX call
            fetch(`/orders/${orderId}`)
                .then(response => response.json())
                .then(order => {
                    // Populate modal fields
                    document.getElementById('modalOrderId').textContent = order.id;
                    document.getElementById('modalOrderDate').textContent = new Date(order.created_at)
                        .toLocaleDateString();
                    document.getElementById('modalOrderTotal').textContent = order.order_total_amount;
                    document.getElementById('modalOrderStatus').textContent = order.order_status;

                    // Populate food items
                    const foodItemsList = document.getElementById('modalFoodItems');
                    foodItemsList.innerHTML = ''; // Clear existing items
                    order.food_items.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item';
                        li.textContent = `${item.name} - ${item.quantity} x ${item.price} JD`;
                        foodItemsList.appendChild(li);
                    });

                    // Show the modal
                    const orderDetailsModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
                    orderDetailsModal.show();
                })
                .catch(error => console.error('Error fetching order details:', error));
        }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateNavCartCount() {
            let cart = getCookie('cart');
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

        // Update the cart UI dynamically
        function updateCartUI() {
            const cartTable = document.querySelector('.cart-table tbody');
            let cart = getCookie('cart');

            if (cartTable) {
                cartTable.innerHTML = '';

                if (cart.length > 0) {
                    cart.forEach(item => {
                        const row = `
                <tr>
                    <td><img src="${item.productImage}" alt="${item.productName}" width="50"></td>
                    <td>${item.productName}</td>
                    <td>${item.productPrice} JD</td>
                    <td>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus-btn" data-id="${item.productId}">-</button>
                            <span id="quantity-${item.productId}">${item.quantity}</span>
                            <button type="button" class="quantity-btn plus-btn" data-id="${item.productId}">+</button>
                        </div>
                    </td>
                    <td>
                        <button type="button" onclick="removeFromCart(${item.productId})" class="btn-remove"><i class="fa fa-multiply"></i></button>
                    </td>
                </tr>
            `;
                        cartTable.innerHTML += row;
                    });
                } else {
                    cartTable.innerHTML = '<tr><td colspan="5">Your cart is empty.</td></tr>';
                }
            }

            calculateCartTotals();
            updateNavCartCount();
        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('quantity-btn')) {
                event.preventDefault();

                const isPlus = event.target.classList.contains('plus-btn');
                const productId = event.target.dataset.id;
                const quantitySpan = document.getElementById(`quantity-${productId}`);
                let currentQuantity = parseInt(quantitySpan.textContent);

                if (isPlus) {
                    currentQuantity++;
                } else if (currentQuantity > 1) {
                    currentQuantity--;
                }

                quantitySpan.textContent = currentQuantity;
                updateCartQuantity(productId, currentQuantity);
            }
        });

        function updateCartQuantity(productId, quantity) {
            console.log('Updating cart for productId:', productId, 'quantity:', quantity);

            // Get the cart from the cookie
            let cart = getCookie('cart');

            // Find the product in the cart and update its quantity
            const updatedCart = cart.map(item => {
                if (item.productId == productId) {
                    item.quantity = quantity;
                }
                return item;
            });

            // Save the updated cart back to the cookie
            setCookie('cart', cart, 7);

            console.log('Cart updated:', updatedCart);
            updateCartUI(); // Refresh the cart UI after updating
        }



        document.addEventListener('DOMContentLoaded', updateCartUI);
    </script>
    <script>
        function calculateCartTotals() {
            let cart = getCookie('cart');
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
        function hideReviewForm() {
            document.getElementById('reviewForm').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>

    <script>
        function showReviewForm(kitchenId) {
            // Show backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop';
            document.body.appendChild(backdrop);
            backdrop.style.display = 'block';

            // Show review form
            const reviewForm = document.getElementById('reviewForm');
            reviewForm.style.display = 'block';

            // Update kitchen_id
            document.querySelector('input[name="kitchen_id"]').value = kitchenId;

            // Prevent body scrolling
            document.body.style.overflow = 'hidden';
        }

        function hideReviewForm() {
            // Hide review form
            document.getElementById('reviewForm').style.display = 'none';

            // Remove backdrop
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }

            // Restore body scrolling
            document.body.style.overflow = 'auto';
        }

        // Star rating functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('review_rating');

            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const value = this.dataset.value;
                    highlightStars(value);
                });

                star.addEventListener('click', function() {
                    const value = this.dataset.value;
                    ratingInput.value = value;
                    highlightStars(value);
                });
            });

            document.querySelector('.star-rating').addEventListener('mouseout', function() {
                const rating = ratingInput.value;
                highlightStars(rating);
            });

            function highlightStars(value) {
                stars.forEach(star => {
                    star.classList.toggle('active', star.dataset.value <= value);
                });
            }
        });
    </script>

    <script>
        function showReviewForm(orderId, kitchenId) {
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop';
            document.body.appendChild(backdrop);
            backdrop.style.display = 'block';

            const reviewForm = document.getElementById('reviewForm');
            reviewForm.style.display = 'block';

            // Assign dynamic values to hidden inputs
            document.getElementById('order_id').value = orderId;
            document.getElementById('kitchen_id').value = kitchenId;

            document.body.style.overflow = 'hidden';
        }


        function hideReviewForm() {
            // Hide review form
            const reviewForm = document.getElementById('reviewForm');
            reviewForm.style.display = 'none';
            reviewForm.setAttribute('aria-hidden', 'true');

            // Remove backdrop
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }

            // Restore body scrolling
            document.body.style.overflow = 'auto';
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

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            let currentSlide = 0;

            // Initialize the first slide
            slides[currentSlide].classList.add('active');

            // Auto-advance slides
            setInterval(() => {
                const outgoingSlide = slides[currentSlide];
                currentSlide = (currentSlide + 1) % slides.length;
                const incomingSlide = slides[currentSlide];

                // Add "active" to the next slide
                incomingSlide.classList.add('active');

                // Remove "active" from the current slide after fade-out
                setTimeout(() => {
                    outgoingSlide.classList.remove('active');
                }, 1000); // Match this with the CSS transition duration (1s)
            }, 5000); // Change slide every 5 seconds
        });
    </script>

    </script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> <!-- Include your styles -->
    <style>
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form method="POST" action="{{ route('admin.login') }}" id="adminLoginForm">
            @csrf
            <div>
                <label for="email">Email</label>
                <input  id="email" name="email" class="email">
                <span id="emailError" class="error-message"></span>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" >
                <span id="passwordError" class="error-message"></span>
            </div>
            <button type="submit" class="button btn-danger">Login</button>
        </form>
    </div>

    <script>
        document.getElementById("adminLoginForm").addEventListener("submit", function(event) {
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
</body>
</html>

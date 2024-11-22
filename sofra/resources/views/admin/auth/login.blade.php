<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> <!-- Include your styles -->
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="button btn-danger">Login</button>
        </form>
    </div>
</body>
</html>

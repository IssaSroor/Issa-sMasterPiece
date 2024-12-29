<x-guest-layout>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="register-container">
        <h2 class="register-title">Hungry?</h2>

    <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
    @csrf

    <!-- Email Address -->
    <div class="form-group">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <div class="error-message" id="emailError"></div>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="form-group">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="form-input"
                      type="password"
                      name="password"
                      required autocomplete="current-password" />
        <div class="error-message" id="passwordError"></div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="form-footer"></div>

    <!-- Form Footer -->
    <div class="form-footer">
        <a class="login-link" href="/register">Register Here</a>
        <x-primary-button class="register-button">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</form>

<script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        // Clear previous errors
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        emailError.textContent = '';
        passwordError.textContent = '';

        // Input elements
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        let valid = true;

        // Email validation
        if (!email.value) {
            emailError.textContent = 'Email is required.';
            valid = false;
        } else if (!/\S+@\S+\.\S+/.test(email.value)) {
            emailError.textContent = 'Please enter a valid email address.';
            valid = false;
        }

        // Password validation
        if (!password.value) {
            passwordError.textContent = 'Password is required.';
            valid = false;
        }

        // Prevent form submission if validation fails
        if (!valid) {
            e.preventDefault();
        }
    });
</script>

</x-guest-layout>

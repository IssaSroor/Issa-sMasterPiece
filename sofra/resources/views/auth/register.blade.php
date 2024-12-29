<x-guest-layout>
    <div class="register-container">
        <h2 class="register-title">Create Your Account</h2>

        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
    @csrf

    <!-- Name -->
    <div class="form-group">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <div class="error-message" id="nameError"></div>
        <x-input-error :messages="$errors->get('name')" class="error-message" />
    </div>

    <!-- Email Address -->
    <div class="form-group">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <div class="error-message" id="emailError"></div>
        <x-input-error :messages="$errors->get('email')" class="error-message" />
    </div>

    <!-- Phone -->
    <div class="form-group">
        <x-input-label for="phone" :value="__('Phone')" />
        <x-text-input id="phone" class="form-input" type="number" name="phone" :value="old('phone')" required autocomplete="username" />
        <div class="error-message" id="phoneError"></div>
        <x-input-error :messages="$errors->get('phone')" class="error-message" />
    </div>

    <!-- Address -->
    <div class="form-group">
        <x-input-label for="address" :value="__('Address')" />
        <x-text-input id="address" class="form-input" type="text" name="address" :value="old('address')" required autocomplete="username" />
        <div class="error-message" id="addressError"></div>
        <x-input-error :messages="$errors->get('address')" class="error-message" />
    </div>

    <!-- Password -->
    <div class="form-group">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
        <div class="error-message" id="passwordError"></div>
        <x-input-error :messages="$errors->get('password')" class="error-message" />
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
        <div class="error-message" id="confirmPasswordError"></div>
        <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
    </div>

    <div class="form-footer">
        <a class="login-link" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        <x-primary-button class="register-button">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>

<script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        // Clear previous errors
        const errors = {
            name: document.getElementById('nameError'),
            email: document.getElementById('emailError'),
            phone: document.getElementById('phoneError'),
            address: document.getElementById('addressError'),
            password: document.getElementById('passwordError'),
            confirmPassword: document.getElementById('confirmPasswordError'),
        };
        Object.values(errors).forEach(error => error.textContent = '');

        // Input elements
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const phone = document.getElementById('phone');
        const address = document.getElementById('address');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        let valid = true;

        // Name validation
        if (!name.value.trim()) {
            errors.name.textContent = 'Name is required.';
            valid = false;
        } else if (!/^[a-zA-Z\s]+$/.test(name.value)) {
            errors.name.textContent = 'Name must contain only letters and spaces.';
            valid = false;
        }

        // Email validation
        if (!email.value.trim()) {
            errors.email.textContent = 'Email is required.';
            valid = false;
        } else if (!/\S+@\S+\.\S+/.test(email.value)) {
            errors.email.textContent = 'Please enter a valid email address.';
            valid = false;
        }

        // Phone validation
        if (!phone.value.trim()) {
            errors.phone.textContent = 'Phone number is required.';
            valid = false;
        } else if (!/^\d{10}$/.test(phone.value)) {
            errors.phone.textContent = 'Phone number must be exactly 10 digits.';
            valid = false;
        }

        // Address validation
        if (!address.value.trim()) {
            errors.address.textContent = 'Address is required.';
            valid = false;
        } else if (!/^[a-zA-Z0-9\s,.-]+$/.test(address.value)) {
            errors.address.textContent = 'Address must contain only letters, numbers, spaces, and common punctuation (,.-).';
            valid = false;
        }

        // Password validation
        if (!password.value) {
    errors.password.textContent = 'Password is required.';
    valid = false;
} else {
    const passwordErrors = [];

    if (password.value.length < 8) {
        passwordErrors.push('Password must be at least 8 characters long.');
    }
    if (!/(?=.*[A-Z])/.test(password.value)) {
        passwordErrors.push('Password must contain at least 1 capital letter.');
    }
    if (!/(?=.*\d)/.test(password.value)) {
        passwordErrors.push('Password must contain at least 1 number.');
    }
    if (!/(?=.*[!@#$%^&*(),.?":{}|<>])/.test(password.value)) {
        passwordErrors.push('Password must contain at least 1 special character.');
    }

    // Display all errors if any exist
    if (passwordErrors.length > 0) {
        errors.password.textContent = passwordErrors.join(' ');
        valid = false;
    }
}

        // Confirm Password validation
        if (password.value !== confirmPassword.value) {
            errors.confirmPassword.textContent = 'Passwords do not match.';
            valid = false;
        }

        // Prevent form submission if validation fails
        if (!valid) {
            e.preventDefault();
        }
    });
</script>


    </div>
</x-guest-layout>

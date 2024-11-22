<x-guest-layout>
    <div class="register-container">
        <h2 class="register-title">Create Your Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="error-message" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <div class="form-group">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="form-input" type="number" name="phone" :value="old('phone')" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('phone')" class="error-message" />
            </div>

            <div class="form-group">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="form-input" type="text" name="address" :value="old('address')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('address')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-input" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>

            <div class="form-footer">
                <a class="login-link" href="{{ route('login') }}">{{ __('Already registered?') }}</a>

                <x-primary-button class="register-button">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>

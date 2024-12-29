@extends('layouts.master')

@section('content')
<div class="register-container">
    <h1 class="form-title">Register As Kitchen Owner</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('owner.register') }}" enctype="multipart/form-data" class="styled-form" id="registerForm">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="owner_name" id="name" value="{{ old('name') }}"  class="form-input">
            <small id="nameError" class="error-message"></small>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input name="email" id="email" value="{{ old('email') }}"  class="form-input">
            <small id="emailError" class="error-message"></small>
        </div>
        <div class="form-group">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="owner_address" id="address" value="{{ old('address') }}"  class="form-input">
            <small id="addressError" class="error-message"></small>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password"  class="form-input">
            <small id="passwordError" class="error-message"></small>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation"  class="form-input">
            <small id="passwordConfirmationError" class="error-message"></small>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection

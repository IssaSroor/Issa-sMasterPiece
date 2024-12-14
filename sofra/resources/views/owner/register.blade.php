@extends('layouts.master')

@section('content')
<div class="register-container">
    <h1 class="form-title">Register As Kitchen Owner</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('owner.register') }}" enctype="multipart/form-data" class="styled-form">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="owner_name" id="name" value="{{ old('name') }}" required class="form-input">
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-input">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" required class="form-input">
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-input">
        </div>
        <div class="form-group">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="owner_address" id="address" value="{{ old('address') }}" required class="form-input">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <div class="login-redirect">
        <p>Already have an account?</p>
        <a href="{{ route('owner.login') }}" class="btn btn-secondary">Login Here</a>
    </div>
</div>
@endsection

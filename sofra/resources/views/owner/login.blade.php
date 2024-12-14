@extends('layouts.master')

@section('content')
<div class="register-container">
    <h1>Login as a Kitchen Owner</h1>

    <form method="POST" action="{{ route('owner.login') }}" enctype="multipart/form-data" class="styled-form">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-input" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection

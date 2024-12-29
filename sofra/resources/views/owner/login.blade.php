@extends('layouts.master')

@section('content')
    <div class="register-container1">
        <h1>Login as a Kitchen Owner</h1>

        <form method="POST" action="{{ route('owner.login') }}" enctype="multipart/form-data" class="styled-form1"
            id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input name="email" id="email" class="form-input1" value="{{ old('email') }}" >
                <span id="emailError" class="error-message"></span>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-input1" >
                <span id="passwordError" class="error-message"></span>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="login-redirect" style="display: flex; justify-content:space-around; align-items:center; ">
            <p>Don't have an account? <span><a href="{{ route('owner.register') }}" style="color: #ff4500; text-decoration:none;">Register Here</a></span></p>
            
        </div>
    </div>
@endsection

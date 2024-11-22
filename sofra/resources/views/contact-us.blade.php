@extends('layouts.master')

@section('content')
<div class="contact-form">
    <h1>Contact Us</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_name">Name</label>
            <input type="text" id="client_name" name="client_name" required>
        </div>
        <div class="form-group">
            <label for="client_email">Email</label>
            <input type="email" id="client_email" name="client_email" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="question">Message</label>
            <textarea id="question" name="question" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn-submit">Submit</button>
    </form>
</div>
@endsection

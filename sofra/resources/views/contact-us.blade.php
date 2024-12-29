@extends('layouts.master')

@section('content')
<div class="contact-form">
    <h1>Contact Us</h1>
    <form id="questionForm" action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_name">Name</label>
            <input type="text" id="client_name" name="client_name" >
            <small class="error-message" id="nameError"></small>
        </div>
        <div class="form-group">
            <label for="client_email">Email</label>
            <input type="email" id="client_email" name="client_email" >
            <small class="error-message" id="emailError"></small>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" >
            <small class="error-message" id="subjectError"></small>
        </div>
        <div class="form-group">
            <label for="question">Message</label>
            <textarea id="question" name="question" rows="4" ></textarea>
            <small class="error-message" id="messageError"></small>
        </div>
        <button type="submit" class="btn-submit">Submit</button>
    </form>
    
    <script>
        document.getElementById('questionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Reset previous error messages
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => element.textContent = '');

            let isValid = true;
            const errors = {};

            // Get form elements
            const clientName = document.getElementById('client_name').value.trim();
            const clientEmail = document.getElementById('client_email').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const question = document.getElementById('question').value.trim();

            // Name validation
            if (clientName === '') {
                errors.name = 'Name is required';
                isValid = false;
            } else if (clientName.length < 2) {
                errors.name = 'Name must be at least 2 characters long';
                isValid = false;
            } else if (!/^[a-zA-Z\s'-]+$/.test(clientName)) {
                errors.name = 'Name can only contain letters, spaces, hyphens and apostrophes';
                isValid = false;
            }

            // Email validation
            if (clientEmail === '') {
                errors.email = 'Email is required';
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(clientEmail)) {
                errors.email = 'Please enter a valid email address';
                isValid = false;
            }

            // Subject validation
            if (subject === '') {
                errors.subject = 'Subject is required';
                isValid = false;
            } else if (subject.length < 3) {
                errors.subject = 'Subject must be at least 3 characters long';
                isValid = false;
            }

            // Message validation
            if (question === '') {
                errors.message = 'Message is required';
                isValid = false;
            } else if (question.length < 10) {
                errors.message = 'Message must be at least 10 characters long';
                isValid = false;
            }

            // Display errors if any
            if (!isValid) {
                if (errors.name) document.getElementById('nameError').textContent = errors.name;
                if (errors.email) document.getElementById('emailError').textContent = errors.email;
                if (errors.subject) document.getElementById('subjectError').textContent = errors.subject;
                if (errors.message) document.getElementById('messageError').textContent = errors.message;
                return;
            }

            // If validation passes, you can submit the form
            this.submit();
        });

        // Add real-time validation
        const inputs = {
            'client_name': 'nameError',
            'client_email': 'emailError',
            'subject': 'subjectError',
            'question': 'messageError'
        };

        for (const [inputId, errorId] of Object.entries(inputs)) {
            document.getElementById(inputId).addEventListener('input', function() {
                document.getElementById(errorId).textContent = '';
            });
        }
    </script>
@endsection

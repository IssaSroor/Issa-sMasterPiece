@extends('layouts.master')

@section('content')
<div class="thank-you-container" style="text-align: center; padding: 50px;">
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been placed successfully. We’ll notify you when it’s on the way.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
</div>
@endsection

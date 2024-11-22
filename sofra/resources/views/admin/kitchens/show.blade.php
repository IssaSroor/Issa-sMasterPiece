@extends('admin.layouts.admin')

@section('title', 'Kitchen Details')

@section('header-title', 'Kitchen Details')

@section('content')
<div class="container">
    <div class="section">
        <h2>{{ $kitchen->kitchen_name }}</h2>
        <div class="details">
            <p><strong>Owner Name:</strong> {{ $kitchen->owner->owner_name }}</p>
            <p><strong>Description:</strong> {{ $kitchen->kitchen_description }}</p>
            <p><strong>Phone:</strong> {{ $kitchen->kitchen_phone }}</p>
            <p><strong>Address:</strong> {{ $kitchen->kitchen_address }}</p>
        </div>
        <div class="image-section">
            <h3>Kitchen Image:</h3>
            <img src="{{ asset('storage/' . $kitchen->kitchen_image) }}" alt="{{ $kitchen->kitchen_name }}" style="max-width: 100%; border-radius: 8px;">
        </div>
        <a href="{{ route('admin.kitchens.admin_index') }}" class="btn btn-primary mt-3">Back to Kitchens</a>
    </div>
</div>
@endsection

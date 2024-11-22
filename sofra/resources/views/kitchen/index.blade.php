@extends('layouts.master')

@section('title', 'All Kitchens')

@section('content')
    <!-- Navbar -->

    <!-- Filters -->
    <div class="filters-container">
        <div class="primary-filters">
            <button class="btn btn-primary" onclick="filterKitchens('food')">Food</button>
            <button class="btn btn-primary" onclick="filterKitchens('dessert')">Dessert</button>
        </div>
        <div class="secondary-filters">
            <button class="btn btn-secondary" onclick="filterKitchens('free-delivery')">Free Delivery</button>
            <button class="btn btn-secondary" onclick="filterKitchens('rating')">High Rating</button>
            <button class="btn btn-secondary" onclick="filterKitchens('time')">Fast Delivery</button>
        </div>
    </div>

    <!-- Kitchens List -->
    <div class="kitchen-list">
        @foreach($kitchens as $kitchen)
            <div class="kitchen-card">
                <div class="kitchen-image">
                    <img src="{{ asset('storage/kitchens/' . $kitchen->kitchen_image) }}" alt="{{ $kitchen->kitchen_name }}">
                </div>
                <div class="kitchen-details">
                    <div class="top-row">
                        <h3>{{ $kitchen->kitchen_name }}</h3>
                        <span>{{ $kitchen->kitchen_address }}</span>
                        <span>{{ $kitchen->time_for_delivery }} mins</span>
                    </div>
                    <p>{{ $kitchen->kitchen_short_desc }}</p>
                    <div class="bottom-row">
                        @if($kitchen->free_delivery)
                            <span class="badge badge-success">Free Delivery</span>
                        @endif
                        <span class="rating">⭐ {{ $kitchen->rating }}/5</span>
                        @if($kitchen->discount)
                            <span class="discount">Discount: {{ $kitchen->discount }}%</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Footer -->
@endsection

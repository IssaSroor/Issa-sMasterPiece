@extends('layouts.master')

@section('title', 'All Kitchens')

@section('content')
    <!-- Navbar -->

    <!-- Filters -->
    <div class="filters-container">
        <div class="primary-filters">
            <a href="{{ route('all') }}" class="btn btn-primary">All Kitchens</a>
            <a href="{{ route('all', ['category' => 'Food']) }}" class="btn btn-primary">Food</a>
            <a href="{{ route('all', ['category' => 'sweet']) }}" class="btn btn-primary">Dessert</a>
        </div>
        <div class="secondary-filters">
            <a href="{{ route('all', ['filter' => 'free-delivery']) }}" class="btn btn-secondary">Free Delivery</a>
            <a href="{{ route('all', ['filter' => 'time']) }}" class="btn btn-secondary">Fast Delivery</a>
            <a href="{{ route('all', ['filter' => 'rating']) }}" class="btn btn-secondary">High Rating</a>
        </div>
    </div>

    <!-- Kitchens List -->
    <div class="container my-4">
        <div class="row g-3">
            @foreach ($kitchens as $kitchen)
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('kitchen.show', $kitchen->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <!-- Image Section -->
                            <img 
                                src="{{ asset($kitchen->kitchen_image) }}" 
                                class="card-img-top img-fluid" 
                                alt="{{ $kitchen->kitchen_name }}" 
                                style="height: 230px; object-fit: cover;">
                            
                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <!-- Title -->
                                <h5 class="card-title text-truncate">
                                    {{ $kitchen->kitchen_name }}
                                </h5>
    
                                <!-- Short Description -->
                                <p class="card-text text-truncate" style="max-width: 100%;">
                                    {{ $kitchen->kitchen_short_desc }}
                                </p>
    
                                <!-- Delivery Time -->
                                <p class="text-muted mt-auto text-truncate" style="max-width: 100%;">
                                    <small>{{ $kitchen->time_for_delivery }} mins</small>
                                </p>
    
                                <!-- Bottom Row -->
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    @if ($kitchen->free_delivery)
                                        <span class="badge bg-success">Free Delivery</span>
                                    @endif
                                    <span class="text-warning">⭐ {{ $kitchen->kitchen_rating }}/5</span>
                                    @if ($kitchen->discount)
                                        <span class="badge bg-danger">{{ $kitchen->discount }}% Off</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
    

    <!-- Footer -->
@endsection

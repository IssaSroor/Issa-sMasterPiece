@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <!-- Hero Slider -->
    <section id="hero-slider">
        <div class="slider-container">
            <div class="slider">
                <!-- Slide 1 -->
                <div class="slide" style="background-image: url('{{ asset('images/slider22.jpg') }}');">
                    <div class="overlay">
                        <h1>Discover Delicious Kitchens</h1>
                        <p>Order from the best kitchens in town!</p>
                        <a href="{{ route('all') }}" class="cta-button">Explore Kitchens</a>
                    </div>
                </div> 
                <!-- Slide 2 -->
                <div class="slide" style="background-image: url('{{ asset('images/slider4.png') }}');">
                    <div class="overlay">
                        <h1>Fresh, Home-Cooked Meals</h1>
                        <p>Support your local kitchens.</p>
                        <a href="{{ route('all') }}" class="cta-button">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Kitchens Section -->
    <section id="new-kitchens" class="section">
        <h2>New Kitchens</h2>
        <div class="kitchen-grid">
            @foreach($newKitchens as $kitchen)
            <div class="kitchen-card1">
                <img src="{{ $kitchen->kitchen_image ? asset($kitchen->kitchen_image) : asset('storage/kitchens/kitchen.jpg') }}" alt="{{ $kitchen->kitchen_name }}">
                <h3>{{ $kitchen->kitchen_name }}</h3>
                <p>{{ $kitchen->kitchen_short_desc }}</p>
                <a href="{{ route('kitchen.show', $kitchen->id) }}" class="btn">View Kitchen</a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Popular Kitchens Section -->
    <section id="new-kitchens" class="section">
        <h3>Popular Kitchens</h3>
        <div class="kitchen-grid">
            @foreach($popularKitchens as $kitchen)
            <div class="kitchen-card1">
                <img src="{{ asset($kitchen->kitchen_image) }}" alt="{{ $kitchen->kitchen_name }}">
                <h3>{{ $kitchen->kitchen_name }}</h3>
                <p class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $kitchen->kitchen_rating)
                            <i class="fas fa-star filled-star"></i> <!-- Filled star -->
                        @else
                            <i class="fas fa-star empty-star"></i> <!-- Empty star -->
                        @endif
                    @endfor
                </p>
                <a href="{{ route('kitchen.show', $kitchen->id) }}" class="btn">Order Now</a>
            </div>
            @endforeach
        </div>
    </section>
    
@endsection

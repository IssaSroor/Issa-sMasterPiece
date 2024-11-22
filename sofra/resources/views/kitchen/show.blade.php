@extends('layouts.master')

@section('content')
<!-- Kitchen Banner -->
<section class="kitchen-banner" style="background-image: url('{{ asset('storage/kitchens/' . $kitchen->kitchen_image) }}');">
    <div class="overlay">
        <h1>{{ $kitchen->kitchen_name }}</h1>
    </div>
</section>

<!-- Kitchen Details -->
<section class="kitchen-details">
    <div class="container">
        <!-- Kitchen Header -->
        <div class="kitchen-header">
            <h2>{{ $kitchen->kitchen_name }}</h2>
            <div class="rating">
                Rating: {{ $kitchen->kitchen_rating }}/5
            </div>
            <p>{{ $kitchen->kitchen_short_desc }}</p>
            {{-- <a href="{{ route('kitchens.menu', $kitchen->id) }}" class="btn">View Menu</a> --}}
        </div>

        <!-- Full Description -->
        <div class="kitchen-description">
            <h3>About the Kitchen</h3>
            <p>{{ $kitchen->kitchen_description }}</p>
        </div>

        <!-- Best Sellers -->
        <section class="best-sellers">
            <h3>Best Sellers</h3>
            <div class="product-grid">
                @foreach($bestSellers as $item)
                <div class="product-card">
                    <img src="{{ asset('storage/food_items/' . $item->image) }}" alt="{{ $item->name }}">
                    <h4>{{ $item->name }}</h4>
                    <p>Price: ${{ $item->price }}</p>
                    <p>Sold: {{ $item->total_sales }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="reviews">
            <h3>Reviews</h3>
            @if($reviews->isEmpty())
                <p>No reviews yet. Be the first to review!</p>
            @else
                @foreach($reviews as $review)
                <div class="review-card">
                    <h4>{{ $review->user->name }}</h4>
                    <p>Rating: {{ $review->rating }}/5</p>
                    <p>{{ $review->comment }}</p>
                </div>
                @endforeach
            @endif
        </section>
    </div>
</section>

@endsection

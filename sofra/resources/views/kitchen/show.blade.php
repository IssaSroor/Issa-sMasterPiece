@extends('layouts.master')

@section('content')
    <!-- Kitchen Banner -->
    <section class="kitchen-banner" style="background-image: url('{{ asset($kitchen->kitchen_image) }}');">
        <div class="overlay">
            <h1>{{ $kitchen->kitchen_name }}</h1>
        </div>
    </section>

    <!-- Kitchen Details -->
    <section class="kitchen-details">
        <div class="container">
            <!-- Kitchen Header -->
            <div class="kitchen-header">
                <div class="rating">
                    <p class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $kitchen->kitchen_rating)
                                <i class="fas fa-star filled-star"></i> <!-- Filled star -->
                            @else
                                <i class="fas fa-star empty-star"></i> <!-- Empty star -->
                            @endif
                        @endfor
                    </p>
                </div>
                <div>
                    {{-- <a href="{{ route('kitchens.menu', $kitchen->id) }}" class="btn">View Menu</a> --}}
                </div>
                <div>
                    <button>send Message</button>
                </div>
            </div>

            <!-- Full Description -->
            <div class="kitchen-description">
                <h3>About the Kitchen</h3>
                <p>{{ $kitchen->kitchen_description }}</p>
            </div>

            <!-- Best Sellers -->
            <section class="best-sellers py-4">
                <div class="container">
                    <h2 class="text-center mb-4">Best Sellers</h2>
                    <div class="row">
                        @foreach ($bestSellers as $item)
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ $item->item_image }}" class="img-fluid rounded-start" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with supporting text below as a
                                                natural
                                                lead-in to additional content. This content is a little bit longer.</p>
                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins
                                                    ago</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </section>


        </div>
    </section>

    <!-- Reviews Section -->
    <div class="container">
        <section class="reviews my-4">
            <h2 class="mb-3">Reviews</h2>
            @if ($reviews->isEmpty())
                <p class="text-muted">No reviews yet. Be the first to review!</p>
            @else
                <div class="row g-3">
                    @foreach ($reviews as $review)
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <!-- User Name -->
                                    <h5 class="card-title mb-2 text-truncate">
                                        <strong>{{ $review->user->name }}</strong>
                                    </h5>

                                    <!-- Review Text -->
                                    <p class="card-text text-truncate" style="max-height: 75px; overflow: hidden;">
                                        {{ $review->review_text }}
                                    </p>

                                    <!-- Rating -->
                                    <p class="mb-0">
                                        <small class="text-warning">⭐ {{ $review->review_rating }}/5</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
    </div>
    </section>

@endsection

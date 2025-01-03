@extends('layouts.master')

@section('content')
    <!-- Kitchen Details Page -->
    <section class="kitchen-page">
        <div class="container d-flex">
            <!-- Kitchen Image -->
            <div class="kitchen-image">
                <img src="{{ asset($kitchen->kitchen_image) }}" alt="Kitchen Image">
            </div>

            <!-- Kitchen Details -->
            <div class="kitchen-details ms-4">
                <!-- Kitchen Header -->
                <div>
                    <h3>{{ $kitchen->kitchen_name }}</h3>
                </div>
                <div class="kitchen-header">
                    <!-- Rating Section -->
                    <div class="rating mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($averageRating))
                                <i class="fas fa-star filled-star"></i> <!-- Filled star -->
                            @elseif ($i - $averageRating < 1)
                                <i class="fas fa-star-half-alt filled-star"></i> <!-- Half star -->
                            @else
                                <i class="fas fa-star empty-star"></i> <!-- Empty star -->
                            @endif
                        @endfor
                        <span>{{ number_format($averageRating, 1) }} / 5</span> <!-- Display the numeric average -->
                    </div>

                    <!-- Kitchen Status -->
                    <div class="kitchen-status mb-3">
                        @if ($kitchen->kitchen_status == 'opened')
                            <span class="badge bg-success">Open</span>
                        @elseif ($kitchen->kitchen_status == 'closed')
                            <span class="badge bg-danger">Closed</span>
                        @elseif ($kitchen->kitchen_status == 'busy')
                            <span class="badge bg-warning text-dark">Busy</span>
                        @else
                            <span class="badge bg-secondary">Unknown</span>
                        @endif
                    </div>
                    <div class="kitchen-description mt-4">
                        <h3>About the Kitchen</h3>
                        <p>{{ $kitchen->kitchen_description }}</p>
                    </div>

                    <!-- Send Message Section -->
                    <div style="display: flex; justify-content:space-around">


                        <!-- View Menu Section -->
                        <div>
                            <a href="{{ route('menu', $kitchen->id) }}" class="view-menu">View Menu</a>
                        </div>
                        <div class="mb-3">
                            @if (auth()->check())
                                <a href="#" class="send-message" data-bs-toggle="modal"
                                    data-bs-target="#messageModal">Send Message</a>
                            @else
                                <a href="#" class="send-message" onclick="showLoginAlert()">Send Message</a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Full Description -->

            </div>
        </div>
    </section>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Send a Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="messageForm" method="POST" action="{{ route('send.message') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="customer_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="kitchen_id" value="{{ $kitchen->id }}">

                        <div class="mb-3">
                            <label for="messageSubject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="messageSubject" name="message_subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="messageText" class="form-label">Message</label>
                            <textarea class="form-control" id="messageText" name="message_text" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Best Sellers -->
    <section class="best-sellers py-4">
        <div class="container">
            <h2 class="text-center mb-4">Best Sellers</h2>
            <div class="row">
                @foreach ($bestSellers as $item)
                    {{-- @dd($bestSellers); --}}
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $item->item_image) }}" class="img-fluid rounded-start"
                                        alt="{{ $item->item_name }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->item_name }}</h5>
                                        <p class="card-text text-truncate" title="{{ $item->item_description }}">
                                            {{ $item->item_description }}
                                        </p>
                                        <p class="card-text">
                                            @if ($item->item_discount > 0)
                                                <small class="text-muted">
                                                    <s>{{ $item->item_price }} JD</s>
                                                </small>
                                                <small class="text-danger">
                                                    {{ number_format($item->item_price - $item->item_price * $item->item_discount, 2, '.', '') }}
                                                    JD
                                                </small>
                                            @else
                                                <small class="text-body-secondary">{{ $item->item_price }}
                                                    JD</small>
                                            @endif
                                        </p>
                                        <button class="mt-3 add-to-cart-btn"
                                            onclick="addToCart(
                                                        {{ $item->id }}, 
                                                        {{ $item->kitchen_id }}, 
                                                        '{{ $item->item_name }}', 
                                                        {{ $item->item_discount > 0 ? number_format($item->item_price - $item->item_price * $item->item_discount, 2, '.', '') : $item->item_price }}, 
                                                        '{{ asset('storage/' . $item->item_image) }}'
                                                    )">
                                            Add to Cart
                                        </button>
                                    </div>
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
            <h2 class="text-center mb-4">Reviews</h2>
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


    </section>

@endsection

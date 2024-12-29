@extends('dashboard')

@section('dashboard-content')
    <div>
        @if ($orders->isEmpty())
            <p class="text-muted">You haven't placed any orders yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        {{-- @dd($orders); --}}
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $order->order_total_amount }} JD</td>
                            <td>{{ $order->order_status }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-order-id="{{ $order->id }}"
                                    onclick="viewOrderDetails(this)">
                                    View
                                </button>
                                @if (!$order->has_review)
                                    <button onclick="showReviewForm({{ $order->id }}, {{ $order->kitchen_id }})"
                                        class="btn btn-primary">
                                        Add Review
                                    </button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

    <!-- Modal for Order Details -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Order ID:</strong> <span id="modalOrderId"></span></p>
                    <p><strong>Date:</strong> <span id="modalOrderDate"></span></p>
                    <p><strong>Total:</strong> <span id="modalOrderTotal"></span> JD</p>
                    <p><strong>Status:</strong> <span id="modalOrderStatus"></span></p>
                    <hr>
                    <h5>Food Items</h5>
                    <ul id="modalFoodItems" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>

    <div id="reviewForm" class="review-form-container mt-4 p-4 border rounded shadow-lg container" style="display: none;">
        <h5 class="mb-3">Write a Review</h5>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf

            <input type="hidden" name="order_id" id="order_id">
            <input type="hidden" name="kitchen_id" id="kitchen_id">


            <!-- Review Text -->
            <div class="mb-3">
                <label for="review_text" class="form-label">Your Review</label>
                <textarea name="review_text" id="review_text" class="form-control" rows="4" placeholder="Share your experience..."
                    required></textarea>
            </div>

            <!-- Rating -->
            <div class="mb-3">
                <label for="review_rating" class="form-label">Your Rating</label>
                <div class="star-rating">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" name="review_rating" id="review_rating" required>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn bg3 w-100">Submit Review</button>
            <button type="button" class="btn-close" onclick="hideReviewForm()" aria-label="Close"></button>

        </form>
    </div>
    @endif


@endsection

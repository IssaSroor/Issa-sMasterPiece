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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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

@endsection

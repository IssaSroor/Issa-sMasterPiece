@extends('layouts.kitchen')

@section('content')
    <div class="container">
        <h1>Update Order #{{ $order->id }}</h1>
        
        <!-- Display success or error message if exists -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form to update the order status -->
        <form class="edit-form" method="POST" action="{{ route('kitchen.orders.update', ['id' => $kitchen->id, 'order_id' => $order->id]) }}">
            @csrf
            @method('PUT')
            
            <!-- Order Status Form Group -->
            <div class="form-group">
                <label for="order_status" class="font-weight-bold">Order Status</label>
                <select name="order_status" id="order_status" class="form-control">
                    <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="prepared" {{ $order->order_status == 'prepared' ? 'selected' : '' }}>Prepared</option>
                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
        </form>

        <!-- Back Button -->
        <a href="{{ route('kitchen.orders', ['id' => $kitchen->id]) }}" class="btn btn-secondary mt-3">Back to Orders</a>
    </div>
@endsection

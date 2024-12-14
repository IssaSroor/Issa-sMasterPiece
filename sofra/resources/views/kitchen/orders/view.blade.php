@extends('layouts.kitchen')

@section('content')
<h1 class="order-title">Order Details #{{ $order->id }}</h1>

<div class="order-details">
    <p><strong>Order Address:</strong> {{ $order->order_address }}</p>
    <p><strong>Total Amount:</strong> {{ $order->order_total_amount }}</p>
    <p><strong>Payment Status:</strong> {{ $order->order_payment_status }}</p>
    <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
</div>

<h3 class="order-items-title">Items in the Order:</h3>
<ul class="order-items-list">
    @foreach($order->items as $item)
        <li>
            <strong>{{ $item->foodItem->item_name }}</strong> ({{ $item->quantity }})
            <p>{{ $item->foodItem->item_description }}</p>
        </li>
    @endforeach
</ul>

<div class="back-button">
    <a href="{{ route('kitchen.orders', ['id' => $kitchen->id]) }}" class="button">Back to Orders</a>
</div>
@endsection

@extends('layouts.kitchen')

@section('content')
<h1>Orders for {{ $kitchen->kitchen_name }}</h1>

<!-- Filter Buttons -->
<div class="filter-buttons">
    <a href="{{ route('kitchen.orders', ['id' => $kitchen->id, 'filter' => 'confirmed']) }}" 
       class="btn btn-confirmed {{ $filter == 'confirmed' ? 'active' : '' }}">Confirmed</a>
    <a href="{{ route('kitchen.orders', ['id' => $kitchen->id, 'filter' => 'prepared']) }}" 
       class="btn btn-warning {{ $filter == 'prepared' ? 'active' : '' }}">Prepared</a>
    <a href="{{ route('kitchen.orders', ['id' => $kitchen->id, 'filter' => 'delivered']) }}" 
       class="btn btn-success {{ $filter == 'delivered' ? 'active' : '' }}">Delivered</a>
</div>

<!-- Orders Table -->
<table class="common-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Address</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_address }}</td>
            <td>{{ $order->order_total_amount }} JD</td>
            <td>{{ $order->order_status }}</td>
            <td class="flex">
                <!-- Edit Button -->
                <a href="{{ route('kitchen.orders.edit', ['id' => $kitchen->id, 'order_id' => $order->id]) }}" class="btn btn-danger margin ">Edit</a>
                <!-- View Button -->
                <a href="{{ route('kitchen.orders.view', ['id' => $kitchen->id, 'order_id' => $order->id]) }}" class="btn btn-info margin">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

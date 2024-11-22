@extends('admin.layouts.admin')

@section('title', 'Kitchen Orders')

@section('header-title', 'Orders for ' . $kitchen->kitchen_name)

@section('content')
    <div class="container">
        <h2>Orders for {{ $kitchen->kitchen_name }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kitchen->orders as $order)
                    <tr>
                        <td>#{{ $loop->iteration }}</td> 
                        <td>{{ $order->customer->name }}</td>
                        <td>${{ $order->order_total_amount }}</td>
                        <td>{{ ucfirst($order->order_status) }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No orders for this kitchen yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

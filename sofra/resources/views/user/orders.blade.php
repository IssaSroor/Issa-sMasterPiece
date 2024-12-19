@extends('dashboard')

@section('dashboard-content')
<div>
    <h2>Your Orders</h2>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td>{{ $order->total }} JD</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

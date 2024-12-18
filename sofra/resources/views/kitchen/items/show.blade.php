@extends('layouts.kitchen')

@section('content')
<h1>Item Details: {{ $item->item_name }}</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Item Information</h5>
        <p><strong>Name:</strong> {{ $item->item_name }}</p>
        <p><strong>Category:</strong> {{ $item->category_id }}</p>
        <p><strong>Description:</strong> {{ $item->item_description }}</p>
        <p><strong>Availability:</strong> {{ $item->item_availability ? 'Available' : 'Out of Stock' }}</p>
        <p><strong>Discount:</strong> {{ $item->item_discount }}%</p>

        <div>
            <strong>Image:</strong><br>
            @if($item->item_image)
                <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="img-fluid" style="max-width: 200px;">
            @else
                <p>No image available</p>
            @endif
        </div>

        <a href="{{ route('kitchen.items.edit', ['kitchen_id' => $kitchen->id, 'item_id' => $item->id]) }}" class="btn btn-warning mt-3">Edit Item</a>
    </div>
</div>

@endsection

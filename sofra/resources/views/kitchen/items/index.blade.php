@extends('layouts.kitchen')

@section('content')
<h1>Items</h1>
<a href="{{ route('kitchen.items.add', $kitchen->id) }}" class="btn btn-primary mb-3">Add Item</a>

<!-- Table to display the items -->
<table id="items-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Availability</th>
            <th>Discount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->item_name }}</td>
            <td>{{ $item->item_description }}</td>
            <td><img src="{{ asset('images/items/'.$item->item_image) }}" alt="{{ $item->item_name }}" style="width: 100px; height: auto;"></td>
            <td>{{ $item->item_availability ? 'Available' : 'Out of Stock' }}</td>
            <td>{{ $item->item_discount }}%</td>
            <td>
                <!-- Action Buttons -->
                <a href="{{ route('kitchen.items.edit', ['kitchen_id' => $kitchen->id, 'item_id' => $item->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('kitchen.items.view', ['kitchen_id' => $kitchen->id, 'item_id' => $item->id]) }}" class="btn btn-info btn-sm">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection



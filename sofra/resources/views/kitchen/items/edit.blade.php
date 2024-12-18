@extends('layouts.kitchen')

@section('content')
<h1>Edit Item: {{ $item->item_name }}</h1>

<form action="{{ route('kitchen.items.update', ['kitchen_id' => $kitchen->id, 'item_id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST') <!-- or @method('PUT') if your update route uses PUT method -->

    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" class="form-control" id="item_name" name="item_name" value="{{ old('item_name', $item->item_name) }}" required>
    </div>

    <div class="form-group">
        <label for="item_description">Item Description</label>
        <textarea class="form-control" id="item_description" name="item_description" rows="4" required>{{ old('item_description', $item->item_description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="item_availability">Item Availability</label>
        <select class="form-control" id="item_availability" name="item_availability" required>
            <option value="1" {{ $item->item_availability ? 'selected' : '' }}>Available</option>
            <option value="0" {{ !$item->item_availability ? 'selected' : '' }}>Out of Stock</option>
        </select>
    </div>

    <div class="form-group">
        <label for="item_discount">Item Discount (%)</label>
        <input type="text" class="form-control" id="item_discount" name="item_discount" value="{{ old('item_discount', $item->item_discount) }}" required min="0" max="100">
    </div>

    <div class="form-group">
        <label for="item_image">Item Image</label>
        <input type="file" class="form-control-file" id="item_image" name="item_image">
        @if($item->item_image)
            <p>Current image: <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="img-thumbnail" style="max-width: 150px;"></p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Item</button>
    <a href="{{ route('kitchen.items', ['id' => $kitchen->id]) }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

@extends('layouts.kitchen')

@section('content')
<div class="form-container">
    <h1>Add New Item</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('kitchen.items.store', $kitchen->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" required class="form-input">
        </div>
        <div class="form-group">
            <label for="item_description">Item Description:</label>
            <textarea name="item_description" id="item_description" required class="form-input">{{ old('item_description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="item_price">Item Price:</label>
            <input type="number" step="0.01" name="item_price" id="item_price" value="{{ old('item_price') }}" required class="form-input">
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" required class="form-input">
                <option value="" disabled selected>Choose a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="item_image">Item Image (Optional):</label>
            <input type="file" name="item_image" id="item_image" class="form-input">
        </div>
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>
@endsection

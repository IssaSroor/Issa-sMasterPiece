@extends('layouts.kitchen')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit {{ $kitchen->kitchen_name }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kitchen.update', $kitchen->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kitchen_name">Kitchen Name</label>
                    <input type="text" id="kitchen_name" name="kitchen_name" class="input-field" value="{{ old('kitchen_name', $kitchen->kitchen_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="kitchen_status">Status</label>
                    <select id="kitchen_status" name="kitchen_status" class="input-field" required>
                        <option value="opened" {{ $kitchen->kitchen_status === 'opened' ? 'selected' : '' }}>Opened</option>
                        <option value="busy" {{ $kitchen->kitchen_status === 'busy' ? 'selected' : '' }}>Busy</option>
                        <option value="closed" {{ $kitchen->kitchen_status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kitchen_short_desc">Short Description</label>
                    <textarea id="kitchen_short_desc" name="kitchen_short_desc" class="input-field" required>{{ old('kitchen_short_desc', $kitchen->kitchen_short_desc) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="kitchen_description">Description</label>
                    <textarea id="kitchen_description" name="kitchen_description" class="input-field" required>{{ old('kitchen_description', $kitchen->kitchen_description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="kitchen_phone">Phone</label>
                    <input type="text" id="kitchen_phone" name="kitchen_phone" class="input-field" value="{{ old('kitchen_phone', $kitchen->kitchen_phone) }}" required>
                </div>

                <div class="form-group">
                    <label for="kitchen_address">Address</label>
                    <input type="text" id="kitchen_address" name="kitchen_address" class="input-field" value="{{ old('kitchen_address', $kitchen->kitchen_address) }}" required>
                </div>

                <div class="form-group">
                    <label for="free_delivery">Free Delivery</label>
                    <select id="free_delivery" name="free_delivery" class="input-field" required>
                        <option value="1" {{ $kitchen->free_delivery ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$kitchen->free_delivery ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="time_for_delivery">Delivery Time (mins)</label>
                    <input type="number" id="time_for_delivery" name="time_for_delivery" class="input-field" value="{{ old('time_for_delivery', $kitchen->time_for_delivery) }}" required>
                </div>

                <div class="form-group">
                    <label for="kitchen_image">Image</label>
                    @if($kitchen->kitchen_image)
                    <div class="image-preview">
                        <img src="{{ asset($kitchen->kitchen_image) }}" alt="{{ $kitchen->kitchen_name }}">
                    </div>
                    @endif
                    <input type="file" id="kitchen_image" name="kitchen_image" class="input-field">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

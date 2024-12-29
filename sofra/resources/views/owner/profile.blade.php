@extends('layouts.kitchen')

@section('title', 'Owner Profile')

@section('content')
<div class="owner-profile">
    <h1>Owner Profile</h1>

    <form action="{{ route('owner.profile.update', ['id' => $kitchen->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Owner Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="owner_name" value="{{ $owner->owner_name }}" required>
        </div>

        <!-- Owner Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $owner->email }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="owner_address" value="{{ $owner->owner_address }}" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection

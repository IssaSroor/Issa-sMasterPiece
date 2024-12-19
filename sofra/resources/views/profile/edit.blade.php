@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Profile Image -->
        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control">
            @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-thumbnail mt-2" style="width: 150px;">
            @endif
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection

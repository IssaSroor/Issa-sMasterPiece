@extends('dashboard')

@section('dashboard-content')
<div>
    <form action="{{ route('user.update-account') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="customer_address" class="form-control" value="{{ auth()->user()->customer_address }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" id="phone" name="customer_phone" class="form-control" value="{{ auth()->user()->customer_phone }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Account</button>
    </form>
</div>
@endsection

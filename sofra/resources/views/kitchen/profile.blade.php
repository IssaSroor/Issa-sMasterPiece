@extends('layouts.kitchen')

@section('content')
<div class="container-fluid my-4">
    <!-- Kitchen Info -->
    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">{{ $kitchen->kitchen_name }}</h3>
            <span class="badge bg-{{ $kitchen->kitchen_status === 'opened' ? 'success' : ($kitchen->kitchen_status === 'busy' ? 'warning' : 'danger') }}">
                {{ ucfirst($kitchen->kitchen_status) }}
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Short Description:</strong> {{ $kitchen->kitchen_short_desc }}</p>
                    <p><strong>Description:</strong> {{ Str::limit($kitchen->kitchen_description, 100, '...') }}</p>
                    <p><strong>Phone:</strong> {{ $kitchen->kitchen_phone }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Address:</strong> {{ $kitchen->kitchen_address }}</p>
                    <p><strong>Free Delivery:</strong> {{ $kitchen->free_delivery ? 'Yes' : 'No' }}</p>
                    <p><strong>Delivery Time:</strong> {{ $kitchen->time_for_delivery }} mins</p>
                    <p><strong>Rating:</strong> {{ $kitchen->kitchen_rating }}</p>
                </div>
            </div>
            @if($kitchen->kitchen_image)
            <div class="text-center mt-3">
                <img src="{{ asset($kitchen->kitchen_image) }}" alt="{{ $kitchen->kitchen_name }}" class="img-fluid rounded" style="max-width: 300px;">
            </div>
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('kitchen.edit', $kitchen->id) }}" class="btn btn-primary">Edit Kitchen Info</a>
        </div>
    </div>
</div>
@endsection

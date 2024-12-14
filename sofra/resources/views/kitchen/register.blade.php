@extends('layouts.master')

@section('content')
<div class="register-container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Register Your Kitchen</h1>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('kitchen.register.submit') }}" enctype="multipart/form-data" class="p-4 shadow rounded">
                @csrf
                <!-- Kitchen Name -->
                <div class="mb-3">
                    <label for="kitchen_name" class="form-label">Kitchen Name:</label>
                    <input type="text" class="form-control" name="kitchen_name" id="kitchen_name" 
                           value="{{ old('kitchen_name') }}" placeholder="Enter your kitchen name" required>
                </div>

                <!-- Short Description -->
                <div class="mb-3">
                    <label for="kitchen_short_desc" class="form-label">Short Description:</label>
                    <input type="text" class="form-control" name="kitchen_short_desc" id="kitchen_short_desc" 
                           value="{{ old('kitchen_short_desc') }}" placeholder="Enter a short description" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="kitchen_description" class="form-label">Description:</label>
                    <textarea class="form-control" name="kitchen_description" id="kitchen_description" 
                              rows="4" placeholder="Provide a detailed description" required>{{ old('kitchen_description') }}</textarea>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="kitchen_phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" name="kitchen_phone" id="kitchen_phone" 
                           value="{{ old('kitchen_phone') }}" placeholder="Enter contact number" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="kitchen_address" class="form-label">Address:</label>
                    <input type="text" class="form-control" name="kitchen_address" id="kitchen_address" 
                           value="{{ old('kitchen_address') }}" placeholder="Enter your address" required>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="kitchen_image" class="form-label">Image:</label>
                    <input type="file" class="form-control" name="kitchen_image" id="kitchen_image" required>
                </div>

                <!-- Delivery Time -->
                <div class="mb-3">
                    <label for="time_for_delivery" class="form-label">Delivery Time (in minutes):</label>
                    <input type="number" class="form-control" name="time_for_delivery" id="time_for_delivery" 
                           value="{{ old('time_for_delivery') }}" placeholder="Enter delivery time" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Register Kitchen</button>
            </form>
        </div>
    </div>
</div>
@endsection

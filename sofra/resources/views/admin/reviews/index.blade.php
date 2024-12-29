@extends('admin.layouts.admin')

@section('header-title', 'Kitchen Reviews')

@section('content')
    <div class="admin-reviews-container">

        <!-- Dropdown to select kitchen -->
        <form method="GET" action="{{ route('admin.reviews.index') }}">
            <label for="kitchen_id">Select Kitchen:</label>
            <select name="kitchen_id" id="kitchen_id" class="kitchen-selection" onchange="this.form.submit()">
                <option value="">-- Select Kitchen --</option>
                @foreach ($kitchens as $kitchen)
                    <option value="{{ $kitchen->id }}" @if ($selectedKitchen && $selectedKitchen->id == $kitchen->id) selected @endif>
                        {{ $kitchen->kitchen_name }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- If a kitchen is selected, show reviews -->
        @if ($selectedKitchen)
            <h2>Reviews for {{ $selectedKitchen->kitchen_name }}</h2>

            <table class="common-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Review Text</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->review_rating }} / 5</td>
                            <td>{{ $review->review_text }}</td>
                            <td class="table-actions">
                                <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reviews.reject', $review) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Please select a kitchen to view reviews.</p>
        @endif
    </div>
@endsection

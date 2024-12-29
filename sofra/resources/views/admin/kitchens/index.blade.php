@extends('admin.layouts.admin')

@section('title', 'Manage Kitchens')

@section('header-title', 'Pending Kitchens')

@section('content')
    <div class="container">
        <table class="common-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingKitchens as $kitchen)
                    <tr>
                        <td data-label="Name">{{ $kitchen->kitchen_name }}</td>
                        <td data-label="Owner">{{ $kitchen->owner->owner_name }}</td>
                        <!-- Assuming `owner` relationship is defined -->
                        <td data-label="Phone">{{ $kitchen->kitchen_phone }}</td>
                        <td data-label="Address">{{ $kitchen->kitchen_address }}</td>
                        <td data-label="Actions">
                            <div class="table-actions">
                                <form action="{{ route('admin.kitchens.admin_show', $kitchen->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Show</button>
                                </form>
                                <form method="POST" action="{{ route('admin.kitchens.approve', $kitchen->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.kitchens.reject', $kitchen->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

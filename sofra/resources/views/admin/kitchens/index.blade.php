@extends('admin.layouts.admin')

@section('title', 'Manage Kitchens')

@section('header-title', 'Manage Kitchens')

@section('content')
<div class="container">
    <div class="section">
        <h2>Pending Kitchens</h2>
        <table class="table">
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
                        <td>{{ $kitchen->kitchen_name }}</td>
                        <td>{{ $kitchen->owner->owner_name }}</td> <!-- Assuming `owner` relationship is defined -->
                        <td>{{ $kitchen->kitchen_phone }}</td>
                        <td>{{ $kitchen->kitchen_address }}</td> 
                        <td>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

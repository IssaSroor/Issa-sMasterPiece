@extends('admin.layouts.admin')

@section('title', 'Admin Dashboard')

@section('header-title', 'Admin Dashboard')

@section('content')
    <div class="container" style="margin-top: -10px">
        <div class="statistics">
            <div class="stat-card">
                <h3>Total Customers</h3>
                <p>{{ $totalCustomers }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Kitchens</h3>
                <p>{{ $totalKitchens }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <p>${{ number_format($totalRevenue, 2) }}</p>
            </div>
            <div class="stat-card">
                <h3>Active Kitchens</h3>
                <p>{{ $activeKitchens }}</p>
            </div>
            <div class="stat-card">
                <h3>New Signups (Last Month)</h3>
                <p>{{ $newCustomers }}</p>
            </div>
            <div class="stat-card">
                <h3>Top Performing Kitchen</h3>
                <p>{{ $topKitchens->first()->kitchen_name }}</p>
            </div>
            <div class="stat-card">
                <h3>Average Kitchen Rating</h3>
                <p>{{ number_format($averageKitchenRating, 1) }}</p>
            </div>
        </div>
    </div>
    
@endsection

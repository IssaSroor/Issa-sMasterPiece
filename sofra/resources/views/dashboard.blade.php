@extends('layouts.master')

@section('title', 'User Dashboard')

@section('content')
<div class="dashboard-container">

    <nav class="dashboard-nav">
        <ul class="nav-list">
            <li>
                <a href={{ route('user.account-info') }} class="nav-link">
                    <i class="fas fa-user"></i>
                    Account Info
                </a>
            </li>
            <li>
                <a href={{ route('user.orders') }} class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>
            </li>
        </ul>
    </nav>

    <main class="dashboard-content">
        @yield('dashboard-content')
    </main>
</div>
@endsection

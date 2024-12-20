@extends('layouts.master')

@section('title', 'User Dashboard')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <aside class="sidebar bg-dark text-white vh-100 p-3">
        <h3 class="mb-4">User Dashboard</h3>
        <ul class="list-unstyled">
            <li class="mb-2">
                <a href="{{ route('user.account-info') }}" class="text-white text-decoration-none">
                    <i class="fas fa-user me-2"></i> Account Info
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('user.orders') }}" class="text-white text-decoration-none">
                    <i class="fas fa-shopping-bag me-2"></i> Orders
                </a>
            </li>
            <li class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <main class="p-4">
            @yield('dashboard-content')
        </main>
    </div>
</div>
@endsection

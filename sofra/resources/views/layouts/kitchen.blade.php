<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kitchen Dashboard')</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/new1.css') }}">
</head>

<body>
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Kitchen Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('kitchen.profile', ['id' => $kitchen->id]) }}"
                        class="{{ request()->routeIs('kitchen.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i> Manage Kitchen
                    </a>
                </li>
                <li>
                    <a href="{{ route('kitchen.orders', ['id' => $kitchen->id]) }}"
                        class="{{ request()->routeIs('kitchen.orders') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Manage Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('kitchen.messages', ['id' => $kitchen->id]) }}"
                        class="{{ request()->routeIs('kitchen.messages') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i> Manage Messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('kitchen.items', ['id' => $kitchen->id]) }}"
                        class="{{ request()->routeIs('kitchen.items') ? 'active' : '' }}">
                        <i class="fas fa-utensils"></i> Manage Items
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.profile', ['id' => $kitchen->id]) }}"
                        class="{{ request()->routeIs('owner.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i> Owner Profile
                    </a>
                </li>
                <li>
                    <form action="{{ route('owner.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger" style="text-decoration: none;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Add your JS files -->
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
        $('#messages-table').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable searching
            "ordering": true, // Enable sorting
            "info": true, // Show information
            "responsive": true // Make the table responsive on small screens
        });
    });
    </script>

<script>
    $(document).ready(function() {
        $('#items-table').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable searching
            "ordering": true, // Enable sorting
            "info": true, // Show information
            "responsive": true // Make the table responsive on small screens
        });
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

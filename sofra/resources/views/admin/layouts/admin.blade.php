<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Add Admin-specific CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/admin1.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

</head>

<body>
    <!-- Admin Sidebar -->
    <aside class="admin-sidebar col-3">
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.kitchens.admin_index') }}">Manage Kitchens</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
                <li><a href="{{ route('admin.reviews.index') }}">Pending Reviews</a></li>
                <li><a href="{{ route('admin.orders.index') }}">Manage Orders</a></li>
                <li><a href="{{ route('admin.questions.index') }}">Contact Messages</a></li>
                @if (auth()->user()->admin_role === 'super_admin')
                    <li><a href="{{ route('admin.admins.index') }}">Manage Admins</a></li>
                @endif
            </ul>
        </nav>
    </aside>
    <button class="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="admin-main-content">
        <header class="admin-header">
            <h1>@yield('header-title', 'Admin Dashboard')</h1>
            <div class="admin-actions">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-logout">Logout</button>
                </form>
            </div>
        </header>

        <section class="admin-content col-9">
            @yield('content')
        </section>
    </main>

    <!-- Add Admin-specific JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#kitchensTable').DataTable({
                "paging": true,
                "searching": true,
                "info": false
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#admins-table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "columnDefs": [{
                        "orderable": false,
                        "targets": 4
                    } // Disable ordering for the Actions column
                ]
            });
        });
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>

    <script>
        document.querySelector('.sidebar-toggle').addEventListener('click', () => {
            document.querySelector('.admin-sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        });

        document.querySelector('.sidebar-overlay').addEventListener('click', () => {
            document.querySelector('.admin-sidebar').classList.remove('active');
            document.querySelector('.sidebar-overlay').classList.remove('active');
        });
    </script>
</body>

</html>

@extends('admin.layouts.admin')

@section('title', 'Manage Admins')

@section('content')
<div class="container">

    <!-- Add Admin Button -->
    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">Add Admin</a>

    <!-- Admins Table -->
    <table id="admins-table" class="common-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->admin_name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ ucfirst($admin->admin_role) }}</td>
                    <td>
                        <div style="display:flex; gap:10px;">
                        <form action="{{ route('admin.admins.edit', $admin->id) }}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn" style="background-color:#484848; color:#fff;">Edit</button>
                        </form>
    
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick= "confirmDelete(this)">Delete</button>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

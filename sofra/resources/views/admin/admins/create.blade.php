@extends('admin.layouts.admin')

@section('title', 'Add New Admin')

@section('content')
<div class="container">
    <h1>Add New Admin</h1>

    <form method="POST" action="{{ route('admin.admins.store') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="admin_name" id="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div>
            <label for="role">Role</label>
            <select name="admin_role" id="role" class="kitchen-selection" required>
                <option value="admin">Admin</option>
                <option value="super_admin">Super Admin</option>
            </select>
        </div>
        <button type="submit" class="btn-primary" style="width: 97.4%">Add Admin</button>
    </form>
</div>
@endsection

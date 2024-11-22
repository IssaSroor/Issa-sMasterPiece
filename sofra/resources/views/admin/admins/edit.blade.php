@extends('admin.layouts.admin')

@section('title', 'Edit Admin')

@section('content')
<div class="container">
    <h1>Edit Admin</h1>

    <form method="POST" action="{{ route('admin.admins.update', $admin->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $admin->admin_name }}" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $admin->email }}" required>
        </div>
        <div>
            <label for="role">Role</label>
            <select name="role" id="role" class="kitchen-selection" required>
                <option value="admin" {{ $admin->admin_role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="super_admin" {{ $admin->admin_role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>
        <button type="submit" class="btn-warning" style="width: 97.4%">Update Admin</button>
    </form>
</div>
@endsection

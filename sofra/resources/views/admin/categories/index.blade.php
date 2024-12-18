@extends('admin.layouts.admin')

@section('title', 'Manage Categories')

@section('header-title', 'Manage Categories')<tbody>
    @section('content')
    <div class="container">
        <h1>Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-add">Add New Category</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
        <tr>
            <td>{{ $category->category_name }}</td>
            <td>
                <img src="{{ asset('storage/categories/' . $category->category_image) }}" alt="Category Image" width="50">
            </td>
            <td>
                <form action="{{ route('admin.categories.edit', $category->id) }}" style="display: inline-block">
                    @csrf
                
                    <button class="btn btn-warning btn-sm">Edit</button>
                </form>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
            </tbody>
        </table>
    </div>
</tbody>
@endsection

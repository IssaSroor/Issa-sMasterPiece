@extends('admin.layouts.admin')

@section('title', 'Create Category')

@section('header-title', 'Create Category')

@section('content')
<div class="container">
    <div class="form-container">
        <h2>Add New Category</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="category_name" class="form-control" placeholder="Enter category name" required>
            </div>

            <div class="form-group">
                <label for="image">Category Image:</label>
                <input type="file" id="image" name="category_image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-success" style="width: 97.4%">Create Category</button>
            @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </form>
    </div>
</div>
@endsection

@extends('admin.layouts.admin')
@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
        </div>
        <div class="form-group">
            <label for="category_image">Category Image</label>
            <input type="file" class="form-control" id="category_image" name="category_image">
            @if($category->category_image)
                <img src="{{ asset('storage/categories/' . $category->category_image) }}" alt="Category Image" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-warning" style="width: 97.4%">Update Category</button>
    </form>
</div>
@endsection

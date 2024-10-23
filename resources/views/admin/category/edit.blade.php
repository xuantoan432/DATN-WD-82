@extends('admin.layouts.master')

@section('title', 'Edit Category')

@section('content')
    <h1 class="my-4">Edit Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Category Icon</label>
            <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
            @if ($category->icon)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$category->icon) }}" alt="Category Icon" width="100">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="fee_percentage" class="form-label">Fee Percentage (%)</label>
            <input type="number" class="form-control" id="fee_percentage" name="fee_percentage" value="{{ old('fee_percentage', $category->fee_percentage) }}" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
@endsection

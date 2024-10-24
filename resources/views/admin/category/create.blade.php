@extends('admin.layouts.master')

@section('title', 'Create Category')

@section('content')
    <h1 class="my-4">Create New Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Category Icon</label>
            <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="fee_percentage" class="form-label">Fee Percentage (%)</label>
            <input type="number" class="form-control" id="fee_percentage" name="fee_percentage" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
@endsection

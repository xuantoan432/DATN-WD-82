@extends('admin.layouts.master')

@section('title', 'Category Manager')

@section('content')
<div class="main-wrapper">
    <div class="main-content">
        <div class="col-xl-12">
            <h3 class="mb-0 text-uppercase">Categories</h3>
            <hr>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Create New Category</a>
            
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Fee Percentage</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $model)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>
                                        @if($model->icon)
                                        <img src="{{ asset('storage/' . $model->icon) }}" alt="Category Icon" style="width: 50px; height: 50px;">
                                        @else
                                            No icon
                                        @endif
                                    </td>
                                    <td>{{ $model->fee_percentage }}%</td>
                                    <td>
                                        <a href="{{ route('admin.category.edit', $model->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.category.destroy', $model->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Do you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $data->links() }} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

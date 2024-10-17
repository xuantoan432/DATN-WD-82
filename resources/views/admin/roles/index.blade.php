@extends('admin.layouts.master')

@section('css_new')
    <!-- Add your specific CSS here -->
@endsection

@section('content')
<div class="main-wrapper">
    <div class="main-content">
        <div class="col-xl-12">
            <h3 class="mb-0 text-uppercase">Roles</h3>
        <hr>

            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
            <div class="card">
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('roles.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="name" value="{{ $role->name }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('js_new')
    <!-- Add your specific JS here -->
@endsection


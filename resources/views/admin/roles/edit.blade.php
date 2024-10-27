@extends('admin.layouts.master')


@section('content')
    <h1 class="my-4">Update Role</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{$role->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
@endsection



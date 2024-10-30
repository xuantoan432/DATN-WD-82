@extends('admin.layouts.master')


@section('content')
    <h1 class="my-4">Update User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">User Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{$user->name}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Day of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required value="{{$user->dob}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" required value="{{$user->phone}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Avatar</label>
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Image" style="width: 100px;">
                <input type="file" class="form-control" id="avatar" name="avatar" value="{{$user->avatar}}">
        </div>
            <label for="name" class="form-label">Gender</label>
            <input type="text" class="form-control" id="gender" name="gender" required value="{{$user->gender}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" required value="{{$user->password}}">
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
@endsection



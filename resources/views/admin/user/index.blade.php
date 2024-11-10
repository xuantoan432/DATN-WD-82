@extends('admin.layouts.master')

@section('css_new')
<!-- Add your specific CSS here -->
@endsection

@section('content')
<div class="main-wrapper">
    <div class="main-content">
        <div class="col-xl-12">
            <h3 class="mb-0 text-uppercase">Users</h3>
            <hr>

            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create New User</a>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <!-- <img src="{{ Storage::url($user->avatar) }}" alt="Not photo" style="width: 50; height: 50;">
                                        -->
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Image"
                                            style="width: 100px;">

                                    </td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>**********</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="name" value="{{ $user->name }}">
                                            <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa người dùng này không?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

    @section('js_new')
    <!-- Add your specific JS here -->
    @endsection
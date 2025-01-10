@extends('admin.layouts.master')

@section('css_new')
    <!-- Add your specific CSS here -->
@endsection

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.users.create') }}" class="btn btn-info">Thêm mới người dùng</a> <!-- Nút Create -->
        </div>
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">All Users</a>
            <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="btn btn-primary">Admins</a>
            <a href="{{ route('admin.users.index', ['role' => 'client']) }}" class="btn btn-success">Clients</a>
            <a href="{{ route('admin.users.index', ['role' => 'seller']) }}" class="btn btn-warning">Sellers</a>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.png') }}"
                                            alt="Avatar" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_new')
    <!-- Add your specific JS here -->
@endsection

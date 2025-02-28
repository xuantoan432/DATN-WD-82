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
        <div class="row justify-content-between">
            <div class="col-auto product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-bold flex-wrap font-text1">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">All Users</a>
                <a href="{{ route('admin.users.index', ['role' => '1']) }}" class="btn btn-primary">Admins</a>
                <a href="{{ route('admin.users.index', ['role' => '3']) }}" class="btn btn-success">Clients</a>
                <a href="{{ route('admin.users.index', ['role' => '2']) }}" class="btn btn-warning">Sellers</a>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Customers</a>
                </div>
            </div>
        </div>



        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Email</th>
                                <th>Địện thoại</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <a class="d-flex align-items-center gap-3" href="javascript:;">
                                            <div class="customer-pic">
                                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.png') }}" class="rounded-circle" width="40" height="40" alt="">
                                            </div>
                                            <p class="mb-0 customer-name fw-bold">{{ $user->name }}</p>
                                        </a>
                                    </td>
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

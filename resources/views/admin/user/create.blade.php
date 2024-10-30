<div class="card">
    <div class="card-body">
        @extends('admin.layouts.master')

        @section('css_new')
        <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
            rel="stylesheet" />
        @endsection
        @section('content')
        <h1 class="my-4">Create New User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">User Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Day of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Phone</label>
                <input type="number" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar" required>
            </div>
            <!-- <div class="mb-3">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Nam">Nam</option>
                            <option value="Nu">Nữ</option>
                        </select>
                    </div> -->
            <label for="name" class="form-label">Gender</label>
            <input type="text" class="form-control" id="gender" name="gender" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
</div>
@endsection
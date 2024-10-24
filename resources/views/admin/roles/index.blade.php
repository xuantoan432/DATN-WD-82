@extends('admin.layouts.master')

@section('css_new')
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Roles</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Danh sách Roles</h6>
                    </div>
                    <div class="card-body">
                        <!-- Form thêm Role mới -->
                        <form action="{{ route('admin.roles.store') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên Role"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Tạo Role Mới</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table id="rolesTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-3 mt-2">
                                                    @if (!in_array($role->name, ['admin', 'customer', 'seller']))
                                                        <div class="col">
                                                            <form action="{{ route('admin.roles.destroy', $role) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-outline-danger d-flex gap-2"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                                    <i class="material-icons-outlined">delete</i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col">
                                                            <a href="{{ route('admin.roles.edit', $role) }}"
                                                                class="btn btn-outline-warning d-flex gap-2">
                                                                <i class="material-icons-outlined">edit</i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="col">
                                                            <span class="text-muted">Không thể chỉnh sửa/xóa</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_new')
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#rolesTable').DataTable({
                "aaSorting": [
                    [0, "asc"]
                ] // Sắp xếp theo cột đầu tiên
            });
        });
    </script>
@endsection

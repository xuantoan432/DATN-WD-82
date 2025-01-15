@extends('admin.layouts.master')

@section('css_new')
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tags</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách Tags</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Danh sách Tags</h6>
                    </div>
                    <div class="card-body">
                        <!-- Form tạo Tag mới -->
                        <form action="{{ route('admin.tags.store') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên Tag" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Tạo Tag Mới</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table id="tagsTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{ $tag->id }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-3 mt-2">
                                                    <div class="col">
                                                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-outline-warning d-flex gap-2">
                                                            <i class="material-icons-outlined">edit</i>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger d-flex gap-2" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbod  y>
                            </table>
                        </div>

                        <!-- Phân trang -->
                        <div class="mt-3">
                            {{ $tags->links('pagination::bootstrap-4') }} 
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
            $('#tagsTable').DataTable({
                "aaSorting": [[0, "asc"]] // Sắp xếp theo cột ID
            });
        });
    </script>
@endsection

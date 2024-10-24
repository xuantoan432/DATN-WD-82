@extends('admin.layouts.master')

@section('css_new')
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bài Viết</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Danh sách Bài Viết</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Tạo Bài Viết Mới</a>
                    </div>

                    <div class="table-responsive">
                        <table id="postsTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu Đề</th>
                                    <th>Mô Tả</th>
                                    <th>Nội Dung</th>
                                    <th>Ảnh Minh Họa</th>
                                    <th>Lượt Xem</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($post->content, 50) }}</td> <!-- Giới hạn nội dung hiển thị -->
                                    <td>
                                        @if($post->thumbnail)
                                            <img src="{{ asset($post->thumbnail) }}" alt="Thumbnail" style="max-width: 100px; height: auto;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $post->views }}</td>
                                    <td>
                                        <div class="row row-cols-auto g-3 mt-2">
                                            <div class="col">
                                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-outline-warning d-flex gap-2">
                                                    <i class="material-icons-outlined">edit</i>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
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
                            </tbody>
                        </table>
                    </div>

                    <!-- Phân trang -->
                    <div class="mt-3">
                        {{ $posts->links('pagination::bootstrap-4') }} 
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
            $('#postsTable').DataTable({
                "aaSorting": [[0, "asc"]] // Sắp xếp theo cột ID
            });
        });
    </script>
@endsection

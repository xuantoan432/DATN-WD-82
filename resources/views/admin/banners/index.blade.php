@extends('admin.layouts.master')


@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Banner</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách Banner</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Tạo Banner Mới</a>
                        </div>

                        <div class="table-responsive">
                            <table id="postsTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề banner</th>
                                        <th>Ảnh banner</th>
                                        <th>Vị trí</th>
                                        <th>Trạng thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $key => $banner)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $banner->banner_title }}</td>
                                            <td>
                                                @if ($banner->banner_image)
                                                    <img src="{{ Storage::url($banner->banner_image) }}" alt="Ảnh lỗi"
                                                        style="max-width: 100px; height: auto;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ config('banner_positions.'. $banner->position) }}</td>
                                            <td>{{ $banner->status }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-3 mt-2">
                                                    <div class="col">
                                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                                            class="btn btn-outline-warning d-flex gap-2">
                                                            <i class="material-icons-outlined">edit</i>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger d-flex gap-2"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_new')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

@endsection


@section('js_new')
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#postsTable').DataTable({
                "aaSorting": [
                    [0, "asc"]
                ]
            });
        });
        function thongbao(color, icon, msg) {
            Lobibox.notify(color, {
                pauseDelayOnHover: false,
                icon: icon,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                size: 'mini',
                msg: msg
            });
        }
        @if (session('error'))
            thongbao('error', 'bi bi-exclamation-triangle', '{{ session('error') }}')
        @endif

        @if (session('success'))
        console.log(1)
            thongbao('success', 'bi bi-check-circle', '{{ session('success') }}');
        @endif
    </script>


@endsection

@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <h3 class="m-0 font-weight-bold text-center">CHỈNH SỬA BANNER</h3>

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" name="banner_title" value="{{ old('banner_title', $banner->banner_title) }}"
                    class="form-control @error('banner_title') is-invalid @enderror">
                @error('banner_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Ảnh Banner</label>
                <input type="file" name="banner_image" class="form-control @error('thumbnail') is-invalid @enderror">
                @if ($banner->banner_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $banner->banner_image) }}" alt="Banner Image" width="200">
                    </div>
                @endif
                @error('banner_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="banner_text" class="form-label">Nội dung</label>
                <textarea class="form-control" id="banner_text" name="banner_text" rows="4">{{ old('banner_text', $banner->banner_text) }}</textarea>
                @error('banner_text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="banner_link" class="form-label">Liên kết</label>
                <input type="url" class="form-control" id="banner_link" name="banner_link"
                    value="{{ old('banner_link', $banner->banner_link) }}" placeholder="Nhập liên kết (URL)">
                @error('banner_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="is_featured" class="form-label">Trạng thái hoạt động</label>
                <select class="form-select" id="is_featured" name="is_featured">
                    <option value="0" {{ old('is_featured', $banner->is_featured) == '0' ? 'selected' : '' }}>Không
                    </option>
                    <option value="1" {{ old('is_featured', $banner->is_featured) == '1' ? 'selected' : '' }}>Có
                    </option>
                </select>
                @error('is_featured')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection

@section('css_new')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .toast-title,
        .toast-message {
            font-size: 20px !important;
        }
    </style>
@endsection

@section('js_new')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        CKEDITOR.replace('banner_text');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "timeOut": "5000",
            };
            toastr.success("{{ session('success') }}", "🎉 Thành công!");
        @endif
    </script>
@endsection

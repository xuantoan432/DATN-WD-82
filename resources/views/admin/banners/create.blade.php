@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <h3 class="m-0 font-weight-bold text-center">THÊM BANNER MỚI</h3>

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" name="banner_title" value="{{ old('banner_title') }}"
                    class="form-control @error('banner_title') is-invalid @enderror">
                @error('banner_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Ảnh Banner</label>
                <input type="file" name="banner_image" class="form-control @error('thumbnail') is-invalid @enderror">
                @error('banner_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="banner_text" class="form-label">Nội dung</label>
                <textarea class="form-control" id="banner_text" name="banner_text" rows="4" placeholder="Nhập nội dung">{{ old('banner_text') }}</textarea>
                @error('banner_text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="banner_link" class="form-label">Liên kết</label>
                <input type="url" class="form-control" id="banner_link" name="banner_link"
                    value="{{ old('banner_link') }}" placeholder="Nhập liên kết (URL)">
                @error('banner_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="is_featured" class="form-label">Đặc trưng</label>
                <select class="form-select" id="is_featured" name="is_featured">
                    <option value="0" {{ old('is_featured') == '0' ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Có</option>
                </select>
                @error('is_featured')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Thêm mới</button>
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
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
@endsection

@section('js_new')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session('success'))
        Lobibox.notify('success', {
                pauseDelayOnHover: false,
                icon: 'bi bi-check2-all',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                size: 'mini',
                msg: 'Thành công 🐒'
            });
        @endif
    </script>
@endsection

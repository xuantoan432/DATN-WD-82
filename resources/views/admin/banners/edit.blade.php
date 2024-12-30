@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <h5 class="card-header">Chỉnh sửa Banner</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu Đề</label>
                                <input type="text" name="banner_title" value="{{ old('banner_title', $banner->banner_title) }}"
                                       class="form-control @error('banner_title') is-invalid @enderror">
                                @error('banner_title')
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
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <h6 class="card-header">Xuất bản</h6>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                    <div class="card">
                        <h6 class="card-header">Trạng thái</h6>
                        <div class="card-body">
                            <select name="status" id="position" class="form-control">
                                <option value="active" @selected($banner->status === 'active')>Active</option>
                                <option value="inactive" @selected($banner->status === 'inactive')>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <h6 class="card-header">Vị trí</h6>
                        <div class="card-body">
                            <div class="form-group">
                                <select name="position" id="position" class="form-control">
                                    @foreach (config('banner_positions') as $key => $value)
                                        <option value="{{ $key }}" @selected($key === $banner->position)>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

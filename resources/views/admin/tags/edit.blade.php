@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <h6 class="m-0 font-weight-bold">Chỉnh sửa Tag</h6>
    
    <!-- Form chỉnh sửa Tag -->
    <form action="{{ route('admin.tags.update', $tag) }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')
        <div class="input-group">
            <input type="text" name="name" value="{{ old('name', $tag->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên Tag" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Cập nhật Tag</button>
        </div>
    </form>

    <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection

@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <h6 class="m-0 font-weight-bold">Tạo Bài Viết Mới</h6>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror"></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Ảnh Minh Họa</label>
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" >
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple>
                    <option value="" disabled selected>Chọn Tags</option> <!-- Placeholder -->
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu Bài Viết</button>
        </form>
    </div>
    
@endsection

@section('js_new')
<script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection

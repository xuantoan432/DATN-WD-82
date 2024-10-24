@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bài Viết</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Danh sách Bài Viết</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Bài Viết</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold">Chỉnh Sửa Bài Viết</h6>

                    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu Đề</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Nội Dung</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Ảnh Minh Họa</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @if ($post->thumbnail)
                                <img src="{{ asset($post->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail mt-2" style="max-width: 150px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select name="tags[]" class="form-control" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập Nhật Bài Viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

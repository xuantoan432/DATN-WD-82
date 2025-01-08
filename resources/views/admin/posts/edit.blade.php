@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <h5 class="card-header">Chỉnh sửa bài viết</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu Đề</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Ảnh Minh Họa</label>
                                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" >
                                @if ($post->thumbnail)
                                    <img src="{{asset('storage/'.$post->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail mt-2" style="max-width: 150px;">
                                @endif
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Mô Tả</label>
                                <textarea name="description" class="form-control @error('thumbnail') is-invalid @enderror">{{ old('description', $post->description) }}</textarea>
                            </div>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="content" class="form-label" >Nội Dung</label>
                                <textarea name="content">{{ old('description', $post->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <h6 class="card-header">Xuất bản</h6>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Sửa Bài Viết</button>
                        </div>
                    </div>
                    <div class="card">
                        <h6 class="card-header">Chọn tags</h6>
                        <div class="card-body">
                            <select class="form-select form-control" id="tags" name="tags[]"
                                    multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" @selected(in_array($tag->id, $post->tags->pluck('id')->toArray()))> {{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css_new')
    <x-head.tinymce-config/>
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/npm/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/npm/select2-bootstrap-5/dist/select2-bootstrap-5-theme.min.css') }}">
@endsection

@section('js_new')
    <script src="{{ asset('theme/admin/assets/npm/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tags').select2({
                theme: "bootstrap-5",
                closeOnSelect: false,
                allowClear: false,
                tags: true,
            });
        });
    </script>
@endsection

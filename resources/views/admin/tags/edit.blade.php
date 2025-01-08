@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="card col-8">
            <h5 class="card-header">
                Sửa tag: {{ $tag->name }}
            </h5>
            <div class="card-body">
                <form action="{{ route('admin.tags.update', $tag) }}" method="POST" class="mb-3">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <input type="text" name="name" value="{{ old('name', $tag->name) }}"
                               class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên Tag"
                               required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                        <button type="submit" class="btn btn-primary">Cập nhật Tag</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection

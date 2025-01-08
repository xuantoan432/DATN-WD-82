@extends('seller.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Đánh giá "{{ $review->user->name }}"</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-8">
                <div class="card mb-3">
                    <div class="card-header bg-transparent">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->star)
                                <i class="material-icons-outlined text-warning">star</i>
                            @else
                                <i class="material-icons-outlined ">star</i>
                            @endif
                        @endfor
                        <div>
                            <p>{{ $review->user->name }} (<a href="mailto:{{ $review->user->email }}">{{ $review->user->email }}</a>) - <i class="lni lni-alarm-clock"></i> {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $review->content }}</p>
                        @if($review->image)
                            <img src="{{ \Storage::url($review->image) }}" width="100px">
                        @endif
                    </div>
                    @if($reviewRely)
                        <div class="card-footer bg-transparent">
                            <p class="card-title">Trả lời đánh giá</p>
                            <form action="{{ route('seller.reviews.update', $reviewRely->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="parent_id" value="{{ $review->id }}">
                                <input type="hidden" name="product_id" value="{{ $review->product_id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="" cols="30" rows="3">{{ $reviewRely->content }}</textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="text-end">
                                    <button type="submit" class="btn btn-warning mt-3">
                                        Cập nhật
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                    <div class="card-footer bg-transparent">
                        <p class="card-title">Trả lời đánh giá</p>
                        <form action="{{ route('seller.reviews.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $review->id }}">
                            <input type="hidden" name="product_id" value="{{ $review->product_id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="" cols="30" rows="3"></textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="lni lni-reply"></i>
                                    Trả lời
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="card">
                            <div class="card-header">
                                Sản phẩm
                            </div>
                            <div class="card-body">
                                <div class="d-flex gap-3 align-items-start">
                                    <img class="img-thumbnail" src="{{ \Storage::url($review->product->image) }}" alt="" style="width: 15%">
                                    <div>
                                        <h4>
                                            <a href="{{ route('home.product-detail', $review->product) }}" target="_blank" class="fs-6">
                                                {{ $review->product->name }}
                                            </a>
                                        </h4>
                                        <div>
                                            <div class="rating_wrap d-inline-block">
                                                <div class="rating text-warning">
                                                    @php
                                                        $averageRating = $review->product->reviews->where('parent_id', 0)->avg('star');
                                                        $fullStars = floor($averageRating);
                                                        $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;

                                                    @endphp
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $fullStars)
                                                            <i class="lni lni-star-filled"></i>
                                                        @elseif ($i == $fullStars && $halfStar)
                                                            <i class="lni lni-star-half"></i>
                                                        @else
                                                            <i class="lni lni-star-empty"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <span>({{ $review->product->reviews->where('parent_id', 0)->count() }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('css_new')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/extra-icons.css') }}">
@endsection
@section('js_new')
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script>
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
        @if(session('success'))
        thongbao('success', 'bi bi-check-circle', '{{ session('success') }}');
        @endif
        @if(session('error'))
        thongbao('error', 'bi bi-exclamation-triangle', '{{ session('error') }}');
        @endif
    </script>
@endsection

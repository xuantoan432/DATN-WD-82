@extends('client.layouts.master')

@section('title')
    Wishlist
@endsection

@section('content')
    @include('client.components.breadcrumbs')
    <section class="cart product wishlist footer-padding" data-aos="fade-up">
        <div class="container">
            <div class="arrival-section">
                <div class="row g-5">
                    @if ($wishlistItems->isEmpty())
                        <p class="p-5" style="text-align: center; font-size:20px; color:#ae1c9a;"><b>Danh sách sản phẩm yêu
                                thích trống</b></p>
                    @else
                        @foreach ($wishlistItems as $item)
                            @include('client.components.product', [
                            'class' => 'col-lg-3 col-md-6',
                            'product' => $item->product,
                        ])
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="wishlist-btn">
                <form action="{{ route('wishlist.clean') }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi danh sách yêu thích?');">
                    @csrf
                    <div class="clean-btn">
                        <button type="submit" class="product-btn">Xóa tất cả khỏi yêu thích</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        .toast-title,
        .toast-message {
            font-size: 20px !important;
        }

        .form-control,
        .form-select {
            height: 50px;
            font-size: 16px;
            width: 100%;
            max-width: 500px;
            margin-top: 10px;
        }
    </style>
@endsection


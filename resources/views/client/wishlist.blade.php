@extends('client.layouts.master')

@section('title')
    Wishlist
@endsection

@section('content')
    @include('client.components.breadcrumbs')
    <section class="cart product wishlist footer-padding" data-aos="fade-up">
        <div class="container">
            <div class="cart-section wishlist-section">
                <table>
                    <tbody>
                        <tr class="table-row table-top-row">
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading text">STT</h5>
                            </td>
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading">ẢNH SẢN PHẨM</h5>
                            </td>
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading">TÊN SẢN PHẨM</h5>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">GIÁ</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">HÀNH ĐỘNG</h5>
                                </div>
                            </td>
                        </tr>
                        @if ($wishlistItems->isEmpty())
                            <tr class="table-row ticket-row ">
                                <td class="p-5" colspan="4"
                                    style="text-align: center; font-size:20px; color:#ae1c9a;"><b>Danh sách sản phẩm yêu
                                        thích trống</b></td>
                            </tr>
                        @else
                            @foreach ($wishlistItems as $key => $item)
                                <tr class="table-row ticket-row">
                                    <td class="table-wrapper">
                                        <div class="table-wrapper-center">
                                            <h5 class="heading">{{ $key + 1 }}</h5>
                                        </div>
                                    </td>
                                    <td class="table-wrapper wrapper-product">
                                        <div class="wrapper">
                                            <a href="{{ route('home.product-detail', $item->product->id)}}">
                                                <div class="wrapper-img">
                                                    <img src="{{ Storage::url($item->product->image) }}" alt="img">
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="table-wrapper">
                                        <a href="{{ route('home.product-detail', $item->product->id)}}">
                                            <div class="table-wrapper-center">
                                                <h5 class="heading">{{ $item->product->name }}</h5>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="table-wrapper">
                                        <div class="table-wrapper-center">
                                            <h5 class="heading">{{ $item->product->price }} <sup>đ</sup></h5>
                                        </div>
                                    </td>
                                    <td class="table-wrapper">
                                        <div class="table-wrapper-center">
                                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')">
                                                @csrf
                                                <button type="submit" style="background: none; border: none; padding: 0;">
                                                    <span>
                                                        <svg width="10" height="10" viewBox="0 0 10 10"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                                fill="#AAAAAA"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <div class="wishlist-btn">
                <form action="{{ route('wishlist.clean') }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi danh sách yêu thích?');">
                    @csrf
                    <div class="clean-btn">
                        <button type="submit" class="clean-btn">Xóa tất cả khỏi yêu thích</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

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

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

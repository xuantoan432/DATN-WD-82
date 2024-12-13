@extends('client.layouts.master2')

@section('title')
    Product-sidebar
@endsection

@section('content')
<div class="col-lg-9">
    <div class="product-sidebar-section" data-aos="fade-up">
        <div class="row g-5" id="product-list">
            <div class="col-lg-12">
                <div class="product-sorting-section">
                    <div class="result">
                        <p>Đang hiển thị <span>{{ $products->firstItem() }}–{{ $products->lastItem() }} trong {{ $products->total() }} sản phẩm</span></p>
                    </div>
                    <div class="product-sorting">
                        <span class="product-sort">Sắp xếp theo:</span>
                        <div class="product-list">


                                <select class="form-select" id="sort_order">
                                    <option value="default" {{request()->input('sort_order') == "default" ? 'selected' : ''}}>Mặc định</option>
                                    <option value="price_asc" {{request()->input('sort_order') == "price_asc" ? 'selected' : ''}}>Giá: Thấp đến cao</option>
                                    <option value="price_desc" {{request()->input('sort_order') == "price_desc" ? 'selected' : ''}}>Giá: Cao đến thấp</option>
                                    <option value="rating" {{request()->input('sort_order') == "rating" ? 'selected' : ''}}>Số sao</option>
                                </select>

                        </div>
                    </div>
                </div>
            </div>
            @foreach($products as $product)
                @include('client.components.product', ['class' => 'col-lg-4 col-sm-6', 'product' => $product])
            @endforeach


            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <p>Đang hiển thị <span>{{ $products->firstItem() }}–{{ $products->lastItem() }} trong {{ $products->total() }} sản phẩm</span></p>
                </div>
                {{ $products->links('client.components.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection

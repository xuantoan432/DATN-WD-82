

<div class="col-lg-3">
    <form class="form-search-filters" action="{{ route('home.shop') }}" method="GET">
        <input type="hidden" name="sort_order" id="sort_order_value" value="{{ request()->input('sort_order', 'default') }}">
        <div class="sidebar" data-aos="fade-right">
            <div class="sidebar-section">
                <div class="sidebar-wrapper">
                    <h5 class="wrapper-heading">Danh mục sản phẩm</h5>
                    <div class="sidebar-item">
                        <ul class="sidebar-list">
                            @foreach ($topCategories as $cat)
                            <li>
                                <input type="checkbox"
                                       data-filter="category"
                                       id="category-{{ $cat->id }}"
                                       name = "categories_id[]"
                                       class="form-control-checkbox category-filter categories" value="{{$cat->id}}"
                                @if(request()->has('categories_id') && in_array($cat->id, request()->input('categories_id')))
                                     checked
                                @endif
                                >
                                <label for="category-{{ $cat->id }}" class="d-flex justify-content-between w-100"><span>{{$cat->name}}</span><span>{{ numberToShortString($cat->products_count) }}</span></label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr>
                 <div class="sidebar-wrapper sidebar-range">
                    <h5 class="wrapper-heading">Khoảng giá</h5>
                    <div class="price-slide range-slider">
                        <div class="price">
                            <div class="range-slider style-1">
                                <div id="slider-tooltips"
                                     class="slider-range mb-3"
                                     data-min-price="{{ $minPrice }}"
                                     data-max-price="{{ $maxPrice }}"
                                     data-request-min="{{request()->input('min-value')}}"
                                     data-request-max="{{request()->input('max-value')}}"
                                ></div>
                                <span class="example-val" id="slider-margin-value-min"></span>
                                <span>-</span>
                                <span class="example-val" id="slider-margin-value-max"></span>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="min-value" value="">
                                <input type="hidden" name="max-value" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="sidebar-wrapper">
                    <h5 class="wrapper-heading">Tên cửa hàng</h5>
                    <div class="sidebar-item">
                        <ul class="sidebar-list">
                            @foreach($topSellers as $sell)
                                <li>
                                    <input type="checkbox"
                                           id="seller-{{$sell->id}}"
                                           class="sellers"
                                           name="sellers_id[]"
                                           value="{{$sell->id}}"
                                           @if(request()->has('sellers_id') && in_array($sell->id, request()->input('sellers_id')))
                                               checked
                                           @endif>
                                    <label for="seller-{{$sell->id}}"  class="d-flex justify-content-between w-100"><span>{{$sell->store_name}}</span><span>{{ numberToShortString($sell->products_count) }}</span></label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{-- <hr>
                <div class="sidebar-wrapper">
                    <h5 class="wrapper-heading">Color</h5>
                    <div class="sidebar-item">
                        <ul class="sidebar-list">
                            <li>
                                <input type="checkbox" id="red" name="red">
                                <label for="red">Red</label>
                            </li>
                            <li>
                                <input type="checkbox" id="blue" name="blue">
                                <label for="blue">blue</label>
                            </li>
                            <li>
                                <input type="checkbox" id="navy" name="navy">
                                <label for="navy">Navy</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="sidebar-wrapper">
                    <h5 class="wrapper-heading">Size</h5>
                    <div class="sidebar-item">
                        <ul class="sidebar-list">
                            <li>
                                <input type="checkbox" id="small" name="small">
                                <label for="small">Small</label>
                            </li>
                            <li>
                                <input type="checkbox" id="medium" name="medium">
                                <label for="medium">Medium</label>
                            </li>
                            <li>
                                <input type="checkbox" id="large" name="large">
                                <label for="large">Large</label>
                            </li>
                            <li>
                                <input type="checkbox" id="xl" name="xl">
                                <label for="xl">XL</label>
                            </li>
                            <li>
                                <input type="checkbox" id="2xl" name="2xl">
                                <label for="2xl">2XL</label>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>

        </div>

    </form>
</div>

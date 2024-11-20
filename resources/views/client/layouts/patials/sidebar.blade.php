

<div class="col-lg-3">
    <form action="{{ route('home.shop') }}" method="GET">
        <div class="sidebar" data-aos="fade-right">
            <div class="sidebar-section">
                <div class="sidebar-wrapper">
                    <h5 class="wrapper-heading">Danh mục sản phẩm</h5>
                    <form action="{{ route('home.shop') }}" method="GET" id="category-form">
                    <div class="sidebar-item">
                        <ul class="sidebar-list">
                            @foreach ($topCategories as $cat)
                            <li>
                                <input type="checkbox" data-filter="category"
                                name = "category_id[]"
                                class="form-control-checkbox category-filter" value="{{$cat->id}}"
                                @if(in_array($cat->id, $checkCategoryId))
                                    checked
                                @endif
                                >
                                <label for="category-{{ $cat->id }}">{{$cat->name}}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
                </div>
                <hr>
                {{-- <div class="sidebar-wrapper sidebar-range">
                    <h5 class="wrapper-heading">Price Range</h5>
                    <div class="price-slide range-slider">
                        <div class="price">
                            <div class="range-slider style-1">
                                <div id="slider-tooltips" class="slider-range mb-3"></div>
                                <span class="example-val" id="slider-margin-value-min"></span>
                                <span>-</span>
                                <span class="example-val" id="slider-margin-value-max"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr> --}}
                <div class="sidebar-wrapper">
                    <h5 class="wrapper-heading">Tên cửa hàng</h5>
                    <div class="sidebar-item">
                        <ul class="sidebar-list">
                            @foreach($topSellers as $sell)
                                <li>
                                    <input type="checkbox" id="couture" name="seller[]" value="{{$sell->id}}"
                                    
                                    @if(in_array($sell->id, $checkSeller))
                                        checked
                                    @endif
                                    >
                                    <label for="couture">{{ $sell->store_name }}</label>
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
            <button type="submit" style="    background: rgba(174, 28, 154, .188);
    color: #ae1c9a;
    padding: 10px;
    width: 100%;
    margin-top: 20px;
    font-weight: bold;
    font-size: 14px;">
                Tìm kiếm
            </button>
            {{-- <div class="sidebar-shop-section">
                <span class="wrapper-subtitle">TRENDY</span>
                <h5 class="wrapper-heading">Best wireless Shoes</h5>
                <a href="seller-sidebar.html" class="shop-btn deal-btn">Shop Now </a>
            </div> --}}
        </div>
        
    </form>
</div>
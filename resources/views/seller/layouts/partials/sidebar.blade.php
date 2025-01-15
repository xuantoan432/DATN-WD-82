<div class="sidebar-header">
    <div class="logo-icon">
        <img src="{{ asset('theme/admin/assets/images/g.png') }}" class="logo-img" alt="">
    </div>
    <div class="logo-name flex-grow-1">
        <h5 class="mb-0">StyleNest</h5>
    </div>
    <div class="sidebar-close">
        <span class="material-icons-outlined">close</span>
    </div>
</div>
<div class="sidebar-nav">
    <!--navigation-->
    <ul class="metismenu" id="sidenav">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="material-icons-outlined">home</i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="material-icons-outlined">widgets</i>
                </div>
                <div class="menu-title">Sản phẩm</div>
            </a>
            <ul>
                <li><a href="{{ route('seller.products.create') }}"><i
                            class="material-icons-outlined">arrow_right</i>Thêm Sản Phẩm </a>
                </li>
                <li>
                    <a href="{{ route('seller.products.index') }}"><i
                            class="material-icons-outlined">arrow_right</i>Danh sách Sản Phẩm</a>
                </li>
                <li>
                    <a href="{{ route('seller.vouchers.index') }}"><i class="material-icons-outlined">arrow_right</i>Mã
                        giảm giá
                    </a>
                </li>
                <li><a href="{{ route('seller.attributes.index') }}"><i
                            class="material-icons-outlined">arrow_right</i>Thuộc
                        tính</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="material-icons-outlined">shopping_bag</i>
                </div>
                <div class="menu-title">Đơn hàng</div>
            </a>
            <ul>
                <li><a href="{{ route('seller.orders.index') }}"><i
                            class="material-icons-outlined">arrow_right</i>Danh sách đơn hàng </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('seller.reviews.index') }}">
                <div class="parent-icon"><i class="material-icons-outlined">star</i>
                </div>
                <div class="menu-title">Đánh giá</div>
            </a>
        </li>
        <li>
            <a href="{{ route('seller.chats') }}">
                <div class="parent-icon"><i class="material-icons-outlined">messenger</i>
                </div>
                <div class="menu-title">Chat</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>

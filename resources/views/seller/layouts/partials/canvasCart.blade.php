<div class="offcanvas-header border-bottom h-70">
    <h5 class="mb-0" id="offcanvasRightLabel">{{ count($notificationOrders) }} đơn hàng mới</h5>
    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
        <i class="material-icons-outlined">close</i>
    </a>
</div>
<div class="offcanvas-body p-0">
    <div class="order-list">
        @foreach($notificationOrders as $item)
            <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                <div class="order-img">
                    <img src="{{ \Storage::url($item['notifiable']->image) }}" class="img-fluid rounded-3" width="75"
                         alt="">
                </div>
                <div class="order-info flex-grow-1">
                    <h5 class="mb-1 order-title">{{ $item['notifiable']?->name }}</h5>
                    <p class="mb-0 order-price">{{ number_format($item['notifiable']->price, 0, ',','.') }} VNĐ</p>
                </div>
                <div class="d-flex">
                    <a href="{{ route('seller.orders.edit', $item['notifiable']->id ?? 0) }}" class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="offcanvas-footer h-70 p-3 border-top">
    <div class="d-grid">
        <a href="{{ route('seller.orders.index') }}" class="btn btn-grd btn-grd-primary" >Xem tất cả</a>
    </div>
</div>

import '../bootstrap';
window.Echo.private(`seller.${sellerId}`)
    .listen('OrderDetailNotification', (e) => {
        let html = document.querySelector('.order-list');
        let thongbao = document.querySelector('#notification-order-count');
        let totalItems = document.querySelector('#offcanvasRightLabel');
        let count = parseInt(thongbao.dataset.data, 10) || 0;
        count += 1;

        // Cập nhật số lượng thông báo
        thongbao.innerText = count <= 9 ? '0' + count : count;
        thongbao.dataset.data = count;
        totalItems.innerText = count ;
        console.log(e);
        // Xây dựng nội dung thông báo mới
        let UI = `
            <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                <div class="order-img">
                    <img src="/storage/${e.orderDetail.image}" class="img-fluid rounded-3" width="75"
                         alt="">
                </div>
                <div class="order-info flex-grow-1">
                    <h5 class="mb-1 order-title">${e.orderDetail.name}</h5>
                    <p class="mb-0 order-price">${e.orderDetail.price} VNĐ</p>
                </div>
                <div class="d-flex">
                    <a href="${e.url}" class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                </div>
            </div>
        `;

        // Thêm thông báo mới vào đầu danh sách
        html.insertAdjacentHTML('afterbegin', UI);

    })
    .listen('ReviewNotifycation', (e) => {
        let html = document.querySelector('#notify-list');
        let thongbao = document.querySelector('#notify-list-count');
        let count = parseInt(thongbao.dataset.data, 10) || 0;
        count += 1;

        // Cập nhật số lượng thông báo
        thongbao.innerText = count <= 9 ? '0' + count : count;
        thongbao.dataset.data = count;

        let UI = `
            <div>
                <a class="dropdown-item border-bottom py-2" href="${e.url}">
                    <div class="d-flex align-items-center gap-3">
                        <div class="">
                            <img src="${e.avatar}" class="rounded-circle"
                                width="45" height="45" alt="">
                        </div>
                        <div class="">
                            <h5 class="notify-title">${ e.title}</h5>
                            <p class="mb-0 notify-desc">${ e.message}</p>
                            <p class="mb-0 notify-time">${e.time}</p>
                        </div>
                        <div class="notify-close position-absolute end-0 me-3">
                            <i class="material-icons-outlined fs-6">close</i>
                        </div>
                    </div>
                </a>
            </div>
        `;

        // Thêm thông báo mới vào đầu danh sách
        html.insertAdjacentHTML('afterbegin', UI);
    });

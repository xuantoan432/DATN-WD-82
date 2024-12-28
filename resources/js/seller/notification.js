import '../bootstrap';
let html = document.querySelector('.order-list');
console.log(html)
window.Echo.private(`seller.${sellerId}`)
    .listen('OrderDetailNotification', (e) => {
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

    });


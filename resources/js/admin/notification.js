import '../bootstrap';

let html = document.querySelector('.notify-list');

// document.querySelectorAll('.notify-time').forEach(element => {
//     const timeString = element.dataset.time;
//     element.textContent = timeAgo(timeString);
// });
updateNotificationTimes();
setInterval(updateNotificationTimes, 10000);

window.Echo.channel('thongbao').listen('EventNotification', (e) => {

    let thongbao = document.querySelector('#notif-cont');
    let count = parseInt(thongbao.dataset.data, 10) || 0;
    count += 1;

    // Cập nhật số lượng thông báo
    thongbao.innerText = count <= 9 ? '0' + count : count;
    thongbao.dataset.data = count;

    // Xây dựng nội dung thông báo mới
    let UI = `
      <div>
        <a class="dropdown-item border-bottom py-2 position-relative" href="${e.url}">
            <div class="d-flex align-items-center gap-3">
                <div class="">
                    <img src="{{ 
                    \Storage::url(${e.avatar})
                    }}"
                        class="rounded-circle" width="45" height="45" alt="">
                </div>
                <div class="">
                    <h5 class="notify-title">${e.name} Đã ${e.title}</h5>
                    <p class="mb-0 notify-desc">${e.message}</p>
                    <p class="mb-0 notify-time" data-time="${e.time}"></p>
                </div>
                <div class="notify-close position-absolute end-0 me-3">
                    <i class="material-icons-outlined fs-6">close</i>
                </div>
            </div>
            <span class="badge-notify"></span>
        </a>
      </div>
    `;

    // Thêm thông báo mới vào đầu danh sách
    html.insertAdjacentHTML('afterbegin', UI);

    // Cập nhật lại thời gian hiển thị
    updateNotificationTimes();
});

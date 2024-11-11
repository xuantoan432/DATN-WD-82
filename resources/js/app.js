import './bootstrap';
window.Echo.private(`user.${window.userId}`)  // Kênh riêng tư cho người dùng
    .listen('SellerApproved', (e) => {
        console.log(e);
        if (e.userId === window.userId) {
            alert('Bạn đã được xác thực thành công. Chuyển hướng tới trang đăng nhập...');
            // window.location.href = "/login";
        }
    });

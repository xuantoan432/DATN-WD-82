import './bootstrap';
window.Echo.private(`user.${window.userId}`)  // Kênh riêng tư cho người dùng
    .listen('SellerApproved', (e) => {
        console.log(e);
        if (e.userId === window.userId) {
            if (confirm('Bạn đã được xác thực thành công. Bạn có muốn chuyển hướng tới trang đăng nhập không?')) {
                window.location.href = "/"; 
            }
        }
    });

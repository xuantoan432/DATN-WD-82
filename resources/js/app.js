import './bootstrap';
window.Echo.private(`user.${window.userId}`)  // Kênh riêng tư cho người dùng
    .listen('SellerApproved', (e) => {
        console.log(e);
        if (e.userId === window.userId) {
            Swal.fire({
                title: 'Xác thực thành công!',
                text: 'Bạn đã được xác thực với vai trò Seller. Bạn có muốn chuyển đến trang đăng nhập không?',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/"; // Chuyển hướng đến trang đăng nhập
                }
            });

        }
    });
    window.Echo.private(`user.${window.userId}`)
    .listen('SellerRejected', (e) => {
        if (e.userId === window.userId) {
            Swal.fire({
                title: 'Yêu cầu bị từ chối!',
                text: 'Bạn đã bị từ chối xác minh vai trò seller. Bạn sẽ được chuyển hướng về trang chủ với vai trò customer.',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/";
                }
            });
        }

    });

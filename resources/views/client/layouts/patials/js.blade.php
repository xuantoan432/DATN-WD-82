<script src="/theme/client/assets/js/jquery_3.7.1.min.js"></script>

<script src="https://kit.fontawesome.com/147ffd2c04.js"></script>

<script src="/theme/client/assets/js/bootstrap_5.3.2.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/147ffd2c04.js"></script>
<script src="/theme/client/assets/js/nouislider.min.js"></script>

<script src="/theme/client/assets/js/aos-3.0.0.js"></script>

<script src="/theme/client/assets/js/swiper10-bundle.min.js"></script>

<script src="/theme/client/assets/js/shopus.js"></script>

<script>
    // Hàm mở/đóng modal
    function modalAction(modalClass) {
        const modal = document.querySelector(modalClass);
        modal.classList.toggle('active');
    }

    // Hàm tìm kiếm sản phẩm
    // function searchProducts() {
    //     // Lấy giá trị từ ô tìm kiếm
    //     const keyword = document.getElementById('searchKeyword').value;

    //     // Kiểm tra nếu không có từ khóa tìm kiếm
    //     if (keyword.trim() === '') {
    //         alert("Vui lòng nhập từ khóa tìm kiếm.");
    //         return;
    //     }

    //     // Tạo URL tìm kiếm (đảm bảo route trong Laravel đã được định nghĩa)
    //     const searchUrl = '{{ route('home.shop') }}/' + encodeURIComponent(keyword);

    //     // Điều hướng đến URL tìm kiếm
    //     window.location.href = searchUrl;
    // }

    // Hàm để hiển thị danh mục tìm kiếm (nếu cần)
    function showCategories() {
        // Chức năng hiển thị danh mục sẽ được xử lý ở đây (nếu cần)
        alert("Hiển thị danh mục tìm kiếm!");
    }
</script>


$(document).ready(function () {
    // Cấu hình `toastr` một lần duy nhất
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };

    function updateQuantityDisplay(inputElement, quantity) {
        $(inputElement).val(quantity);
    }

    function updateTotalPrice(inputElement, unitPrice, quantity) {
        let totalPriceElement = $(inputElement).closest('.table-row').find('.total-price');
        let newTotalPrice = unitPrice * quantity;
        totalPriceElement.text('₫' + newTotalPrice.toLocaleString('vi-VN'));
    }

    $('.plus').click(function () {
        let inputElement = $(this).siblings('.quantity-input');
        let currentVal = parseInt(inputElement.val());
        let cartID = inputElement.data('id');

        if (isNaN(currentVal)) {
            updateQuantityDisplay(inputElement, 1);
            return;
        }
        let newQuantity = currentVal + 1;
        let unitPrice = parseInt($(this).closest('.table-row').find('.total-price').data('unit-price'));

        $.ajax({
            url: PATH_ROOT + 'api/check-quantity',
            type: 'GET',
            data: {
                quantity: newQuantity,
                cartId: cartID
            },
            success: function (response) {
                if(response.status === 'success'){
                    updateQuantityDisplay(inputElement, newQuantity);
                    updateTotalPrice(inputElement, unitPrice, newQuantity);
                    updateCartTotal();
                }

            },
            error: function (xhr) {
                if (xhr.status === 422 || xhr.status === 400) {
                    const errorMessage = xhr.responseJSON?.message || 'Đã xảy ra lỗi. Vui lòng thử lại.';
                    toastr.warning(errorMessage, "Thông báo!");
                    updateQuantityDisplay(inputElement, currentVal);
                    updateTotalPrice(inputElement, unitPrice, currentVal);
                    updateCartTotal();
                } else {
                    toastr.error("Lỗi không xác định. Vui lòng thử lại.", "Thông báo!");
                }
            }
        });
    });

    $('.minus').click(function () {
        let inputElement = $(this).siblings('.quantity-input');
        let currentVal = parseInt(inputElement.val());
        let cartID = inputElement.data('id');

        if (isNaN(currentVal) || currentVal <= 1) {
            return;
        }
        let newQuantity = currentVal - 1;
        let unitPrice = parseInt($(this).closest('.table-row').find('.total-price').data('unit-price'));
        $.ajax({
            url: PATH_ROOT + 'api/check-quantity',
            type: 'GET',
            data: {
                quantity: newQuantity,
                cartId: cartID
            },
            success: function (response) {
                if(response.status === 'success'){
                    updateQuantityDisplay(inputElement, newQuantity);
                    updateTotalPrice(inputElement, unitPrice, newQuantity);
                    updateCartTotal();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422 || xhr.status === 400) {
                    const errorMessage = xhr.responseJSON?.message || 'Đã xảy ra lỗi. Vui lòng thử lại.';
                    toastr.warning(errorMessage, "Thông báo!");
                    updateQuantityDisplay(inputElement, currentVal);
                    updateTotalPrice(inputElement, unitPrice, currentVal);
                    updateCartTotal();
                } else {
                    toastr.error("Lỗi không xác định. Vui lòng thử lại.", "Thông báo!");
                }
            }
        });
    });

    $('.delete-product').click(function () {
        let button = $(this);
        let cartID = button.data('id');

        $.ajax({
            url: PATH_ROOT + 'api/remove-from-cart', // Giả sử API có endpoint là remove-from-cart
            type: 'DELETE',
            data: {
                cartId: cartID
            },
            success: function (response) {
                if (response.success){
                    button.closest('.table-row').remove();

                    toastr.success("Sản phẩm đã được xóa khỏi giỏ hàng.", "Thông báo!");

                    updateCartTotal();
                }

            },
            error: function (xhr) {
                toastr.error("Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại.", "Thông báo!");
            }
        });
    });

    function updateCartTotal() {
        let total = 0;

        $('.table-row').each(function () {
            let unitPrice = parseInt($(this).find('.total-price').data('unit-price')) || 0;

            let quantity = parseInt($(this).find('.quantity-input').val()) || 1;

            total += unitPrice * quantity;
        });
        $('#cart-total1').text('₫' + total.toLocaleString('vi-VN'));
    }

});

$('.cart-btn-delete').click(function () {
    let button = $(this);
    let cartID = button.data('id');

    $.ajax({
        url: PATH_ROOT + 'api/remove-from-cart',
        type: 'DELETE',
        data: {
            cartId: cartID
        },
        success: function (response) {
            console.log(response); // Log response for debugging
            if (response.success) {
                button.closest('.wrapper').remove();

                updateCartTotal1();
            }
        },
        error: function () {
            console.error("Failed to remove item from cart.");
        }
    });
});


function updateCartTotal1() {
    let total = 0;
    let count = 0;
    $('.wrapper').each(function () {
        // Get the unit price from `data-unit-price` attribute of `.wrapper`
        let unitPrice = parseInt($(this).data('unit-price')) || 0;

        // Get the quantity from the `.wrapper-title` text (e.g., "Product Name x 2")
        let quantityText = $(this).find('.wrapper-title').text();
        let quantity = parseInt(quantityText.split(' x ')[1]) || 1;

        // Calculate the total for the current product and add to `total`
        total += unitPrice * quantity;
        ++ count;
    });
    $('#text-quantity').html(count);
    // Update the cart total display with currency formatting
    $('#cart-total').text('₫' + total.toLocaleString('vi-VN'));
}



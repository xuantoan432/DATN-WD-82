<script>
    const PATH_ROOT = '{{ config('app.url') }}/';
</script>
<script src="/theme/client/assets/js/jquery_3.7.1.min.js"></script>

<script src="https://kit.fontawesome.com/147ffd2c04.js"></script>

<script src="/theme/client/assets/js/bootstrap_5.3.2.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/147ffd2c04.js"></script>
<script src="/theme/client/assets/js/nouislider.min.js"></script>

<script src="/theme/client/assets/js/aos-3.0.0.js"></script>

<script src="/theme/client/assets/js/swiper10-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/theme/client/assets/js/shopus.js"></script>

<script src="/theme/client/assets/js/custom.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };
    @if (session('success'))
        toastr.success("{{ session('success') }}", "🎉 Thành công!");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}", "Thất bại!");
    @endif
</script>
<script>
    $(document).on('click', '.favourite.cart-item', function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');

        if (!productId) {
            toastr.error('Sản phẩm không hợp lệ.');
            return;
        }

        $.ajax({
            url: '{{ route('wishlist.add') }}',
            method: 'POST',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message, "🎉 Thành công!");
                    $('#wishlist-quantity').html(response.quantity);
                } else {
                    toastr.error(response.message || 'Đã có lỗi xảy ra.');
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message || 'Đã có lỗi xảy ra.');
            }
        });
    });

    const formatCurrencyVND = (amount) => {
        if (typeof amount !== "number") {
            amount = parseFloat(amount);
            if (isNaN(amount)) {
                throw new Error("Số tiền không hợp lệ");
            }
        }

        return new Intl.NumberFormat("vi-VN", { style: "currency", currency: "VND" }).format(amount);
    }
</script>

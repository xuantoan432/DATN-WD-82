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

<script>
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


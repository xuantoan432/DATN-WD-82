
const totalAttributes = $('.attribute-options').length;
const defaultImage = $('.product-top .swiper-slide img').attr('src');
const swiperBottom = new Swiper('.product-bottom', {
    spaceBetween: 10,
    slidesPerView: 4,
    watchSlidesProgress: true,
});

const swiperTop = new Swiper('.product-top', {
    spaceBetween: 10,
    thumbs: {
        swiper: swiperBottom,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
$(document).ready(function () {
    let selectedValues = {};

    $('.attribute-options input[type="radio"]').on('click', function () {
        $(this).closest('.attribute-options').find('.attribute-name').removeClass('active');
        $(this).next('.attribute-name').addClass('active');

        selectedValues = {};

        $('.attribute-options').each(function () {
            let selectedValue = $(this).find('input[type="radio"]:checked').val();
            if (selectedValue) {
                let [attrKey, attrId] = selectedValue.split('-');
                selectedValues[attrKey] = attrId;
            }
        });

        if (Object.keys(selectedValues).length === totalAttributes) {
            $.ajax({
                url: PATH_ROOT + 'api/check-variant',
                type: 'GET',
                data: {
                    selectedAttributes: selectedValues,
                    productId: productId,
                },
                success: function (response) {
                    if (response.status){
                        const variantImage = `/storage/${response.variant.image}`;

                        swiperTop.slides[0].querySelector('img').src = variantImage;

                        swiperTop.update();

                        swiperTop.slideTo(0);

                        if(response.variant.price_sale){
                            $('.new-price').html('₫' + response.variant.price_sale)
                            $('.price-cut').html('₫' + response.variant.price)
                        }else{
                            $('.price-cut').html('')
                            $('.new-price').html('₫' + response.variant.price)
                        }

                        $('.product-availability').children('.inner-text').html(`${response.variant.stock_quantity} sản phẩm có sẵn`);
                        $('#stock-quantity').val(response.variant.stock_quantity);
                        $('#product-variant-id').val(response.variant.id);

                        if (response.variant.sku){
                            $('.sku').children('.inner-text').html(response.variant.sku)
                        }
                    }
                },
                error: function(xhr) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "timeOut": "5000",
                    };
                    toastr.warning("Không có sản phẩm với biến thể này", "Thông báo!");
                    $.each(selectedValues, function(attrKey, attrId) {
                        let $radioInput = $(`.attribute-options input[type="radio"][value="${attrKey}-${attrId}"]`);

                        if ($radioInput.length) {
                            $radioInput.prop('checked', false);

                            $radioInput.closest('.attribute-options').find('.attribute-name').removeClass('active');
                        }
                    });
                }
            });
        }
    });

    swiperBottom.on('click', function(swiper) {
        var currentImage = swiperTop.slides[0].querySelector('img').src;

        if (currentImage !== defaultImage) {
            swiperTop.slides[0].querySelector('img').src = defaultImage;
            swiperTop.slideTo(0);
        }
    });

    $('.plus').click(function () {
        if (Object.keys(selectedValues).length === totalAttributes) {
            let input = $(this).prev();
            let currentQuantity = parseInt(input.val());
            let stockQuantity = parseInt($('#stock-quantity').val());

            if (currentQuantity + 1 > stockQuantity) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "5000",
                };
                toastr.warning("Số lượng không được vượt quá trong kho", "Thông báo!");
            } else {
                input.val(currentQuantity + 1);
            }
        } else {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
            };
            toastr.warning("Vui lòng chọn biến thể trước rồi chọn số lượng", "Thông báo!");
        }
    });

    $('.minus').click(function () {
        let input = $(this).next();
        let currentValue = +input.val();

        if (currentValue > 1) {
            input.val(currentValue - 1);
        }else{
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
            };
            toastr.warning("Số lượng sản phẩm không thể nhỏ hơn 1", "Thông báo!");
        }
    });

    const addToCart = $('#add-to-cart').on('click', function (e) {
        if (Object.keys(selectedValues).length === totalAttributes) {
            return true;
        } else {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
            };
            toastr.warning("Vui lòng chọn các thuộc tính trước khi thêm vào giỏ hàng", "Thông báo!");
            return false;
        }
    });
});






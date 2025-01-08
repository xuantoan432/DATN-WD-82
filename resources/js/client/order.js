
$(document).ready(function() {
    async function displayFullAddress(addressDefault, line_address) {
        try {
            $('input[name="address_id"]').val(addressDefault.id)
            $('.address-line').html(line_address);
            $('.address-info .name').html(`${addressDefault.details.full_name} | ${addressDefault.details.phone_number}`);
        } catch (error) {
            console.error(error);
        }
    }

    displayFullAddress(addressDefault, line_address);


    $('.confirm-button').on('click', function (){
        const addressRadios = document.querySelectorAll('#all-address input[name="address"]');
        const selectedRadio = Array.from(addressRadios).find(radio => radio.checked);
        if (selectedRadio) {
            const selectedAddress = allAddresses.find(address => address.id == selectedRadio.value);

            if (selectedAddress) {
                const addressElement = selectedRadio.closest('.address-item');
                const fullAddressText = addressElement.querySelector('p.mb-3').innerText;

                displayFullAddress(selectedAddress, fullAddressText);
                const modalElement = document.getElementById('exampleModal');
                const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                modal.hide();
            }
        } else {
            toastr.error("Vui lòng chọn đia chỉ", "Thông báo!");
        }
    })


    $('#cart-coupon').submit(function (e) {
        e.preventDefault();

        var couponCode = $('#coupon-code').val();
        var cartTotal = $('#cart_total').val();
        var userId = $('#user_id').val();
        var discountValue = $('#discount_value').val();
        var voucherPrevious = $('#voucher_previous').val();

        $.ajax({
            url: PATH_ROOT + 'api/voucher/apply',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                coupon_code: couponCode,
                total: cartTotal,
                user_id: userId,
                discount_value: discountValue,
                voucher_previous: voucherPrevious
            },
            success: function (response) {
                // Nếu thành công, hiển thị thông báo và số tiền đã được trừ
                if (response.success) {
                    $('#coupon-message').html('<p>Áp dụng mã giảm giá thành công!</p>');

                    $('ul.product-list.fee .price .wrapper-heading').text(formatCurrencyVND(response.discount));
                    $('#total-amount').text(formatCurrencyVND(response.total_after_discount));
                    $("input[name='total_price']").val(response.total_after_discount);

                    $('#voucher_previous').val(response.voucher_id)
                    $("#discount_value").val(response.discount);
                } else {
                    $('#coupon-message').html('<p>' + response.message + '</p>');
                }
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu có
                $('#coupon-message').html('<p>An error occurred. Please try again later.</p>');
            }
        });
    });

    $('.add-new-address').click(function (){
        $('#modal-address').html(`
            <form action="" method="POST" id="new-address-form">
                <div class="login-section account-section modal-main">
                    <div class="review-form">
                        <div class="review-content">
                            <h5 class="comment-title mt-0">Thêm địa chỉ mới</h5>
                        </div>
                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="full_name" class="form-label">Họ và tên*</label>
                                <input type="text" id="full_name" name="full_name" class="form-control"
                                     required  placeholder="Nhập họ và tên">
                            </div>
                            <div class="review-form-name">
                                <label for="phone_number" class="form-label">Phone*</label>
                                <input type="tel" id="phone_number" required name="phone_number" class="form-control"
                                       placeholder="+880388**0899">
                            </div>
                        </div>
                        <div class=" account-inner-form city-inner-form">
                            <div class="review-form-name">
                                <label for="usercity" class="form-label ">Tỉnh/Thành
                                    phố</label>
                                <select id="province" name="province" required
                                    class="form-select province form-control">
                                    <option></option>
                                </select>
                            </div>
                            <div class="review-form-name">
                                <label for="usercity"
                                    class="form-label">Quận/Huyện</label>
                                <select id="district" name="district" required
                                    class="form-select district form-control">
                                </select>
                            </div>
                        </div>

                        <div class=" account-inner-form city-inner-form">
                            <div class="review-form-name">
                                <label for="usercity"
                                    class="form-label">Phường/Xã</label>
                                <select id="ward" name="ward" required
                                    class="form-select ward form-control">
                                </select>
                            </div>
                        </div>

                        <div class="review-form-name address-form">
                            <label for="useraddress" class="form-label">Địa
                                chỉ</label>
                            <input type="text" id="useraddress"
                                name="address_line" class="form-control"
                                placeholder="Khu/Số nhà ...">
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Thêm địa
                                chỉ</button>
                        </div>
                    </div>
                </div>
            </form>
        `)
        $.ajax({
            url: '/api/p/',
            method: 'GET',
            success: function(response) {
                const provinces = response.data
                $('#province').append(provinces.map(function(province) {
                    return `<option value="${province.id}">${province.name}</option>`;
                }).join(''));
            },
            error: function() {
                alert('Không thể tải danh sách Tỉnh/Thành phố.');
            }
        });

        $('#province').on( 'change' , function () {

            let selectedValue = $(this).val();

            $('#district').html('<option value="">Chọn Quận/Huyện</option>'); // Reset danh sách quận/huyện
            $('#ward').html('<option value="">Chọn Xã/Phường</option>'); // Reset danh sách xã/phường

            if (selectedValue) {
                $.ajax({
                    url: `/api/p/${selectedValue}`,
                    method: 'GET',
                    success: function(response) {
                        const districts = response.data
                        $('#district').append(districts.map(function(district) {
                            return `<option value="${district.id}">${district.name}</option>`;
                        }));
                    },
                    error: function() {
                        alert('Không thể tải danh sách Quận/Huyện.');
                    }
                });
            }
        })

        $('#district').on( 'change' , function () {

            let selectedValue = $(this).val();
            $('#ward').html('<option value="">Chọn Xã/Phường</option>'); // Reset danh sách xã/phường

            if (selectedValue) {
                $.ajax({
                    url: `/api/d/${selectedValue}`,
                    method: 'GET',
                    success: function(response) {
                        const wards = response.data
                        $('#ward').append(wards.map(function(ward) {
                            return `<option value="${ward.id}">${ward.name}</option>`;
                        }));
                    },
                    error: function() {
                        alert('Không thể tải danh sách Xã/Phường.');
                    }
                });
            }

        })
    });
    $(document).on('submit', '#new-address-form', function (e) {
        e.preventDefault(); // Ngăn hành vi gửi form mặc định

        // Thu thập dữ liệu từ form
        const formData = {
            full_name: $('#full_name').val(),
            phone_number: $('#phone_number').val(),
            province: $('#province').val(),
            district: $('#district').val(),
            ward: $('#ward').val(),
            address_line: $('#useraddress').val(),
            user_id: $('input[name="user_id"]').val()
        };

        // Gửi dữ liệu qua AJAX
        $.ajax({
            url: '/api/address/create',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#exampleModal').modal('hide');
                displayFullAddress(response.data, response.address_line)
            },
            error: function (xhr) {

                console.error(xhr.responseJSON);
                alert(responseJSON.message);
            }
        });
    });
});








$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };
    async function displayFullAddress(addressDefault) {
        try {
            const province = await getLocation('p', addressDefault.province_id);
            const district = await getLocation('d', addressDefault.district_id);
            const ward = await getLocation('w', addressDefault.ward_id);
            $('input[name="address_id"]').val(addressDefault.id)
            const fullAddress = getFullAddress(addressDefault.address_line, ward.name, district.name, province.name);
            $('.address-line').html(fullAddress);
            $('.address-info .name').html(`${addressDefault.details.full_name} | ${addressDefault.details.phone_number}`);
        } catch (error) {
            console.error(error);
        }
    }

    displayFullAddress(addressDefault);

    async function getAllFullAddresses(addressArray) {
        try {
            const addressPromises = addressArray.map(async (address, index) => {
                const province = await getLocation('p', address.province_id);
                const district = await getLocation('d', address.district_id);
                const ward = await getLocation('w', address.ward_id);

                const fullAddress = getFullAddress(address.address_line, ward.name, district.name, province.name);

                const defaultLabel = address.id === addressDefault.id ? `<span class="default-label address-deafault">Mặc định</span>` : '';

                return `<div class="address-item row">
                        <div class="col-9">
                        <div class="d-flex">
                            <input type="radio" name="address" id="address${index + 1}" value="${address.id}" ${ defaultLabel != '' ? 'checked' : ''}>
                            <label for="address${index + 1}"><strong>${address.details.full_name}</strong> ${address.details.phone_number}  <p class="mb-3">${fullAddress}</p></label>
                        </div>
                            ${defaultLabel}
                        </div>
                        <div class="address-actions col-3">
                            <a href="#" onclick="editAddress(${address.id})">Cập nhật</a>
                        </div>
                    </div>`;
            });

            const fullAddressesHTML = await Promise.all(addressPromises);
            const html = fullAddressesHTML.join('');
            return html;
        } catch (error) {
            console.error(error);
        }
    }


    getAllFullAddresses(allAddresses).then(fullAddresses => {
        $('#all-address').append(fullAddresses)
    })

    $('.confirm-button').on('click', function (){
        const addressRadios = document.querySelectorAll('#all-address input[name="address"]');
        const selectedRadio = Array.from(addressRadios).find(radio => radio.checked);
        if (selectedRadio) {
            const selectedAddress = allAddresses.find(address => address.id == selectedRadio.value);

            if (selectedAddress) {
                displayFullAddress(selectedAddress);
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
            url: 'https://provinces.open-api.vn/api/p/',
            method: 'GET',
            success: function(data) {
                $('#province').append(data.map(function(province) {
                    return `<option value="${province.code}">${province.name}</option>`;
                }));
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
                    url: `https://provinces.open-api.vn/api/p/${selectedValue}?depth=2`,
                    method: 'GET',
                    success: function(data) {
                        $('#district').append(data.districts.map(function(district) {
                            return `<option value="${district.code}">${district.name}</option>`;
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
                    url: `https://provinces.open-api.vn/api/d/${selectedValue}?depth=2`,
                    method: 'GET',
                    success: function(data) {
                        $('#ward').append(data.wards.map(function(ward) {
                            return `<option value="${ward.code}">${ward.name}</option>`;
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
                displayFullAddress(response.data)
            },
            error: function (xhr) {

                console.error(xhr.responseJSON);
                alert(responseJSON.message);
            }
        });
    });
});

const getLocation = (type, id) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `https://provinces.open-api.vn/api/${type}/${id}?depth=2`,
            method: 'GET',
            success: function (data) {
                resolve(data);
            },
            error: function () {
                reject(`Không thể tải danh sách ${type === 'p' ? 'Tỉnh/Thành phố' : type === 'd' ? 'Quận/Huyện' : 'Xã/Phường'}.`);
            }
        });
    });
};

const getFullAddress = (addressInline, ward, district, province) => {

    return  `${addressInline},${ward},${district},${province}`;
}




$(document).ready(function() {

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

async function displayFullAddress(addressDefault, element) {
    try {
        const province = await getLocation('p', addressDefault.province_id);
        const district = await getLocation('d', addressDefault.district_id);
        const ward = await getLocation('w', addressDefault.ward_id);
        const fullAddress = getFullAddress(addressDefault.address_line, ward.name, district.name, province.name);
        element.html(fullAddress);
    } catch (error) {
        console.error(error);
    }
}

$('.seller-info.all-address').each(function (index) {
    if (address[index]) { // Kiểm tra nếu địa chỉ tồn tại
        displayFullAddress(address[index], $(this).find('.address-line'));
    } else {
        console.error(`No address found for index ${index}`);
    }
});





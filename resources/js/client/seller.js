

var j = jQuery.noConflict();

j(document).ready(function() {

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
});



j('#province').on( 'change' , function () {

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

j('#district').on( 'change' , function () {

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

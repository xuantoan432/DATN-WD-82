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


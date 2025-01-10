
var giatien = 0;

$(function () {
    var catgoryId = 0;
    var isValid = false;
    var chietkhau = 0;

    $('#chietkhau').text(formatPriceToVND(chietkhau))
    $('#phantram').text('Tiền Chiết Khấu :')
    show(dulieu.idcategory , dulieu.gia)
    $('#cate').change(function () {
        var cate = $('#cate option:selected');
        catgoryId = cate.val();
        if (isValid) {
            show(catgoryId, giatien);
        }
    });
    $('#gia').on('input', function () {
        giatien = $(this).val();
        isValid = validatePrice(giatien);
        if (isValid && catgoryId) {
            show(catgoryId, giatien);
        }
    });
    $('#cate').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: true
    });

});

function show(idcate, gia) {
    categories.forEach((value) => {
        if (value.id == idcate) {
            var chietkhau = (gia * value.fee_percentage) / 100;
            $('#phantram').text(`Tiền Chiết Khấu - (${value.fee_percentage}%) :`)
            $('#chietkhau').text(formatPriceToVND(chietkhau))
        }
    })
}

function validatePrice(value) {
    if (isNaN(value) && value.trim() !== '') {
        $('#err-gia').text('Giá tiền phải là số .');
        return false
    } else if (parseInt(value, 10) < 0 && value.trim() !== '') {
        $('#err-gia').text('Giá tiền phải là số nguyên dương.');
        return false
    } else if (value.trim() !== '' && value.length > 10) {
        $('#err-gia').text('Giá tiền không vượt quá 10 số ');
        $('#chietkhau').text(formatPriceToVND(0))
        return false
    } else {
        $('#err-gia').text('');;
        return true;
    }
}
function formatPriceToVND(gia) {
    return gia.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
}
// hiện thị thông báo
function thongbao(color, icon, msg) {
    Lobibox.notify(color, {
        pauseDelayOnHover: false,
        icon: icon,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        size: 'mini',
        msg: msg
    });
}
// sửa sản phẩm







$(function () {
    var catgoryId = 0;
    var isValid = false;
    var chietkhau = 0;
    var giatien = 0;
    $('#chietkhau').text(formatPriceToVND(chietkhau))
    $('#cate').change(function () {
        var cate = $('#cate option:selected');
        catgoryId = cate.val();
        show(catgoryId, giatien);
    });
    $('#gia').on('input', function () {
        giatien = $(this).val();
        isValid = validatePrice(giatien);
        if (isValid && catgoryId) {
            show(catgoryId, giatien);
        }
    });
    $('#add-item-btn').click(function () {
        var selectedValues = $('#bien-the').val();
        thembienthe(selectedValues);
    });

    $('#repeater').on('click', '.remove-variant', function () {
        $(this).closest('.card').remove();
    });
});

function show(idcate, gia) {
    $.ajax({
        url: '/api/cate/' + idcate,
        type: 'GET',
        success: function (response) {
            var chietkhau = (gia * response.fee_percentage) / 100;

            $('#chietkhau').text(formatPriceToVND(chietkhau))
        },
        error: function (error) {

        }
    });
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
        return false
    } else {
        $('#err-gia').text('');;
        return true;
    }

}
function formatPriceToVND(gia) {
    return gia.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
}
function thembienthe(selectedValues) {
    var htmls = '';
    var ajaxCalls = [];

    selectedValues.forEach((idcate) => {
        var ajaxCall = $.ajax({
            url: '/api/bienthe/' + idcate,
            type: 'GET',
            success: function (response) {

                let bienthe = '';
                response.attribute_values.forEach(function (attribute) {
                    bienthe += `<option value="${attribute.id}">${attribute.value}</option>`;
                });

                htmls += `
                 <div class="col-12">
                    <label for="Tags" class="form-label"> Giá Trị :  ${response.giatri.name}</label>
                             <select class="form-select" id="AddCategory">
                                      ${bienthe}
                             </select>
                </div>

                `;

            },
            error: function (error) {
                console.error("Lỗi khi lấy dữ liệu:", error);
            }
        });
        ajaxCalls.push(ajaxCall);
    });

    $.when(...ajaxCalls).done(function () {
        console.log(ajaxCalls);
        var newVariant = `
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Biến thể sản phẩm </h5>
                        <button class="btn btn-danger remove-variant">Xóa</button>
                    </div>

                   <div class="col-12">
                        <label for="Collection" class="form-label">Mã Sản Phẩm </label>
                        <input type="text" class="form-control" id="Collection" placeholder="SKU_">
                    </div>
                     <div class="col-12">
                        <label for="Collection" class="form-label">Giá Sản Phẩm </label>
                        <input type="text" class="form-control" id="Collection" placeholder="tiền ">
                    </div>
                     <div class="col-12">
                        <label for="Collection" class="form-label">Giảm giá  </label>
                        <input type="text" class="form-control" id="Collection" placeholder="tiền">
                    </div>
                      ${htmls}
                    <div class="col-12">
                        <label for="Collection" class="form-label">Ảnh sản phẩm </label>
                        <input type="file" class="form-control" id="Collection" placeholder="tiền">
                    </div>
                     <div class="col-12">
                        <label for="Collection" class="form-label">Số lượng  sản phẩm </label>
                        <input type="text" class="form-control" id="Collection" placeholder="tiền">
                    </div>
                      <div class="col-12">
                        <label for="Collection" class="form-label">Ngày bắt đầu giảm giá  </label>
                        <input type="date" class="form-control" id="Collection" placeholder="tiền">
                    </div>  <div class="col-12">
                        <label for="Collection" class="form-label">Ngày kết thúc giảm giá </label>
                        <input type="date" class="form-control" id="Collection" placeholder="tiền">
                    </div>
                </div>
            </div>
        `;
        $('#repeater').append(newVariant);
    });
}

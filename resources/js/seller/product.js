
// hiện thị cate + giá
var giatien = 0;
$(function () {
    // $('#image-uploadify').imageuploadify();
    var catgoryId = 0;
    var isValid = false;
    var chietkhau = 0;
    $('#chietkhau').text(formatPriceToVND(chietkhau))
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
    $('#bien-the').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
        allowClear: true,
        tags: true,
        createTag: function (params) {
            // Tạo một đối tượng cho mục mới
            return {
                id: params.term, // Sử dụng từ người dùng đã nhập làm id
                text: params.term, // Sử dụng từ người dùng đã nhập làm text
                newOption: true // Đánh dấu đây là một mục mới
            };
        },
        templateResult: function (data) {
            var $result = $('<span></span>');
            $result.text(data.text);
            if (data.newOption) {
                $result.append('<em>(mới)</em>'); // Ghi chú rằng đây là mục mới
            }
            return $result;
        }
    });
});
let IdAttribute = [];
$('#add-item-btn').click(function (e) {
    e.preventDefault();
    const selectedValues = $('#bien-the').select2('data');
    if (selectedValues.length > 0) {
        const ajaxCalls = selectedValues.map(item => {
            if (item.newOption) {
                return $.ajax({
                    type: "POST",
                    url: "http://datn-wd-82.test/api/attribute",
                    data: {
                        name: item.text,
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function (data) {
                        let options = `<option value="${data.id}">${data.name}</option>`;
                        $('#bien-the').append(options);
                        IdAttribute.push({ id: data.id, name: data.name });
                    }
                });
            } else {
                IdAttribute.push({ id: item.id, name: item.text });
                return Promise.resolve();
            }
        }); // Lọc bỏ các undefined

        // Chờ tất cả các yêu cầu AJAX hoàn tất
        $.when(...ajaxCalls).done(function () {
            valuebienthe(IdAttribute);
            $('#FormModal').modal('show');
        }).fail(function () {
            console.error("Có lỗi xảy ra khi gửi yêu cầu AJAX.");
            let color = 'error';
            let icon = 'bi bi-exclamation-triangle';
            let msg = 'Có lỗi xảy ra khi thêm biến thể!';
            thongbao(color, icon, msg);
        });
    } else {
        let color = 'error';
        let icon = 'bi bi-exclamation-triangle';
        let msg = 'Vui lòng chọn loại biến thể !!';
        thongbao(color, icon, msg);
    }
});
var IdSelect2 = [];
function valuebienthe(selectedValues) {
    var htmls = '';
    selectedValues.forEach((valueAttribute) => {
        let options = '';
        let IdValue = 'value-bien-the-' + Math.random().toString(36).substr(2, 9);
        IdSelect2.push({
            valueName: valueAttribute.name,
            valueIDA: valueAttribute.id,
            valueId: `#${IdValue}`
        });
        if (attributeValues[valueAttribute.id] && Object.keys(attributeValues[valueAttribute.id]).length > 0) {
            for (const [id, name] of Object.entries(attributeValues[valueAttribute.id])) {
                options += `<option value="${id}">${name}</option>`;
            }
        }
        htmls += `
                 <div class="col-md-12 mb-3">
                          <label class="form-label"> Giá Trị: ${valueAttribute.name}</label>
                        <select class="form-select" id="${IdValue}" data-name="${valueAttribute.name}" data-id="${valueAttribute.id}" name="attributeValues[${valueAttribute.id}][]" multiple>
                           ${options}
                        </select>
                </div>`;
    });

    $('#vaule-bienthe').append(htmls);
    IdSelect2.forEach(value => {
        $(value.valueId).select2({
            theme: "bootstrap-5",
            width: $(value.valueId).data('width') ? $(value.valueId).data('width') : $(value.valueId).hasClass('w-100') ? '100%' : 'style',
            placeholder: 'Vui lòng chọn giá trị ' + value.valueName,
            allowClear: true,
            tags: true,
            createTag: function (params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                };
            },
            templateResult: function (data) {
                var $result = $('<span></span>');
                $result.text(data.text);
                if (data.newOption) {
                    $result.append('<em>( giá trị mới)</em>');
                }
                return $result;
            }

        });
    });
}
let index = 0;
let previousLength = 0;
let danhSachToHopBienThe = [];

$('#them-bien-the').click(function (e) {
    e.preventDefault();
    let chek = true;

    if (IdSelect2.length != previousLength) {
        index = 0;
        $('#repeater').empty();
        IdSelect2.map(function (value) {
            const selectedValues = $(value.valueId).select2('data');

            if (selectedValues.length > 0) {
                selectedValues.map(item => {
                    if (item.newOption) {
                        return $.ajax({
                            type: "POST",
                            url: "http://datn-wd-82.test/api/attributevalue",
                            data: {
                                attribute_id: value.valueIDA,
                                value: item.text,
                                user_id: user_id
                            },
                            dataType: "json",
                            success: function (data) {
                                let option = `<option value="${data.id}">${data.name}</option>`;
                                $(value.id).append(option);
                            }
                        });
                    }
                    else {
                        // console.log(item) ;
                        return Promise.resolve();
                    }
                });
            } else {
                let color = 'error';
                let icon = 'bi bi-exclamation-triangle';
                let msg = `Vui lòng chọn giá trị ${value.valueName}  !!`;
                thongbao(color, icon, msg);
                chek = false;
            }
        });
    } else if (IdSelect2.length === previousLength) {
        IdSelect2.map(function (value) {
            const selectedValues = $(value.valueId).select2('data');
            if (selectedValues.length > 0) {
                selectedValues.map(item => {
                    if (item.newOption) {
                        return $.ajax({
                            type: "POST",
                            url: "http://datn-wd-82.test/api/attributevalue",
                            data: {
                                attribute_id: value.valueIDA,
                                value: item.text,
                                user_id: user_id
                            },
                            dataType: "json",
                            success: function (data) {
                                let option = `<option value="${data.id}">${data.name}</option>`;
                                $(value.id).append(option);
                            }
                        });
                    } else {
                        return Promise.resolve();
                    }
                });
            } else {
                let color = 'error';
                let icon = 'bi bi-exclamation-triangle';
                let msg = `Vui lòng chọn giá trị ${value.valueName}  !!`;
                thongbao(color, icon, msg);
                chek = false;
            }
        });
    }
    previousLength = IdSelect2.length;
    if (chek) {
        let selectedAttributes = $('select[name^="attributeValues"]');
        let attributeValues = getCombinations(selectedAttributes);
        let duplicateCombination = null;

        // Kiểm tra nếu có bất kỳ tổ hợp nào bị trùng
        let isDuplicate = attributeValues.some((val) => {
            let comboString = JSON.stringify(val);
            if (danhSachToHopBienThe.includes(comboString)) {
                duplicateCombination = val;
                return true;
            }
            return false;
        });

        if (isDuplicate && duplicateCombination) {
            // Tạo thông báo chi tiết về tổ hợp bị trùng
            let duplicateText = duplicateCombination.map(item => `${item.nameop}: ${item.name}`).join(', ');
            thongbao('error', 'bi bi-exclamation-triangle', `Vui lòng bỏ biến thể : ${duplicateText}`);
            return;
        }
            attributeValues.forEach((val) => {
                let comboString = JSON.stringify(val);
                danhSachToHopBienThe.push(comboString);
                let html = ``;
                val.forEach(item => {
                    html += `
                    <div class="col-md-6">
                        <label for="input1" class="form-label">Giá Trị Biến Thể: ${item.nameop}</label>
                        <input type="text" class="form-control" value="${item.name}" disabled>
                        <input type="hidden" class="form-control" name="valuebute[${index}]" value="${item.id}">
                        <input type="hidden" class="form-control" name="variants[${index}][idvalue][]" value="${item.id}">
                    </div>`;
                });
                let newVariant = `
            <div class="card" data-value="${JSON.stringify(val)}" >
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Biến thể sản phẩm </h5>
                        <button class="btn btn-danger remove-variant">Xóa</button>
                    </div>
                    <div class="form-group row g-3">
                        ${html}
                    </div>
                    <div class="form-group">
                        <label>Giá sản phẩm:</label>
                        <input type="text" name="variants[${index}][gia]" class="form-control" placeholder="Nhập giá biến thể">
                        <div class="error-variants-${index}-gia text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label>Giảm giá:</label>
                        <input type="text" name="variants[${index}][giamgia]" class="form-control" placeholder="Nhập giảm giá">
                        <div class="error-variants-${index}-giamgia text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label>Mã sản phẩm:</label>
                        <input type="text" name="variants[${index}][sku]" class="form-control" placeholder="SKU_">
                        <div class="error-variants-${index}-sku text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label>Số lượng:</label>
                        <input type="text" name="variants[${index}][soluong]" class="form-control" placeholder="">
                        <div class="error-variants-${index}-soluong text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label>Ảnh sản phẩm:</label>
                         <input id="anhbienthe-${index}" class="form-control" type="file" name="variants[${index}][anhbienthe]" >
                        <div class="error-variants-${index}-anhbienthe text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu giảm giá:</label>
                        <input type="date" name="variants[${index}][ngaybd]" class="form-control">
                        <div class="error-variants-${index}-ngaybd text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc giảm giá:</label>
                        <input type="date" name="variants[${index}][ngayketthuc]" class="form-control">
                        <div class="error-variants-${index}-ngayketthuc text-danger"></div>
                    </div>
                </div>
            </div>`;

            let cardElement = $(newVariant);
            cardElement.data('combo', val);
            $('#repeater').append(cardElement);
            index++  ;
    })
            $('#FormModal').modal('hide');
            thongbao('success', 'bi bi-check-circle', 'thêm biến thể thành công');



    }
})
$('#FormModal').on('hidden.bs.modal', function () {
    $('#vaule-bienthe').empty();
    IdSelect2 = [];
    IdAttribute = [];
});

$('#repeater').on('click', '.remove-variant', function () {
    let comboData = $(this).closest('.card').data('combo');
    let comboString = JSON.stringify(comboData);
    danhSachToHopBienThe = danhSachToHopBienThe.filter(item => item !== comboString);
    $(this).closest('.card').remove();
    thongbao('success', 'bi bi-check-circle', 'Đã xóa biến thể thành công');

});

// kết thúc thêm biến thể

/// hiện thị giá chiết khấu
function show(idcate, gia) {
    categories.forEach((value) => {
        if (value.id == idcate) {
            var chietkhau = (gia * value.fee_percentage) / 100;
            $('#chietkhau').text(formatPriceToVND(chietkhau))
        }
    })
}
///  kiểm tra giữ liệu của giá khi nhập vào
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
/// thay đổi kiểu hiện thị giá thành VNĐ
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
function getCombinations(selectElements) {
    let attributeValues = Array.from(selectElements).map(select => {
        return Array.from(select.selectedOptions).map(option => ({
            idop: $(select).data('id'),
            nameop: $(select).data('name'),
            id: option.value,
            name: option.text
        }));
    });

    // Nếu chỉ chọn một thuộc tính, trả về giá trị thuộc tính đó
    if (attributeValues.length === 1) {
        return attributeValues[0].map(item => [item]);
    }

    // Hàm đệ quy để kết hợp các giá trị thuộc tính
    function combine(arr) {
        if (arr.length === 0) return [[]];

        let result = [];
        let restCombinations = combine(arr.slice(1));

        arr[0].forEach(item => {
            restCombinations.forEach(combination => {
                result.push([item].concat(combination));
            });
        });

        return result;
    }

    return combine(attributeValues);
}


/// đắng sản phẩm

$('#product').on('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // formData.append('_token', $('meta[name="csrf-token"]').attr('content'));


    $.ajax({
        type: "POST",
        url: routePost,

        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log("Form submitted successfully", data);
            thongbao(data.color, data.icon, data.success);
            // Xóa tất cả các giá trị của các trường input, select
            $('#product').find('input, select, textarea').val('').prop('checked', false).prop('selected', false);

        },
        error: function (error, xhr, status) {
            if (error.status === 422) {
                thongbao('error', 'bi bi-exclamation-octagon', 'Thêm sản phẩm thất bại !!! ')
                $('.text-danger').text('');
                let er = error.responseJSON.errors;
                // console.log(er) ;
                if (er.namesanpham) {
                    $('.error-namesanpham').text(er.namesanpham.join(', '));
                }
                if (er.anhsanphamchinh) {
                    $('.error-anhsanphamchinh').text(er.anhsanphamchinh.join(', '));
                } if (er.motangan) {
                    $('.error-motangan').text(er.motangan.join(', '));
                } if (er.noidung) {
                    $('.error-noidung').text(er.noidung.join(', '));
                } if (er.gallery) {
                    $('.error-gallery').text(er.gallery.join(', '));
                } if (er.danhmuc) {
                    $('.error-danhmuc').text(er.danhmuc.join(', '));
                } if (er.masanpham) {
                    $('.error-masanpham').text(er.masanpham.join(', '));
                } if (er.giasanpham) {
                    $('.error-giasanpham').text(er.giasanpham.join(', '));
                } if (er.valuebute) {
                    $('.error-valuebute').text(er.valuebute.join(', '));
                }



                $.each(er, function (key, messages) {
                    let id = key.replace(/\./g, '-');

                    $('.error-' + id).text(messages.join(', '));

                });
            } else {
                ``
                console.log("Trạng thái: " + xhr.status); // Kiểm tra trạng thái lỗi
                console.log("Thông báo lỗi: " + error); // Hiển thị lỗi
                console.log("Phản hồi từ máy chủ: " + xhr.responseText); // Phản hồi từ server
            }
        }
    });
});




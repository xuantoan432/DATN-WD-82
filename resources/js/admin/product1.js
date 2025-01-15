let url = "/api/admin/admin-product/"

$('#duyet').click(function (e) {

    e.preventDefault();
    const id = $(this).data('id');


    Swal.fire({
        title: "Bạn chắc chắn phê duyệt ? ",
        text: "Bạn sẽ không thể hoàn tác điều này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#84D9BA",
        cancelButtonColor: "#d33",
        confirmButtonText: "Chấp thuận",
        cancelButtonText: "Từ Chối"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url + id,
                method: 'PUT',
                data: {
                    status: 'duyet'
                },
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        text: "Duyệt sản phẩm thành công!",
                        icon: "success"
                    });
                    $('#html').html('<span class="badge bg-success  ">Đã phê duyệt </span >')
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        text: "Đã xảy ra lỗi khi duyệt sản phẩm!",
                        icon: "error"
                    });
                    console.error(error);
                }
            });
        }
    });
});
$('.tuchoi').click(function (e) {
    $('#noidung').empty();
    e.preventDefault();
    const id = $(this).data('id');
    $('#pro-id').val(id);
    $('#modalText').text('');
    $('#inputField').val('');
    $('#myModal').modal('show');

})

$('#product').on('submit', function (e) {
    e.preventDefault();

    let id = $('#pro-id').val();
    let nd = $('#inputField').val()


    $.ajax({
        url:  url + id,
        method: 'PUT',
        data: {
            status: 'tuchoi' ,
            lido :  nd
        },
        dataType: "json",
        success: function (response) {
            Swal.fire({
                text: "Đã từ chối sản phẩm  !",
                icon: "success"
            });

            $('#html').html('<span class="badge bg-danger  ">Đã từ chối  </span >')
            $('#myModal').modal('hide');

            $('#modalText').text('');
            $('#inputField').val('');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                text: "Đã xảy ra lỗi khi duyệt sản phẩm!",
                icon: "error"
            });
            $('#myModal').modal('hide');

            $('#modalText').text('');
            $('#inputField').val('');

        }
    });




});
$('#closeModal').click(function () {
    $('#myModal').modal('hide');

    $('#modalText').text('');
    $('#inputField').val('');
});
$('#myModal').on('hidden.bs.modal', function () {
    $('#modalText').text('');
    $('#inputField').val('');
});

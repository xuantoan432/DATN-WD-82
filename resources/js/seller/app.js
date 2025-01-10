const url =  "seller/products/";
// xoá sản phẩm

$('.xoa').click(function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    var row = $(this).closest('tr');
    Swal.fire({
        title: "Cảnh Báo !!!",
        text: "Hành Động Này Sẽ Xoá Vĩnh Viễn",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng Ý, Xoá vĩnh viễn" ,
        cancelButtonText : "Huỷ bỏ"
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: appUrl + url + id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    table.row(row).remove().draw();
                    thongbao('success', 'bi bi-check-circle', 'Đã xóa thành công');
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        text: "Đã xảy ra lỗi khi xoá!   ",
                        icon: "error"
                    });
                    console.error(error);
                }
            });
        }
      });
})
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

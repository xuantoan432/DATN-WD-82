@extends('client.layouts.master')

@section('title')
    Cart
@endsection

@section('content')
    @include('client.components.breadcrumbs')

    <section class="product privacy footer-padding">
        <div class="container">
            <div class="privacy-section">
                <div class="policy">
                    <h5 class="intro-heading">1. Chính sách bảo mật là gì? ?</h5>
                    <p class="policy-details">Điều khoản và điều kiện thường bao gồm một mô tả ngắn gọn về chính sách bảo mật
                        của bạn hoặc một tuyên bố xác nhận rằng việc sử dụng trang web đồng nghĩa với việc người dùng đồng ý
                        với cách bạn xử lý và xử lý dữ liệu cá nhân. Nội dung này đã tồn tại không chỉ qua năm thế kỷ mà còn
                        qua sự chuyển mình vào thời đại sắp chữ điện tử, hầu như không thay đổi. Nó không trở nên phổ biến
                        vào những năm 1960 với việc phát hành các tờ Letraset chứa các đoạn văn bản Lorem Ipsum, và gần đây
                        hơn với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker, bao gồm các phiên bản Lorem
                        Ipsum để tạo một cuốn sách mẫu kiểu chữ.</p>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">2. Ví dụ về Điều khoản và Điều kiện Thương mại Điện tử</h5>
                    <p class="policy-details">Mặc dù không bắt buộc theo pháp luật rằng các trang web thương mại điện tử phải
                        có thỏa thuận điều khoản và điều kiện, việc thêm một thỏa thuận như vậy sẽ giúp bảo vệ doanh nghiệp
                        trực tuyến của bạn. Vì điều khoản và điều kiện là những quy tắc có tính ràng buộc pháp lý, chúng cho
                        phép bạn đặt ra các tiêu chuẩn về cách người dùng tương tác với trang web của bạn. Dưới đây là một
                        số lợi ích chính của việc bao gồm điều khoản và điều kiện trên trang thương mại điện tử của bạn:
                        <span class="policy-inner-text">
                            Nó đã tồn tại không chỉ qua năm thế kỷ mà còn qua bước chuyển mình vào thời đại sắp chữ điện tử,
                            hầu như không thay đổi. Nó không trở nên phổ biến vào những năm 1960 với việc phát hành các tờ
                            Letraset chứa các đoạn văn Lorem Ipsum, và gần đây hơn với các máy tính để bàn.
                        </span>
                    </p>
                    <div class="policy-features">
                        <h5 class="intro-heading">Tính năng :</h5>
                        <ul>
                            <li>
                                <p>Thân máy mỏng với vỏ kim loại</p>
                            </li>
                            <li>
                                <p>Bộ vi xử lý Intel Core i5-1135G7 mới nhất (4 nhân / 8 luồng)</p>
                            </li>
                            <li>
                                <p>RAM DDR4 8GB và SSD PCIe 512GB tốc độ cao</p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">3. Mẫu Điều khoản và Điều kiện Thương mại Điện tử [Miễn phí]</h5>
                    <p class="policy-details">Lorem Ipsum chỉ là văn bản giả dùng trong ngành in ấn và sắp chữ. Lorem Ipsum
                        đã là văn bản tiêu chuẩn giả của ngành công nghiệp này từ những năm 1500, khi một nhà in không rõ
                        tên đã lấy một bộ chữ và xáo trộn nó để tạo ra một cuốn sách mẫu chữ. Nó đã tồn tại không chỉ qua
                        năm thế kỷ mà còn qua bước chuyển mình vào sắp chữ điện tử, hầu như không thay đổi. Nó không trở nên
                        phổ biến vào những năm 1960 với việc phát hành các tờ Letraset chứa các đoạn văn Lorem Ipsum, và gần
                        đây hơn với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker, bao gồm các phiên bản Lorem
                        Ipsum để tạo một cuốn sách mẫu chữ.
                    </p>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">4. Những gì cần bao gồm trong Điều khoản và Điều kiện cho các cửa hàng trực
                        tuyến</h5>
                    <p class="policy-details">Lorem Ipsum chỉ là văn bản giả được sử dụng trong ngành in ấn và sắp chữ.
                        Lorem Ipsum đã là văn bản tiêu chuẩn giả của ngành công nghiệp này từ những năm 1500, khi một nhà in
                        không rõ tên đã lấy một bộ chữ và xáo trộn nó để tạo ra một cuốn sách mẫu chữ. Nó đã tồn tại không
                        chỉ qua năm thế kỷ mà còn qua bước chuyển mình vào sắp chữ điện tử, hầu như không thay đổi. Nó không
                        trở nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset chứa các đoạn văn Lorem
                        Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker, bao gồm các
                        phiên bản Lorem Ipsum để tạo một cuốn sách mẫu chữ.
                        <span class="policy-inner-text">
                            Nó đã tồn tại không chỉ qua năm thế kỷ mà còn qua bước chuyển mình vào sắp chữ điện tử, hầu như
                            không thay đổi. Nó không trở nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset
                            chứa các đoạn văn Lorem Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như
                            Aldus PageMaker, bao gồm các phiên bản Lorem Ipsum để tạo một cuốn sách mẫu chữ.
                        </span>
                    </p>
                </div>

                html
                Copy code
                <div class="policy">
                    <h5 class="intro-heading">05. Điều khoản về Giá cả và Thanh toán</h5>
                    <p class="policy-details">Lorem Ipsum chỉ là văn bản giả được sử dụng trong ngành in ấn và sắp chữ.
                        Lorem Ipsum đã là văn bản tiêu chuẩn giả của ngành công nghiệp này từ những năm 1500, khi một nhà in
                        không rõ tên đã lấy một bộ chữ và xáo trộn nó để tạo ra một cuốn sách mẫu chữ. Nó đã tồn tại không
                        chỉ qua năm thế kỷ mà còn qua bước chuyển mình vào sắp chữ điện tử, hầu như không thay đổi. Nó không
                        trở nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset chứa các đoạn văn Lorem
                        Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker, bao gồm các
                        phiên bản Lorem Ipsum để tạo một cuốn sách mẫu chữ.
                        <span class="policy-inner-text">
                            Nó đã tồn tại không chỉ qua năm thế kỷ mà còn qua bước chuyển mình vào sắp chữ điện tử, hầu như
                            không thay đổi. Nó không trở nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset
                            chứa các đoạn văn Lorem Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như
                            Aldus PageMaker, bao gồm các phiên bản Lorem Ipsum để tạo một cuốn sách mẫu chữ. Nó không trở
                            nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset chứa các đoạn văn Lorem
                            Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker, bao gồm
                            các phiên bản Lorem Ipsum để tạo một cuốn sách mẫu chữ.
                        </span>
                        <span class="policy-inner-text">
                            Nó đã tồn tại không chỉ qua năm thế kỷ mà còn qua bước chuyển mình vào sắp chữ điện tử, hầu như
                            không thay đổi. Nó không trở nên phổ biến vào những năm 1960 với việc phát hành các tờ Letraset
                            chứa các đoạn văn Lorem Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như
                            Aldus PageMaker, bao gồm các phiên bản Lorem Ipsum để tạo một cuốn sách mẫu chữ.
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

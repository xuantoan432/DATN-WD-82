@extends('client.layouts.master')

@section('title')
    Điều khoản và điều kiện
@endsection

@section('content')
    @include('client.components.breadcrumbs')
    <section class="product privacy footer-padding">
        <div class="container">
            <div class="privacy-section">
                <div class="policy">
                    <h5 class="intro-heading">1. Chính sách bảo mật là gì?</h5>
                    <p class="policy-details">Điều khoản và điều kiện thường có một mô tả ngắn gọn về chính sách bảo mật của
                        bạn hoặc một tuyên bố rằng việc sử dụng trang web đồng nghĩa với việc đồng ý với cách bạn xử lý và
                        xử lý dữ liệu cá nhân. Nó đã tồn tại không chỉ qua năm thế kỷ mà còn qua sự chuyển đổi sang sắp chữ
                        điện tử, vẫn giữ nguyên bản chất. Nó không trở nên phổ biến vào những năm 1960 khi các tấm Letraset
                        chứa các đoạn văn Lorem Ipsum được phát hành, và gần đây hơn là với phần mềm xuất bản trên máy tính
                        để bàn như Aldus PageMaker bao gồm các phiên bản của Lorem Ipsum để tạo một cuốn sách mẫu kiểu chữ.
                    </p>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">2. Ví dụ về điều khoản và điều kiện thương mại điện tử</h5>
                    <p class="policy-details">Mặc dù không bắt buộc phải có điều khoản và điều kiện đối với các trang web
                        thương mại điện tử, việc thêm điều khoản này sẽ giúp bảo vệ doanh nghiệp trực tuyến của bạn. Vì điều
                        khoản và điều kiện là các quy tắc có hiệu lực pháp lý, chúng cho phép bạn thiết lập tiêu chuẩn về
                        cách người dùng tương tác với trang web của bạn. Dưới đây là một số lợi ích chính khi thêm điều
                        khoản và điều kiện vào trang web thương mại điện tử của bạn:
                        <span class="policy-inner-text">
                            Nó đã tồn tại không chỉ qua năm thế kỷ mà còn qua sự chuyển đổi sang sắp chữ điện tử, vẫn giữ
                            nguyên bản chất. Nó không trở nên phổ biến vào những năm 1960 khi các tấm Letraset chứa các đoạn
                            văn Lorem Ipsum được phát hành, và gần đây hơn là với phần mềm xuất bản trên máy tính để bàn.
                        </span>
                    </p>
                    <div class="policy-features">
                        <h5 class="intro-heading">Tính năng:</h5>
                        <ul>
                            <li>
                                <p>Thân máy mỏng với vỏ kim loại</p>
                            </li>
                            <li>
                                <p>Bộ xử lý Intel Core i5-1135G7 mới nhất (4 lõi / 8 luồng)</p>
                            </li>
                            <li>
                                <p>RAM DDR4 8GB và ổ cứng SSD PCIe 512GB tốc độ cao</p>
                            </li>
                            <li>
                                <p>Card đồ họa NVIDIA GeForce MX350 2GB GDDR5, bàn phím có đèn nền, touchpad hỗ trợ cử chỉ
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">3. Mẫu điều khoản và điều kiện thương mại điện tử [Miễn phí]</h5>
                    <p class="policy-details">Lorem Ipsum chỉ đơn giản là văn bản giả của ngành in ấn và sắp chữ. Lorem
                        Ipsum đã trở thành tiêu chuẩn của ngành kể từ những năm 1500, khi một thợ in vô danh lấy một khay
                        chữ và xáo trộn để tạo ra một cuốn sách mẫu kiểu chữ. Nó đã tồn tại không chỉ qua năm thế kỷ mà còn
                        qua sự chuyển đổi sang sắp chữ điện tử, vẫn giữ nguyên bản chất. Nó không trở nên phổ biến vào những
                        năm 1960 khi các tấm Letraset chứa các đoạn văn Lorem Ipsum được phát hành, và gần đây hơn là với
                        phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker bao gồm các phiên bản của Lorem Ipsum để
                        tạo một cuốn sách mẫu kiểu chữ.</p>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">4. Những gì cần bao gồm trong điều khoản và điều kiện cho các cửa hàng trực
                        tuyến</h5>
                    <p class="policy-details">Lorem Ipsum chỉ đơn giản là văn bản giả của ngành in ấn và sắp chữ. Lorem
                        Ipsum đã trở thành tiêu chuẩn của ngành kể từ những năm 1500, khi một thợ in vô danh lấy một khay
                        chữ và xáo trộn để tạo ra một cuốn sách mẫu kiểu chữ. Nó đã tồn tại không chỉ qua năm thế kỷ mà còn
                        qua sự chuyển đổi sang sắp chữ điện tử, vẫn giữ nguyên bản chất.
                        <span class="policy-inner-text">
                            Nó đã không trở nên phổ biến cho đến những năm 1960, khi các tấm Letraset chứa các đoạn Lorem
                            Ipsum được phát hành. Gần đây hơn, các chương trình xuất bản trên máy tính để bàn như Aldus
                            PageMaker đã bao gồm các phiên bản của Lorem Ipsum để tạo ra sách mẫu kiểu chữ.
                        </span>
                    </p>
                </div>
                <div class="policy">
                    <h5 class="intro-heading">5. Điều khoản giá cả và thanh toán</h5>
                    <p class="policy-details">Lorem Ipsum là văn bản giả của ngành công nghiệp in ấn và sắp chữ. Kể từ những
                        năm 1500, khi một thợ in vô danh xáo trộn một khay chữ để tạo ra một cuốn sách mẫu kiểu chữ, Lorem
                        Ipsum đã trở thành tiêu chuẩn giả định của ngành. Nó đã tồn tại gần như không thay đổi trong năm thế
                        kỷ và thậm chí còn vượt qua sự chuyển đổi sang sắp chữ điện tử.
                        <span class="policy-inner-text">
                            Nó đã không trở nên phổ biến cho đến những năm 1960, khi các tấm Letraset chứa các đoạn Lorem
                            Ipsum được phát hành. Gần đây hơn, các chương trình xuất bản trên máy tính để bàn như Aldus
                            PageMaker đã bao gồm các phiên bản của Lorem Ipsum để tạo ra sách mẫu kiểu chữ.
                        </span>
                    </p>
                </div>
            </div>
        </div>

    </section>
@endsection

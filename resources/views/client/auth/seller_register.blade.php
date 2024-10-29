@extends('client.layouts.master')

@section('title')
    Trở thành người bán hàng
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    @include('client.components.breadcrumbs')

    <section class="seller-application product footer-padding">
        <div class="container">
            <div class="seller-application-section">
                <form action="{{ route('register.seller') }}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="col-lg-7">
                            <div class="row gy-5">

                                <div class="col-lg-12">
                                    <div class="seller-information" data-aos="fade-right">
                                        <h5 class="comment-title">Thông tin</h5>
                                        <p class="paragraph">Vui lòng điền đầy đủ thông tin ở bên dưới
                                        </p>
                                        <div class="review-form">
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="name" class="form-label">Tên Shop*</label>
                                                    <input type="text" id="name" name="store_name"
                                                        class="form-control" placeholder="Name">
                                                    @if ($errors->has('store_name'))
                                                        <span class="text-danger">{{ $errors->first('store_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="review-form-name">
                                                    <label for="email" class="form-label">Email*</label>
                                                    <input type="text" id="address" name="store_email"
                                                        class="form-control" placeholder="Address">
                                                    @if ($errors->has('store_email'))
                                                        <span class="text-danger">{{ $errors->first('store_email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="review-form-name">
                                                    <label for="email" class="form-label">Mô tả *</label>
                                                    <input type="text" id="address" name="store_description"
                                                        class="form-control" placeholder="Address">
                                                    @if ($errors->has('store_description'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('store_description') }}</span>
                                                    @endif
                                                </div>
                                                <div class="review-form-name checkbox">
                                                    <input type="checkbox">
                                                    <label for="address" class="form-label">
                                                        Tôi đồng ký với tất cả điều kiện chính sách của Shop </label>
                                                </div>
                                                <div class="form-btn">
                                                    <button type="submit" class="shop-btn">Đăng ký</button>

                                                    <span class="shop-account">Đã có tài khoản?<a href="login.html">Đăng
                                                            nhập
                                                        </a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="row gy-5">

                                <div class="col-lg-12">
                                    <div class="seller-information" data-aos="fade-right">
                                        <h5 class="comment-title">Địa chỉ</h5>
                                        <p class="paragraph">Vui lòng điền rõ ràng thông tin </p>
                                        <div class="review-form">
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="province" class="form-label">Tỉnh/Thành phố*</label>
                                                    <select id="province" name="province"
                                                        onchange="getDistricts(this.value)" class="form-select province">
                                                        <option></option>

                                                    </select>
                                                    @if ($errors->has('province'))
                                                        <span class="text-danger">{{ $errors->first('province') }}</span>
                                                    @endif
                                                </div>


                                            </div>
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="district" class="form-label">Quận/Huyện*</label>
                                                    <select id="district" name="district" onchange="getWards(this.value)"
                                                        class="form-select district">


                                                    </select>
                                                    @if ($errors->has('district'))
                                                        <span class="text-danger">{{ $errors->first('district') }}</span>
                                                    @endif
                                                </div>


                                            </div>
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="ward" class="form-label">Phường/Xã*</label>
                                                    <select id="ward" name="ward" class="form-select ward">


                                                    </select>
                                                    @if ($errors->has('ward'))
                                                        <span class="text-danger">{{ $errors->first('ward') }}</span>
                                                    @endif
                                                </div>


                                            </div>
                                            <div class="review-form-name">
                                                <label for="address_line" class="form-label">Địa chỉ cụ thể*</label>
                                                <input type="text" id="detail" name="address_line"
                                                    class="form-control" placeholder="Số nhà . . .">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
        </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.province').select2();
            $('.district').select2();
            $('.ward').select2();
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

        // Khi chọn tỉnh/thành phố, tải danh sách quận/huyện
        function getDistricts(provinceCode) {
            $('#district').html('<option value="">Chọn Quận/Huyện</option>'); // Reset danh sách quận/huyện
            $('#ward').html('<option value="">Chọn Xã/Phường</option>'); // Reset danh sách xã/phường

            if (provinceCode) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`,
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
        }

        // Khi chọn quận/huyện, tải danh sách xã/phường
        function getWards(districtCode) {
            $('#ward').html('<option value="">Chọn Xã/Phường</option>'); // Reset danh sách xã/phường

            if (districtCode) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/d/${districtCode}?depth=2`,
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
        }
    </script>
@endsection

@extends('client.profile.layout')
@section('main-content')
    <div>
        <form action="{{ route('shop.save') }}" method="POST" enctype="multipart/form-data">
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
                                                   value="{{ $store?->store_name }}"
                                                   class="form-control @error('store_name') is-invalid @enderror"
                                                   placeholder="Name">
                                            @error('store_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="review-form-name">
                                            <label for="email" class="form-label">Email*</label>
                                            <input type="text" id="address" name="store_email"
                                                   value="{{ $store?->store_email }}"
                                                   class="form-control" placeholder="Address">
                                            @error('store_email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="img-upload-section">
                                            <div class="logo-wrapper">
                                                <p>Logo shop</p>
                                                <div class="logo-upload">
                                                    <img src="{{ \Storage::url($store?->logo_shop) }}" alt="upload"
                                                         class="upload-img" id="upload-img">
                                                    <div class="upload-input">
                                                        <label for="input-file">
                                                                <span>
                                                                    <svg width="32" height="32"
                                                                         viewBox="0 0 32 32" fill="none"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M16.5147 11.5C17.7284 12.7137 18.9234 13.9087 20.1296 15.115C19.9798 15.2611 19.8187 15.4109 19.6651 15.5683C17.4699 17.7635 15.271 19.9587 13.0758 22.1539C12.9334 22.2962 12.7948 22.4386 12.6524 22.5735C12.6187 22.6034 12.5663 22.6296 12.5213 22.6296C11.3788 22.6334 10.2362 22.6297 9.09365 22.6334C9.01498 22.6334 9 22.6034 9 22.536C9 21.4009 9 20.2621 9.00375 19.1271C9.00375 19.0746 9.02997 19.0109 9.06368 18.9772C10.4123 17.6249 11.7609 16.2763 13.1095 14.9277C14.2295 13.8076 15.3459 12.6913 16.466 11.5712C16.4884 11.5487 16.4997 11.5187 16.5147 11.5Z"
                                                                            fill="white"></path>
                                                                        <path
                                                                            d="M20.9499 14.2904C19.7436 13.0842 18.5449 11.8854 17.3499 10.6904C17.5634 10.4694 17.7844 10.2446 18.0054 10.0199C18.2639 9.76139 18.5261 9.50291 18.7884 9.24443C19.118 8.91852 19.5713 8.91852 19.8972 9.24443C20.7251 10.0611 21.5492 10.8815 22.3771 11.6981C22.6993 12.0165 22.7105 12.4698 22.3996 12.792C21.9238 13.2865 21.4443 13.7772 20.9686 14.2717C20.9648 14.2792 20.9536 14.2867 20.9499 14.2904Z"
                                                                            fill="white"></path>
                                                                    </svg>
                                                                </span>
                                                        </label>
                                                        <input type="file" name="logo_shop"
                                                               accept="image/jpeg, image/jpg, image/png, image/webp"
                                                               id="input-file">
                                                        @error('logo_shop')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="review-form-name">
                                            <label for="email" class="form-label">Mô tả *</label>
                                            <input type="text" id="address" name="store_description"
                                                   value="{{ $store?->store_description }}"
                                                   class="form-control" placeholder="Address">
                                            @error('store_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-btn">
                                            <button type="submit" class="shop-btn">{{ $store ? 'Cập Nhật' : 'Thêm Mới' }}</button>
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
                                <div class="review-form">
                                    <div class="review-inner-form ">
                                        <div class="review-form-name">
                                            <label for="province" class="form-label">Tỉnh/Thành phố*</label>
                                            <select id="province" name="address[province]"
                                                    class="form-select province">
                                                <option></option>

                                            </select>
                                            @error('address.province')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="review-inner-form ">
                                        <div class="review-form-name">
                                            <label for="district" class="form-label">Quận/Huyện*</label>
                                            <select id="district" name="address[district]"
                                                    class="form-select district">


                                            </select>
                                            @error('address.district')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="review-inner-form ">
                                        <div class="review-form-name">
                                            <label for="ward" class="form-label">Phường/Xã*</label>
                                            <select id="ward" name="address[ward]" class="form-select ward">


                                            </select>
                                            @error('address.ward')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="review-form-name">
                                        <label for="address_line" class="form-label">Địa chỉ cụ thể*</label>
                                        <input type="text" id="detail" name="address[address_line]"
                                               value="{{ $address?->address_line }}"
                                               class="form-control" placeholder="Số nhà . . .">
                                        @error('address.address_line')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            const provinceId = {{ $address->province_id ?? 'null' }};
            const districtId = {{ $address->district_id ?? 'null' }};
            const wardId = {{ $address->ward_id ?? 'null' }};

            // Load provinces
            $.ajax({
                url: '/api/p/',
                method: 'GET',
                success: function (response) {
                    const provinces = response.data;
                    $('#province').append(
                        provinces.map(function (province) {
                            let selected = province.id === provinceId ? 'selected' : '';
                            return `<option value="${province.id}" ${selected}>${province.name}</option>`;
                        }).join('')
                    );

                    // Nếu có provinceId, tải quận/huyện
                    if (provinceId) {
                        loadDistricts(provinceId, districtId, wardId);
                    }
                },
                error: function () {
                    alert('Không thể tải danh sách Tỉnh/Thành phố.');
                }
            });

            // Khi chọn tỉnh/thành phố
            $('#province').on('change', function () {
                let selectedValue = $(this).val();
                $('#district').html('<option value="">Chọn Quận/Huyện</option>');
                $('#ward').html('<option value="">Chọn Xã/Phường</option>');

                if (selectedValue) {
                    loadDistricts(selectedValue);
                }
            });

            // Khi chọn quận/huyện
            $('#district').on('change', function () {
                let selectedValue = $(this).val();
                $('#ward').html('<option value="">Chọn Xã/Phường</option>');

                if (selectedValue) {
                    loadWards(selectedValue);
                }
            });

            // Hàm tải danh sách quận/huyện
            function loadDistricts(provinceId, selectedDistrictId = null, selectedWardId = null) {
                $.ajax({
                    url: `/api/p/${provinceId}`,
                    method: 'GET',
                    success: function (response) {
                        const districts = response.data;
                        $('#district').append(
                            districts.map(function (district) {
                                let selected = district.id === selectedDistrictId ? 'selected' : '';
                                return `<option value="${district.id}" ${selected}>${district.name}</option>`;
                            }).join('')
                        );

                        // Nếu có districtId, tải phường/xã
                        if (selectedDistrictId) {
                            loadWards(selectedDistrictId, selectedWardId);
                        }
                    },
                    error: function () {
                        alert('Không thể tải danh sách Quận/Huyện.');
                    }
                });
            }

            // Hàm tải danh sách phường/xã
            function loadWards(districtId, selectedWardId = null) {
                $.ajax({
                    url: `/api/d/${districtId}`,
                    method: 'GET',
                    success: function (response) {
                        const wards = response.data;
                        $('#ward').append(
                            wards.map(function (ward) {
                                let selected = ward.id === selectedWardId ? 'selected' : '';
                                return `<option value="${ward.id}" ${selected}>${ward.name}</option>`;
                            }).join('')
                        );
                    },
                    error: function () {
                        alert('Không thể tải danh sách Xã/Phường.');
                    }
                });
            }
        });
    </script>
@endsection

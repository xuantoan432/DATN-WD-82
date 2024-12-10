@extends('client.profile.layout')
@section('main-content')
    <div class="profile-section address-section addresses ">
        <div class="row gy-md-0 g-5">
            @foreach ($addresses as $key => $address)
                <div class="col-md-6 mt-5">
                    <div class="seller-info all-address">
                        <h5 class="heading">Địa chỉ {{ $key + 1 }}</h5>
                        <table class="info-list">
                            <tr>
                                <td style="min-width: 120px; height: 36px">
                                    Họ và tên:
                                </td>
                                <td>
                                    <strong>{{ $address->details->full_name }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số điện thoại:
                                </td>
                                <td>
                                    <strong>{{ $address->details->phone_number }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Địa chỉ:
                                </td>
                                <td>
                                    <strong class="address-line"></strong>
                                </td>
                            </tr>
                        </table>
                        <form action="{{ route('user.address.delete', $address->id) }}"
                              method="POST"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit ">
                                <div class="text-end">
                                    <i class="fa-solid fa-trash"
                                       style="color: #ae1c9a; font-size:20px"></i>
                                </div>
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-lg-12">
                    <a href="#" class="shop-btn" onclick="modalAction('.submit')">Thêm địa
                        chỉ mới</a>
                    <div class="modal-wrapper submit">
                        <div onclick="modalAction('.submit')" class="anywhere-away"></div>
                        <form action="{{ route('user.address.create') }}" method="POST">
                            @csrf
                            <div class="login-section account-section modal-main">
                                <div class="review-form">
                                    <div class="review-content">
                                        <h5 class="comment-title">Thêm địa chỉ mới</h5>
                                        <div class="close-btn">
                                            <img src="theme/client/assets/images/homepage-one/close-btn.png"
                                                 onclick="modalAction('.submit')" alt="close-btn">
                                        </div>
                                    </div>
                                    <div class=" account-inner-form">
                                        <div class="review-form-name">
                                            <label for="full_name" class="form-label">Họ và tên*</label>
                                            <input type="text" id="full_name" name="full_name" class="form-control"
                                                   placeholder="Nhập họ và tên">
                                            @error('full_name')
                                            <span
                                                class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="review-form-name">
                                            <label for="phone_number" class="form-label">Phone*</label>
                                            <input type="tel" id="phone_number" name="phone_number" class="form-control"
                                                   placeholder="+880388**0899">
                                            @error('phone_number')
                                            <span
                                                class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class=" account-inner-form city-inner-form">
                                        <div class="review-form-name">
                                            <label for="usercity" class="form-label ">Tỉnh/Thành
                                                phố</label>
                                            <select id="province" name="province"
                                                    class="form-select province form-control">
                                                <option></option>
                                                @error('province')
                                                <span
                                                    class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="review-form-name">
                                            <label for="usercity"
                                                   class="form-label">Quận/Huyện</label>
                                            <select id="district" name="district"
                                                    class="form-select district form-control">
                                            </select>
                                            @error('district')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" account-inner-form city-inner-form">
                                        <div class="review-form-name">
                                            <label for="usercity"
                                                   class="form-label">Phường/Xã</label>
                                            <select id="ward" name="ward"
                                                    class="form-select ward form-control">


                                            </select>
                                            @error('ward')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="review-form-name address-form">
                                        <label for="useraddress" class="form-label">Địa
                                            chỉ</label>
                                        <input type="text" id="useraddress"
                                               name="address_line" class="form-control"
                                               placeholder="Khu/Số nhà ...">
                                        @error('address_line')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="login-btn text-center">
                                        <button type="submit" class="shop-btn">Thêm địa
                                            chỉ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const address = @json($addresses);
    </script>
    @vite('resources/js/client/address.js')
@endsection

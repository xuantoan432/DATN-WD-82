@extends('client.profile.layout')
@section('main-content')
    <div class="seller-application-section">
        <form action="{{ route('user.update', Auth::id()) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row ">
                <div class="col-lg-7">
                    <div class=" account-section">
                        <div class="review-form">
                            <div class=" account-inner-form">
                                <div class="review-form-name">
                                    <label for="firname" class="form-label">Tên tài khoản</label>
                                    <input type="text" name="name" id="firname"
                                           value="{{ $user->name }}" class="form-control"
                                           placeholder="First Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class=" account-inner-form">
                                <div class="review-form-name">
                                    <label for="gmail" class="form-label">Email</label>
                                    <input type="email" name="email" id="gmail"
                                           value="{{ $user->email }}" class="form-control"
                                           placeholder="user@gmail.com">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="review-form-name">
                                    <label for="telephone" class="form-label">Số điện
                                        thoại</label>
                                    <input type="tel" id="telephone" name="phone"
                                           value="{{ $user->phone }}" class="form-control"
                                           placeholder="+966432004">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="review-form-name address-form">
                                <label for="date" class="form-label">Ngày tháng năm
                                    sinh</label>
                                <input type="date" name="dob" id="date"
                                       value="{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : null }}"
                                       class="form-control">
                                @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" account-inner-form city-inner-form">
                                <div class="review-form-name">
                                    <label for="teritory" class="form-label">Giới tính</label>
                                    <select name="gender" id="teritory" class="form-select">
                                        <option value=""
                                            {{ $user->gender == null ? 'selected' : '' }}>Giới tính
                                        </option>
                                        <option value="Nam"
                                            {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam
                                        </option>
                                        <option value="Nữ"
                                            {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ
                                        </option>
                                        <option value="Khác"
                                            {{ $user->gender == 'Khác' ? 'selected' : '' }}>Khác
                                        </option>
                                    </select>
                                    @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="submit-btn">
                                <button type="submit" class="shop-btn update-btn">Cập nhật tài
                                    khoản</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="img-upload-section">
                        <div class="logo-wrapper">
                            <h5 class="comment-title">Cập nhật ảnh đại diện</h5>
                            <div class="logo-upload">
                                <img src="{{ \Storage::url($user->avatar) }}" alt="upload"
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
                                    <input type="file" name="avatar"
                                           accept="image/jpeg, image/jpg, image/png, image/webp"
                                           id="input-file">
                                    @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

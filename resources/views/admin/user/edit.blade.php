@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card rounded-4">
            <div class="card-body p-4">
                <div class="position-relative mb-5">
                    <img src="assets/images/gallery/profile-cover.html" class="img-fluid rounded-4 shadow" alt="">
                    <div class="profile-avatar position-absolute top-100 start-50 translate-middle">
                        <!-- Avatar -->
                        <img src="{{ asset('storage/' . $user->avatar) }}"
                            class="img-fluid rounded-circle p-1 bg-grd-danger shadow" style="width: 170px;height: 170px;">
                    </div>
                </div>
                <div class="profile-info pt-5 d-flex align-items-center justify-content-between">
                    <div class="">
                        <h3>{{ $user->name }}</h3>
                        <p class="mb-0">{{ $user->phone }}<br>{{ $user->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0 fw-bold">Edit Profile</h5>
                            </div>
                        </div>

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="col-md-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>


                            <div class="col-md-12">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>

                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="row account-inner-form city-inner-form">
                                <div class="col-6 review-form-name">
                                    <label for="usercity" class="form-label ">Tỉnh/Thành
                                        phố</label>
                                    <select id="province" name="address[province]"
                                            class="form-select province form-control">
                                        <option></option>
                                        @error('address[province]')
                                        <span
                                            class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                                <div class="col-6 review-form-name">
                                    <label for="usercity"
                                           class="form-label">Quận/Huyện</label>
                                    <select id="district" name="address[district]"
                                            class="form-select district form-control">
                                    </select>
                                    @error('address[district]')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class=" account-inner-form city-inner-form">
                                    <div class="review-form-name">
                                        <label for="usercity"
                                               class="form-label">Phường/Xã</label>
                                        <select id="ward" name="address[ward]"
                                                class="form-select ward form-control">


                                        </select>
                                        @error('address[ward]')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="review-form-name address-form">
                                    <label for="useraddress" class="form-label">Địa
                                        chỉ</label>
                                    <input type="text" id="useraddress"
                                           name="address[address_line]" class="form-control"
                                           value="{{ $address->address_line }}"
                                           placeholder="Khu/Số nhà ...">
                                    @error('address[address_line]')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-control" id="role_id" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">

                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror</div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                       name="password_confirmation">
                                @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-grd-primary px-4">Update Profile</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
@endsection

@section('js_new')
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

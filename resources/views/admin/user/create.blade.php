@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start justify-content-between mb-3">
                                    <div class="">
                                        <h5 class="mb-0 fw-bold">Tạo mới hồ sơ</h5>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                                    @error('avatar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                               value="{{ old('address[address_line]') }}"
                                               placeholder="Khu/Số nhà ...">
                                        @error('address[address_line]')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>

                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror</div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                           name="password_confirmation" required>
                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <h6 class="card-header">Xuất bản</h6>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-grd-primary px-4">Thêm mới</button>
                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h6 class="card-header">Role</h6>
                            <div class="card-body">
                                <select class="form-select form-control" id="roles" name="roles[]"
                                        multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @selected(in_array($role->id, old('roles', [])))> {{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js_new')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/p/',
                method: 'GET',
                success: function(response) {
                    const provinces = response.data
                    $('#province').append(provinces.map(function(province) {
                        return `<option value="${province.id}">${province.name}</option>`;
                    }).join(''));
                },
                error: function() {
                    alert('Không thể tải danh sách Tỉnh/Thành phố.');
                }
            });
        });

        $('#province').on( 'change' , function () {

            let selectedValue = $(this).val();

            $('#district').html('<option value="">Chọn Quận/Huyện</option>'); // Reset danh sách quận/huyện
            $('#ward').html('<option value="">Chọn Xã/Phường</option>'); // Reset danh sách xã/phường

            if (selectedValue) {
                $.ajax({
                    url: `/api/p/${selectedValue}`,
                    method: 'GET',
                    success: function(response) {
                        const districts = response.data
                        $('#district').append(districts.map(function(district) {
                            return `<option value="${district.id}">${district.name}</option>`;
                        }));
                    },
                    error: function() {
                        alert('Không thể tải danh sách Quận/Huyện.');
                    }
                });
            }
        })

        $('#district').on( 'change' , function () {

            let selectedValue = $(this).val();
            $('#ward').html('<option value="">Chọn Xã/Phường</option>'); // Reset danh sách xã/phường

            if (selectedValue) {
                $.ajax({
                    url: `/api/d/${selectedValue}`,
                    method: 'GET',
                    success: function(response) {
                        const wards = response.data
                        $('#ward').append(wards.map(function(ward) {
                            return `<option value="${ward.id}">${ward.name}</option>`;
                        }));
                    },
                    error: function() {
                        alert('Không thể tải danh sách Xã/Phường.');
                    }
                });
            }

        })
    </script>
@endsection

@extends('client.profile.layout')
@section('main-content')
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="form-section">
                <form action="{{ route('user.changePassword') }}" method="POST">
                    @csrf
                    <div class="currentpass form-item position-relative">
                        <label for="currentpass" class="form-label">Mật khẩu hiện tại</label>
                        <div class="input-group">
                            <input type="password" name="current_password" class="form-control"
                                   id="currentpass" placeholder="******">
                            <button type="button" class="input-group-text "
                                    onclick="togglePassword('currentpass')">👁️</button>
                        </div>
                        @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="password form-item">
                        <label for="pass" class="form-label">Mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="new_password" class="form-control"
                                   id="pass" placeholder="******" >
                            <button type="button" class="input-group-text"
                                    onclick="togglePassword('pass')">👁️</button>
                        </div>
                        @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="re-password form-item">
                        <label for="repass" class="form-label">Xác nhận mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="new_password_confirmation"
                                   class="form-control" id="repass" placeholder="******">
                            <button type="button" class="input-group-text"
                                    onclick="togglePassword('repass')">👁️</button>
                        </div>
                        @error('new_password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-btn">
                        <button type="submit" class="shop-btn">Cập nhật mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="reset-img text-end">
                <img src="theme/client/assets/images/homepage-one/reset.webp" alt="reset">
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function togglePassword(inputId) {
            var input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
@endsection

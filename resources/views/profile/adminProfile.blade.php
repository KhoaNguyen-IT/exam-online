@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarAdmin')

@section('content')
    <div class="profile-page-container">
        <div class="profile-card">
            <form class="profile-form" action="{{ route('admin.updateProfile', ['id' => $viewData['user']->maTK]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="avatar-section">
                    @if ($viewData['user']->anhDaiDien)
                        <img src="{{ asset('storage/' . $viewData['user']->anhDaiDien) }}"
                            alt="{{ $viewData['user']->hoTen }}" class="profile_avatar" id="preview-avatar">
                    @else
                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Ảnh đại diện" class="profile_avatar"
                            id="preview-avatar">
                    @endif
                    <button type="button" class="change-avatar-button">Đổi ảnh đại diện</button>
                    <input type="file" name="anhDaiDien" id="avatar-input" accept="image/*" style="display: none;">
                </div>

                <div class="form-group-row">
                    <label for="full-name" class="form-label">Họ tên:</label>
                    <input type="text" id="full-name" name="hoTen" value="{{ $viewData['user']->hoTen }}"
                        class="form-input" spellcheck="false">
                </div>

                <div class="form-group-row">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" value="{{ $viewData['user']->email }}" readonly disabled
                        class="form-input disabled-input">
                </div>

                <div class="form-group-row">
                    <label for="current-password" class="form-label">Mật khẩu hiện tại:</label>
                    <input type="password" id="current-password" name="matKhauCu" placeholder="Nhập mật khẩu hiện tại"
                        class="form-input">
                    <span class="toggle-password">
                        <i class="fa fa-eye" aria-hidden="true" id="toggleCurrentPassword"></i>
                    </span>
                </div>

                <div class="form-group-row">
                    <label for="new-password" class="form-label">Mật khẩu mới:</label>
                    <input type="password" id="new-password" name="matKhauMoi" placeholder="Nhập mật khẩu mới"
                        class="form-input">
                    <span class="toggle-password">
                        <i class="fa fa-eye" aria-hidden="true" id="toggleNewPassword"></i>
                    </span>
                </div>

                <div class="form-group-row">
                    <label for="confirm-new-password" class="form-label">Xác nhận mật khẩu mới:</label>
                    <input type="password" id="confirm-new-password" name="matKhauMoi_confirmation"
                        placeholder="Nhập lại mật khẩu mới" class="form-input">
                    <span class="toggle-password">
                        <i class="fa fa-eye" aria-hidden="true" id="toggleConfirmNewPassword"></i>
                    </span>
                </div>

                <button type="submit" class="update-profile-button">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection

@section('CssProfile')
    <link rel="stylesheet" href="{{ asset('user/css/profile.css') }}">
@endsection

@section('JsProfile')
    <script src="{{ asset('user/js/accountInfo.js') }}"></script>

    <script>
        // Thông báo cập nhật thông tin tài khoản thất bại do lỗi validate
        @if ($errors->any())
            let errors = @json($errors->all());
            Swal.fire({
                icon: 'error',
                title: 'Cập nhật không thành công!',
                html: errors.join('<br>'),
            });
        @endif

        // Thông báo cập nhật thông tin tài khoản thất bại do lỗi mật khẩu củ không chính xác
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Cập nhật không thành công!',
                text: @json(session('error')),
            });
        @endif

        // Thông báo cập nhật thông tin tài khoản thành công
        @if (session('updateInfoSuccess'))
            Swal.fire({
                icon: 'success',
                title: 'Cập nhật thành công!',
                text: @json(session('updateInfoSuccess')),
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection

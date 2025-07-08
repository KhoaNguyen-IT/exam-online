@extends('user.layout.app')

@section('title', $viewData['title'])

@section('js')
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
                title: 'Cập nhật thành công',
                text: @json(session('updateInfoSuccess')),
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection

@section('header')
    <!-- Botbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col text-left">
                <div class="d-inline-flex flex-wrap">
                    <a href="{{ route('user.home.index') }}" class="text-white mx-2">Trang chủ</a>
                    <span class="text-white mx-2">/</span>
                    <a href="{{ route('user.accountInfo.index') }}" class="text-white mx-2">Thông tin tài khoản</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Botbar End -->
@endsection

@section('content')
    <div class="profile-page-container">
        <div class="profile-card">
            @if ($viewData['user'])
                <form class="profile-form"
                    action="{{ route('user.accountInfo.update', ['id' => $viewData['user']->maTK]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="avatar-section">
                        @if ($viewData['user']->anhDaiDien)
                            <img src="{{ asset('storage/' . $viewData['user']->anhDaiDien) }}"
                                alt="{{ $viewData['user']->hoTen }}" class="profile_avatar" id="preview-avatar">
                        @else
                            <img src="{{ asset('user/images/img_user.jpg') }}" alt="{{ $viewData['user']->hoTen }}"
                                class="profile_avatar" id="preview-avatar">
                        @endif

                        <button type="button" class="change-avatar-button">Đổi ảnh đại diện</button>
                        <input type="file" name="anhDaiDien" id="avatar-input" accept="image/*" style="display: none;">
                    </div>

                    <div class="form-group-row">
                        <label for="full-name" class="form-label">Họ tên:</label>
                        <input type="text" id="full-name" name="hoTen" value="{{ $viewData['user']->hoTen }}"
                            class="form-input">
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
            @else
                <div class="text-center text-danger font-weight-bold display-4">
                    Lỗi hệ thống, vui lòng thử lại sau!
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Xử lý tìm kiếm bằng tên môn học và chuyển đến vị trí danh sách kỳ thi
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#applyFilter') {
                const section = document.getElementById('applyFilter');
                if (section) {
                    section.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });

        @if (session('notFoundTenMH'))
            // Nếu URL đang có #applyFilter thì xóa đi sau khi load
            if (window.location.hash === '#applyFilter') {
                history.replaceState(null, '', window.location.pathname + window.location.search);
            }

            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: @json(session('notFoundTenMH')),
            });
        @endif
    </script>
@endsection

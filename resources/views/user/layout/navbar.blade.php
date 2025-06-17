<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{ route('user.home') }}" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Exam Online</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ route('user.home') }}"
                    class="nav-item nav-link {{ Route::currentRouteNamed('user.home') ? 'active' : '' }}">Trang chủ</a>
                <a href="{{ route('user.examList') }}"
                    class="nav-item nav-link {{ Route::currentRouteNamed('user.examList') ? 'active' : '' }}">Bài thi
                    kiểm tra</a>
                <a href="{{ route('user.testHistory') }}"
                    class="nav-item nav-link {{ Route::currentRouteNamed('user.testHistory') ? 'active' : '' }}">Lịch sử
                    làm bài</a>
            </div>
            <ul class="user-profile-dropdown">
                <span class="username-text">{{ request()->cookie('userName') }}</span>
                <img src="{{ asset('storage/' . request()->cookie('userAvatar')) }}"
                    alt="{{ request()->cookie('userName') }}" class="profile-avatar">

                <ul class="dropdown-menu">
                    <li><a href="{{ route('user.accountInfo.index') }}"><i class="fas fa-info-circle"></i> Thông tin
                            tài khoản</a></li>
                    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> <i
                                class="fas fa-right-from-bracket"></i> Đăng xuất</a></li>
                </ul>
            </ul>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <span>Quản lý hệ thống thi trắc nghiệm trực tuyến</span>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <h2 style="font-size: .7em; font-weight: 600; margin-right: 5px;">
                                {{ request()->cookie('userName') }}
                            </h2>
                            @if (request()->cookie('userAvatar'))
                                <img src="{{ asset('storage/' . request()->cookie('userAvatar')) }}"
                                    alt="{{ request()->cookie('userName') }}" width="35" height="35" class="rounded-circle">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="{{ Auth::user()->vaiTro == 'quanTri' ? route('admin.getProfileAdmin') : route('teacher.getProfileTeacher') }}"
                                    class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">Thông tin tài khoản</p>
                                </a>
                                </a>
                                <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block"
                                    id="logout-link">Đăng xuất</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->
</div>

<script>
    // Thông báo xác nhận đăng xuất
    document.addEventListener('DOMContentLoaded', function () {
        const logoutLink = document.getElementById('logout-link');

        logoutLink.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Bạn có chắc chắn muốn đăng xuất?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đăng xuất',
                cancelButtonText: 'Huỷ'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutLink.href;
                }
            });
        });
    });
</script>
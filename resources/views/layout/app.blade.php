<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý hệ thống thi trắc nghiệm trực tuyến</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @yield('CssProfile')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        @yield('sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        @include('layout.header')
        @yield('content')
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/loadChuong.js') }}"></script>
    <script src="{{ asset('assets/js/fillterMonHoc.js') }}"></script>
    <script src="{{ asset('assets/js/fillterTenSV.js') }}"></script>
    <script src="{{ asset('assets/js/fillterNgayThi.js') }}"></script>
    <script src="{{ asset('assets/js/fillterDeThi.js') }}"></script>
    <script src="{{ asset('assets/js/fillterCauHoi.js') }}"></script>
    <script src="{{ asset('assets/js/maTranDeThi.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('JsProfile')

    <script>
        // Thông báo đăng nhập thành công
        @if (session('successLogin'))
            Swal.fire({
                icon: 'success',
                title: 'Đăng nhập thành công',
                text: @json(session('successLogin')),
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        // Thông báo đăng nhập thành công, đồng thời yêu cầu đổi mật khẩu cho lần đăng nhập đầu tiên
        @if (session('successfulLogin'))
            Swal.fire({
                icon: 'success',
                title: 'Đăng nhập thành công',
                html: @json(str_replace('\n', '<br>', session('successfulLogin'))),
                showCancelButton: true,
                showCloseButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#495057',
                confirmButtonText: 'OK',
                cancelButtonText: 'Để lần sau',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ Auth::user()->vaiTro == 'quanTri' ? route('admin.getProfileAdmin') : route('teacher.getProfileTeacher') }}";
                }
            });
        @endif
    </script>
</body>

</html>
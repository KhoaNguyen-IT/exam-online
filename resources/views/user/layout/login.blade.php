<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang đăng nhập</title>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('user/images/login/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/login/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('user/fonts/login/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/login/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/login/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/login/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/login/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/login/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('user/images/login/img-01.png') }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="{{ route('postLogin') }}" method="post">
                    @csrf
                    <span class="login100-form-title">
                        Đăng Nhập Hệ Thống
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="matKhau" placeholder="Mật khẩu">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('user/vendor/login/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('user/vendor/login/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('user/vendor/login/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('user/vendor/login/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('user/vendor/login/tilt/tilt.jquery.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script>
        @if (session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Đăng nhập không thành công!',
                text: @json(session('errors')),
            });
        @endif
    </script>

    <!--===============================================================================================-->
    <script src="{{ asset('user/js/login/main.js') }}"></script>
</body>

</html>

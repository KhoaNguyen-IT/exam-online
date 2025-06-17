<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link href="{{ asset('user/images/favicon/favicon-16x16.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/layout/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/layout/style.css') }}" rel="stylesheet">

    {{-- css content --}}
    <link rel="stylesheet" href="{{ asset('user/css/student.css') }}">
</head>

<body>
    @include('user.layout.navbar')
    @yield('header')
    @yield('content')
    @include('user.layout.footer')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/layout/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/layout/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('user/lib/layout/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('user/lib/layout/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/layout/main.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Đăng nhập thành công!',
                text: @json(session('success')),
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('successful'))
            Swal.fire({
                icon: 'successful',
                title: 'Đăng nhập thành công!',
                html: @json(str_replace('\n', '<br>', session('successful'))),
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Để lần sau',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.accountInfo.index') }}";
                }
            });
        @endif
    </script>

    @yield('js')
</body>

</html>

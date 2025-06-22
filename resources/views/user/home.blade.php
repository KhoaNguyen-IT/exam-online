@extends('user.layout.app')

@section('title', $viewData['title'])

@section('header')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Ứng dụng</h1>
            <h1 class="text-white display-1 mb-5">Thi trắc nghiệm trực tuyến</h1>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Các môn học</button>
                        <div class="dropdown-menu">
                            @foreach ($viewData['danhSachMonHoc'] as $mh)
                                <a class="dropdown-item"
                                    href="{{ route('user.examList.filterMaMH', ['id' => $mh->maMH]) }}#applyFilter">{{ $mh->tenMH }}</a>
                            @endforeach
                        </div>
                    </div>
                    <form action="{{ route('user.examList.filterTenMH') }}#applyFilter" method="get">
                        <div class="input-group">
                            <input type="text" name="kyThiTheoTenMonHoc" class="form-control border-light"
                                style="padding: 30px 25px;" placeholder="Từ khóa" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary px-4 px-lg-5">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
@endsection

@section('content')
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-10">
                    <div class="section-title text-center position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Giới Thiệu</h6>
                        <h1 class="display-4">Chào mừng bạn đến với ứng dụng thi trắc nghiệm trực tuyến</h1>
                    </div>
                    <p class="text-center">Hệ thống được xây dựng nhằm tối ưu quá trình kiểm tra,<br> đánh giá kiến thức của
                        sinh viên thông qua hình thức trắc nghiệm khách quan.<br> Với giao diện thân thiện và thao tác đơn
                        giản, sinh viên có thể nhanh chóng truy cập<br> các bài thi, theo dõi điểm số sau khi công bố và tra
                        cứu toàn bộ lịch sử bài làm một cách thuận tiện.</p>
                    <div class="row pt-3 mx-0">
                        <a href="{{ route('user.examList.index') }}#applyFilter" class="btn nutLamBai">Bắt đầu làm bài</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    @if (isset($viewData['danhSachMonHoc']) && count($viewData['danhSachMonHoc']) > 3)
        <!-- Team Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Các Môn Học</h6>
                </div>
                <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                    @foreach ($viewData['danhSachMonHoc'] as $mh)
                        <div class="team-item">
                            <a href="{{ route('user.examList.filterMaMH', ['id' => $mh->maMH]) }}#applyFilter"
                                title="Xem danh sách bài thi môn {{ $mh->tenMH }}"><img class="img-fluid w-100"
                                    src="{{ asset('user/images/book.jpg') }}" alt=""></a>
                            <div class="bg-light text-center p-4">
                                <h5 class="mb-3"><a
                                        href="{{ route('user.examList.filterMaMH', ['id' => $mh->maMH]) }}#applyFilter"
                                        class="text-decoration-none text-dark"
                                        title="Xem danh sách bài thi môn {{ $mh->tenMH }}">{{ $mh->tenMH }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Team End -->
    @endif

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

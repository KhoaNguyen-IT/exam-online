@extends('user.layout.app')

@section('title', $viewData['title'])

@section('header')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="display-3 mt-4 mb-4" 
                style="
                    color: #fff500; 
                    text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px  1px 0 black, 1px  1px 0 black;">
                    Hệ thống
            </h1>
            <h1 class="display-1 mb-5" 
                style="
                    color: #fff500; 
                    text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px  1px 0 black, 1px  1px 0 black">
                Trắc nghiệm trực tuyến
            </h1>
        </div>
    </div>
    <!-- Header End -->
@endsection

@section('content')
    @if (isset($viewData['danhSachMonHoc']) && count($viewData['danhSachMonHoc']) > 3)
        <!-- Team Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2 h5">Các Môn Học</h6>
                </div>
                <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                    @foreach ($viewData['danhSachMonHoc'] as $mh)
                        <div class="team-item">
                            <a href="{{ route('user.examList.filterMaMH', ['id' => $mh->maMH]) }}#applyFilter"
                                title="Xem danh sách bài thi môn {{ $mh->tenMH }}"><img class="img-fluid w-100 h-270"
                                    style="border: solid 1px black;"
                                    src="{{ asset($viewData['danhSachLogoMonHoc'][$mh->maMH]) }}" alt=""></a>
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

    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;"></div>

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

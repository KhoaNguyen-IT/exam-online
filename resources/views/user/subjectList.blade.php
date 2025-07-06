@extends('user.layout.app')

@section('title', $viewData['title'])

@section('header')
    <!-- Botbar Start -->
    <div class="container-fluid bg-primary">
        <div class="row py-2 px-lg-5">
            <div class="col text-left">
                <div class="d-inline-flex flex-wrap">
                    <a href="{{ route('user.home.index') }}" class="text-white mx-2">Trang chủ</a>
                    <span class="text-white mx-2">/</span>
                    <a href="{{ route('user.subjectList') }}" class="text-white mx-2">Môn học</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Botbar End -->
@endsection

@section('content')
    @if (isset($viewData['danhSachMonHoc']))
        <!-- Team Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2 h5">Các Môn Học Được Phép
                        Thi</h6>
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
    @else
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2 h5">Các Môn Học Được Phép
                        Thi</h6>
                </div>
                <div class="text-center text-white"
                    style="border-radius: 15px; font-size: 1.5em; font-weight: 600; padding: 5.15rem;
            background-image: linear-gradient(90.57deg, #3e65fe, #d23cff);">
                    Không có môn học nào bạn được phép thi
                </div>
            </div>
        </div>
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

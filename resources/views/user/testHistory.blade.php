@extends('user.layout.app')

@section('title', 'Trang lịch sử làm bài')

@section('header')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-1">Lịch sử làm bài</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user.home.index') }}">Trang chủ</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Lịch sử làm bài</p>
            </div>
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
    <div class="completed-exams-page-container">
        <div class="section-title text-center position-relative mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Danh Sách Các Bài Thi Kiểm Tra
            </h6>
        </div>

        <div class="completed-exams-list">
            @foreach ($viewData['danhSachBaiLam'] as $dsbl)
                <div class="completed-exam-item status-no-score">
                    <h3 class="exam-name">{{ $dsbl->deThi->kyThis->first()->tenKT }}</h3>
                    <p>Môn học: {{ $dsbl->deThi->monHoc->tenMH }}</p>
                    <p>Ngày thi: {{ \Carbon\Carbon::parse($dsbl->deThi->kyThis->first()->ngayThi)->format('d/m/Y - H \g\i\ờ i \p\h\ú\t') }}</p>
                    <p>Số câu đúng:
                        @if ($dsbl->daKetThuc)
                            {{ $dsbl->soCauDung }}/{{ $dsbl->tongSoCau }}
                        @else
                            0/{{ $dsbl->tongSoCau }}
                        @endif
                    </p>
                    @if ($dsbl->daKetThuc)
                        <div class="exam-score has-score">Điểm: {{ $dsbl->diemSo }}</div>
                    @else
                        <div class="exam-score no-score">Chưa có điểm</div>
                    @endif
                    <a href="{{ route('user.testDetail.index', ['id' => $dsbl->maKQT]) }}" class="detail-exam-button">Xem chi
                        tiết</a>
                </div>
            @endforeach

            <div class="d-flex justify-content-center mt-4">
                {{ $viewData['danhSachBaiLam']->appends(request()->query())->links() }}
            </div>            
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

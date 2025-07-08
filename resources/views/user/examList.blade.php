@extends('user.layout.app')

@section('title', $viewData['title'])

@section('js')
    <script src="{{ asset('user/js/examList.js') }}"></script>
@endsection

@section('header')
    <!-- Botbar Start -->
    <div class="container-fluid bg-primary">
        <div class="row py-2 px-lg-5">
            <div class="col text-left">
                <div class="d-inline-flex flex-wrap">
                    <a href="{{ route('user.home.index') }}" class="text-white mx-2">Trang chủ</a>
                    <span class="text-white mx-2">/</span>
                    <a href="{{ route('user.examList.index') }}" class="text-white mx-2">Bài thi kiểm tra</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Botbar End -->
@endsection

@section('content')
    <div class="exam-list-page-container">
        <div class="section-title text-center position-relative mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2 h5" id="applyFilter">Danh Sách
                Các Bài Thi Kiểm Tra
            </h6>
        </div>

        <div class="d-flex">
            <div class="filter-section">
                <label for="subject-select" class="filter-label">Môn học:</label>
                <div class="custom-dropdown">
                    <button class="dropdown-toggle" type="button" id="subject-select-btn" aria-expanded="false">
                        {{ $viewData['monHocSelected'] ?? 'Tất cả' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="subject-select-btn">
                        <li><a class="dropdown-item" href="{{ route('user.examList.index') }}#applyFilter"
                                data-value="all">Tất
                                cả</a></li>
                        @foreach ($viewData['monHocs'] as $mh)
                            <li><a class="dropdown-item"
                                    href="{{ route('user.examList.filterMaMH', ['id' => $mh->maMH]) }}#applyFilter"
                                    data-value="math">{{ $mh->tenMH }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="filter-section">
                <label for="status-select" class="filter-label">Trạng thái:</label>
                <div class="custom-dropdown">
                    <button class="dropdown-toggle" type="button" id="status-select-btn" aria-expanded="false">
                        {{ $viewData['statusSelected'] ?? 'Tất cả' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="status-select-btn">
                        <li><a class="dropdown-item" href="{{ route('user.examList.index') }}#applyFilter"
                                data-value="all">Tất
                                cả</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.examList.filterStatus', ['status' => 'da-mo']) }}">Đã mở</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.examList.filterStatus', ['status' => 'chua-mo']) }}">Chưa mở</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.examList.filterStatus', ['status' => 'da-hoan-thanh']) }}">Đã hoàn
                                thành</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.examList.filterStatus', ['status' => 'da-dong']) }}">Đã đóng</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="exam-items-list">
            @if ($viewData['deThis']->isNotEmpty())
                @foreach ($viewData['deThis'] as $deThi)
                    <div class="exam-item status-not-open">
                        <h3 class="exam-name">{{ $deThi->tenDT }}</h3>
                        <p>Môn học: {{ $deThi->tenMH }}</p>
                        <p>Thời lượng: {{ $deThi->thoiLuongPhut }} phút</p>
                        <p>Ngày thi: {{ \Carbon\Carbon::parse($deThi->ngayThi)->format('d/m/Y - H \g\i\ờ i \p\h\ú\t') }}
                        </p>

                        @if (now()->lt($deThi->thoiGianBatDau))
                            <div class="exam-status not-open">Chưa mở</div>
                        @elseif (now()->between($deThi->thoiGianBatDau, $deThi->thoiGianKetThuc))
                            @if ($deThi->daLamBai)
                                <div class="exam-status completed">Đã hoàn thành</div>
                            @else
                                <div class="exam-status open">Đã mở</div>
                                <a href="{{ route('user.test.index', ['id' => $deThi->maDT]) }}"
                                    class="start-exam-button">Bắt
                                    đầu
                                    làm bài</a>
                            @endif
                        @else
                            @if ($deThi->daLamBai)
                                <div class="exam-status completed">Đã hoàn thành</div>
                            @else
                                <div class="exam-status closed">Đã đóng</div>
                            @endif
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center text-white"
                    style="border-radius: 15px; font-size: 1.5em; font-weight: 600; padding: 2.55rem;
                background-image: linear-gradient(90.57deg, #3e65fe, #d23cff);">
                    {{ $viewData['noticeNotFound'] ?? 'Không có bài thi trong thời gian này' }}
                </div>
            @endif

            <div class="d-flex justify-content-center mt-4">
                {{ $viewData['deThis']->appends(request()->query())->links() }}
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

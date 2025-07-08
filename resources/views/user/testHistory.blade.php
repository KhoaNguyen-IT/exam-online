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
                    <a href="{{ route('user.testHistory.getTestHistory') }}" class="text-white mx-2">Lịch sử làm bài</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Botbar End -->
@endsection

@section('content')
    <div class="completed-exams-page-container">
        <div class="section-title text-center position-relative mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2 h5">Danh Sách Các Bài thi Đã Hoàn
                Thành
            </h6>
        </div>

        <div class="completed-exams-list">
            @if ($viewData['baiLams']->isNotEmpty())
                @foreach ($viewData['baiLams'] as $baiLam)
                    <div class="completed-exam-item status-no-score">
                        <h3 class="exam-name">{{ $baiLam->deThi->tenDT }}</h3>
                        <p>Môn học: {{ $baiLam->deThi->monHoc->tenMH }}</p>
                        <p>Ngày thi:
                            {{ \Carbon\Carbon::parse($baiLam->deThi->kyThi->ngayThi)->format('d/m/Y - H \g\i\ờ i \p\h\ú\t') }}
                        </p>
                        @if ($baiLam->daKetThuc)
                            <p>Số câu đúng:
                                {{ $baiLam->ketQuaThi->soCauDung }}/{{ $baiLam->ketQuaThi->tongSoCau }}
                            </p>
                        @endif
                        @if ($baiLam->daKetThuc)
                            <div class="exam-score has-score">Điểm: {{ $baiLam->ketQuaThi->diemSo }}</div>
                        @else
                            <div class="exam-score no-score">Chưa có điểm</div>
                        @endif

                        @if (!empty($baiLam->maKQT))
                            <a href="{{ route('user.testDetail.index', ['id' => $baiLam->maKQT]) }}"
                                class="detail-exam-button">
                                Xem chi tiết
                            </a>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center text-white p-5"
                    style="border-radius: 15px; font-size: 1.5em; font-weight: 600; margin: 1.8rem; background-image: linear-gradient(90.57deg, #3e65fe, #d23cff);">
                    Không có bài thi nào được bạn hoàn thành
                </div>
            @endif

            <div class="d-flex justify-content-center mt-4">
                {{ $viewData['baiLams']->appends(request()->query())->links() }}
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

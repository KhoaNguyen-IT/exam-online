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
    <div class="container py-5">
        <div class="row justify-content-center p-4" style="border-radius: 15px;">
            <div class="col-lg-11 col-md-11">
                <h1 class="text-center mb-4" style="font-weight: 700; color: var(--dark);">
                    Giới thiệu hệ thống trắc nghiệm trực tuyến
                </h1>
                <p class="lead text-center mb-5" style="color: var(--dark);">
                    Kiểm tra, thi trắc nghiệm trực tuyến là một hình thức kiểm tra, đánh giá kiến thức được nhiều trường
                    học áp dụng, nhờ khả năng hỗ trợ tổ chức kỳ thi nhanh chóng, chính xác và dễ dàng quản lý kết quả.
                    Hệ thống này được xây dựng nhằm đáp ứng nhu cầu ứng dụng công nghệ trong giáo dục hiện nay.
                </p>

                <div class="text-center mb-5">
                    <h2 class="mb-4" style="font-weight: 700; color: var(--primary);">Các tính năng nổi bật</h2>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-laptop-code fa-3x mb-3" style="color: var(--success);"></i>
                                    <h5 style="color: var(--primary);">Tổ chức <br> thi trực tuyến linh hoạt</h5>
                                    <p class="text-muted small">Tạo và quản lý các kỳ thi trực tuyến <br> mọi lúc, mọi
                                        nơi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-hourglass-half fa-3x mb-3" style="color: var(--gray-dark);"></i>
                                    <h5 style="color: var(--primary);">Đồng hồ đếm ngược <br> & tự động thu bài</h5>
                                    <p class="text-muted small">Quản lý thời gian thi, tự động thu bài khi hết giờ, <br>
                                        đảm bảo công bằng.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-check-circle fa-3x mb-3" style="color: var(--danger);"></i>
                                    <h5 style="color: var(--primary);">Chấm điểm tự động <br> & kết quả tức thời</h5>
                                    <p class="text-muted small">Chấm bài tự động và trả kết quả sau khi hoàn thành <br>
                                        và kỳ thi kết thúc.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-history fa-3x mb-3" style="color: var(--warning);"></i>
                                    <h5 style="color: var(--primary);">Xem lại <br> lịch sử làm bài</h5>
                                    <p class="text-muted small">Dễ dàng xem lại chi tiết các bài thi đã làm, <br> theo
                                        dõi tiến độ và hiệu suất.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-5 p-lg-5 border">
                    <h3 class="mb-4 text-center" style="color: var(--primary);">Lợi ích hệ thống mang lại</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-user-check me-2"
                                    style="color: var(--success);"></i> Tiết kiệm thời gian & chi phí: Tối ưu hóa quy
                                trình quản lý thi, giảm thiểu công việc thủ công.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-globe-asia me-2"
                                    style="color: var(--success);"></i> Thi cử mọi lúc, mọi nơi: Đảm bảo tính linh hoạt
                                và tiện lợi cho sinh viên tham gia thi.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-graduation-cap me-2"
                                    style="color: var(--success);"></i> Nâng cao hiệu quả học tập: Phân tích kết quả
                                giúp sinh viên củng cố kiến thức qua kết quả bài thi.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-cogs me-2" style="color: var(--success);"></i>
                                Quản lý chuyên nghiệp: Dễ dàng kiểm soát, theo
                                dõi và tổng hợp dữ liệu thi.</p>
                        </div>
                    </div>
                    <p class="mt-4 text-center lead" style="color: var(--gray-dark);">
                        Hệ thống hướng đến việc trở thành nền tảng thi và đánh giá trực tuyến đáng tin cậy, <br> góp
                        phần vào sự phát triển bền vững của giáo dục số.
                    </p>
                </div>
            </div>
        </div>
    </div>

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

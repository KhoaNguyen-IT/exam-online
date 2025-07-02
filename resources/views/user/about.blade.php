@extends('user.layout.app')

@section('title', 'Trang giới thiệu | Trắc nghiệm')

@section('header')
    <!-- Botbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col text-left">
                <div class="d-inline-flex flex-wrap">
                    <a href="{{ route('user.home.index') }}" class="text-white mx-2">Trang chủ</a>
                    <span class="text-white mx-2">/</span>
                    <a href="{{ route('user.about') }}" class="text-white mx-2">Giới thiệu</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Botbar End -->
@endsection

@section('content')
    <div class="bodyAbout" style="background-image: linear-gradient(90.57deg, #3e65fe, #d23cff);">
        <div class="container py-5">
        <div class="row justify-content-center border p-4 bg-light" style="border-radius: 15px;">
            <div class="col-lg-11 col-md-11">

                <h1 class="text-center mb-4" style="font-weight: 700; color: var(--dark);">
                    Giới thiệu hệ thống trắc nghiệm trực tuyến
                </h1>
                <p class="lead text-center mb-5" style="color: var(--dark);">
                    Kiểm tra, thi trắc nghiệm trực tuyến là một hình thức kiểm tra, đánh giá kiến thức được nhiều trường học áp dụng, nhờ khả năng hỗ trợ tổ chức kỳ thi nhanh chóng, chính xác và dễ dàng quản lý kết quả. Hệ thống này được xây dựng nhằm đáp ứng nhu cầu ứng dụng công nghệ trong giáo dục hiện nay.
                </p>

                {{-- <div class="card shadow-sm mb-5 border-0">
                    <div class="card-body p-lg-5">
                        <h3 class="card-title mb-4 text-center" style="color: var(--primary);">
                            Chuyển đổi phương pháp đánh giá
                        </h3>
                        <p class="mb-4 text-center" style="color: var(--gray);">
                            Trong kỷ nguyên số, việc tối ưu hóa quy trình kiểm tra và đánh giá kiến thức là yếu tố then chốt. Hệ thống thi trắc nghiệm trực tuyến của chúng tôi ra đời nhằm cung cấp một giải pháp hiện đại, hiệu quả và đáng tin cậy cho các tổ chức giáo dục, doanh nghiệp và cá nhân.
                        </p>
                        <p class="text-center" style="color: var(--gray);">
                            Sứ mệnh của chúng tôi là nâng cao chất lượng đánh giá, tối ưu hóa quy trình thi cử và tạo môi trường học tập linh hoạt, dễ tiếp cận cho mọi đối tượng người dùng.
                        </p>
                    </div>
                </div> --}}

                <div class="text-center mb-5">
                    <h2 class="mb-4" style="font-weight: 700; color: var(--primary);">Các tính năng nổi bật</h2>
                    <div class="row justify-content-center">
                        {{-- <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-desktop fa-3x mb-3" style="color: var(--info);"></i>
                                    <h5 style="color: var(--primary);">Giao diện <br> thân thiện, dễ sử dụng</h5>
                                    <p class="text-muted small">Thiết kế trực quan, tối ưu trải nghiệm cho cả giảng viên và sinh viên.</p>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-database fa-3x mb-3" style="color: var(--info);"></i>
                                    <h5 style="color: var(--primary);">Quản lý <br> ngân hàng câu hỏi</h5>
                                    <p class="text-muted small">Tạo, chỉnh sửa và phân loại câu hỏi trắc nghiệm một cách khoa học.</p>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-laptop-code fa-3x mb-3" style="color: var(--success);"></i>
                                    <h5 style="color: var(--primary);">Tổ chức <br> thi trực tuyến linh hoạt</h5>
                                    <p class="text-muted small">Tạo và quản lý các kỳ thi trực tuyến <br> mọi lúc, mọi nơi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-hourglass-half fa-3x mb-3" style="color: var(--gray-dark);"></i>
                                    <h5 style="color: var(--primary);">Đồng hồ đếm ngược <br> & tự động thu bài</h5>
                                    <p class="text-muted small">Quản lý thời gian thi, tự động thu bài khi hết giờ, <br> đảm bảo công bằng.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-check-circle fa-3x mb-3" style="color: var(--danger);"></i>
                                    <h5 style="color: var(--primary);">Chấm điểm tự động <br> & kết quả tức thời</h5>
                                    <p class="text-muted small">Chấm bài tự động và trả kết quả sau khi hoàn thành <br> và kỳ thi kết thúc.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card h-100 shadow-sm border">
                                <div class="card-body">
                                    <i class="fas fa-history fa-3x mb-3" style="color: var(--warning);"></i>
                                    <h5 style="color: var(--primary);">Xem lại <br> lịch sử làm bài</h5>
                                    <p class="text-muted small">Dễ dàng xem lại chi tiết các bài thi đã làm, <br> theo dõi tiến độ và hiệu suất.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-5 p-lg-5 border">
                    <h3 class="mb-4 text-center" style="color: var(--primary);">Lợi ích hệ thống mang lại</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-user-check me-2" style="color: var(--success);"></i> Tiết kiệm thời gian & chi phí: Tối ưu hóa quy trình quản lý thi, giảm thiểu công việc thủ công.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-globe-asia me-2" style="color: var(--success);"></i> Thi cử mọi lúc, mọi nơi: Đảm bảo tính linh hoạt và tiện lợi cho sinh viên tham gia thi.</p>
                        </div>
                         <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-graduation-cap me-2" style="color: var(--success);"></i> Nâng cao hiệu quả học tập: Phân tích kết quả giúp sinh viên củng cố kiến thức qua kết quả bài thi.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p style="color: var(--gray);"><i class="fas fa-cogs me-2" style="color: var(--success);"></i> Quản lý chuyên nghiệp: Dễ dàng kiểm soát, theo dõi và tổng hợp dữ liệu thi.</p>
                        </div>
                    </div>
                    <p class="mt-4 text-center lead" style="color: var(--gray-dark);">
                        Hệ thống hướng đến việc trở thành nền tảng thi và đánh giá trực tuyến đáng tin cậy, <br> góp phần vào sự phát triển bền vững của giáo dục số.
                    </p>
                </div>

                {{-- <div class="text-center p-4 bg-light rounded shadow-sm">
                    <h3 class="mb-3" style="color: var(--dark);">Sẵn sàng chuyển đổi phương pháp đánh giá?</h3>
                    <p style="color: var(--gray);">Khám phá sức mạnh của hệ thống thi trắc nghiệm trực tuyến ngay hôm nay.</p>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg mt-3" style="background-color: var(--primary); border-color: var(--primary);">Bắt Đầu Ngay</a>
                </div> --}}

            </div>
        </div>
    </div>
    </div>
@endsection
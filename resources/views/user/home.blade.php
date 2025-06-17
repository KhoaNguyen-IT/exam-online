@extends('user.layout.app')

@section('title', 'Trang chủ')

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
                            <a class="dropdown-item" href="#">Môn học 1</a>
                            <a class="dropdown-item" href="#">Môn học 2</a>
                            <a class="dropdown-item" href="#">Môn học 3</a>
                        </div>
                    </div>
                    <input type="text" class="form-control border-light" style="padding: 30px 25px;"
                        placeholder="Từ khóa">
                    <div class="input-group-append">
                        <button class="btn btn-secondary px-4 px-lg-5">Tìm kiếm</button>
                    </div>
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
                        <a href="" class="btn nutLamBai">Bắt đầu làm bài</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Các Môn Học</h6>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                <div class="team-item">
                    <a href=""><img class="img-fluid w-100" src="{{ asset('user/images/book.jpg') }}"
                            alt=""></a>
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3"><a href="" class="text-decoration-none text-dark">Môn học 1</a></h5>
                    </div>
                </div>
                <div class="team-item">
                    <a href=""><img class="img-fluid w-100" src="{{ asset('user/images/book.jpg') }}"
                            alt=""></a>
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3"><a href="" class="text-decoration-none text-dark">Môn học 2</a></h5>
                    </div>
                </div>
                <div class="team-item">
                    <a href=""><img class="img-fluid w-100" src="{{ asset('user/images/book.jpg') }}"
                            alt=""></a>
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3"><a href="" class="text-decoration-none text-dark">Môn học 3</a></h5>
                    </div>
                </div>
                <div class="team-item">
                    <a href=""><img class="img-fluid w-100" src="{{ asset('user/images/book.jpg') }}"
                            alt=""></a>
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3"><a href="" class="text-decoration-none text-dark">Môn học 4</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection

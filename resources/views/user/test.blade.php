@extends('user.layout.app')

@section('title', $viewData['title'])

@section('js')
    <script src="{{ asset('user/js/test.js') }}"></script>
    <script>
        const routeTestDetail = "{{ route('user.testDetail.index', ['id' => 'PLACEHOLDER']) }}";
        const routeExamList = "{{ route('user.examList.index') }}";
    </script>

    @if (session('nopBaiThanhCongVaXemKetQua'))
        <script>
            // Thông báo nộp bài thành công và cho xem kết quả bài làm
            sessionStorage.setItem('ketQuaSauKhiNop', 'true');
            sessionStorage.setItem('maKQT', '{{ session('maKQT') }}');
            sessionStorage.setItem('noiDungKetQua', {!! json_encode(session('nopBaiThanhCongVaXemKetQua')) !!});
        </script>
    @elseif (session('nopBaiThanhCong'))
        <script>
            // Thông báo nộp bài thành công
            sessionStorage.setItem('nopBaiThanhCong', 'true');
            sessionStorage.setItem('noiDungNopBai', {!! json_encode(session('nopBaiThanhCong')) !!});
        </script>
    @elseif (session('daHoanThanhBaiThi'))
        <script>
            // Thông báo đã hoàn thành bài thi
            sessionStorage.setItem('daHoanThanhBaiThi', 'true');
            sessionStorage.setItem('noiDungHoanThanh', {!! json_encode(session('daHoanThanhBaiThi')) !!});
        </script>
    @endif
@endsection

@section('content')
    <div class="exam-page-container">
        @if ($viewData['deThi'] && $viewData['baiLam'] && $viewData['chiTietBaiLams'])
        <div class="exam-sidebar-left">
            <div class="exam-info-section">
                @if ($viewData['deThi']->kyThi)
                    <h2 class="exam-title">{{ $viewData['deThi']->tenDT }}</h2>
                    <span style="font-size: 0.9em;">Bắt đầu lúc: {{ \Carbon\Carbon::parse($viewData['deThi']->kyThi->ngayThi)->format('d/m/Y - H \g\i\ờ i \p\h\ú\t') }}</span>
                    <p class="exam-instruction-text mt-1">Thời gian làm bài: {{ $viewData['deThi']->thoiLuongPhut }} phút</p>
                @endif
                <div class="exam-timer-display">
                    Thời gian còn lại: <span id="exam-timer" data-duration="{{ $viewData['deThi']->thoiLuongPhut }}"
                        data-ngay-thi="{{ \Carbon\Carbon::parse($viewData['deThi']->kyThi->ngayThi)->timestamp }}">00:00</span>
                </div>
            </div>
    
            <div class="exam-action-buttons">
                <button type="submit" form="exam-quiz-form" class="exam-btn-submit-main">Nộp bài</button>
            </div>
        </div>
    
        <div class="exam-question-main-area">
            <form id="exam-quiz-form" method="POST"
                action="{{ route('user.test.nopBai', ['id' => $viewData['deThi']->maDT]) }}">
                @csrf
                <input type="hidden" name="ngayThiKetQuaThi"
                    value="{{ $viewData['deThi']->kyThi->ngayThi }}">

                <input type="hidden" name="maBaiLam" id="maBaiLamBackup"
                    value="{{ $viewData['baiLam']->maBL }}">
    
                <div class="exam-question-list" style="min-height: 400px;">
                    @foreach ($viewData['chiTietBaiLams'] as $index => $ct)
                        <div class="exam-question-card {{ $loop->first ? 'is-active-question' : '' }}"
                            data-question-index="{{ $index }}">
                            <div class="exam-question-header-row">
                                <h3 class="exam-question-number-text">Câu {{ $loop->iteration }}</h3>
                            </div>

                            <div class="exam-question-content-body">
                                <p class="exam-question-text-content">{{ $ct->cauHoi->noiDung }}</p>

                                @if (!empty($ct->cauHoi->hinhAnh))
                                    <div class="exam-question-image-container">
                                        <img src="{{ asset('storage/' . $ct->cauHoi->hinhAnh) }}" alt="Hình ảnh câu hỏi" class="exam-question-image">
                                    </div>
                                @endif

                                <div class="exam-options-group">
                                    <label class="exam-option-item">
                                        <input type="radio" name="question[{{ $ct->maCH }}]" value="{{ $ct->hienThiA }}" class="exam-option-radio" onchange="luuTamBaiLam({{$ct->maCH}}, '{{ $ct->hienThiA }}')"> A.
                                        {{ $ct->cauHoi->{'dapAn' . $ct->hienThiA} }}
                                    </label>
                                    <label class="exam-option-item">
                                        <input type="radio" name="question[{{ $ct->maCH }}]" value="{{ $ct->hienThiB }}" class="exam-option-radio" onchange="luuTamBaiLam({{$ct->maCH}}, '{{ $ct->hienThiB }}')"> B.
                                        {{ $ct->cauHoi->{'dapAn' . $ct->hienThiB} }}
                                    </label>
                                    <label class="exam-option-item">
                                        <input type="radio" name="question[{{ $ct->maCH }}]" value="{{ $ct->hienThiC }}" class="exam-option-radio" onchange="luuTamBaiLam({{$ct->maCH}}, '{{ $ct->hienThiC }}')"> C.
                                        {{ $ct->cauHoi->{'dapAn' . $ct->hienThiC} }}
                                    </label>
                                    <label class="exam-option-item">
                                        <input type="radio" name="question[{{ $ct->maCH }}]" value="{{ $ct->hienThiD }}" class="exam-option-radio" onchange="luuTamBaiLam({{$ct->maCH}}, '{{ $ct->hienThiD }}')"> D.
                                        {{ $ct->cauHoi->{'dapAn' . $ct->hienThiD} }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    
        <div class="exam-sidebar-right">
            <div class="exam-navigator-section">
                <h4 class="exam-sidebar-title">Mục lục câu hỏi</h4>
                <div class="exam-question-navigator-grid">
                    @foreach ($viewData['chiTietBaiLams'] as $index => $ct)
                        <div class="exam-question-number-item {{ $loop->first ? 'is-current' : '' }}"
                            data-question-index="{{ $index }}">
                            {{ $loop->iteration }}
                        </div>
                    @endforeach
                </div>
                <div class="exam-navigation-controls">
                    <button type="button" id="exam-prev-question" class="exam-nav-button">Câu trước</button>
                    <button type="button" id="exam-next-question" class="exam-nav-button">Câu kế tiếp</button>
                </div>
            </div>
        </div>
        @else
        <div class="text-center text-danger font-weight-bold display-4 w-100" style="margin: 171px 0 172px 0;">
            Lỗi hệ thống, vui lòng thử lại sau!
        </div>
        @endif
    </div>
@endsection

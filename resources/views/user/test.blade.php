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
    @endif
@endsection

@section('content')
    <div class="quiz-page-container">
        @if ($viewData['baiLam']->kyThis->isNotEmpty())
            <h2 class="quiz-title">{{ $viewData['baiLam']->kyThis->first()->tenKT }}</h2>
        @endif
        <p class="quiz-instruction">Thời gian làm bài: {{ $viewData['baiLam']->thoiLuongPhut }} phút</p>

        <div class="countdown-timer">
            Thời gian còn lại: <span id="timer" data-duration="{{ $viewData['baiLam']->thoiLuongPhut }}"
                data-ngay-thi="{{ \Carbon\Carbon::parse($viewData['baiLam']->kyThis->first()->ngayThi)->timestamp }}">{{ $viewData['baiLam']->thoiLuongPhut }}:00</span>
        </div>

        <form id="quiz-form" method="POST" action="{{ route('user.test.nopBai', ['id' => $viewData['baiLam']->maDT]) }}">
            @csrf
            <div class="question-list">
                <input type="hidden" name="ngayThiKetQuaThi" value="{{ $viewData['baiLam']->kyThis->first()->ngayThi }}">
                @foreach ($viewData['baiLam']->cauHois as $cauHoi)
                    <div class="question-card">
                        <h3 class="question-text">Câu {{ $loop->iteration }}: {{ $cauHoi->noiDung }}</h3>
                        <div class="options-group">
                            <label class="option-item">
                                <input type="radio" name="question[{{ $cauHoi->maCH }}]" value="A"> A.
                                {{ $cauHoi->dapAnA }}
                            </label>
                            <label class="option-item">
                                <input type="radio" name="question[{{ $cauHoi->maCH }}]" value="B"> B.
                                {{ $cauHoi->dapAnB }}
                            </label>
                            <label class="option-item">
                                <input type="radio" name="question[{{ $cauHoi->maCH }}]" value="C"> C.
                                {{ $cauHoi->dapAnC }}
                            </label>
                            <label class="option-item">
                                <input type="radio" name="question[{{ $cauHoi->maCH }}]" value="D"> D.
                                {{ $cauHoi->dapAnD }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="submit-quiz-button">Nộp bài</button>
        </form>
    </div>
@endsection

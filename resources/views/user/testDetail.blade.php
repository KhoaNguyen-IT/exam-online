@extends('user.layout.app')

@section('title', $viewData['title'])

@section('content')
    <div class="exam-review-page-container">
        <div class="exam-header-info">
            <h2 class="exam-header-title">{{ $viewData['ketQuaThi']->deThi->kyThis->first()->tenKT }}</h2>
            <p><b>Môn học:</b> {{ $viewData['ketQuaThi']->deThi->monHoc->tenMH }}</p>
            <p><b>Ngày thi:</b>
                {{ \Carbon\Carbon::parse($viewData['ketQuaThi']->deThi->kyThis->first()->ngayThi)->format('d/m/Y - H \g\i\ờ i \p\h\ú\t') }}
            </p>
        </div>

        <div class="exam-summary-bar">
            <div class="summary-line-item correct-count">
                <span class="label">Số câu đúng:</span>
                <span class="value">
                    @if ($viewData['daKetThuc'])
                        {{ $viewData['ketQuaThi']->soCauDung }}/{{ $viewData['ketQuaThi']->tongSoCau }}
                    @else
                        0/{{ $viewData['ketQuaThi']->tongSoCau }}
                    @endif
                </span>
            </div>
            <div class="summary-line-item score">
                <span class="label">Điểm:</span>
                <span class="value">
                    @if ($viewData['daKetThuc'])
                        {{ $viewData['ketQuaThi']->diemSo }}
                    @else
                        0.00
                    @endif
                </span>
            </div>
        </div>
        <div class="questions-review-list">
            @foreach ($viewData['ketQuaThi']->baiLams as $baiLam)
                @if ($viewData['daKetThuc'])
                    <div class="question-review-card">
                        <p class="question-text">Câu {{ $loop->iteration }}: {{ $baiLam->cauHoi->noiDung }}</p>
                        <ul class="answers-list">
                            <li
                                class="answer-item 
                                @if ($baiLam->cauHoi->dapAnDung == 'A') correct
                                @elseif ($baiLam->dapAnChon == 'A')
                                    wrong @endif
                            ">
                                <input type="radio" id="q{{ $loop->iteration }}a" name="q{{ $loop->iteration }}" disabled
                                    {{ $baiLam->dapAnChon == 'A' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}a">A. {{ $baiLam->cauHoi->dapAnA }}</label>
                            </li>
                            <li
                                class="answer-item 
                                @if ($baiLam->cauHoi->dapAnDung == 'B') correct
                                @elseif ($baiLam->dapAnChon == 'B')
                                    wrong @endif
                            ">
                                <input type="radio" id="q{{ $loop->iteration }}b" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'B' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}b">B. {{ $baiLam->cauHoi->dapAnB }}</label>
                            </li>
                            <li
                                class="answer-item 
                                @if ($baiLam->cauHoi->dapAnDung == 'C') correct
                                @elseif ($baiLam->dapAnChon == 'C')
                                    wrong @endif
                            ">
                                <input type="radio" id="q{{ $loop->iteration }}c" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'C' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}c">C. {{ $baiLam->cauHoi->dapAnC }}</label>
                            </li>
                            <li
                                class="answer-item 
                                @if ($baiLam->cauHoi->dapAnDung == 'D') correct
                                @elseif ($baiLam->dapAnChon == 'D')
                                    wrong @endif
                            ">
                                <input type="radio" id="q{{ $loop->iteration }}d" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'D' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}d">D. {{ $baiLam->cauHoi->dapAnD }}</label>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="question-review-card">
                        <p class="question-text">Câu {{ $loop->iteration }}: {{ $baiLam->cauHoi->noiDung }}</p>
                        <ul class="answers-list">
                            <li class="answer-item">
                                <input type="radio" id="q{{ $loop->iteration }}a" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'A' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}a">A. {{ $baiLam->cauHoi->dapAnA }}</label>
                            </li>
                            <li class="answer-item">
                                <input type="radio" id="q{{ $loop->iteration }}b" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'B' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}b">B. {{ $baiLam->cauHoi->dapAnB }}</label>
                            </li>
                            <li class="answer-item">
                                <input type="radio" id="q{{ $loop->iteration }}c" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'C' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}c">C. {{ $baiLam->cauHoi->dapAnC }}</label>
                            </li>
                            <li class="answer-item">
                                <input type="radio" id="q{{ $loop->iteration }}d" name="q{{ $loop->iteration }}"
                                    disabled {{ $baiLam->dapAnChon == 'D' ? 'checked' : '' }}>
                                <label for="q{{ $loop->iteration }}d">D. {{ $baiLam->cauHoi->dapAnD }}</label>
                            </li>
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>

        <form action="{{ route('user.testDetail.guiNhanXet', ['id' => $viewData['ketQuaThi']->deThi->maDT]) }}"
            method="post">
            @csrf
            <div class="comment-section-container">
                <div class="section-title text-center position-relative mb-5">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Nhận xét</h6>
                </div>
                <div class="comment-form-group">
                    <label for="user-comment" class="comment-label">Nội dung</label>
                    <textarea id="user-comment" name="noiDungNhanXet"
                        placeholder="Nhập nội dung nhận xét về bài thi kiểm tra (không bắt buộc)" spellcheck="false"></textarea>
                </div>
                <div class="comment-submit-wrapper">
                    <button type="submit" class="send-comment-button">Gửi nhận xét</button>
                </div>
            </div>
        </form>
    </div>

    @if (session('guiNhanXetThanhCong'))
        <script>
            // Thông báo gửi nhận xét thành công
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Gửi nhận xét thành công',
                    text: {!! json_encode(session('guiNhanXetThanhCong')) !!},
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

@endsection

@extends('user.layout.app')

@section('title', $viewData['title'])

@section('js')
    <script src="{{ asset('user/js/testDetail.js') }}"></script>
@endsection

@section('content')
    <div class="review-page-wrapper">
        <div class="review-page-container">
            <div class="review-sidebar-left review-block">
                <h4 class="review-sidebar-title">Thông tin đề thi</h4>
                <div class="review-exam-info">
                    <p><b>Tên đề thi:</b> {{ $viewData['ketQuaThi']->deThi->tenDT }}</p>
                    <p><b>Môn học:</b> {{ $viewData['ketQuaThi']->deThi->monHoc->tenMH }}</p>
                    <p>
                        <b>Ngày thi:</b>
                        {{ \Carbon\Carbon::parse($viewData['ketQuaThi']->deThi->kyThi->ngayThi)->format('d/m/Y - H:i') }}
                    </p>
                </div>
    
                <div class="review-sidebar-block review-exam-summary-bar">
                    <h4 class="review-sidebar-title">Tổng quan kết quả</h4>
                    @if ($viewData['daKetThuc'])
                        <div class="review-summary-line-item review-correct-count">
                            <span class="review-label">Số câu đúng:</span>
                            <span class="review-value">
                                {{ $viewData['ketQuaThi']->soCauDung }}/{{ $viewData['ketQuaThi']->tongSoCau }}
                            </span>
                        </div>
                        <div class="review-summary-line-item review-score">
                            <span class="review-label">Điểm:</span>
                            <span class="review-value">
                                {{ $viewData['ketQuaThi']->diemSo }}
                            </span>
                        </div>
                    @else
                        <div class="border-0 text-center text-white font-weight-bold p-2 bg-warning">
                            Chưa có điểm
                        </div>
                    @endif
                </div>
    
                <form action="{{ route('user.testDetail.guiNhanXet', ['id' => $viewData['ketQuaThi']->deThi->maDT]) }}"
                    method="post" class="review-comment-form">
                    @csrf
                    <div class="review-comment-section-container review-sidebar-block">
                        <h4 class="review-sidebar-title">Nhận xét</h4>
                        <div class="review-comment-form-group">
                            <label for="user-comment" class="review-comment-label">Nội dung</label>
                            <textarea id="user-comment" name="noiDungNhanXet"
                                placeholder="Nhập nội dung nhận xét về bài thi kiểm tra (không bắt buộc)" spellcheck="false"></textarea>
                        </div>
                        <div class="review-comment-submit-wrapper">
                            <button type="submit" class="review-send-comment-button">Gửi nhận xét</button>
                        </div>
                    </div>
                </form>
            </div>
    
            <div class="review-main-content review-block">
                <div class="review-question-list">
                    @if ($viewData['daKetThuc'])
                        @foreach ($viewData['ketQuaThi']->baiLam->chiTietBaiLams as $index => $ct)
                            <div class="review-question-card {{ $loop->first ? 'review-active-question' : '' }}"
                                data-question-index="{{ $index }}">
                                <p class="review-question-text">Câu {{ $loop->iteration }}: {{ $ct->cauHoi->noiDung }}</p>
    
                                @if (!empty($ct->cauHoi->hinhAnh))
                                    <div class="review-question-image-container">
                                        <img src="{{ asset('storage/' . $ct->cauHoi->hinhAnh) }}" alt="Hình ảnh câu hỏi">
                                    </div>
                                @endif
    
                                <ul class="review-answers-list">
                                    <li
                                        class="review-answer-item
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiA) review-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiA && $ct->cauHoi->dapAnDung != $ct->hienThiA) review-wrong @endif
                                        @if ($ct->dapAnChon == $ct->hienThiA && $ct->cauHoi->dapAnDung == $ct->hienThiA) review-chosen-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiA && empty($ct->cauHoi->dapAnDung)) review-chosen @endif
                                        @if (empty($ct->dapAnChon) && $ct->cauHoi->dapAnDung == $ct->hienThiA) review-correct-not-chosen @endif
                                    ">
                                        <input type="radio" id="q{{ $loop->iteration }}a" name="q{{ $loop->iteration }}"
                                            disabled {{ $ct->dapAnChon == $ct->hienThiA ? 'checked' : '' }}>
                                        <label for="q{{ $loop->iteration }}a">A. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiA } }}</label>
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiA)
                                            <span class="review-indicator review-correct-indicator">✓</span>
                                        @endif
                                        @if ($ct->dapAnChon == $ct->hienThiA && $ct->cauHoi->dapAnDung != $ct->hienThiA)
                                            <span class="review-indicator review-wrong-indicator">✗</span>
                                        @endif
                                    </li>
                                    <li
                                        class="review-answer-item
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiB) review-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiB && $ct->cauHoi->dapAnDung != $ct->hienThiB) review-wrong @endif
                                        @if ($ct->dapAnChon == $ct->hienThiB && $ct->cauHoi->dapAnDung == $ct->hienThiB) review-chosen-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiB && empty($ct->cauHoi->dapAnDung)) review-chosen @endif
                                        @if (empty($ct->dapAnChon) && $ct->cauHoi->dapAnDung == $ct->hienThiB) review-correct-not-chosen @endif
                                    ">
                                        <input type="radio" id="q{{ $loop->iteration }}b" name="q{{ $loop->iteration }}"
                                            disabled {{ $ct->dapAnChon == $ct->hienThiB ? 'checked' : '' }}>
                                        <label for="q{{ $loop->iteration }}b">B. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiB } }}</label>
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiB)
                                            <span class="review-indicator review-correct-indicator">✓</span>
                                        @endif
                                        @if ($ct->dapAnChon == $ct->hienThiB && $ct->cauHoi->dapAnDung != $ct->hienThiB)
                                            <span class="review-indicator review-wrong-indicator">✗</span>
                                        @endif
                                    </li>
                                    <li
                                        class="review-answer-item
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiC) review-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiC && $ct->cauHoi->dapAnDung != $ct->hienThiC) review-wrong @endif
                                        @if ($ct->dapAnChon == $ct->hienThiC && $ct->cauHoi->dapAnDung == $ct->hienThiC) review-chosen-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiC && empty($ct->cauHoi->dapAnDung)) review-chosen @endif
                                        @if (empty($ct->dapAnChon) && $ct->cauHoi->dapAnDung == $ct->hienThiC) review-correct-not-chosen @endif
                                    ">
                                        <input type="radio" id="q{{ $loop->iteration }}c" name="q{{ $loop->iteration }}"
                                            disabled {{ $ct->dapAnChon == $ct->hienThiC ? 'checked' : '' }}>
                                        <label for="q{{ $loop->iteration }}c">C. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiC } }}</label>
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiC)
                                            <span class="review-indicator review-correct-indicator">✓</span>
                                        @endif
                                        @if ($ct->dapAnChon == $ct->hienThiC && $ct->cauHoi->dapAnDung != $ct->hienThiC)
                                            <span class="review-indicator review-wrong-indicator">✗</span>
                                        @endif
                                    </li>
                                    <li
                                        class="review-answer-item
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiD) review-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiD && $ct->cauHoi->dapAnDung != $ct->hienThiD) review-wrong @endif
                                        @if ($ct->dapAnChon == $ct->hienThiD && $ct->cauHoi->dapAnDung == $ct->hienThiD) review-chosen-correct @endif
                                        @if ($ct->dapAnChon == $ct->hienThiD && empty($ct->cauHoi->dapAnDung)) review-chosen @endif
                                        @if (empty($ct->dapAnChon) && $ct->cauHoi->dapAnDung == $ct->hienThiD) review-correct-not-chosen @endif
                                    ">
                                        <input type="radio" id="q{{ $loop->iteration }}d" name="q{{ $loop->iteration }}"
                                            disabled {{ $ct->dapAnChon == $ct->hienThiD ? 'checked' : '' }}>
                                        <label for="q{{ $loop->iteration }}d">D. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiD } }}</label>
                                        @if ($ct->cauHoi->dapAnDung == $ct->hienThiD)
                                            <span class="review-indicator review-correct-indicator">✓</span>
                                        @endif
                                        @if ($ct->dapAnChon == $ct->hienThiD && $ct->cauHoi->dapAnDung != $ct->hienThiD)
                                            <span class="review-indicator review-wrong-indicator">✗</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    @else
                        @if (!empty($viewData['ketQuaThi']) && !empty($viewData['ketQuaThi']->baiLam->chiTietBaiLams))
                            @foreach ($viewData['ketQuaThi']->baiLam->chiTietBaiLams as $index => $ct)
                                <div class="review-question-card {{ $loop->first ? 'review-active-question' : '' }}"
                                    data-question-index="{{ $index }}">
                                    <p class="review-question-text">Câu {{ $loop->iteration }}: {{ $ct->cauHoi->noiDung }}
                                    </p>
    
                                    @if (!empty($ct->cauHoi->hinhAnh))
                                        <div class="review-question-image-container">
                                            <img src="{{ asset('storage/' . $ct->cauHoi->hinhAnh) }}"
                                                alt="Hình ảnh câu hỏi">
                                        </div>
                                    @endif
    
                                    <ul class="review-answers-list">
                                        <li
                                            class="review-answer-item
                                            @if ($ct->dapAnChon == $ct->hienThiA) review-chosen @endif ">
                                            <input type="radio" id="q{{ $loop->iteration }}a" name="q{{ $loop->iteration }}"
                                                disabled {{ $ct->dapAnChon == $ct->hienThiA ? 'checked' : '' }}>
                                            <label for="q{{ $loop->iteration }}a">A. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiA } }}</label>
                                        </li>
                                        <li
                                            class="review-answer-item
                                            @if ($ct->dapAnChon == $ct->hienThiB) review-chosen @endif ">
                                            <input type="radio" id="q{{ $loop->iteration }}b" name="q{{ $loop->iteration }}"
                                                disabled {{ $ct->dapAnChon == $ct->hienThiB ? 'checked' : '' }}>
                                            <label for="q{{ $loop->iteration }}b">B. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiB } }}</label>
                                        </li>
                                        <li
                                            class="review-answer-item
                                            @if ($ct->dapAnChon == $ct->hienThiC) review-chosen @endif ">
                                            <input type="radio" id="q{{ $loop->iteration }}c" name="q{{ $loop->iteration }}"
                                                disabled {{ $ct->dapAnChon == $ct->hienThiC ? 'checked' : '' }}>
                                            <label for="q{{ $loop->iteration }}c">C. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiC } }}</label>
                                        </li>
                                        <li
                                            class="review-answer-item
                                            @if ($ct->dapAnChon == $ct->hienThiD) review-chosen @endif ">
                                            <input type="radio" id="q{{ $loop->iteration }}d" name="q{{ $loop->iteration }}"
                                                disabled {{ $ct->dapAnChon == $ct->hienThiD ? 'checked' : '' }}>
                                            <label for="q{{ $loop->iteration }}d">D. {{ $ct->cauHoi->{ 'dapAn' . $ct->hienThiD } }}</label>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <p class="review-no-result-message">Lỗi hệ thống, vui lòng thử lại sau!</p>
                        @endif
                    @endif
                </div>
                </div>
    
            <div class="review-sidebar-right review-block">
                <div class="review-sidebar-block review-question-numbers-section">
                    <h4 class="review-sidebar-title mucluccutom">Mục lục câu hỏi</h4>
                    <div class="review-question-numbers-grid">
                        @if ($viewData['daKetThuc'])
                            @foreach ($viewData['ketQuaThi']->baiLam->chiTietBaiLams as $index => $ct)
                                @php
                                    $itemClass = '';
                                    if ($ct->dapAnChon == $ct->cauHoi->dapAnDung) {
                                        $itemClass = 'review-correct';
                                    } elseif (
                                        !empty($ct->dapAnChon) &&
                                        $ct->dapAnChon != $ct->cauHoi->dapAnDung
                                    ) {
                                        $itemClass = 'review-wrong';
                                    } elseif (empty($ct->dapAnChon)) {
                                        $itemClass = 'review-skipped';
                                    }
                                @endphp
                                <div class="review-question-number-item {{ $loop->first ? 'review-current' : '' }} {{ $itemClass }}"
                                    data-question-index="{{ $index }}" data-result="{{ $itemClass }}">
                                    {{ $loop->iteration }}
                                </div>
                            @endforeach
                        @else
                            @if (!empty($viewData['ketQuaThi']) && !empty($viewData['ketQuaThi']->baiLam->chiTietBaiLams))
                                @foreach ($viewData['ketQuaThi']->baiLam->chiTietBaiLams as $index => $ct)
                                    <div class="review-question-number-item {{ $loop->first ? 'review-current' : '' }}"
                                        data-question-index="{{ $index }}">
                                        {{ $loop->iteration }}
                                    </div>
                                @endforeach
                            @else
                                <p class="review-no-result-message-sidebar">Lỗi hệ thống, vui lòng thử lại sau!</p>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="review-navigation-buttons">
                    <button type="button" id="review-prev-question" class="review-nav-button">Câu trước</button>
                    <button type="button" id="review-next-question" class="review-nav-button">Câu kế tiếp</button>
                </div>
            </div>
        </div>
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

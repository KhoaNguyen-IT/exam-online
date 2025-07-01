document.addEventListener('DOMContentLoaded', function () {
    const timerElement = document.getElementById('exam-timer');
    const submitButton = document.querySelector('.exam-btn-submit-main');
    const quizForm = document.getElementById('exam-quiz-form');
    const questionCards = document.querySelectorAll('.exam-question-card');
    const questionNumberItems = document.querySelectorAll('.exam-question-number-item');
    const prevButton = document.getElementById('exam-prev-question');
    const nextButton = document.getElementById('exam-next-question');

    let currentQuestionIndex = 0;
    const answeredQuestions = new Set();

    // --- Function to update question display and sidebar ---
    function updateQuestionDisplay() {
        questionCards.forEach((card, index) => {
            if (index === currentQuestionIndex) {
                card.classList.add('is-active-question');
            } else {
                card.classList.remove('is-active-question');
            }
        });

        questionNumberItems.forEach((item, index) => {
            item.classList.remove('is-current');
            if (index === currentQuestionIndex) {
                item.classList.add('is-current');
                // Cuộn sidebar đến số câu hỏi hiện tại
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            if (answeredQuestions.has(index)) {
                item.classList.add('is-answered');
            } else {
                item.classList.remove('is-answered');
            }
        });

        prevButton.disabled = currentQuestionIndex === 0;
        nextButton.disabled = currentQuestionIndex === questionCards.length - 1;
    }

    // --- Function to mark a question as answered and update sidebar ---
    function markQuestionAsAnswered(questionIndex) {
        if (questionIndex >= 0 && questionIndex < questionCards.length) {
            const currentCard = questionCards[questionIndex];
            const radioButtons = currentCard.querySelectorAll('.exam-option-radio');
            let isAnswered = false;
            radioButtons.forEach(radio => {
                if (radio.checked) {
                    isAnswered = true;
                }
            });

            const correspondingNumberItem = questionNumberItems[questionIndex];
            if (isAnswered) {
                correspondingNumberItem.classList.add('is-answered');
                answeredQuestions.add(questionIndex);
            } else {
                correspondingNumberItem.classList.remove('is-answered');
                answeredQuestions.delete(questionIndex);
            }
        }
    }

    // --- Event listeners for radio buttons to mark questions as answered ---
    questionCards.forEach((card, index) => {
        const radioButtons = card.querySelectorAll('.exam-option-radio');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', () => {
                markQuestionAsAnswered(index);
            });
            if (radio.checked) {
                markQuestionAsAnswered(index);
            }
        });
    });

    // --- Event listeners for navigation buttons ---
    prevButton.addEventListener('click', () => {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            updateQuestionDisplay();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentQuestionIndex < questionCards.length - 1) {
            currentQuestionIndex++;
            updateQuestionDisplay();
        }
    });

    // --- Event listeners for sidebar question numbers ---
    questionNumberItems.forEach(item => {
        item.addEventListener('click', () => {
            const indexToGo = parseInt(item.dataset.questionIndex);
            if (!isNaN(indexToGo) && indexToGo !== currentQuestionIndex) {
                currentQuestionIndex = indexToGo;
                updateQuestionDisplay();
            }
        });
    });

    let daTuongTac = false;
    let beforeUnloadHandler = function (e) {
        e.preventDefault();
        e.returnValue = '';
    };

    // --- Existing Timer and Submission Logic (adapted) ---
    if (sessionStorage.getItem('daNopBai') === 'true') {
        if (sessionStorage.getItem('ketQuaSauKhiNop') === 'true') {
            Swal.fire({
                icon: 'success',
                title: 'Bạn đã hoàn thành bài thi',
                html: sessionStorage.getItem('noiDungKetQua'),
                showCancelButton: true,
                showCloseButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#495057',
                confirmButtonText: 'Xem kết quả',
                cancelButtonText: 'Về danh sách bài thi kiểm tra'
            }).then((result) => {
                sessionStorage.removeItem('ketQuaSauKhiNop');
                sessionStorage.removeItem('noiDungKetQua');
                if (result.isConfirmed) {
                    const maKQT = sessionStorage.getItem('maKQT');
                    sessionStorage.removeItem('maKQT');
                    const finalRoute = routeTestDetail.replace('PLACEHOLDER', maKQT);
                    sessionStorage.removeItem('daNopBai');
                    window.location.href = finalRoute;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    sessionStorage.removeItem('daNopBai');
                    window.location.href = routeExamList;
                }
            });
        }

        if (sessionStorage.getItem('nopBaiThanhCong') === 'true') {
            Swal.fire({
                icon: 'success',
                title: 'Bạn đã hoàn thành bài thi',
                html: sessionStorage.getItem('noiDungNopBai'),
                showCloseButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonText: 'Về danh sách bài thi kiểm tra'
            }).then((result) => {
                sessionStorage.removeItem('nopBaiThanhCong');
                sessionStorage.removeItem('noiDungNopBai');
                if (result.isConfirmed) {
                    sessionStorage.removeItem('daNopBai');
                    window.location.href = routeExamList;
                }
            });
        }

        if (sessionStorage.getItem('daHoanThanhBaiThi') === 'true') {
            Swal.fire({
                icon: 'error',
                title: 'Nộp bài không thành công!',
                html: sessionStorage.getItem('noiDungHoanThanh'),
                showCloseButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonText: 'Về danh sách bài thi kiểm tra'
            }).then((result) => {
                sessionStorage.removeItem('daHoanThanhBaiThi');
                sessionStorage.removeItem('noiDungHoanThanh');
                if (result.isConfirmed) {
                    sessionStorage.removeItem('daNopBai');
                    window.location.href = routeExamList;
                }
            });
        }

        //quizForm.querySelectorAll('input, button, select, textarea').forEach(el => el.disabled = true);
        window.removeEventListener('beforeunload', beforeUnloadHandler);
        return;
    }

    document.addEventListener('click', function () {
        if (!daTuongTac) {
            window.addEventListener('beforeunload', beforeUnloadHandler);
            daTuongTac = true;
        }
    });

    if (!timerElement) {
        console.error('Không tìm thấy #exam-timer');
        return;
    }

    const durationMinutes = parseInt(timerElement.dataset.duration);
    const ngayThiTimestamp = parseInt(timerElement.dataset.ngayThi);
    const nowTimestamp = Math.floor(Date.now() / 1000);

    if (isNaN(durationMinutes) || isNaN(ngayThiTimestamp)) {
        console.error('Giá trị data-duration hoặc data-ngay-thi không hợp lệ');
        return;
    }

    const totalDurationSeconds = durationMinutes * 60;
    const secondsPassed = nowTimestamp - ngayThiTimestamp;
    let totalSeconds = Math.max(totalDurationSeconds - secondsPassed, 0);

    function updateTimer() {
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;

        timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            Swal.fire({
                icon: 'warning',
                title: 'Hết giờ!',
                text: 'Bài thi đang được nộp...',
                showConfirmButton: false,
                timer: 2000,
                willClose: () => {
                    daTuongTac = true;
                    sessionStorage.setItem('daNopBai', 'true');
                    window.removeEventListener('beforeunload', beforeUnloadHandler);
                    if (quizForm) quizForm.submit();
                }
            });
        } else {
            totalSeconds--;
        }
    }

    const timerInterval = setInterval(updateTimer, 1000);

    if (submitButton) {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Bạn có chắc chắn muốn nộp bài không?',
                html: `Bạn đã hoàn thành ${answeredQuestions.size}/${questionCards.length} câu.`,
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#495057',
                confirmButtonText: 'Có, nộp ngay',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    clearInterval(timerInterval);
                    daTuongTac = true;
                    sessionStorage.setItem('daNopBai', 'true');
                    window.removeEventListener('beforeunload', beforeUnloadHandler);
                    quizForm?.submit();
                }
            });
        });
    }

    // Call updateQuestionDisplay initially to set up the first question and its height
    updateQuestionDisplay(); 
    updateTimer(); // Initial call for timer display
});
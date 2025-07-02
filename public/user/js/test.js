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

    // --- Hàm cập nhật câu hỏi và sidebar câu hỏi ---
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

    // --- Hàm đánh dấu câu hỏi đã làm và cập nhật trang thái sidebar câu hỏi ---
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

    // --- Bắt sự kiện cho các nút radio để đánh dấu câu hỏi đã làm ---
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

    // --- Bắt sự kiện cho các nút điều hướng ---
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

    // --- Bắt sự kiện cho các số câu hỏi trên sidebar câu hỏi ---
    questionNumberItems.forEach(item => {
        item.addEventListener('click', () => {
            const indexToGo = parseInt(item.dataset.questionIndex);
            if (!isNaN(indexToGo) && indexToGo !== currentQuestionIndex) {
                currentQuestionIndex = indexToGo;
                updateQuestionDisplay();
            }
        });
    });

    // Xử lý khôi phục kết quả
    const maBL = document.getElementById('maBaiLamBackup').value;
    let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll'));
    let baiLam = baiLamAll ? baiLamAll[maBL] : null;

    if (baiLam) {
        for (let maCH in baiLam) {
            let dapAnChon = baiLam[maCH];
            let radio = document.querySelector(`input[name="question[${maCH}]"][value="${dapAnChon}"]`);
            if (radio) {
                radio.checked = true;
            }
        }
    
        // Xử lý cập nhật sidebar câu hỏi và số câu đã làm
        questionCards.forEach((card, index) => {
            markQuestionAsAnswered(index);
        });
    }

    // Cờ hiệu xác định người dùng đã tương tác với trang hay chưa
    let daTuongTac = false;

    // Hàm xử lý cảnh báo trước khi rời trang và tải lại trang
    let beforeUnloadHandler = function (e) {
        e.preventDefault();
        e.returnValue = '';
    };

    // --- Hàm xử lý thông báo khi đã nộp bài và tắt cảnh báo rời hoặc tải lại trang ---
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
                    
                    // Xóa dữ liệu lưu tạm của bài làm
                    const maBL = document.getElementById('maBaiLamBackup').value;
                    let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll'));
                    if (baiLamAll && baiLamAll[maBL]) {
                        delete baiLamAll[maBL];
                        localStorage.setItem('baiLamAll', JSON.stringify(baiLamAll));
                    }

                    window.location.href = finalRoute;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    sessionStorage.removeItem('daNopBai');
                    
                    // Xóa dữ liệu lưu tạm của bài làm
                    const maBL = document.getElementById('maBaiLamBackup').value;
                    let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll'));
                    if (baiLamAll && baiLamAll[maBL]) {
                        delete baiLamAll[maBL];
                        localStorage.setItem('baiLamAll', JSON.stringify(baiLamAll));
                    }

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
                    
                    // Xóa dữ liệu lưu tạm của bài làm
                    const maBL = document.getElementById('maBaiLamBackup').value;
                    let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll'));
                    if (baiLamAll && baiLamAll[maBL]) {
                        delete baiLamAll[maBL];
                        localStorage.setItem('baiLamAll', JSON.stringify(baiLamAll));
                    }

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
                    
                    // Xóa dữ liệu lưu tạm của bài làm
                    const maBL = document.getElementById('maBaiLamBackup').value;
                    let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll'));
                    if (baiLamAll && baiLamAll[maBL]) {
                        delete baiLamAll[maBL];
                        localStorage.setItem('baiLamAll', JSON.stringify(baiLamAll));
                    }

                    window.location.href = routeExamList;
                }
            });
        }

        window.removeEventListener('beforeunload', beforeUnloadHandler);
        return;
    }

    // Xử lý bật cờ hiệu khi người dùng đã tương tác với trang
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

    // Tính thời gian kết thúc để xóa dữ liệu bài làm lưu tạm
    const endTime = ngayThiTimestamp * 1000 + durationMinutes * 60 * 1000;
    if (Date.now() >= endTime) {
        const maBL = document.getElementById('maBaiLamBackup').value;
        let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll'));
        if (baiLamAll && baiLamAll[maBL]) {
            delete baiLamAll[maBL];
            localStorage.setItem('baiLamAll', JSON.stringify(baiLamAll));
        }
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

    updateQuestionDisplay(); // Gọi hàm để thiết lập hiển thị câu hỏi ban đầu
    updateTimer(); // Gọi hàm để thiết lập thời gian đếm ngược
});

// Hàm lưu tạm kết quả bài làm
function luuTamBaiLam(maCH, dapAnChon) {
    const maBL = document.getElementById('maBaiLamBackup').value;
    let baiLamAll = JSON.parse(localStorage.getItem('baiLamAll')) || {};

    if (!baiLamAll[maBL]) {
        baiLamAll[maBL] = {};
    }

    baiLamAll[maBL][maCH] = dapAnChon;

    localStorage.setItem('baiLamAll', JSON.stringify(baiLamAll));
}
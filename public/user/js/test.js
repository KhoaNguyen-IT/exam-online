document.addEventListener('DOMContentLoaded', function () {
    const timerElement = document.getElementById('timer');
    const submitButton = document.querySelector('.submit-quiz-button');
    const quizForm = document.getElementById('quiz-form');
    
    // 👉 Nếu đã nộp bài rồi (reload lại sau khi submit)
    if (sessionStorage.getItem('daNopBai') === 'true') {
        // Thông báo nộp bài thành công và cho xem kết quả bài làm
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
                    // Thay thế PLACEHOLDER bằng maKQT
                    const finalRoute = routeTestDetail.replace('PLACEHOLDER', maKQT);
                    sessionStorage.removeItem('daNopBai');
                    window.location.href = finalRoute;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    sessionStorage.removeItem('daNopBai');
                    window.location.href = routeExamList;
                }
            });
        }
    
        // Thông báo nộp bài thành công
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

        // Chỉ disable phần tử trong form, không ảnh hưởng đến SweetAlert2
        quizForm.querySelectorAll('input, button, select, textarea').forEach(el => el.disabled = true);


        return; // Không chạy phần còn lại
    }

    let daTuongTac = false;

    let beforeUnloadHandler = function (e) {
        e.preventDefault();
        e.returnValue = '';
    };
    
    document.addEventListener('click', function () {
        if (!daTuongTac) {
            window.addEventListener('beforeunload', beforeUnloadHandler);
            daTuongTac = true;
        }
    });
    
    

    if (!timerElement) {
        console.error('Không tìm thấy #timer');
        return;
    }

    const durationMinutes = parseInt(timerElement.dataset.duration);
    const ngayThiTimestamp = parseInt(timerElement.dataset.ngayThi); // timestamp từ PHP
    const nowTimestamp = Math.floor(Date.now() / 1000); // timestamp hiện tại

    if (isNaN(durationMinutes) || isNaN(ngayThiTimestamp)) {
        console.error('Giá trị data-duration hoặc data-ngay-thi không hợp lệ');
        return;
    }

    // Tổng thời gian làm bài (giây)
    const totalDurationSeconds = durationMinutes * 60;

    // Tính số giây đã trôi qua từ lúc bắt đầu
    const secondsPassed = nowTimestamp - ngayThiTimestamp;

    // Tính thời gian còn lại
    let totalSeconds = Math.max(totalDurationSeconds - secondsPassed, 0); // không âm

    function updateTimer() {
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;

        timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            // Dùng SweetAlert2
            Swal.fire({
                icon: 'warning',
                title: 'Hết giờ!',
                text: 'Bài thi đang được nộp...',
                showConfirmButton: false,
                timer: 2000, // Hiển thị 2 giây rồi tự submit
                willClose: () => {
                    daTuongTac = true;
                    sessionStorage.setItem('daNopBai', 'true'); // 👉 Đánh dấu đã nộp bài
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
            e.preventDefault(); // Ngăn form nộp ngay
    
            Swal.fire({
                icon: 'question',
                title: 'Bạn có chắc chắn muốn nộp bài không?',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#495057',
                confirmButtonText: 'Có, nộp ngay',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    clearInterval(timerInterval); // Dừng timer
                    daTuongTac = true;
                    sessionStorage.setItem('daNopBai', 'true'); // 👉 Đánh dấu đã nộp bài
                    window.removeEventListener('beforeunload', beforeUnloadHandler);
                    quizForm?.submit(); // Submit form
                }
            });
        });
    }
    

    updateTimer();
});

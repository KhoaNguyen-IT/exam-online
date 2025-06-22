document.addEventListener('DOMContentLoaded', function () {
    const timerElement = document.getElementById('timer');
    const submitButton = document.querySelector('.submit-quiz-button');
    const quizForm = document.getElementById('quiz-form');

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
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    clearInterval(timerInterval); // Dừng timer
                    quizForm?.submit(); // Submit form
                }
            });
        });
    }
    

    updateTimer();
});

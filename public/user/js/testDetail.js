document.addEventListener('DOMContentLoaded', function() {
    const questionCards = document.querySelectorAll('.review-question-card');
    const questionNumberItems = document.querySelectorAll('.review-question-number-item');
    const prevButton = document.getElementById('review-prev-question');
    const nextButton = document.getElementById('review-next-question');

    let currentQuestionIndex = 0;

    function updateQuestionDisplay() {
        questionCards.forEach((card, index) => {
            if (index === currentQuestionIndex) {
                card.classList.add('review-active-question');
            } else {
                card.classList.remove('review-active-question');
            }
        });

        questionNumberItems.forEach((item, index) => {
            item.classList.remove('review-current');
            if (index === currentQuestionIndex) {
                item.classList.add('review-current');
                item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });

        prevButton.disabled = currentQuestionIndex === 0;
        nextButton.disabled = currentQuestionIndex === questionCards.length - 1;
    }

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

    questionNumberItems.forEach(item => {
        item.addEventListener('click', () => {
            const indexToGo = parseInt(item.dataset.questionIndex);
            if (!isNaN(indexToGo) && indexToGo >= 0 && indexToGo < questionCards.length) {
                currentQuestionIndex = indexToGo;
                updateQuestionDisplay();
            }
        });
    });

    // Gọi updateQuestionDisplay ban đầu để thiết lập câu hỏi đầu tiên
    updateQuestionDisplay();
});
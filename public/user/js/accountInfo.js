document.addEventListener('DOMContentLoaded', function() {
    const changeAvatarButton = document.querySelector('.change-avatar-button');
    const avatarInput = document.querySelector('#avatar-input');
    const avatarPreview = document.querySelector('#preview-avatar');

    if (changeAvatarButton && avatarInput) {
        changeAvatarButton.addEventListener('click', function() {
            avatarInput.click(); // Mở chọn file ảnh
        });

        avatarInput.addEventListener('change', function() {
            if (avatarInput.files.length > 0) {
                const file = avatarInput.files[0];

                // Xem ảnh trước khi gửi
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // JavaScript để xử lý chuyển đổi hiển thị mật khẩu cho cả 3 trường
    function setupPasswordToggle(inputId, toggleId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(toggleId);

        if (passwordInput && toggleIcon) {
            toggleIcon.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
        }
    }

    setupPasswordToggle('current-password', 'toggleCurrentPassword');
    setupPasswordToggle('new-password', 'toggleNewPassword');
    setupPasswordToggle('confirm-new-password', 'toggleConfirmNewPassword');
});

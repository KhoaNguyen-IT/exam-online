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

                // ✅ Preview ảnh trước khi gửi
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

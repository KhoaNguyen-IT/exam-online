document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggle = document.getElementById('subject-select-btn');
    const dropdown = dropdownToggle?.parentElement;

    if (dropdownToggle && dropdown) {
        // Toggle dropdown khi click vào nút
        dropdownToggle.addEventListener('click', function (event) {
            event.stopPropagation(); // Ngăn sự kiện click lan ra ngoài
            dropdown.classList.toggle('show');
            dropdownToggle.setAttribute('aria-expanded', dropdown.classList.contains('show'));
        });

        // Click vào ul (dropdown menu) không làm ẩn menu
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        dropdownMenu.addEventListener('click', function (event) {
            event.stopPropagation(); // Giữ menu khi click bên trong ul
        });

        // Click ra ngoài sẽ ẩn dropdown
        document.addEventListener('click', function () {
            dropdown.classList.remove('show');
            dropdownToggle.setAttribute('aria-expanded', 'false');
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggle = document.getElementById('status-select-btn');
    const dropdown = dropdownToggle?.parentElement;

    if (dropdownToggle && dropdown) {
        dropdownToggle.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdown.classList.toggle('show');
            dropdownToggle.setAttribute('aria-expanded', dropdown.classList.contains('show'));
        });

        const dropdownMenu = dropdown.querySelector('.dropdown-menu-status');
        dropdownMenu.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        document.addEventListener('click', function () {
            dropdown.classList.remove('show');
            dropdownToggle.setAttribute('aria-expanded', 'false');
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('ngayThiFilter');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr[data-ngaythi]');
    const noResultRow = document.createElement('tr');
    noResultRow.innerHTML = `<td colspan="6" class="text-center">Không có kết quả thi trong ngày đã chọn.</td>`;
    noResultRow.id = 'noResultRow';

    dateInput.addEventListener('change', function () {
        const selectedDate = this.value;
        let visibleCount = 0;

        // Xoá dòng thông báo nếu đã tồn tại
        const oldRow = document.getElementById('noResultRow');
        if (oldRow) oldRow.remove();

        rows.forEach(row => {
            const rowDate = row.getAttribute('data-ngaythi');
            const match = selectedDate === '' || rowDate === selectedDate;
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        if (visibleCount === 0) {
            tableBody.appendChild(noResultRow);
        }
    });
});
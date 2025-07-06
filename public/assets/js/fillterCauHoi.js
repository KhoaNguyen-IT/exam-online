document.addEventListener('DOMContentLoaded', function () {
    const chuongSelect = document.getElementById('chuongFilter'); // Thay đổi ở đây
    const doKhoSelect = document.getElementById('doKhoFilter');
    const ngayTaoInput = document.getElementById('ngayTaoFilter');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr[data-dokho]');
    const noResultRow = document.createElement('tr');
    noResultRow.innerHTML = `<td colspan="5" class="text-center">Không có kết quả phù hợp.</td>`;
    noResultRow.id = 'noResultRow';

    function filterRows() {
        const selectedChuong = chuongSelect.value.toLowerCase(); // Lọc theo chương
        const selectedDoKho = doKhoSelect.value.toLowerCase();
        const selectedNgayTao = ngayTaoInput.value;

        let visibleCount = 0;

        const oldRow = document.getElementById('noResultRow');
        if (oldRow) oldRow.remove();

        rows.forEach(row => {
            const rowDoKho = row.dataset.dokho;
            const rowNgayTao = row.dataset.ngaytao;
            const rowChuong = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Lấy chương

            const matchChuong = !selectedChuong || rowChuong === selectedChuong;
            const matchDoKho = !selectedDoKho || rowDoKho === selectedDoKho;
            const matchNgayTao = !selectedNgayTao || rowNgayTao === selectedNgayTao;

            const match = matchChuong && matchDoKho && matchNgayTao;
            row.style.display = match ? '' : 'none';

            if (match) visibleCount++;
        });

        if (visibleCount === 0) {
            tableBody.appendChild(noResultRow);
        }
    }

    // Gán sự kiện lọc
    chuongSelect.addEventListener('change', filterRows);
    doKhoSelect.addEventListener('change', filterRows);
    ngayTaoInput.addEventListener('change', filterRows);
});
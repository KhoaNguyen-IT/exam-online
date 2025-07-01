document.addEventListener('DOMContentLoaded', function () {
    const nguoiTaoInput = document.getElementById('nguoiTaoFilter');
    const doKhoSelect = document.getElementById('doKhoFilter');
    const ngayTaoInput = document.getElementById('ngayTaoFilter');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr[data-dokho]');
    const noResultRow = document.createElement('tr');
    noResultRow.innerHTML = `<td colspan="5" class="text-center">Không có kết quả phù hợp.</td>`;
    noResultRow.id = 'noResultRow';

    function filterRows() {
        const keywordNguoiTao = nguoiTaoInput.value.toLowerCase();
        const selectedDoKho = doKhoSelect.value;
        const selectedNgayTao = ngayTaoInput.value;

        let visibleCount = 0;

        const oldRow = document.getElementById('noResultRow');
        if (oldRow) oldRow.remove();

        rows.forEach(row => {
            const rowDoKho = row.dataset.dokho;
            const rowNgayTao = row.dataset.ngaytao;
            const rowNguoiTao = row.dataset.nguoitao;

            const matchDoKho = !selectedDoKho || rowDoKho === selectedDoKho;
            const matchNgayTao = !selectedNgayTao || rowNgayTao === selectedNgayTao;
            const matchNguoiTao = !keywordNguoiTao || rowNguoiTao.includes(keywordNguoiTao);

            const match = matchDoKho && matchNgayTao && matchNguoiTao;
            row.style.display = match ? '' : 'none';

            if (match) visibleCount++;
        });

        if (visibleCount === 0) {
            tableBody.appendChild(noResultRow);
        }
    }

    nguoiTaoInput.addEventListener('input', filterRows);
    doKhoSelect.addEventListener('change', filterRows);
    ngayTaoInput.addEventListener('change', filterRows);
});
document.addEventListener('DOMContentLoaded', function () {
    const keywordInput = document.getElementById('keywordFilter');
    const ngayTaoInput = document.getElementById('ngayTaoFilter');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr[data-tendt]');

    const noResultRow = document.createElement('tr');
    noResultRow.id = 'noResultRow';
    noResultRow.innerHTML = `<td colspan="4" class="text-center">Không có kết quả phù hợp.</td>`;

    function filterRows() {
        const keyword = keywordInput.value.toLowerCase().trim();
        const selectedNgayTao = ngayTaoInput.value;
        let visible = 0;

        // Xóa dòng không kết quả cũ nếu có
        const oldRow = document.getElementById('noResultRow');
        if (oldRow) oldRow.remove();

        rows.forEach(row => {
            const tenDT = row.dataset.tendt?.toLowerCase() || '';
            const monHoc = row.dataset.monhoc?.toLowerCase() || '';
            const ngayTao = row.dataset.ngaytao || '';

            const matchKeyword = !keyword || tenDT.includes(keyword) || monHoc.includes(keyword);
            const matchNgayTao = !selectedNgayTao || ngayTao === selectedNgayTao;

            const isMatch = matchKeyword && matchNgayTao;
            row.style.display = isMatch ? '' : 'none';

            if (isMatch) visible++;
        });

        // Thêm dòng không có kết quả nếu cần
        if (visible === 0) {
            tableBody.appendChild(noResultRow);
        }
    }

    keywordInput.addEventListener('input', filterRows);
    ngayTaoInput.addEventListener('change', filterRows);
});
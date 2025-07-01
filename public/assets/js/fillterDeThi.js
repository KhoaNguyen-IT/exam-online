document.addEventListener('DOMContentLoaded', function () {
    const keywordInput = document.getElementById('keywordFilter');
    const ngayTaoInput = document.getElementById('ngayTaoFilter');
    const rows = document.querySelectorAll('#tableBody tr[data-tendt]');

    const noResultRow = document.createElement('tr');
    noResultRow.id = 'noResultRow';
    noResultRow.innerHTML = `<td colspan="5" class="text-center">Không có kết quả phù hợp.</td>`;

    function filterRows() {
        const keyword = keywordInput.value.toLowerCase();
        const selectedNgayTao = ngayTaoInput.value;
        let visible = 0;

        // Xóa hàng "Không có kết quả" cũ
        const oldRow = document.getElementById('noResultRow');
        if (oldRow) oldRow.remove();

        rows.forEach(row => {
            const tenDT = row.dataset.tendt;
            const monHoc = row.dataset.monhoc;
            const ngayTao = row.dataset.ngaytao;

            const matchKeyword = !keyword || tenDT.includes(keyword) || monHoc.includes(keyword);
            const matchNgayTao = !selectedNgayTao || ngayTao === selectedNgayTao;

            const isMatch = matchKeyword && matchNgayTao;
            row.style.display = isMatch ? '' : 'none';

            if (isMatch) visible++;
        });

        if (visible === 0) {
            document.getElementById('tableBody').appendChild(noResultRow);
        }
    }

    keywordInput.addEventListener('input', filterRows);
    ngayTaoInput.addEventListener('change', filterRows);
});
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr');
    const noResultRow = document.createElement('tr');
    noResultRow.innerHTML = `<td colspan="3" class="text-center">Không có kết quả phù hợp.</td>`;
    noResultRow.id = 'noResultRow';

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const tenMH = row.querySelector('.ten-mh')?.textContent.toLowerCase() || '';
            const match = tenMH.includes(keyword);

            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        // Hiện hoặc ẩn dòng "Không có kết quả phù hợp"
        if (visibleCount === 0) {
            if (!document.getElementById('noResultRow')) {
                tableBody.appendChild(noResultRow);
            }
        } else {
            const existing = document.getElementById('noResultRow');
            if (existing) existing.remove();
        }
    });
});
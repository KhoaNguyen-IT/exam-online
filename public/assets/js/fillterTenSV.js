document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr');
    const noResultRow = document.createElement('tr');
    noResultRow.id = 'noResultRow';
    noResultRow.innerHTML = `<td colspan="4" class="text-center">Không có kết quả phù hợp.</td>`;

    input.addEventListener('keyup', function () {
        const keyword = input.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const nameCell = row.querySelector('.ho-ten');
            if (!nameCell) return;

            const name = nameCell.textContent.toLowerCase();
            const match = name.includes(keyword);

            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        if (visibleCount === 0) {
            if (!document.getElementById('noResultRow')) {
                tableBody.appendChild(noResultRow);
            }
        } else {
            const noRow = document.getElementById('noResultRow');
            if (noRow) noRow.remove();
        }
    });
});
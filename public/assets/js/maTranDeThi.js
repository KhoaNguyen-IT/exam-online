document.addEventListener('DOMContentLoaded', function () {
    const monHocSelect = document.getElementById('monHocSelect');
    const chuongRows = document.querySelectorAll('.chuong-row');
    const matrixInputs = document.querySelectorAll('.matrix-input');
    const tongCauHoiValue = document.getElementById('tongCauHoiValue');

    function toggleChuongByMonHoc(maMH) {
        chuongRows.forEach(row => {
            if (row.dataset.mamh === maMH) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
                row.querySelectorAll('input[type="number"]').forEach(input => input.value = 0);
                row.querySelector('.total-count').textContent = '0';
            }
        });
    }

    function updateRowTotal(row) {
        const inputs = row.querySelectorAll('.matrix-input');
        let rowTotal = 0;
        inputs.forEach(i => rowTotal += parseInt(i.value || 0));
        row.querySelector('.total-count').textContent = rowTotal;
    }

    function updateAllRowTotal() {
        chuongRows.forEach(row => {
            if (row.style.display !== 'none') {
                updateRowTotal(row);
            }
        });
    }

    function updateTongCauHoi() {
        let sum = 0;
        document.querySelectorAll('.total-count').forEach(span => {
            sum += parseInt(span.textContent || 0);
        });
        if (tongCauHoiValue) {
            tongCauHoiValue.textContent = sum;
        }
    }

    if (monHocSelect) {
        monHocSelect.addEventListener('change', function () {
            toggleChuongByMonHoc(this.value);
            updateAllRowTotal();
            updateTongCauHoi();
        });

        if (monHocSelect.value) {
            toggleChuongByMonHoc(monHocSelect.value);
        }
    }

    matrixInputs.forEach(input => {
        input.addEventListener('input', function () {
            const row = input.closest('tr');
            updateRowTotal(row);
            updateTongCauHoi();
        });
    });

    updateAllRowTotal();
    updateTongCauHoi();
});
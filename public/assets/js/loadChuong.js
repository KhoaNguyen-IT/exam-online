document.addEventListener('DOMContentLoaded', function () {
    const monHocSelect = document.getElementById('maMonHoc');
    const chuongSelect = document.getElementById('maChuong');
    const allChuongOptions = Array.from(chuongSelect.options);

    function filterChuongOptions(maMonHoc) {
        // Xoá tất cả options hiện tại
        chuongSelect.innerHTML = '';

        // Thêm lại các option phù hợp
        const filtered = allChuongOptions.filter(opt => opt.dataset.mamh == maMonHoc);
        filtered.forEach(opt => chuongSelect.appendChild(opt));
    }

    // Gọi khi load lại trang (giữ selected nếu đã chọn)
    const selectedMaMonHoc = monHocSelect.value;
    if (selectedMaMonHoc) {
        filterChuongOptions(selectedMaMonHoc);
    } else {
        chuongSelect.innerHTML = '<option value="">-- Chọn chương --</option>';
    }

    // Gọi khi người dùng thay đổi môn học
    monHocSelect.addEventListener('change', function () {
        const selectedValue = this.value;
        if (selectedValue) {
            filterChuongOptions(selectedValue);
        } else {
            chuongSelect.innerHTML = '<option value="">-- Chọn chương --</option>';
        }
    });
});
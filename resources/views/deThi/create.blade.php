@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid" style="margin-top: 5%;">
            @include('layout.noice')

            <div class="card">
                <div class="card-body">
                    <!-- Tiêu đề + Quay lại -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">{{ $viewData['title'] }}</h4>
                        <a href="{{ route('dethi.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>

                    <!-- Form tạo đề thi -->
                    <form action="{{ route('dethi.store') }}" method="POST">
                        @csrf

                        <!-- Thông tin chung -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><strong>Tên đề thi</strong></label>
                                <input type="text" name="tenDT" class="form-control" required value="{{ old('tenDT') }}">
                            </div>
                            <div class="col-md-3">
                                <label><strong>Thời lượng (phút)</strong></label>
                                <input type="number" name="thoiLuong" class="form-control" min="1" required
                                    value="{{ old('thoiLuong') }}">
                            </div>
                            <div class="col-md-3">
                                <label><strong>Số câu hỏi</strong></label>
                                <input type="number" name="soLuong" class="form-control" min="1" required
                                    value="{{ old('soLuong') }}">
                            </div>
                        </div>

                        <!-- Môn học -->
                        <div class="mb-3">
                            <label><strong>Môn học</strong></label>
                            <select name="monHoc" id="monHocSelect" class="form-select" required>
                                <option value="">-- Chọn môn học --</option>
                                @foreach($viewData['monHoc'] as $mh)
                                    <option value="{{ $mh->maMH }}" {{ old('monHoc') == $mh->maMH ? 'selected' : '' }}>
                                        {{ $mh->tenMH }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Danh sách chương (ẩn/hiện theo môn học) -->
                        <div class="mb-3">
                            <label><strong>Chọn các chương</strong></label>
                            <div class="row">
                                @foreach($viewData['chuong'] as $chuong)
                                    <div class="col-md-4 chuong-item" data-mamh="{{ $chuong->maMH }}" style="display: none;">
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chuong_ids[]" value="{{ $chuong->maChuong }}"
                                            id="chuong{{ $chuong->maChuong }}" {{ in_array($chuong->maChuong, old('chuong_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="chuong{{ $chuong->maChuong }}">
                                                {{ $chuong->tenChuong }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label><strong>Mô tả</strong></label>
                            <textarea name="moTa" class="form-control" rows="3">{{ old('moTa') }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Lưu đề thi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monHocSelect = document.getElementById('monHocSelect');
        const chuongItems = document.querySelectorAll('.chuong-item');

        monHocSelect.addEventListener('change', function () {
            const selectedMaMH = this.value;
            chuongItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                if (item.dataset.mamh === selectedMaMH) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                    checkbox.checked = false;
                }
            });
        });

        // Hiển thị lại chương đã chọn nếu có old input
        if (monHocSelect.value) {
            const selectedMaMH = monHocSelect.value;
            chuongItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                if (item.dataset.mamh === selectedMaMH) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    });
</script>
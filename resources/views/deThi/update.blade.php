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

                <!-- Form cập nhật đề thi -->
                <form action="{{ route('dethi.update', $viewData['deThi']->maDT) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Thông tin chung -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><strong>Tên đề thi</strong></label>
                            <input type="text" name="tenDT" class="form-control" required
                                   value="{{ old('tenDT', $viewData['deThi']->tenDT) }}">
                        </div>
                        <div class="col-md-3">
                            <label><strong>Thời lượng (phút)</strong></label>
                            <input type="number" name="thoiLuong" class="form-control" min="1" required
                                   value="{{ old('thoiLuong', $viewData['deThi']->thoiLuongPhut) }}">
                        </div>
                        <div class="col-md-3">
                            <label><strong>Số câu hỏi cần lấy</strong></label>
                            <input type="number" name="soLuong" class="form-control" min="1" required
                                   value="{{ old('soLuong', $viewData['cauHoiTrongDe']->count()) }}">
                        </div>
                    </div>

                    <!-- Môn học -->
                    <div class="mb-3">
                        <label><strong>Môn học</strong></label>
                        <select name="monHoc" id="monHocSelect" class="form-select" required>
                            <option value="">-- Chọn môn học --</option>
                            @foreach($viewData['monHoc'] as $mh)
                                <option value="{{ $mh->maMH }}"
                                    {{ $mh->maMH == $viewData['deThi']->maMH ? 'selected' : '' }}>
                                    {{ $mh->tenMH }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Danh sách chương -->
                    <div class="mb-3">
                        <label><strong>Chọn các chương</strong></label>
                        <div class="row">
                            @php
                                $selectedChuongIds = \App\Models\CauHoi::whereIn(
                                    'maCH',
                                    $viewData['cauHoiTrongDe']->pluck('maCH')->toArray()
                                )->pluck('maChuong')->unique()->toArray();
                                $chuongList = \App\Models\Chuong::all();
                            @endphp
                            @foreach($chuongList as $chuong)
                                <div class="col-md-4 chuong-item" data-mamh="{{ $chuong->maMH }}">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chuong_ids[]"
                                            value="{{ $chuong->maChuong }}"
                                            id="chuong{{ $chuong->maChuong }}"
                                            {{ in_array($chuong->maChuong, old('chuong_ids', $selectedChuongIds)) ? 'checked' : '' }}>
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
                        <textarea name="moTa" class="form-control" rows="3">{{ old('moTa', $viewData['deThi']->moTa) }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Cập nhật đề thi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript: ẩn/hiện chương theo môn -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monHocSelect = document.getElementById('monHocSelect');
        const chuongItems = document.querySelectorAll('.chuong-item');

        function updateChuongVisibility() {
            const selectedMaMH = monHocSelect.value;
            chuongItems.forEach(item => {
                item.style.display = (item.dataset.mamh === selectedMaMH) ? 'block' : 'none';
                if (item.style.display === 'none') {
                    item.querySelector('input[type="checkbox"]').checked = false;
                }
            });
        }

        monHocSelect.addEventListener('change', updateChuongVisibility);
        updateChuongVisibility();
    });
</script>
@endsection
@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                            <div class="d-md-flex align-items-center justify-content-between mb-3">
                                <h4 class="card-title">{{ $viewData['title'] }}</h4>
                                <div>
                                    <a href="{{ route('kythi.index') }}" class="btn btn-secondary">Quay lại</a>
                                </div>
                            </div>
                                @include('layout.noice')

                                <form action="{{ route('kythi.update', $viewData['kyThi']->getMaKT()) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Tên kỳ thi --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="tenKT" class="me-0 mb-0" style="min-width: 120px;">
                                                <strong>Tên kỳ thi:</strong>
                                            </label>
                                            <input type="text" id="tenKT" name="tenKT" class="form-control"
                                                value="{{ old('tenKT', $viewData['kyThi']->getTenKT()) }}" required>
                                        </div>
                                    </div>

                                    {{-- Ngày & giờ thi --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="ngayThi" class="me-0 mb-0" style="min-width: 120px;">
                                                <strong>Ngày & giờ thi:</strong>
                                            </label>
                                            <input type="date" id="ngayThi" name="ngayThi" class="form-control me-2"
                                                value="{{ old('ngayThi', \Carbon\Carbon::parse($viewData['kyThi']->getNgayThi())->format('Y-m-d')) }}" required>
                                            <input type="time" id="thoiGianThi" name="thoiGianThi" class="form-control"
                                                value="{{ old('thoiGianThi', \Carbon\Carbon::parse($viewData['kyThi']->getNgayThi())->format('H:i')) }}" required>
                                        </div>
                                    </div>

                                    {{-- Chọn môn học --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label for="monHocSelect" class="mb-2"><strong>Chọn môn học:</strong></label>
                                            <select id="monHocSelect" name="monHocSelect" class="form-select">
                                                <option value="">-- Chọn môn học --</option>
                                                @foreach($viewData['monHocList'] as $mon)
                                                    <option value="{{ $mon->maMH }}"
                                                        {{ old('monHocSelect') == $mon->maMH ? 'selected' : '' }}>
                                                        {{ $mon->tenMH }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Danh sách đề thi --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label class="mb-2"><strong>Chọn đề thi:</strong></label>
                                            <div class="row" id="deThiByMonHoc"></div>
                                        </div>
                                    </div>

                                    {{-- Danh sách sinh viên --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label class="mb-2"><strong>Danh sách sinh viên tham gia:</strong></label>
                                            <div class="row">
                                                @foreach($viewData['sinhVienSelectedObjects'] as $sv)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="border rounded p-2">
                                                            <strong>{{ $sv->hoTen }}</strong><br>
                                                            <small>{{ $sv->email }}</small>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Mô tả --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="moTa" class="me-0 mb-0" style="min-width: 120px;">
                                                <strong>Mô tả:</strong>
                                            </label>
                                            <textarea id="moTa" name="moTa"
                                                class="form-control">{{ old('moTa', $viewData['kyThi']->getMoTa()) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="mt-4 ms-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monHocSelect = document.getElementById('monHocSelect');
        const deThiContainer = document.getElementById('deThiByMonHoc');

        // Dữ liệu từ Laravel
        const allDeThi = @json($viewData['deThi']); // Toàn bộ đề thi
        const checkedDeThiIds = @json(old('de_thi_ids', $viewData['deThiList'] ?? [])); // Các đề thi đã chọn trước đó

        // Hiển thị đề thi theo môn học
        function renderDeThiByMonHoc(maMH) {
            deThiContainer.innerHTML = ''; // Reset danh sách

            if (!maMH) {
                deThiContainer.innerHTML = `<div class="text-center ms-3">Vui lòng chọn môn học.</div>`;
                return;
            }

            const filtered = allDeThi.filter(deThi => String(deThi.maMH) === String(maMH));

            if (filtered.length === 0) {
                deThiContainer.innerHTML = `<div class="text-center ms-3">Không có đề thi nào cho môn học này.</div>`;
                return;
            }

            filtered.forEach(deThi => {
                const isChecked = checkedDeThiIds.includes(deThi.maDT) || checkedDeThiIds.includes(String(deThi.maDT));
                const html = `
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                name="de_thi_ids[]"
                                value="${deThi.maDT}"
                                id="deThi${deThi.maDT}"
                                ${isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="deThi${deThi.maDT}">
                                ${deThi.tenDT}
                            </label>
                        </div>
                    </div>`;
                deThiContainer.insertAdjacentHTML('beforeend', html);
            });
        }

        // Khi chọn môn học
        monHocSelect.addEventListener('change', function () {
            const selectedMaMH = this.value;
            renderDeThiByMonHoc(selectedMaMH);
        });

        // Nếu có đề thi đã chọn => tự động chọn môn học tương ứng và render
        if (checkedDeThiIds.length > 0) {
            const firstCheckedDeThi = allDeThi.find(deThi => checkedDeThiIds.includes(deThi.maDT) || checkedDeThiIds.includes(String(deThi.maDT)));
            if (firstCheckedDeThi) {
                monHocSelect.value = firstCheckedDeThi.maMH;
                renderDeThiByMonHoc(firstCheckedDeThi.maMH);
            }
        } else {
            // Nếu không có đề thi nào được chọn, nhưng môn học đang được chọn sẵn thì render theo đó
            const selectedMaMH = monHocSelect.value;
            if (selectedMaMH) {
                renderDeThiByMonHoc(selectedMaMH);
            }
        }
    });
</script>

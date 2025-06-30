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

                                <form action="{{ route('kythi.store') }}" method="POST" class="form-horizontal"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- Tên kỳ thi --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="tenKT" class="me-0 mb-0" style="min-width: 120px;">
                                                <strong>Tên kỳ thi:</strong>
                                            </label>
                                            <input type="text" id="tenKT" name="tenKT" class="form-control"
                                                value="{{ old('tenKT') }}" required>
                                        </div>
                                    </div>

                                    {{-- Ngày & giờ thi --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="ngayThi" class="me-0 mb-0" style="min-width: 120px;">
                                                <strong>Ngày & giờ thi:</strong>
                                            </label>
                                            <input type="date" id="ngayThi" name="ngayThi" class="form-control me-2"
                                                value="{{ old('ngayThi') }}" required>
                                            <input type="time" id="thoiGianThi" name="thoiGianThi" class="form-control"
                                                value="{{ old('thoiGianThi') }}" required>
                                        </div>
                                    </div>

                                    {{-- Chọn môn học --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label for="monHocSelect" class="mb-2"><strong>Chọn môn học:</strong></label>
                                            <select id="monHocSelect" name="monHocSelect" class="form-select">
                                                <option value="">-- Chọn môn học --</option>
                                                @foreach($viewData['monHocList'] as $mon)
                                                    <option value="{{ $mon->maMH }}" {{ old('monHocSelect') == $mon->maMH ? 'selected' : '' }}>
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

                                    {{-- Import danh sách sinh viên --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label class="mb-2"><strong>Import danh sách sinh viên:</strong></label>
                                            <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls"
                                                required>
                                            @if(session('import_error'))
                                                <div class="alert alert-danger mt-2">
                                                    {{ session('import_error') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- Mô tả --}}
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="moTa" class="me-0 mb-0" style="min-width: 120px;">
                                                <strong>Mô tả:</strong>
                                            </label>
                                            <textarea id="moTa" name="moTa"
                                                class="form-control">{{ old('moTa') }}</textarea>
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

        const allDeThi = @json($viewData['deThi']);
        const oldChecked = @json(old('de_thi_ids', []));

        function renderDeThiByMonHoc(maMH) {
            deThiContainer.innerHTML = '';

            if (!maMH) return;

            const filtered = allDeThi.filter(dt => dt.maMH == maMH);

            if (filtered.length === 0) {
                deThiContainer.innerHTML = `<div class="text-danger text-center ms-3">Không có đề thi nào cho môn học này.</div>`;
                return;
            }

            filtered.forEach(deThi => {
                const checked = oldChecked.includes(String(deThi.maDT)) ? 'checked' : '';
                const html = `
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="de_thi_ids[]"
                                   value="${deThi.maDT}"
                                   id="deThi${deThi.maDT}" ${checked}>
                            <label class="form-check-label" for="deThi${deThi.maDT}">
                                ${deThi.tenDT}
                            </label>
                        </div>
                    </div>`;
                deThiContainer.insertAdjacentHTML('beforeend', html);
            });
        }

        monHocSelect.addEventListener('change', () => {
            renderDeThiByMonHoc(monHocSelect.value);
        });

        // Auto render lại nếu old() tồn tại
        if (monHocSelect.value) {
            renderDeThiByMonHoc(monHocSelect.value);
        }
    });
</script>
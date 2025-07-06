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
                                <small id="tongCauHoiText" class="text-muted">
                                    Tổng số câu đã chọn trong ma trận: <span id="tongCauHoiValue">0</span>
                                </small>
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

                        <!-- Bảng chọn số câu hỏi theo chương và độ khó -->
                        <div class="mb-3">
                            <label><strong>Ma trận</strong></label>
                            <div class="table-responsive">
                                <table class="table table-striped align-middle" id="maTranTable">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Chương</th>
                                            <th>Dễ</th>
                                            <th>Trung Bình</th>
                                            <th>Khó</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="chuongMatrixBody">
                                        @foreach($viewData['chuong'] as $chuong)
                                            <tr class="chuong-row" data-mamh="{{ $chuong->maMH }}" style="display: none;">
                                                <td class="text-start">
                                                    <input type="hidden" name="chuong_ids[]" value="{{ $chuong->maChuong }}">
                                                    {{ $chuong->tenChuong }}
                                                </td>
                                                @foreach(['de' => 'Dễ', 'trung_binh' => 'Trung Bình', 'kho' => 'Khó'] as $levelKey => $label)
                                                    <td class="text-center">
                                                        <input type="number" name="matrix[{{ $chuong->maChuong }}][{{ $levelKey }}]"
                                                            class="form-control matrix-input text-end"
                                                            value="{{ old("matrix.{$chuong->maChuong}.{$levelKey}", 0) }}" min="0">
                                                    </td>
                                                @endforeach
                                                <td class="text-center">
                                                    <span class="total-count fw-bold text-primary">0</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label><strong>Mô tả</strong></label>
                            <textarea name="moTa" class="form-control" rows="3">{{ old('moTa') }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
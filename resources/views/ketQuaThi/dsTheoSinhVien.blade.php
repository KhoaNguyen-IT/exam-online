@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">
            @include('layout.noice')

            <!-- Tiêu đề + Nút quay lại -->
            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">
                    {{ $viewData['title'] }}: {{ $viewData['sinhVien']->hoTen }}
                </h4>
                <a href="{{ route('ketquathi.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>

            <!-- Ô lọc theo ngày thi -->
            <div class="mb-3">
                <input type="date" id="ngayThiFilter" class="form-control" placeholder="Lọc theo ngày thi">
            </div>

            <!-- Bảng kết quả -->
            <div class="table-responsive">
                <table class="table table-striped align-middle" id="ketQuaTable">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên đề thi</th>
                            <th>Điểm số</th>
                            <th>Tổng câu</th>
                            <th>Câu đúng</th>
                            <th>Ngày thi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['ketQuaThi'] as $index => $ketQua)
                            <tr data-ngaythi="{{ \Carbon\Carbon::parse($ketQua->ngayThi)->format('Y-m-d') }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ketQua->deThi->tenDT }}</td>
                                <td>{{ $ketQua->diemSo }}</td>
                                <td>{{ $ketQua->tongSoCau }}</td>
                                <td>{{ $ketQua->soCauDung }}</td>
                                <td>{{ \Carbon\Carbon::parse($ketQua->ngayThi)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr id="noResult">
                                <td colspan="6" class="text-center text-danger">
                                    Sinh viên chưa có kết quả thi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
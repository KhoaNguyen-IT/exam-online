@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">
            <div class="d-md-flex align-items-center justify-content-between">
                <h4 class="card-title">Danh sách đề thi - {{ $viewData['giangVien']->hoTen }}</h4>
                <div>
                    <a href="{{ route('dethi.index') }}" class="btn btn-secondary mb-1">Quay lại</a>
                </div>
            </div>

            <!-- Bộ lọc -->
            <div class="row mb-4 mt-3">
                <div class="col-md-6 mb-2">
                    <input type="text" id="keywordFilter" class="form-control"
                        placeholder="Tìm kiếm...">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="date" id="ngayTaoFilter" class="form-control">
                </div>
            </div>

            <div class="table-responsive">
                @include('layout.noice')
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên đề thi</th>
                            <th>Môn học</th>
                            <th>Thời lượng</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['deThi'] as $deThi)
                            <tr data-tendt="{{ strtolower($deThi->tenDT) }}"
                                data-monhoc="{{ strtolower($deThi->monHoc->tenMH ?? '') }}"
                                data-ngaytao="{{ \Carbon\Carbon::parse($deThi->ngayTao)->format('Y-m-d') }}">
                                <td>{{ $deThi->tenDT }}</td>
                                <td>{{ $deThi->monHoc->tenMH ?? 'Không xác định' }}</td>
                                <td>{{ $deThi->thoiLuongPhut }} phút</td>
                                <td>{{ \Carbon\Carbon::parse($deThi->ngayTao)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('dethi.show', $deThi->maDT) }}" class="btn btn-primary btn-sm">Xem</a>
                                    <a href="{{ route('dethi.edit', $deThi->maDT) }}" class="btn btn-warning btn-sm">Sửa</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có đề thi nào do giảng viên này tạo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
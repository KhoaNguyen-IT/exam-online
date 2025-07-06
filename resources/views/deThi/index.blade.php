@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">
            @include('layout.noice')

            <!-- Tiêu đề + hành động -->
            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">Danh sách đề thi của bạn</h4>
                <div>
                    <a href="{{ route('dethi.create') }}" class="btn btn-success">Tạo đề thi</a>
                </div>
            </div>

            <!-- Bộ lọc -->
            <div class="row mb-3">
                <div class="col-md-4 mb-2 mb-md-0">
                    <input type="text" id="keywordFilter" class="form-control" placeholder="Tìm theo tên đề thi...">
                </div>
                <div class="col-md-4 mb-2 mb-md-0">
                    <input type="date" id="ngayTaoFilter" class="form-control" placeholder="Lọc theo ngày tạo">
                </div>
                <div class="col-md-4">  
                    <select id="monHocFilter" class="form-select">
                        <option value="">-- Lọc theo môn học --</option>
                        @foreach($viewData['deThi']->pluck('monHoc.tenMH')->unique() as $tenMH)
                            <option value="{{ $tenMH }}">{{ $tenMH }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Bảng dữ liệu -->
            <div class="table-responsive">
                <table class="table table-striped align-middle" id="deThiTable">
                    <thead class="table-light">
                        <tr>
                            <th>Tên đề thi</th>
                            <th>Môn học</th>
                            <th>Ngày tạo</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['deThi'] as $deThi)
                            <tr data-tendt="{{ strtolower($deThi->tenDT) }}"
                                data-monhoc="{{ strtolower($deThi->monHoc->tenMH ?? '') }}"
                                data-ngaytao="{{ \Carbon\Carbon::parse($deThi->ngayTao)->format('Y-m-d') }}">
                                <td>{{ $deThi->tenDT }}</td>
                                <td>{{ $deThi->monHoc->tenMH ?? 'Chưa gán' }}</td>
                                <td>{{ \Carbon\Carbon::parse($deThi->ngayTao)->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('dethi.show', ['id' => $deThi->maDT]) }}"
                                        class="btn btn-primary btn-sm">Xem</a>
                                    <a href="{{ route('dethi.edit', ['id' => $deThi->maDT]) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                </td>
                            </tr>
                        @empty
                            <tr id="noResult">
                                <td colspan="4" class="text-center">Không có đề thi nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
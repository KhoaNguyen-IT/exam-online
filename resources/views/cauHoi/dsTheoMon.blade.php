@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@include('cauHoi.import')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">
            <!-- Tiêu đề + hành động -->
            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">Danh sách câu hỏi - {{ $viewData['monHocChon']->tenMH }}</h4>
                <div>
                    <a href="{{ route('cauhoi.index') }}" class="btn btn-secondary mb-1">Quay lại</a>
                    <a href="{{ route('cauhoi.exportExcel') }}" class="btn btn-success m-1">Xuất file định dạng</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-success m-1">Nhập câu
                        hỏi</a>
                    <a href="{{ route('cauhoi.create', ['maMH' => $viewData['monHocChon']->maMH]) }}"
                        class="btn btn-success m-1">Tạo mới</a>
                </div>
            </div>

            <!-- Bộ lọc -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <select id="chuongFilter" class="form-select">
                        <option value="">-- Lọc theo chương --</option>
                        @foreach($viewData['chuongList'] as $chuong)
                            <option value="{{ $chuong->getTenChuong() }}">{{ $chuong->getTenChuong() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="doKhoFilter" class="form-select">
                        <option value="">-- Lọc theo độ khó --</option>
                        <option value="dễ">Dễ</option>
                        <option value="trung bình">Trung bình</option>
                        <option value="khó">Khó</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" id="ngayTaoFilter" class="form-control" placeholder="Lọc theo ngày tạo">
                </div>
            </div>

            <!-- Bảng dữ liệu -->
            <div class="table-responsive">
                @include('layout.noice')
                <table class="table table-striped align-middle" id="cauHoiTable">
                    <thead class="table-light">
                        <tr>
                            <th>Nội dung</th>
                            <th>Độ khó</th>
                            <th>Chương</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['cauHoi'] as $cauHoi)
                            <tr data-dokho="{{ strtolower($cauHoi->getDoKho()) }}"
                                data-ngaytao="{{ \Carbon\Carbon::parse($cauHoi->ngayTao)->format('Y-m-d') }}"
                                data-nguoitao="{{ strtolower($cauHoi->taiKhoan->hoTen) }}">
                                <td>{{ $cauHoi->getNoiDung() }}</td>
                                <td>{{ ucfirst($cauHoi->getDoKho()) }}</td>
                                <td>{{ $cauHoi->chuong->getTenChuong()}}</td>
                                <td>{{ \Carbon\Carbon::parse($cauHoi->ngayTao)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('cauhoi.show', ['id' => $cauHoi->maCH]) }}"
                                        class="btn btn-primary btn-sm">Xem</a>
                                    <a href="{{ route('cauhoi.edit', ['id' => $cauHoi->maCH]) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                </td>
                            </tr>
                        @empty
                            <tr id="noResult">
                                <td colspan="5" class="text-center">Không có câu hỏi nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">
            @include('layout.noice')

            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">{{ $viewData['title'] }}</h4>
                <a href="{{ route('ketQuaThi.exportExcel') }}" class="btn btn-success">Xuất danh sách</a>
            </div>

            <!-- Tìm kiếm tên sinh viên -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Tìm theo tên sinh viên...">
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle" id="sinhVienTable">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['sinhVienList'] as $index => $sinhVien)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="ho-ten">{{ $sinhVien->hoTen }}</td>
                                <td>{{ $sinhVien->email }}</td>
                                <td class="text-end">
                                    <a href="{{ route('ketquathi.index', ['maTK' => $sinhVien->maTK]) }}"
                                        class="btn btn-sm btn-primary">Xem kết quả</a>
                                </td>
                            </tr>
                        @empty
                            <tr id="noData">
                                <td colspan="4" class="text-center">Không có sinh viên nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
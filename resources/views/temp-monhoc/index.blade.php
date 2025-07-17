@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">
            @include('layout.noice')

            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">{{ $viewData['title'] }}</h4>
                <a href="{{ route('monhoc.create') }}" class="btn btn-success">Tạo mới</a>
            </div>

            <!-- Ô tìm kiếm -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Tìm tên môn học...">
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle" id="monHocTable">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên môn học</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['monHoc'] as $monHoc)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="ten-mh">{{ $monHoc->getTenMH() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('monhoc.show', ['id' => $monHoc->getMaMH()]) }}"
                                        class="btn btn-sm btn-primary">Xem</a>
                                    <a href="{{ route('monhoc.edit', ['id' => $monHoc->getMaMH()]) }}"
                                        class="btn btn-sm btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @empty
                            <tr id="noResult">
                                <td colspan="3" class="text-center">Không có môn học nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
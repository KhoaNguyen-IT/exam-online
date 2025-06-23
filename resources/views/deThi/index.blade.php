@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')

@section('content')
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
            <div class="container-fluid">
                @include('layout.noice')
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="card-title">{{ $viewData['title'] }}</h4>
                                    </div>
                                    <div>
                                        <a href="{{ route('dethi.create') }}" class="btn btn-success m-1">Tạo mới</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-0 text-muted">Tên đề thi</th>
                                                <th scope="col" class="px-0 text-muted">Người tạo</th>
                                                <th scope="col" class="px-0 text-muted">Thời lượng</th>
                                                <th scope="col" class="px-0 text-muted">Môn học</th>
                                                <th scope="col" class="px-0 text-muted">Ngày tạo</th>
                                                <th scope="col" class="px-0 text-muted text-end">Mô tả</th>
                                                <th scope="col" class="px-0 text-muted text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewData['deThi'] as $deThi)
                                                <tr>
                                                    <td class="px-0">{{ $deThi->getTenDT() }}</td>
                                                    <td class="px-0">{{ $deThi->taiKhoan->getHoten() }}</td>
                                                    <td class="px-0">{{ $deThi->getThoiLuongPhut() }} Phút</td>
                                                    <td class="px-0">{{ $deThi->monHoc->getTenMH() }}</td>
                                                    <td class="px-0">
                                                        {{ \Carbon\Carbon::parse($deThi->getNgayTao())->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-0 text-end">{{ $deThi->getMoTa() }}</td>
                                                    <td class="px-0 text-end">
                                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                                            <a href="{{ route('dethi.edit', ['id' => $deThi->getMaDT()]) }}" class="btn btn-warning">Sửa</a>
                                                            <a href="{{ route('dethi.show', ['id' => $deThi->getMaDT()]) }}"
                                                                class="btn btn-primary">Xem</a>
                                                        </div>
                                                    </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
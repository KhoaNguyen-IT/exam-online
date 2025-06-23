@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@include('cauHoi.import')
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
                                        <a href="{{ route('cauhoi.exportExcel') }}" class="btn btn-success m-1">Xuất danh
                                            sách mẫu</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#importModal"
                                            class="btn btn-success m-1">
                                            Nhập danh sách
                                        </a> <a href="{{ route('cauhoi.create') }}" class="btn btn-success m-1">Tạo mới</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-0 text-muted">Nội dung</th>
                                                <th scope="col" class="px-0 text-muted">Độ khó</th>
                                                <th scope="col" class="px-0 text-muted">Người tạo</th>
                                                <th scope="col" class="px-0 text-muted">Ngày tạo</th>
                                                <th scope="col" class="px-0 text-muted text-end">Môn học</th>
                                                <th scope="col" class="px-0 text-muted text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewData['cauHoi'] as $cauHoi)
                                                <tr>
                                                    <td class="px-0">{{ $cauHoi->getNoiDung() }}</td>
                                                    <td class="px-0">{{ $cauHoi->getDoKho() }}</td>
                                                    <td class="px-0">{{ $cauHoi->taiKhoan->hoTen }}</td>
                                                    <td class="px-0">
                                                        {{ \Carbon\Carbon::parse($cauHoi->ngayTao)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-0 text-end">{{ $cauHoi->monHoc->tenMH }}</td>
                                                    <td class="px-0 text-end">
                                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                                            <a href="{{ route('cauhoi.edit', ['id' => $cauHoi->maCH]) }}"
                                                                class="btn btn-warning">Sửa</a>
                                                            <a href="{{ route('cauhoi.show', ['id' => $cauHoi->maCH]) }}"
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
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
                                        <a href="{{ route('ketQuaThi.exportExcel') }}" class="btn btn-success m-1">Xuất</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-0 text-muted">Tên sinh viên</th>
                                                <th scope="col" class="px-0 text-muted">Tên đề thi</th>
                                                <th scope="col" class="px-0 text-muted">Điểm số</th>
                                                <th scope="col" class="px-0 text-muted">Tổng số câu</th>
                                                <th scope="col" class="px-0 text-muted">Số câu đúng</th>
                                                <th scope="col" class="px-0 text-muted text-end">Ngày thi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewData['ketQuaThi'] as $ketQua)
                                                <tr>
                                                    <td class="px-0">{{ $ketQua->taiKhoan->getHoTen() }}</td>
                                                    <td class="px-0">{{ $ketQua->deThi->getTenDT() }}</td>
                                                    <td class="px-0">{{ $ketQua->getDiemSo() }}</td>
                                                    <td class="px-0">{{ $ketQua->getTongSoCau() }}</td>
                                                    <td class="px-0">{{ $ketQua->getSoCauDung() }}</td>
                                                    <td class="px-0 text-end">
                                                        {{ \Carbon\Carbon::parse($ketQua->ngayThi)->format('d/m/Y') }}
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
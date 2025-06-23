@extends('layout.app')

@section('sidebar')
@include('layout.sidebarAdmin')

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
                                        </a> <a href="{{ route('taikhoan.create') }}" class="btn btn-success m-1">Tạo mới</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-0 text-muted">Họ và tên</th>
                                                <th scope="col" class="px-0 text-muted">Email</th>
                                                <th scope="col" class="px-0 text-muted">Vai trò</th>
                                                <th scope="col" class="px-0 text-muted text-end">Quyền</th>
                                                <th scope="col" class="px-0 text-muted text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewData['taiKhoan'] as $taiKhoan)
                                                <tr>
                                                    <td class="px-0">{{ $taiKhoan->getHoTen() }}</td>
                                                    <td class="px-0">{{ $taiKhoan->getEmail() }}</td>
                                                    <td class="px-0">
                                                        @php
                                                            $vaiTro = $taiKhoan->getVaiTro();
                                                            switch ($vaiTro) {
                                                                case 'quanTri':
                                                                    echo 'Quản trị viên';
                                                                    break;
                                                                case 'giangVien':
                                                                    echo 'Giảng viên';
                                                                    break;
                                                                case 'sinhVien':
                                                                    echo 'Sinh viên';
                                                                    break;
                                                                default:
                                                                    echo $vaiTro;
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td class="px-0 text-end">{{ $taiKhoan->getCapQuyen() }}</td>
                                                    <td class="px-0 text-end">
                                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                                            <a href="" class="btn btn-warning">Cấp quyền</a>
                                                            <a href="" class="btn btn-primary">Xem</a>
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
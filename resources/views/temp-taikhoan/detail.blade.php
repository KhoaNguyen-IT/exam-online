@extends('layout.app')

@section('sidebar')
@include('layout.sidebarAdmin')

@section('content')
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="card-title">{{ $viewData['title'] }}</h4>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <div class="ms-4">
                                        <span><strong>Email:</strong>
                                            {{ $viewData['taiKhoan']->getEmail() }}</span>
                                        <br>
                                        <span><strong>Họ tên:</strong>
                                            {{ $viewData['taiKhoan']->getHoTen() }}</span>
                                        <br>
                                        <span><strong>Vai trò:</strong>
                                            @php
                                                $vaiTro = $viewData['taiKhoan']->getVaiTro();
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
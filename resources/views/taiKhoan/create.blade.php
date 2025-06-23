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
                                @include('layout.noice')
                                <form action="{{ route('taikhoan.store') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="hoTen" class="me-0 mb-0" style="min-width: 120px;"><strong>Họ và tên:</strong></label>
                                            <input type="text" id="hoTen" name="hoTen" class="form-control"
                                                value="{{ old('hoTen') }}" required>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="email" class="me-0 mb-0" style="min-width: 120px;"><strong>Email:</strong></label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="matKhau" class="me-0 mb-0" style="min-width: 120px;"><strong>Mật khẩu:</strong></label>
                                            <input type="text" id="matKhau" name="matKhau" class="form-control"
                                                value="{{ old('matKhau') }}" required>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="vaiTro" class="me-0 mb-0" style="min-width: 120px;"><strong>Vai trò:</strong></label>
                                            <select id="vaiTro" name="vaiTro" class="form-select">
                                                <option value="giangVien" {{ old('vaiTro') == 'Giảng viên' ? 'selected' : '' }}>Giảng viên</option>
                                                <option value="sinhVien" {{ old('vaiTro') == 'Sinh viên' ? 'selected' : '' }}>Sinh viên</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-4 ms-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarAdmin')
@endsection

@section('content')
        <div class="body-wrapper">
            <div class="container-fluid mt-5">
                @include('layout.noice')

                <div class="d-md-flex align-items-center justify-content-between mb-3">
                    <h4 class="card-title">{{ $viewData['title'] }}</h4>
                    <a href="{{ route('taikhoan.create') }}" class="btn btn-success">Tạo mới</a>
                </div>

                <div class="table-responsive">
                <form action="{{ route('taiKhoan.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-end mb-3">
                    @csrf
                    <div class="me-2">
                        <label for="file" class="form-label">Nhập danh sách tài khoản:</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-0">Import</button>
                </form>
                </form>
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($viewData['taiKhoan'] as $taiKhoan)
                                <tr>
                                    <td>{{ $taiKhoan->getHoTen() }}</td>
                                    <td>{{ $taiKhoan->getEmail() }}</td>
                                    <td>
                                        @php
        switch ($taiKhoan->getVaiTro()) {
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
                echo $taiKhoan->getVaiTro();
        }
                                        @endphp
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('taikhoan.show', ['id' => $taiKhoan->getMaTK()]) }}"
                                            class="btn btn-sm btn-primary">Xem</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Không có tài khoản nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
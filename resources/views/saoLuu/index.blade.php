@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarAdmin')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">

            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">Sao lưu & Khôi phục dữ liệu</h4>
                <form action="{{ route('saoLuu.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Tạo bản sao lưu</button>
                </form>
            </div>

            @include('layout.noice')
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tên file</th>
                            <th>Kích thước</th>
                            <th>Ngày tạo</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $file)
                            <tr>
                                <td>{{ $file->getFilename() }}</td>
                                <td>{{ number_format($file->getSize() / 1024, 2) }} KB</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($file->getMTime())->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('saoLuu.download', $file->getFilename()) }}"
                                        class="btn btn-sm btn-primary">Tải về</a>
                                    <form action="{{ route('saoLuu.delete', $file->getFilename()) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Xác nhận xoá?')"
                                            class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Chưa có bản sao lưu nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
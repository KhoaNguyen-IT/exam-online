@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid mt-5">

            <div class="d-md-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title">{{ $viewData['title'] }}</h4>
                <div>
                    <a href="{{ route('kythi.exportExcel') }}" class="btn btn-success me-2">Xuất file định dạng</a>
                    <a href="{{ route('kythi.create') }}" class="btn btn-success">Tạo mới</a>
                </div>
            </div>

            <!-- Ô tìm kiếm -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Tìm tên kỳ thi...">
            </div>

            <!-- Bảng danh sách kỳ thi -->
            <div class="table-responsive">
                @include('layout.noice')
                <table class="table table-striped align-middle" id="kyThiTable">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên kỳ thi</th>
                            <th>Mô tả</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($viewData['kyThi'] as $kyThi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="ten-kt">{{ $kyThi->getTenKT() }}</td>
                                <td>{{ $kyThi->getMoTa() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('kythi.show', ['id' => $kyThi->getMaKT()]) }}"
                                        class="btn btn-sm btn-secondary">Kết quả</a>
                                    <a href="{{ route('kythi.show', ['id' => $kyThi->getMaKT()]) }}"
                                        class="btn btn-sm btn-primary">Xem</a>
                                    <a href="{{ route('kythi.edit', ['id' => $kyThi->getMaKT()]) }}"
                                        class="btn btn-sm btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @empty
                            <tr id="noResult">
                                <td colspan="4" class="text-center">Không có kỳ thi nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('kyThiTable');
        const noResultRow = document.getElementById('noResult');

        searchInput.addEventListener('keyup', function () {
            const keyword = this.value.trim().toLowerCase();
            let hasVisibleRow = false;

            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const tenKTCell = row.querySelector('.ten-kt');
                if (!tenKTCell) return;

                const tenKTText = tenKTCell.textContent.trim().toLowerCase();
                const visible = tenKTText.includes(keyword);

                row.style.display = visible ? '' : 'none';

                if (visible) hasVisibleRow = true;
            });

            if (noResultRow) {
                noResultRow.style.display = hasVisibleRow ? 'none' : '';
            }
        });
    });
</script>
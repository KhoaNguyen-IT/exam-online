@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid" style="margin-top: 5%;">
            @include('layout.noice')

            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title mb-0">{{ $viewData['title'] }}</h4>
                        <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>

                    <form action="{{ route('monhoc.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tenMH" class="form-label"><strong>Tên môn học</strong></label>
                            <input type="text" class="form-control" name="tenMH" id="tenMH" required>
                        </div>

                        <div id="chuong-container">
                            <label class="form-label"><strong>Danh sách chương</strong></label>
                            <div class="input-group mb-2">
                                <input type="text" name="chuong[]" class="form-control" placeholder="Tên chương">
                                <button type="button" class="btn btn-outline-secondary add-chuong">+</button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let chuongCount = 1; // bắt đầu từ 1

        const container = document.getElementById('chuong-container');

        // Set nội dung mặc định cho input đầu tiên
        const firstInput = container.querySelector('input[name="chuong[]"]');
        if (firstInput) {
            firstInput.value = `Chương ${chuongCount}: `;
        }

        // Thêm chương mới
        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-chuong')) {
                chuongCount++;

                const newInputGroup = document.createElement('div');
                newInputGroup.className = 'input-group mb-2';

                newInputGroup.innerHTML = `
                    <input type="text" name="chuong[]" class="form-control" value="Chương ${chuongCount}: " placeholder="Tên chương">
                    <button type="button" class="btn btn-outline-danger remove-chuong">-</button>
                `;

                container.appendChild(newInputGroup);
            }

            // Xoá chương
            if (e.target.classList.contains('remove-chuong')) {
                e.target.closest('.input-group').remove();
                chuongCount--;
            }
        });
    });
</script>
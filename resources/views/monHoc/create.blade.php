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

    <script>
        // Thêm dòng nhập chương mới
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.add-chuong').addEventListener('click', function () {
                const container = document.getElementById('chuong-container');
                const newInput = document.createElement('div');
                newInput.className = 'input-group mb-2';
                newInput.innerHTML = `
                        <input type="text" name="chuong[]" class="form-control" placeholder="Tên chương">
                        <button type="button" class="btn btn-outline-danger remove-chuong">-</button>
                    `;
                container.appendChild(newInput);
            });

            document.getElementById('chuong-container').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-chuong')) {
                    e.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
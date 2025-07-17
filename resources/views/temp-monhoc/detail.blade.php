@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid" style="margin-top: 5%;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">
                    Danh sách chương của môn: {{ $viewData['monHoc']->tenMH }}
                </h4>
                <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên chương</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewData['chuong'] as $chuong)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $chuong->tenChuong }}</td>
                            </tr>
                        @endforeach

                        @if($viewData['chuong']->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center">Không có chương nào cho môn học này.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
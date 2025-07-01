@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid" style="margin-top: 5%;">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('dethi.create') }}" class="btn btn-success">Tạo đề thi</a>
            </div>
            <div class="row">
                @foreach($viewData['giangVienList'] as $giangVien)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            @include('layout.noice')
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <span>
                                    <a href="{{ route('dethi.index', ['maTK' => $giangVien->maTK]) }}">
                                        {{ $giangVien->hoTen }}
                                        <small class="text-muted">{{ $giangVien->email }}</small>
                                    </a>
                                </span>
                                <a href="{{ route('dethi.index', ['maTK' => $giangVien->maTK]) }}"
                                    class="btn btn-sm btn-primary">
                                    Xem đề thi
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
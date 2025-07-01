@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid" style="margin-top: 5%;">
            <div class="row">
                @foreach($viewData['monHoc'] as $monHoc)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <span><a href="{{ route('cauhoi.index', ['maMH' => $monHoc->maMH]) }}">
                                        {{ $monHoc->tenMH }}
                                    </a></span>
                                <a href="{{ route('cauhoi.index', ['maMH' => $monHoc->maMH]) }}" class="btn btn-sm btn-primary">
                                    Xem câu hỏi
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
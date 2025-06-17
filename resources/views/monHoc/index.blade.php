@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

@section('content')

@section('content')
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
            <div class="container-fluid">
                @include('layout.noice')
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="card-title">{{ $viewData['title'] }}</h4>
                                    </div>
                                    <div>
                                        <a href="{{ route('monhoc.create') }}" class="btn btn-success m-1">Tạo mới</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-0 text-muted">Tên môn học</th>
                                                <th scope="col" class="px-0 text-muted text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewData['monHoc'] as $monHoc)
                                                <tr>
                                                    <td class="px-0">{{ $monHoc->getTenMH() }}</td>
                                                    <td class="px-0 text-end">
                                                        <a href="{{ route('monhoc.edit',['id'=>$monHoc->getMaMH()]) }}" class=" btn btn-warning">Sửa</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
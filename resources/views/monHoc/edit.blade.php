@extends('layout.app')

@section('sidebar')
@include('layout.sidebarGiangVien')

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
                                <form action="{{ route('monhoc.update', ['id' => $viewData['monHoc']->getMaMH()]) }}"
                                    method="POST" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="tenMH" class="me-0 mb-0" style="min-width: 120px;"><strong>tên môn
                                                    học:</strong></label>
                                            <input type="text" id="tenMH" name="tenMH" class="form-control"
                                                value="{{ $viewData['monHoc']->getTenMH() }}" required>
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
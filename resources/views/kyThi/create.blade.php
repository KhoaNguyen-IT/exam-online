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
                                <form action="{{ route('kythi.store') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="tenKT" class="me-0 mb-0" style="min-width: 120px;"><strong>tên kỳ
                                                    thi:</strong></label>
                                            <input type="text" id="tenKT" name="tenKT" class="form-control"
                                                value="{{ old('tenKT') }}" required>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label class="mb-2" style="min-width: 120px;"><strong>Chọn đề thi:</strong></label>
                                            <div class="row">
                                                @foreach($viewData['deThi'] as $deThi)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   name="de_thi_ids[]" 
                                                                   value="{{ $deThi->getMaDT() }}" 
                                                                   id="deThi{{ $deThi->getMaDT() }}"
                                                                   {{ (is_array(old('de_thi_ids')) && in_array($deThi->getMaDT(), old('de_thi_ids'))) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="deThi{{ $deThi->getMaDT() }}">
                                                                {{ $deThi->getTenDT() }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="moTa" class="me-0 mb-0" style="min-width: 120px;"><strong>Mô tả:</strong></label>
                                            <textarea id="moTa" name="moTa" class="form-control">{{ old('moTa') }}</textarea>
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
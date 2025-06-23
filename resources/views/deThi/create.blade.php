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
                                <form action="{{ route('dethi.store') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center gap-3">
                                            <label for="tenDT" class="me-0 mb-0" style="min-width: 120px;"><strong>Tên đề thi:</strong></label>
                                            <input type="text" id="tenDT" name="tenDT" class="form-control" value="{{ old('tenDT') }}" style="max-width: 200px;"required>
                                            <label for="monHoc" class="me-0 mb-0" style="min-width: 120px;"><strong>Môn học:</strong></label>
                                            <select id="monHoc" name="monHoc" class="form-select" style="max-width: 200px;"required>
                                                <option value="">-- Chọn môn học --</option>
                                                @foreach($viewData['monHoc'] as $monHoc)
                                                    <option value="{{ $monHoc->getMaMH() }}" {{ old('monHoc') == $monHoc->getMaMH() ? 'selected' : '' }}>
                                                        {{ $monHoc->getTenMH() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="thoiLuong" class="me-0 mb-0" style="min-width: 120px;"><strong>Thời lượng:</strong></label>
                                            <input type="number" id="thoiLuong" name="thoiLuong" class="form-control" value="{{ old('thoiLuong') }}" style="max-width: 100px;"required>
                                            <label for="phut" class="me-0 mb-0" style="min-width: 40px;"><strong>Phút</strong></label>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label class="mb-2" style="min-width: 120px;"><strong>Chọn câu hỏi:</strong></label>
                                            <div class="row">
                                                @foreach($viewData['cauHoi'] as $cauHoi)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   name="cau_hoi_ids[]" 
                                                                   value="{{ $cauHoi->getMaCH() }}" 
                                                                   id="cauHoi{{ $cauHoi->getMaCH() }}"
                                                                   {{ (is_array(old('cau_hoi_ids')) && in_array($cauHoi->getMaCH(), old('cau_hoi_ids'))) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="cauHoi{{ $cauHoi->getMaCH() }}">
                                                                {{ $cauHoi->getNoiDung() }}
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
                                            <textarea id="moTa" name="moTa" class="form-control" rows="3">{{ old('moTa') }}</textarea>
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
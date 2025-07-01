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
                                    <div>
                                        <a href="{{ route('cauhoi.index', ['maMH' => $viewData['monHocChon']]) }}" class="btn btn-secondary me-2">Quay về</a>
                                    </div>
                                </div>
                                @include('layout.noice')
                                <form action="{{ route('cauhoi.update', ['id' => $viewData['chiTietCauHoi']->getMaCH()]) }}"
                                    method="POST" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-4 ms-4">
                                        <div class="col-md-6 mb-3 d-flex align-items-center">
                                            <label for="maMonHoc" class="me-2 mb-0" style="min-width: 80px;"><strong>Môn
                                                    học:</strong></label>
                                            <select id="maMonHoc" name="maMonHoc" class="form-select flex-grow-1"
                                                style="min-width: 220px; max-width: 260px;">
                                                <option value="">-- Chọn --</option>
                                                @foreach($viewData['monHoc'] as $monHoc)
                                                    <option value="{{ $monHoc->maMH }}" {{ $viewData['chiTietCauHoi']->maMonHoc == $monHoc->maMH ? 'selected' : '' }}>
                                                        {{ $monHoc->tenMH }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3 d-flex align-items-center">
                                            <label for="maChuong" class="me-2 mb-0"
                                                style="min-width: 80px;"><strong>Chương:</strong></label>
                                            <select id="maChuong" name="maChuong" class="form-select flex-grow-1"
                                                style="min-width: 180px; max-width: 300px;">
                                                @foreach($viewData['chuong'] as $chuong)
                                                    <option value="{{ $chuong->maChuong }}" data-mamh="{{ $chuong->maMH }}" {{ $viewData['chiTietCauHoi']->maChuong == $chuong->maChuong ? 'selected' : '' }}>
                                                        {{ $chuong->tenChuong }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4 ms-4">
                                        <div class="col-md-6 mb-3 d-flex align-items-center">
                                            <label for="dapAnDung" class="me-2 mb-0" style="min-width: 80px;"><strong>Đáp án
                                                    đúng:</strong></label>
                                            <select id="dapAnDung" name="dapAnDung" class="form-select flex-grow-1"
                                                style="min-width: 60px; max-width: 80px;">
                                                <option value="A" {{ $viewData['chiTietCauHoi']->getDung() == 'A' ? 'selected' : '' }}>A</option>
                                                <option value="B" {{ $viewData['chiTietCauHoi']->getDung() == 'B' ? 'selected' : '' }}>B</option>
                                                <option value="C" {{ $viewData['chiTietCauHoi']->getDung() == 'C' ? 'selected' : '' }}>C</option>
                                                <option value="D" {{ $viewData['chiTietCauHoi']->getDung() == 'D' ? 'selected' : '' }}>D</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3 d-flex align-items-center">
                                            <label for="doKho" class="me-2 mb-0" style="min-width: 60px;"><strong>Độ
                                                    khó:</strong></label>
                                            <select id="doKho" name="doKho" class="form-select flex-grow-1"
                                                style="min-width: 180px; max-width: 200px;">
                                                <option value="Dễ" {{ $viewData['chiTietCauHoi']->getDoKho() == 'Dễ' ? 'selected' : '' }}>Dễ</option>
                                                <option value="Trung Bình" {{ $viewData['chiTietCauHoi']->getDoKho() == 'Trung Bình' ? 'selected' : '' }}>Trung Bình</option>
                                                <option value="Khó" {{ $viewData['chiTietCauHoi']->getDoKho() == 'Khó' ? 'selected' : '' }}>Khó</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="noiDung" class="me-0 mb-0" style="min-width: 120px;"><strong>Nội
                                                    dung:</strong></label>
                                            <input type="text" id="noiDung" name="noiDung" class="form-control"
                                                value="{{ $viewData['chiTietCauHoi']->getNoiDung() }}">
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="dapAnA" class="me-0 mb-0" style="min-width: 120px;"><strong>Đáp án
                                                    A:</strong></label>
                                            <input type="text" id="dapAnA" name="dapAnA" class="form-control"
                                                value="{{ $viewData['chiTietCauHoi']->getA() }}">
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="dapAnB" class="me-0 mb-0" style="min-width: 120px;"><strong>Đáp án
                                                    B:</strong></label>
                                            <input type="text" id="dapAnB" name="dapAnB" class="form-control"
                                                value="{{ $viewData['chiTietCauHoi']->getB() }}">
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="dapAnC" class="me-0 mb-0" style="min-width: 120px;"><strong>Đáp án
                                                    C:</strong></label>
                                            <input type="text" id="dapAnC" name="dapAnC" class="form-control"
                                                value="{{ $viewData['chiTietCauHoi']->getC() }}">
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="dapAnD" class="me-0 mb-0" style="min-width: 120px;"><strong>Đáp án
                                                    D:</strong></label>
                                            <input type="text" id="dapAnD" name="dapAnD" class="form-control"
                                                value="{{ $viewData['chiTietCauHoi']->getD() }}">
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
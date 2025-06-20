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
                                        <a href="{{ route('cauhoi.index') }}" class="btn btn-success m-1">Quay lại</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <div class="ms-4">
                                        <span><strong>Nội dung:</strong>
                                            {{ $viewData['chiTietCauHoi']->getNoiDung() }}</span>
                                        <br>
                                        <br>
                                        <span class="mt-2 d-inline-block"><strong>Đáp án đúng:</strong>
                                            {{ $viewData['chiTietCauHoi']->getDung() }}</span>
                                    </div>
                                    <table class="table ms-2 mb-0 text-nowrap varient-table align-middle fs-3"
                                        style="margin-top: 20px;">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-nowrap" style="width:1%;">Đáp án A: </th>
                                                <td class="ps-2">{{ $viewData['chiTietCauHoi']->getA() }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-nowrap" style="width:1%;">Đáp án B: </th>
                                                <td class="ps-2">{{ $viewData['chiTietCauHoi']->getB() }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-nowrap" style="width:1%;">Đáp án C: </th>
                                                <td class="ps-2">{{ $viewData['chiTietCauHoi']->getC() }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-nowrap" style="width:1%;">Đáp án D: </th>
                                                <td class="ps-2">{{ $viewData['chiTietCauHoi']->getD() }}</td>
                                            </tr>
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
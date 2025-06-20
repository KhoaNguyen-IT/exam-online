@extends('layout.app')

@section('sidebar')
    @include('layout.sidebarGiangVien')
@endsection

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
                                <div class="table-responsive mt-4">
                                    <div class="ms-4">
                                        <span><strong>Tên kỳ thi:</strong>
                                            {{ $viewData['kyThi']->getTenKT() }}</span>
                                        <br>
                                    </div>
                                    <table class="table ms-2 mb-0 text-nowrap varient-table align-middle fs-3"
                                        style="margin-top: 20px;">
                                        <tbody>
                                            @foreach($viewData['chiTietKyThi'] as $chiTietKyThi)
                                                <tr>
                                                    <th scope="row" class="text-nowrap" style="width:1%;">Đề thi
                                                        {{ $loop->iteration }}: </th>
                                                    <td class="ps-2">{{ $chiTietKyThi->deThi->getTenDT() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br/>
                                    <div class="ms-4">
                                        <span><strong>Mô tả:</strong>
                                            {{ $viewData['kyThi']->getMoTa() }}</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
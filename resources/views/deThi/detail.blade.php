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
                                        <a href="{{ route('dethi.index') }}" class="btn btn-success m-1">Quay lại</a>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <div class="ms-4">
                                        <span><strong>Tên đề thi:</strong>
                                            {{ $viewData['deThi']->getTenDT() }}</span>
                                        <br>
                                    </div>
                                    <table class="table ms-2 mb-0 text-nowrap varient-table align-middle fs-3"
                                        style="margin-top: 20px;">
                                        <tbody>
                                            @foreach ($viewData['chiTietDeThi'] as $chiTietDeThi)
                                                <tr>
                                                    <th scope="row" class="text-nowrap" style="width:1%;">Câu hỏi
                                                        {{ $loop->iteration }}:
                                                    </th>
                                                    <td class="ps-2">{{ $chiTietDeThi->cauHoi->getNoiDung() }}</td>
                                                    <td class="ps-2 text-end">
                                                        <a href="{{ route('cauhoi.show', ['id' => $chiTietDeThi->cauHoi->getMaCH()]) }}"
                                                            class="btn btn-primary">Chi tiết</a>
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
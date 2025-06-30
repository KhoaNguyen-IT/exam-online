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
                                <div class="d-md-flex align-items-center justify-content-between mb-3">
                                    <h4 class="card-title">{{ $viewData['title'] }}</h4>
                                    <div>
                                        <a href="{{ route('kythi.index') }}" class="btn btn-primary">Quay lại</a>
                                    </div>
                                </div>

                                <div class="table-responsive mt-4">
                                    <div class="ms-4">
                                        <p><strong>Tên kỳ thi:</strong> {{ $viewData['kyThi']->getTenKT() }}</p>
                                    </div>

                                    <table class="table ms-2 mb-0 text-nowrap varient-table align-middle fs-3"
                                        style="margin-top: 20px;">
                                        <tbody>
                                            @forelse($viewData['deThiList'] as $deThi)
                                                <tr>
                                                    <th scope="row" class="text-nowrap" style="width:1%;">
                                                        Đề thi {{ $loop->iteration }}:
                                                    </th>
                                                    <td class="ps-2">{{ $deThi->getTenDT() }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-muted">Không có đề thi nào cho kỳ thi này.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <br />
                                    <div class="ms-4">
                                        <p><strong>Mô tả:</strong> {{ $viewData['kyThi']->getMoTa() }}</p>
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
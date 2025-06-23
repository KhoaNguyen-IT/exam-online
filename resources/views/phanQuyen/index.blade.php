@extends('layout.app')

@section('sidebar')
@include('layout.sidebarAdmin')

@include('cauHoi.import')
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
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-0 text-muted">STT</th>
                                                <th scope="col" class="px-0 text-muted">Tên quyền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewData['phanQuyen'] as $phanQuyen)
                                                <tr>
                                                    <td class="px-0">{{ $loop->iteration }}</td>
                                                    <td class="px-0">{{ $phanQuyen->getTenQuyen() }}</td>
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
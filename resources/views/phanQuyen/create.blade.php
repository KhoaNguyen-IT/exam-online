@extends('layout.app')

@section('sidebar')
@include('layout.sidebarAdmin')

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
                                <form action="{{ route('phanquyen.store', ['id' => $viewData['taiKhoan']->getMaTK()]) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4 d-flex align-items-center">
                                            <label for="hoTen" class="me-0 mb-0" style="min-width: 120px;"><strong>Email: </strong>{{ $viewData['taiKhoan']->getEmail() }}</label>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="ms-4">
                                            <label class="mb-2" style="min-width: 120px;"><strong>Chọn quyền:</strong></label>
                                            <div class="row">
                                                @foreach($viewData['phanQuyen'] as $quyen)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="quyen_ids[]"
                                                                   value="{{ $quyen->getMaPQ() }}"
                                                                   id="quyen{{ $quyen->getMaPQ() }}"
                                                                   {{ (is_array(old('quyen_ids')) && in_array($quyen->getMaPQ(), old('quyen_ids'))) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="quyen{{ $quyen->getMaPQ() }}">
                                                                {{ $quyen->getTenQuyen() }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
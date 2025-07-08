<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-primary" id="notificationModalLabel">Thông báo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true" class="text-white bg-danger pl-2 pr-2"
                        style="border-radius: 50px;">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="background-image: linear-gradient(90.57deg, #3e65fe, #d23cff);">
                @if (isset($deThisMoiList) && count($deThisMoiList) > 0)
                    <h5 class="text-center text-white font-weight-bold">Các đề thi sắp diễn ra hoặc chưa hoàn thành</h5>
                    @foreach ($deThisMoiList as $deThi)
                        <div class="notification-item mb-2 p-2 rounded bg-white position-relative"
                            style="border: 1px solid #ccc; border-radius: 15px;">
                            @if (Auth::user()->last_seen_de_thi_at && $deThi->created_at > Auth::user()->last_seen_de_thi_at)
                                <span class="badge badge-danger position-absolute"
                                    style="top: 5px; right: 10px; border-radius: 15px;">Mới</span>
                            @endif

                            <div><strong>Đề thi:</strong> {{ $deThi->tenDT }}</div>
                            <div><strong>Môn học:</strong> {{ $deThi->monHoc->tenMH ?? 'Không rõ' }}</div>
                            <div>
                                <strong>Thời gian thi:</strong>
                                {{ \Carbon\Carbon::parse($deThi->kyThi->ngayThi)->format('d/m/Y \l\ú\c H \g\i\ờ i \p\h\ú\t') }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-white font-weight-bold">Hiện tại không có thông báo mới</p>
                @endif
            </div>
        </div>
    </div>
</div>

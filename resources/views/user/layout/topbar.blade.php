<!-- Topbar Start -->
<div class="container-fluid bg-dark">
    <div class="row py-2 px-lg-5">
        <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center text-white">
                <div id="datetime" style="color: white;"></div>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <form action="{{ route('user.examList.filterTenMH') }}#applyFilter" method="get"
                class="d-inline-block w-auto">
                <div class="input-group input-group-sm">
                    <input type="text" name="kyThiTheoTenMonHoc" class="form-control" style="width: 200px;"
                        placeholder="Tìm môn học..." required spellcheck="false">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Topbar End -->

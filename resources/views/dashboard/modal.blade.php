<!-- Tempatkan ini di dalam elemen yang diinginkan pada halaman Anda -->
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter tanggal</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.filter') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <input class="form-control col-md-4" type="date" name="tanggal_awal" id="tglawal">
                        <h6 class="mt-2 col-md-2"><b>s/d</b></h6>
                        <input class="form-control col-md-4" type="date" name="tanggal_akhir" id="tglakhir">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            </form>
        </div>
    </div>
</div>

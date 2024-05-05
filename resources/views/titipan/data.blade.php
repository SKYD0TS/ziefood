<div class="modal fade" id="formInputtitipan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Import Data Produk Titipan</h3>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url(request()->segment(1).'/menu/import')}}" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group row">
                        <label for="menu" class="col-sm-4 col-form-label">File Excel</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="import" id="import">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
@endpush
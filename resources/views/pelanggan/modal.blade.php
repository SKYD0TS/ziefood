<div class="modal fade" id="formInputpelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama pelanggan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">No Telepon</label>
                        <div class="col-sm-8">
                            <input type="double" class="form-control" name="no_telp" value="" id="no_telp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="alamat" id="alamat">
                        </div>
                    </div>
                    <!-- <div class="btn-group">
                        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" name="image" id="image">
                    </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
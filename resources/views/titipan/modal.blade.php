<div class="modal fade" id="formInputTitipan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="kategori_id" class="col-sm-4 col-form-label">Jenis</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="kategori_id" id="kategori_id" required>
                                <option value="">Pilih Jenis</option>
                                @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-4 col-form-label">Nama Produk</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_supplier" class="col-sm-4 col-form-label">Nama Supplier</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-4 col-form-label">Harga Beli</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-4 col-form-label">Harga Jual</label>
                        <div class="col-sm-8">
                            <input type="double" class="form-control" name="harga_jual" value="" id="harga_jual">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_titipan" class="col-sm-4 col-form-label">Stok</label>
                        <div class="col-sm-8">
                            <input type="double" class="form-control" name="stok" id="stok">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
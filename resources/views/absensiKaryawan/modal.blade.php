<div class="modal fade" id="formInputabsensiKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>

                    <div class="form-group row">
                        <label for="namaKaryawan" class="col-sm-4 col-form-label">Nama karyawan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="namaKaryawan" id="namaKaryawan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggalMasuk" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="tanggalMasuk" value="" id="tanggalMasuk">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="waktuMasuk" class="col-sm-4 col-form-label">Waktu Masuk</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" name="waktuMasuk" id="waktuMasuk">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_karyawan" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                        <select name="status" id="status" class="form-control">
                            {{--<option value="">Status</option>--}}
                                <option value="masuk">Masuk</option>
                                <option value="cuti">Cuti</option>
                                <option value="sakit">Sakit</option>
                        </select>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="nama_karyawan" class="col-sm-4 col-form-label"> Status</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="status" name="status">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="nama_karyawan" class="col-sm-4 col-form-label">Waktu Keluar</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" name="waktuKeluar" id="waktuKeluar">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    // Ambil elemen input waktu
    var waktuMasukInput = document.getElementById('waktuMasuk');

    // Buat objek Date untuk mendapatkan waktu saat ini
    var sekarang = new Date();

    // Format waktu saat ini menjadi HH:MM
    var jam = sekarang.getHours();
    var menit = sekarang.getMinutes();

    // Pastikan format waktu memiliki dua digit
    if (jam < 10) {
        jam = '0' + jam;
    }
    if (menit < 10) {
        menit = '0' + menit;
    }

    // Buat string waktu dengan format HH:MM
    var waktuSekarang = jam + ':' + menit;

    // Set nilai input waktu dengan waktu saat ini
    waktuMasukInput.value = waktuSekarang;
</script> -->

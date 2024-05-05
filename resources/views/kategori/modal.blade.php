<div class="modal fade" id="formInputkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h3>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="kategori">
          @csrf
          <div id="method"></div>
          <div class="form-group row">
            <label for="nama_kategori" class="col-sm-4 col-form-label">Nama kategori</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama_kategori" id="nama_kategori">
            </div>
          </div>


          <div class="form-group row">
            <label for="jenis_id" class="col-sm-4 col-form-label">Jenis</label>
            <div class="col-sm-8">
              <select class="form-control" name="jenis_id" id="jenis_id" required>
                <option value="">Pilih Jenis</option>
                @foreach ($jenis as $item)
                <option value="{{ $item->id }}">{{ $item->nama_jenis  }}</option>
                @endforeach
              </select>
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
<!-- <script>
  console.log('kategori')
  $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
    $('.alert-success').slideUp(500)
  })

  $('.delete-data').on('click', function(e) {
    e.preventDefault()
    let nama_kategori = $(this).closest('tr').find('td:eq(1)').text()
    Swal.fire({
      title: `Apakah data ${nama_kategori} akan dihapus ?`,
      text: 'Data tidak bisa dikembalikan!',
      icon: 'error',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: 'd33',
      confirmButtonText: 'Ya, hapus data ini!'
    }).then((result) => {
      if (result.isConfirmed) {
        $(e.target).closest('form').submit()
      } else {
        swal.close()
      }
    })
  })

  $('#formInputkategori').on('show.bs.modal', function(e) {
    console.log('modal')
    const btn = $(e.relatedTarget)
    const mode = btn.data('mode')
    const nama_kategori = btn.data('nama_kategori')
    const id = btn.data('id')
    const modal = $(this)
    if (mode === 'edit') {
      modal.find('.modal-title').text('Edit kategori')
      modal.find('#nama_kategori').val(nama_kategori)
      modal.find('.modal-body form').attr('action', '{{ url("kategori") }}/' + id)
      modal.find('#method').html('@method("PATCH")')
    } else {
      modal.find('.modal-title').text('Input kategori')
      modal.find('#nama_kategori').val('')
      modal.find('#method').html('')
      modal.find('.modal-body form').attr('action', '{{ url("kategori") }}')
    }
  })
</script> -->
@endpush
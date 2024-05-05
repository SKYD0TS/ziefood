@extends('templates.layout')

@push('style')
@endpush

@section('content')
@include('stok.modal')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h1>stok </h1>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">


              @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              <div class="x_content">
                <button class="btn btn-info" data-toggle="modal" data-target="#formstok"><i class="fa fa-file-pdf-o"></i> Import</button>
                <a href="{{ route('stok-export-pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Export PDF</a>
                <a class="btn btn-success" href="{{route('export-stok')}}"><i class="fa fa-file-excel-o"></i>Export</a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Menu Id</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stok as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->menu->nama_menu??"-" }}</td>
                      <td>{{ $item->jumlah }}</td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputStok" data-mode="edit" data-id="{{ $item->id }}" data-menu_id="{{ $item->menu_id }}" data-jumlah="{{ $item->jumlah }}">
                          <i class='fa fa-edit'></i> Edit
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection
      @include('stok.data')
      @push('script')
      <script>
        console.log('stok')
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
          $('.alert-success').slideUp(500)
        })

        $('.delete-data').on('click', function(e) {
          e.preventDefault()
          let menu_id = $(this).closest('tr').find('td:eq(1)').text()
          Swal.fire({
            title: `Apakah data ${menu_id} akan dihapus ?`,
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
        $('#formInputStok').on('show.bs.modal', function(e) {
          console.log('modal')
          const btn = $(e.relatedTarget)
          const mode = btn.data('mode')
          const jumlah = btn.data('jumlah')
          const id = btn.data('id')
          const modal = $(this)
          if (mode === 'edit') {
            modal.find('.modal-title').text('Edit stok')
            modal.find('#jumlah').val(jumlah)
            modal.find('.modal-body form').attr('action', '{{ url("stok") }}/' + id)
            modal.find('#method').html('@method("PATCH")')
          } else {
            modal.find('.modal-title').text('Input stok')
            modal.find('#jumlah').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("stok") }}')
          }
        })
      </script>
       <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable({
                        "paging": true, // Menampilkan paging
                        "lengthChange": true, // Memungkinkan pengguna mengubah jumlah entri per halaman
                        "searching": true, // Memungkinkan pencarian data
                        "ordering": true, // Mengaktifkan pengurutan
                        "info": true, // Menampilkan informasi halaman dan jumlah data
                        "autoWidth": false, // Menonaktifkan penyesuaian otomatis lebar kolom
                        // Atur kolom tertentu untuk disorot saat menggunakan fitur pencarian
                        "columnDefs": [{
                            "searchable": false,
                            "orderable": false,
                            "targets": 0
                        }]
                    });
                });
            </script>
      @endpush
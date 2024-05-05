@extends('templates.layout')

@push('style')
@endpush

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h1>Meja </h1>
       
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formInputmeja"><i class="fa fa-plus-square"></i> Tambah meja</button>

                <button class="btn btn-info" data-toggle="modal" data-target="#formMeja"><i class="fa fa-file-pdf-o"></i> Import</button>
                <a href="{{ route('meja-export-pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Export PDF</a>
                <a class="btn btn-success" href="{{route('export-meja')}}"><i class="fa fa-file-excel-o"></i>Export</a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nomor meja</th>
                      <th>Kapasitas</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($meja as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->nomor_meja }}</td>
                      <td>{{ $item->kapasitas }}</td>
                      <td>{{ $item->status }}</td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputmeja" data-mode="edit" data-id="{{ $item->id }}" data-nomor_meja="{{ $item->nomor_meja }}" data-kapasitas="{{ $item->kapasitas }}" data-status="{{ $item->status }}">
                          <i class='fa fa-edit'></i> Edit
                        </button>
                        <form action="{{ route('meja.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-danger delete-data" data-id="{{ $item->id }}" data-nomor_meja="{{ $item->nomor_meja }}">
                            <i class='fa fa-trash'></i> Delete
                          </button>
                        </form>
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
@include('meja.modal')

      @endsection
      @include('meja.data')
      @push('script')
      <script>
        console.log('meja')
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
          $('.alert-success').slideUp(500)
        })

        $('.delete-data').on('click', function(e) {
          e.preventDefault()
          let nomor_meja = $(this).closest('tr').find('td:eq(1)').text()
          Swal.fire({
            title: `Apakah data ${nomor_meja} akan dihapus ?`,
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

        $('#formInputMeja').on('show.bs.modal', function(e) {
          console.log('modal')
          const btn = $(e.relatedTarget)
          const mode = btn.data('mode')
          const nomor_meja = btn.data('nomor_meja')
          const kapasitas = btn.data('kapasitas')
          const status = btn.data('status')
          const id = btn.data('id')
         const modal = $(this)
          if (mode === 'edit') {
            modal.find('.modal-title').text('Edit meja')
            modal.find('#nomor_meja').val(nomor_meja)
            modal.find('#kapasitas').val(kapasitas)
            modal.find('#status').val(status)
            modal.find('.modal-body form').attr('action', '{{ url("meja") }}/' + id)
            modal.find('#method').html('@method("PATCH")')
          } else {
            modal.find('.modal-title').text('Input meja')
            modal.find('#nomor_meja').val('')
            modal.find('#kapasitas').val('')
            modal.find('#status').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("meja") }}')
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
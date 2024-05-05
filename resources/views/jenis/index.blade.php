@extends('templates.layout')

@push('style')
@endpush

@section('content')
@include('jenis.modal')

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h1>Jenis </h1>
       
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formInputJenis"><i class="fa fa-plus-square"></i> Tambah Jenis</button>

                <button class="btn btn-info" data-toggle="modal" data-target="#formjenis"><i class="fa fa-file-pdf-o"></i> Import</button>
                <a href="{{ route('jenis-export-pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Export PDF</a>
                <a class="btn btn-success" href="{{route('export-jenis')}}"><i class="fa fa-file-excel-o"></i>Export</a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name Jenis</th>
                      <!-- <th>Name Kategori</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jenis as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->nama_jenis }}</td>
                      <!-- <td>
                        @foreach($item->kategori as $k)
                        <p>{{$k->nama_kategori}}</p>
                        @endforeach
                      </td> -->
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputJenis" data-mode="edit" data-id="{{ $item->id }}" data-nama_jenis="{{ $item->nama_jenis }}" data-nama_kategori="{{ $item->nama_kategori }}">
                          <i class='fa fa-edit'></i> Edit
                        </button>
                        <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-danger delete-data" data-id="{{ $item->id }}" data-nama_jenis="{{ $item->nama_jenis }}">
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
      @endsection
      @include('jenis.data')
      @push('script')
      <script>
        console.log('jenis')
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
          $('.alert-success').slideUp(500)
        })

        $('.delete-data').on('click', function(e) {
          e.preventDefault()
          let nama_jenis = $(this).closest('tr').find('td:eq(1)').text()
          Swal.fire({
            title: `Apakah data ${nama_jenis} akan dihapus ?`,
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

        $('#formInputJenis').on('show.bs.modal', function(e) {
          console.log('modal')
          const btn = $(e.relatedTarget)
          const mode = btn.data('mode')
          const nama_jenis = btn.data('nama_jenis')
          const nama_kategori = btn.data('nama_kategori')
          const id = btn.data('id')
          const modal = $(this)
          if (mode === 'edit') {
            modal.find('.modal-title').text('Edit jenis')
            modal.find('#nama_jenis').val(nama_jenis)
            modal.find('#nama_kategori').val(nama_kategori)
            modal.find('.modal-body form').attr('action', '{{ url("jenis") }}/' + id)
            modal.find('#method').html('@method("PATCH")')
          } else {
            modal.find('.modal-title').text('Input jenis')
            modal.find('#nama_jenis').val('')
            modal.find('#nama_kategori').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("jenis") }}')
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
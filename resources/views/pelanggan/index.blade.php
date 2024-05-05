@extends('templates.layout')

@push('style')
@endpush

@section('content')


<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h1>Pelanggan </h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <!-- <div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Berhasil!</strong>
                </div> -->

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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formInputpelanggan"><i class="fa fa-plus-square"></i> Tambah pelanggan</button>

                                <button class="btn btn-info" data-toggle="modal" data-target="#formInputPelanggan"><i class="fa fa-file-pdf-o"></i> Import</button>
                                <a href="{{ route('pelanggan-export-pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Export PDF</a>
                                <a class="btn btn-success" href="{{route('export-pelanggan')}}"><i class="fa fa-file-excel-o"></i>Export</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <table id="data-pelanggan" class="table table-bordered table striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Email</th>
                                                <th>No Telepon</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pelanggan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->no_telp }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputpelanggan" data-mode="edit" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-email="{{ $item->email }}" data-no_telp="{{ $item->no_telp}}" data-alamat="{{ $item->alamat }}">
                                                        <i class='fa fa-edit'></i> Edit
                                                    </button>
                                                    <!-- <form action="pelanggan/{{ $item->id}}" method="post" style="display :inline"> -->
                                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger delete-data">
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
            @include('pelanggan.modal')
            @include('pelanggan.data')
            @endsection
            @push('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
            </script>
            <script>
                console.log('pelanggan')
                // $('#dataTable').DataTable();

                $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                    $('.alert-success').slideUp(500)
                });

                $('.delete-data').on('click', function(e) {
                    e.preventDefault()
                    let nama = $(this).closest('tr').find('td:eq(1)').text()
                    Swal.fire({
                        title: `Apakah data ${nama} akan dihapus ?`,
                        text: 'Data tidak bisa dikembalikan!',
                        icon: 'error',
                        showDenyButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: 'd33',
                        confirmButtonText: 'Ya, hapus data ini!'
                    }).then((result) => {
                        if (result.isConfirmed)
                            $(e.target).closest('form').submit()
                        else swal.close()
                    });
                });

                $('#formInputpelanggan').on('show.bs.modal', function(e) {
                    console.log('modal')
                    const btn = $(e.relatedTarget)
                    const mode = btn.data('mode')
                    const nama = btn.data('nama')
                    const email = btn.data('email')
                    const no_telp = btn.data('no_telp')
                    const alamat = btn.data('alamat')
                    const id = btn.data('id')
                    const modal = $(this)
                    if (mode === 'edit') {
                        modal.find('.modal-title').text('Edit pelanggan')
                        modal.find('#nama').val(nama)
                        modal.find('#email').val(email)
                        modal.find('#no_telp').val(no_telp)
                        modal.find('#alamat').val(alamat)
                        modal.find('.modal-body form').attr('action', '{{ url("pelanggan") }}/' + id)
                        modal.find('#method').html('@method("PATCH")')
                    } else {
                        modal.find('.modal-title').text('Input pelanggan')
                        modal.find('#nama').val('')
                        modal.find('#email').val('')
                        modal.find('#no_telp').val('')
                        modal.find('#alamat').val('')
                        modal.find('#method').html('')
                        modal.find('.modal-body form').attr('action', '{{ url("pelanggan") }}')
                    }
                })
            </script>
             <script>
                $(document).ready(function() {
                    $('#data-pelanggan').DataTable({
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
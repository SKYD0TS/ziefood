@extends('templates.layout')

@push('style')
@endpush

@section('content')


<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h1>Menu </h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formInputmenu"><i class="fa fa-plus-square"></i> Tambah menu</button>

                                <button class="btn btn-info" data-toggle="modal" data-target="#formInputMenu"><i class="fa fa-file-pdf-o"></i> Import</button>
                                <a href="{{ route('menu-export-pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Export PDF</a>
                                <a class="btn btn-success" href="{{route('export-menu')}}"><i class="fa fa-file-excel-o"></i>Export</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <table id="data-menu" class="table table-bordered table striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Id</th>
                                                <th>Nama menu</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Image</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($menu as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>{{ $item->nama_menu }}</td>
                                                <td>{{ $item->harga }}</td>
                                                <td>@if($item->stok)
                                                        {{$item->stok->jumlah}}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td><img class="img-fluid" style="max-width: 100px;" src="{{ asset('storage/menu-image/' .$item->image)}}" alt="Tidak ada gambar"></td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputmenu" data-mode="edit" data-id="{{ $item->id }}" data-kategori_id="{{ $item->kategori_id }}" data-nama_menu="{{ $item->nama_menu }}" data-harga="{{ $item->harga }}" data-jumlah="{{ $item->stok_id}}" data-image="{{ $item->image }}" data-deskripsi="{{ $item->deskripsi }}">
                                                        <i class='fa fa-edit'></i> Edit
                                                    </button>
                                                    <!-- <form action="menu/{{ $item->id}}" method="post" style="display :inline"> -->
                                                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
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
            @include('menu.modal')
            @include('menu.data')
            @endsection
            @push('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
            </script>
            <script>
                console.log('menu')
                // $('#dataTable').DataTable();

                $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                    $('.alert-success').slideUp(500)
                });

                $('.delete-data').on('click', function(e) {
                    e.preventDefault()
                    let nama_menu = $(this).closest('tr').find('td:eq(1)').text()
                    Swal.fire({
                        title: `Apakah data ${nama_menu} akan dihapus ?`,
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

                $('#formInputmenu').on('show.bs.modal', function(e) {
                    console.log('modal')
                    const btn = $(e.relatedTarget)
                    const mode = btn.data('mode')
                    const kategori_id = btn.data('kategori_id')
                    const nama_menu = btn.data('nama_menu')
                    const harga = btn.data('harga')
                    const jumlah = btn.data('jumlah')
                    const image = btn.data('image')
                    const deskripsi = btn.data('deskripsi')
                    const id = btn.data('id')
                    const modal = $(this)
                    if (mode === 'edit') {
                        modal.find('.modal-title').text('Edit menu')
                        modal.find('#kategori_id').val(kategori_id)
                        modal.find('#nama_menu').val(nama_menu)
                        modal.find('#harga').val(harga)
                        modal.find('#jumlah').val(jumlah)
                        modal.find('#old-image').val(image)
                        modal.find('#deskripsi').val(deskripsi)
                        modal.find('.img-preview').attr('src', '{{ asset("storage/menu-image")}}/' + image)
                        modal.find('.modal-body form').attr('action', '{{ url("menu") }}/' + id)
                        modal.find('#method').html('@method("PATCH")')
                    } else {
                        modal.find('.modal-title').text('Input menu')
                        modal.find('#kategori_id').val('')
                        modal.find('#nama_menu').val('')
                        modal.find('#harga').val('')
                        modal.find('#jumlah').val('')
                        modal.find('#image').val('')
                        modal.find('#deskripsi').val('')
                        modal.find('.img-preview').attr('src', '')
                        modal.find('#method').html('')
                        modal.find('.modal-body form').attr('action', '{{ url("menu") }}')
                    }
                })

                function previewImage() {
                    const image = document.querySelector('#image');
                    const imgPreview = document.querySelector('.img-preview');

                    imgPreview.style.display = 'block';

                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);

                    oFReader.onload = function(oFREvent) {
                        imgPreview.src = oFREvent.target.result;
                    }
                }
            </script>
             <script>
                $(document).ready(function() {
                    $('#data-menu').DataTable({
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
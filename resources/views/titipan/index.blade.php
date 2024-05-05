@extends('templates.layout')

@push('style')
@endpush

@section('content')


<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h1>Produk Titipan </h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formInputTitipan"><i class="fa fa-plus-square"></i> Tambah titipan</button>

                                <button class="btn btn-info" data-toggle="modal" data-target="#formInputtitipan"><i class="fa fa-file-excel-o"></i> Import</button>
                                <a class="btn btn-success" href="{{route('export-titipan')}}"><i class="fa fa-file-excel-o"></i>Export</a>
                                <a href="{{ route('titipan-export-pdf') }}" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>Export PDF</a>


                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <table id="data-titipan" class="table table-bordered table striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th>Nama Produk</th>
                                                <th>Nama Supplier</th>
                                                <th>Harga beli</th>
                                                <th>Harga jual</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($titipan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kategori }}</td>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>{{ $item->nama_supplier }}</td>
                                                <td>{{ $item->harga_beli }}</td>
                                                <td>{{ $item->harga_jual }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>

                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputTitipan" data-mode="edit" data-id="{{ $item->id }}" data-kategori_id="{{ $item->kategori_id }}" data-nama_produk="{{ $item->nama_produk }}" data-nama_supplier="{{ $item->nama_supplier }}" data-harga_beli="{{ $item->harga_beli }}" data-harga_jual="{{ $item->harga_jual }}" data-stok="{{ $item->stok}}">
                                                        <i class='fa fa-edit'></i> Edit
                                                    </button>
                                                    <!-- <form action="titipan/{{ $item->id}}" method="post" style="display :inline"> -->
                                                    <form action="{{ route('titipan.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('titipan.modal')
            @include('titipan.data')
            @endsection
            @push('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                console.log('titipan')
                // $('#dataTable').DataTable();

                $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                    $('.alert-success').slideUp(500)
                });

                $('.delete-data').on('click', function(e) {
                    e.preventDefault()
                    let nama_titipan = $(this).closest('tr').find('td:eq(1)').text()
                    Swal.fire({
                        title: `Apakah data ${nama_titipan} akan dihapus ?`,
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

                $('#formInputTitipan').on('show.bs.modal', function(e) {
                    console.log('modal')
                    const btn = $(e.relatedTarget)
                    const mode = btn.data('mode')
                    const kategori_id = btn.data('kategori_id')
                    const nama_produk = btn.data('nama_produk')
                    const nama_supplier = btn.data('nama_supplier')
                    const harga_beli = btn.data('harga_beli')
                    const harga_jual = btn.data('harga_jual')
                    const stok = btn.data('stok')
                    const id = btn.data('id')
                    const modal = $(this)
                    if (mode === 'edit') {
                        modal.find('.modal-title').text('Edit titipan')
                        modal.find('#kategori_id').val(kategori_id)
                        modal.find('#nama_produk').val(nama_produk)
                        modal.find('#nama_supplier').val(nama_supplier)
                        modal.find('#harga_beli').val(harga_beli)
                        modal.find('#harga_jual').val(harga_jual)
                        modal.find('#stok').val(stok)
                        modal.find('.modal-body form').attr('action', '{{ url("titipan") }}/' + id)
                        modal.find('#method').html('@method("PATCH")')
                    } else {
                        modal.find('.modal-title').text('Input Titipan')
                        modal.find('#kategori_id').val('')
                        modal.find('#nama_produk').val('')
                        modal.find('#nama_supplier').val('')
                        modal.find('#harga_beli').val('')
                        modal.find('#harga_jual').val('')
                        modal.find('#stok').val('')
                        modal.find('#method').html('')
                        modal.find('.modal-body form').attr('action', '{{ url("titipan") }}')
                    }
                })
            </script>

            <script>
                // Fungsi untuk menghitung harga jual berdasarkan harga beli
                function hitungHargaJual() {
                    // Dapatkan nilai harga beli dari input
                    var hargaBeli = parseFloat($('#harga_beli').val());

                    // Hitung harga jual dengan keuntungan 70% dan pembulatan 500
                    var hargaJual = Math.ceil(hargaBeli * 1.7 / 500) * 500;

                    // Set nilai harga jual ke input yang sesuai
                    $('#harga_jual').val(hargaJual);
                }

                // Panggil fungsi hitungHargaJual() saat nilai input harga beli berubah
                $('#harga_beli').on('input', function() {
                    hitungHargaJual();
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Memeriksa apakah DataTable sudah diinisialisasi sebelumnya
                    if (!$.fn.DataTable.isDataTable('#titipan')) {
                        $('#titipan').DataTable();
                    }
                });
            </script>

            <script>
                $(document).ready(function() {
                    // Mengubah stok menjadi input teks saat didouble klik
                    $('#data-titipan').on('dblclick', 'td:nth-child(7)', function() {
                        var value = $(this).text();
                        $(this).html('<input type="number" class="form-control" value="' + value + '">');
                    });

                    // Mengirim perubahan stok ke database saat tombol enter ditekan
                    $('#data-titipan').on('keypress', 'input[type="number"]', function(e) {
                        if (e.which == 13) { // Tombol enter ditekan
                            var newValue = $(this).val();
                            var id = $(this).closest('tr').find('[data-mode="edit"]')[0].dataset.id; // Ambil ID dari baris yang diperbarui
                            console.log(id);
                            $.ajax({
                                type: 'PATCH',
                                url: 'titipan/' + id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    stok: newValue
                                },
                                success: function(response) {
                                    // Tambahkan kode untuk menangani respons jika perlu
                                    console.log('Stok berhasil diperbarui');
                                },
                                error: function(xhr, status, error) {
                                    // Tambahkan kode untuk menangani kesalahan jika perlu
                                    console.error(xhr);
                                }
                            });
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#data-titipan').DataTable({
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
@extends('templates.layout')

@push('style')
@endpush

@section('content')


<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h1>Absensi Karyawan </h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formInputabsensiKaryawan"><i class="fa fa-plus-square"></i> Input Absensi Karyawan</button>

                                <button class="btn btn-info" data-toggle="modal" data-target="#formInputAbsensiKaryawan"><i class="fa fa-file-pdf-o"></i> Import</button>
                                <a href="{{ route('absensiKaryawan-export-pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>Export PDF</a>
                                <a class="btn btn-success" href="{{route('export-absensiKaryawan')}}"><i class="fa fa-file-excel-o"></i>Export</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <table id="data-absensiKaryawan" class="table table-bordered table striped">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Tanggal masuk</th>
                                            <th>Waktu Masuk</th>
                                            <th>Status</th>
                                            <th>Waktu selesai kerja</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absensiKaryawan as $item)
                                            <tr>
                                            <td>{{ $i= !isset ($i) ? ($i =1) : ++$i }}</td>
                                            <td>{{ $item->namaKaryawan }}</td>
                                            <td>{{ $item->tanggalMasuk }}</td>
                                            <td>{{ $item->waktuMasuk }}</td>
                                            <td> 
                                                <div class="col-sm-10">
                                                    <select name="status" id="status" class="btn btn-success dropdown-toggle">
                                                        {{-- <option value="">Status</option>--}}
                                                        <option <?= $item->status=="masuk" ? "selected " : ''?> value="masuk">Masuk</option>
                                                        <option <?= $item->status=="cuti" ? "selected " : ''?> value="cuti">Cuti</option>
                                                        <option <?= $item->status=="sakit" ? "Selected " : ''?> value="sakit">Sakit</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>{{ $item->waktuKeluar }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputabsensiKaryawan" data-mode="edit" data-id="{{ $item->id }}" data-nama-karyawan="{{ $item->namaKaryawan }}" data-tanggal-masuk="{{ $item->tanggalMasuk }}" data-waktu-masuk="{{ $item->waktuMasuk }}" data-status="{{ $item->status}}" data-waktu-keluar="{{ $item->waktuKeluar }}">
                                                        <i class='fa fa-edit'></i> Edit
                                                    </button>
                                                    <!-- <form action="absensiKaryawan/{{ $item->id}}" method="post" style="display :inline"> -->
                                                    <form action="{{ route('absensi.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
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
            @include('absensiKaryawan.modal')
            @include('absensiKaryawan.data')
            @endsection
            @push('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
            </script>
            <script>
                console.log('absensiKaryawan')
                // $('#dataTable').DataTable();

                $('#status').on('change', function(){
                    const id = $(this).closest('tr').find('button[data-mode=edit]').data('id')
                    const status = this.value
                    $.ajax({
                        method:'PUT',
                        url: "update-status-absensi/"+id,
                        data: {
                            '_token':'{{csrf_token()}}',
                            'status': status},
                        success:function(response){
                            console.log('success', response)
                        },
                        error:function(error){
                            console.log(error)
                        }
                        });
                })

                $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                    $('.alert-success').slideUp(500)
                });

                $('.delete-data').on('click', function(e) {
                    e.preventDefault()
                    let nama_karyawan = $(this).closest('tr').find('td:eq(1)').text()
                    Swal.fire({
                        title: `Apakah data ${nama_karyawan} akan dihapus ?`,
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

                $('#formInputabsensiKaryawan').on('show.bs.modal', function(e) {
                    console.log('modal')
                    const btn = $(e.relatedTarget)
                    const mode = btn.data('mode')
                    const namaKaryawan = btn.data('nama-karyawan')
                    const tanggalMasuk = btn.data('tanggal-masuk')
                    const waktuMasuk = btn.data('waktu-masuk')
                    const status = btn.data('status')
                    const waktuKeluar = btn.data('waktu-keluar')
                    const id = btn.data('id')
                    const modal = $(this)
                    if (mode === 'edit') {
                        modal.find('.modal-title').text('Edit Absensi Karyawan')
                        modal.find('#namaKaryawan').val(namaKaryawan)
                        modal.find('#tanggalMasuk').val(tanggalMasuk)
                        modal.find('#waktuMasuk').val(waktuMasuk)
                        modal.find('#status').val(status)
                        modal.find('#waktuKeluar').val(waktuKeluar)
                        modal.find('.modal-body form').attr('action', '{{ url("absensi") }}/' + id)
                        modal.find('#method').html('@method("PATCH")')
                    } else {
                        modal.find('.modal-title').text('Input absensiKaryawan')
                        modal.find('#namaKaryawan').val('')
                        modal.find('#tanggalMasuk').val('')
                        modal.find('#waktuMasuk').val('')
                        modal.find('#status').val('')
                        modal.find('#image').val('')
                        modal.find('#waktuKeluar').val('')
                        modal.find('#method').html('')
                        modal.find('.modal-body form').attr('action', '{{ url("absensi") }}')
                    }
                })

                
            </script>
             <script>
                $(document).ready(function() {
                    $('#data-absensiKaryawan').DataTable({
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
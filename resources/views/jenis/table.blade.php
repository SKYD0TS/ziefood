<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_jenis }}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formInputJenis" data-mode="edit" data-id="{{ $item->id }}" data-nama_jenis="{{ $item->nama_jenis }}">
                        <i class='fa fa-edit'></i> Edit
                    </button>
                    <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline form-delete" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-data" data-id="{{ $item->id }}" data-nama_jenis="{{ $item->nama_jenis }}">
                            <i class='fa fa-trash'></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('script')
@endpush
@push('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('gentelella-alela') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('gentelella-alela')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('gentelella-alela') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#data-jenis").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#data-jenis .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush
<script>
    // $(function() {
    //     $('#tbl-produk').DataTable()

    //     //dialog hapus data
    //     $('.btn-delete').on('click', function(e) {
    //         let nama_produk = $(this).closest('tr').find('')
    //     })
    // // })
</script>
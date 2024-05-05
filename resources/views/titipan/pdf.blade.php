<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan PDF</title>
    <style>
        /* Gaya CSS untuk PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan PDF</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
                <th>Nama Produk</th>
                <th>Nama Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_jenis }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->nama_supplier }}</td>
                <td>{{ $item->harga_beli }}</td>
                <td>{{ $item->harga_jual }}</td>
                <td>{{ $item->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
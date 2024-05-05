<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
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
    <h1>Daftar Menu</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ $item->nama_menu }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->stok->jumlah }}</td>
                <td><img src="data:image/jpeg;base64,{{ $item->imageData }}" alt="{{ $item->nama_menu }}" style="max-width: 100px;"></td>
                <td>{{ $item->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
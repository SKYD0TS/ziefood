<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggan</title>
    <style>
        /* Gaya CSS untuk PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Pelanggan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
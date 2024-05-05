<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Jenis</title>
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
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_jenis }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
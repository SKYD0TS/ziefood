<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
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
    <h1>Laporan Transaksi</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Id Transaksi</th>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>
                    @foreach($item->detailTransaksi as $detail)
                    <p>Nama:{{ $detail->menu->nama_menu }}</p>
                    <p>Qty:{{ $detail->jumlah }}</p>
                    <p>Subtotal:{{ $detail->subtotal }}</p>
                    <hr>
                    @endforeach
                </td>
                <td>{{ $item->total_harga }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
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
                <th>Id Transaksi</th>
                <th>Id Menu</th>
                <th>Total</th>
                <th>Tanggal </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>@foreach($item->detailTransaksi as $detail)
                    <p>Nama Menu: {{$detail->menu->nama_menu}}</p>
                    <p><img src="data:image/jpeg;base64,{{ $detail->menu->imageData }}" alt="{{ $detail->menu->nama_menu }}" style="max-width: 100px;"></p>
                    <p>Harga: {{$detail->menu->harga}}</p>
                    <p>Qty: {{$detail->jumlah}}</p>
                    <p>Subtotal: {{$detail->subtotal}}</p>
                    <hr>
                @endforeach</td>
                <td>{{ $item->total_harga }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
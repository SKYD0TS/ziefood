<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran ke Supplier</title>
    <style>
        /* CSS untuk tampilan kuitansi */
    </style>
</head>

<body>
    <div class="kuitansi">
        <div class="header">
            <h2>Kuitansi Pembayaran ke Supplier</h2>
        </div>
        <div class="content">
            <!-- Informasi pembayaran -->
            <p>Tanggal: {{ date('Y-m-d') }}</p>
            <p>Nama Supplier: ABC Supplier</p>
            <p>Jumlah Pembayaran: $500</p>
        </div>
        <div class="footer">
            <p>Terima kasih atas kerjasamanya.</p>
        </div>
    </div>
</body>

</html>
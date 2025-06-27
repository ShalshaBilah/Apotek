<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 15px;
        }

        .header h2 {
            font-size: 24px;
            color: #4CAF50;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #555;
        }

        .header .info {
            font-size: 14px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table tfoot {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .total-row {
            background-color: #f1f1f1;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Invoice Pembelian</h2>
            <p><strong>ID Pembelian:</strong> {{ $pembelian->id_pembelian }}</p>
            <p><strong>Supplier:</strong> {{ $pembelian->supplier->nama ?? 'Tidak Diketahui' }}</p>
            <p><strong>Tanggal:</strong> {{ tanggal_indonesia($pembelian->created_at) }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($detail as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ optional($item->produk)->kode_produk ?? 'N/A' }}</td>
                        <td>{{ optional($item->produk)->nama_produk ?? 'N/A' }}</td>
                        <td>{{ format_uang($item->harga_beli) }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ format_uang($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" style="text-align: right;">Total</td>
                    <td>{{ format_uang($pembelian->total_harga) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Terima kasih atas transaksi Anda!</p>
            <p>Apabila ada pertanyaan, silakan hubungi kami.</p>
        </div>
    </div>
</body>

</html>
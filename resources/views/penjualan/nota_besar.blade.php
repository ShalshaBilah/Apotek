<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota PDF</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            padding: 8px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        table td {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .nota-header,
        .nota-footer {
            margin-bottom: 20px;
        }

        .nota-header img {
            width: 120px;
            margin-right: 20px;
        }

        .nota-header .info {
            margin-top: 10px;
        }

        .nota-footer {
            text-align: center;
        }

        .nota-footer .kasir {
            margin-top: 20px;
        }

        .nota-footer b {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="nota-header">
        <table>
            <tr>
                <td rowspan="3" style="width: 20%;">
                    <img src="image/images.png" alt="Logo">
                </td>
                <td style="width: 20%;">Tanggal</td>
                <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
            </tr>
            <tr>
                <td>Kode Member</td>
                <td>: {{ $penjualan->member->kode_member ?? '-' }}</td>
            </tr>

        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->produk->kode_produk }}</td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td class="text-right">{{ format_uang($item->harga_jual) }}</td>
                    <td class="text-right">{{ format_uang($item->jumlah) }}</td>
                    <td class="text-right">{{ format_uang($item->diskon) }}</td>
                    <td class="text-right">{{ format_uang($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><b>Total Harga</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->total_harga) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Diskon</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->diskon) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Total Bayar</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->bayar) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Diterima</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->diterima) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Kembali</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->diterima - $penjualan->bayar) }}</b></td>
            </tr>
        </tfoot>
    </table>

    <div class="nota-footer">
        <table>
            <tr>
                <td><b>Terimakasih telah berbelanja dan sampai jumpa</b></td>
                <td class="text-center kasir">
                    <b>Kasir</b>
                    <br>
                    <br>
                    {{ auth()->user()->name }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
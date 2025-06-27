<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>

    <link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            font-size: 14px;
            /* Ukuran font keseluruhan lebih kecil */
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .text-center {
            margin-bottom: 20px;
            font-size: 16px;
            /* Ukuran font judul lebih kecil */
        }

        .table {
            border-collapse: collapse;
            font-size: 13px;
            /* Ukuran font tabel lebih kecil */
        }

        .table th,
        .table td {
            padding: 10px;
            /* Mengurangi padding agar lebih padat */
            text-align: center;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-export {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            /* Ukuran padding lebih kecil */
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px;
            /* Ukuran font tombol lebih kecil */
        }

        .btn-export:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Laporan Pendapatan</h3>
        <h4 class="text-center">
            Tanggal {{ tanggal_indonesia($awal, false) }} s/d Tanggal {{ tanggal_indonesia($akhir, false) }}
        </h4>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th>Penjualan</th>
                    <th>Pembelian</th>
                    <!-- <th>Pengeluaran</th> -->
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $row)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $row['tanggal'] }}</td>
                        <td>{{ $row['penjualan'] }}</td>
                        <td>{{ $row['pembelian'] }}</td>
                        <!-- <td>{{ $row['pengeluaran'] }}</td> -->
                        <td>{{ $row['pendapatan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .box {
            position: relative;
            width: 85.60mm;
            height: 53.98mm;
            margin: 10px auto;
            background: url('image/member.png') no-repeat center center;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .logo {
            position: absolute;
            top: 5px;
            right: 15px;
            /* Tambah jarak dari sisi kanan */
            display: flex;
            align-items: center;
            font-size: 12px;
            font-weight: bold;
            color: white;
            padding: 5px;
            /* Menambah jarak dari gambar latar */
        }

        .logo img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }


        .nama {
            position: absolute;
            bottom: 45px;
            left: 15px;
            font-size: 14pt;
            font-weight: bold;
            color: #fff;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }

        .telepon {
            position: absolute;
            bottom: 20px;
            left: 15px;
            font-size: 12pt;
            color: #fff;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }

        .barcode {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.8);
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-spacing: 20px;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <section>
        <table>
            @foreach ($datamember as $key => $data)
                <tr>
                    @foreach ($data as $item)
                        <td>
                            <div class="box">
                                <div class="logo">
                                    Apotek Telu
                                    <img src="image/remove.png" alt="logo">
                                </div>
                                <div class="nama">{{ $item->nama }}</div>
                                <div class="telepon">{{ $item->telepon }}</div>
                                <div class="barcode">
                                    <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG("$item->kode_member", 'QRCODE') }}"
                                        alt="qrcode">
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </section>
</body>

</html>
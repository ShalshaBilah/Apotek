<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .box {
            position: relative;
            width: 85.60mm;
            height: 53.98mm;
            margin: 10px auto;
            background: url('{{ asset("image/member.png") }}') no-repeat center center;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .logo {
            position: absolute;
            top: 5px;
            right: 10px;
            display: flex;
            align-items: center;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .logo img {
            width: 30px;
            height: 30px;
            margin-left: 8px;
            border-radius: 50%;
        }

        .nama {
            position: absolute;
            bottom: 45px;
            left: 15px;
            font-size: 14pt;
            font-weight: bold;
            color: white;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .telepon {
            position: absolute;
            bottom: 20px;
            left: 15px;
            font-size: 12pt;
            color: white;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .barcode {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 5px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-spacing: 10px;
        }

        td {
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
            }

            .box {
                width: 70mm;
                /* Lebar kartu lebih kecil */
                height: 45mm;
                /* Tinggi kartu lebih kecil */
                margin: 5mm auto;
                page-break-inside: avoid;
                /* Hindari kartu terpotong */
            }

            td {
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    <table>
        @foreach ($members->chunk(2) as $chunk) {{-- Membagi data menjadi grup 2 --}}
            <tr>
                @foreach ($chunk as $member)
                    <td>
                        <div class="box">
                            <div class="logo">
                                Apotek Telu
                                <img src="{{ asset('image/remove.png') }}" alt="Logo">
                            </div>
                            <div class="nama">{{ $member->nama }}</div>
                            <div class="telepon">{{ $member->telepon }}</div>
                            <div class="barcode">
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($member->kode_member, 'QRCODE') }}"
                                    alt="QR Code">
                            </div>
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>

</body>

</html>
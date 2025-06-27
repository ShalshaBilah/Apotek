<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .barcode-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .barcode-item {
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 220px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .barcode-item strong {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        .barcode-item p {
            margin: 0;
            font-size: 12px;
            color: #555;
        }

        .barcode-item img {
            margin: 10px 0;
            max-width: 100%;
        }

        .price {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="barcode-container">
        @foreach ($barcodes as $barcode)
            <div class="barcode-item">
                <strong>{{ $barcode['nama_produk'] }}</strong>
                <p>
                    <span
                        style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block;">
                        {{ $barcode['kode_produk'] }}

                    </span>
                </p>
                <img src="data:image/png;base64,{{ $barcode['barcode'] }}" alt="Barcode {{ $barcode['kode_produk'] }}">
                <p class="price">Rp {{ number_format($barcode['harga_jual'], 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Barcode Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f9;
            /* Memberikan latar belakang yang lembut */
            padding: 40px 0;
        }

        .barcode-container {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            width: 220px;
            background-color: #fff;
            /* Latar belakang putih */
            border-radius: 10px;
            /* Sudut yang membulat */
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
            /* Garis batas tipis */
        }

        .barcode-container img {
            width: 100%;
            height: auto;
            /* Border pada barcode */
            /* Membulatkan sudut barcode */
            margin-top: 10px;
            /* Memberikan jarak antara gambar dan teks */
        }

        .barcode-container p {
            margin: 10px 0;
            font-size: 16px;
        }

        .barcode-container p strong {
            font-size: 18px;
            color: #333;
            /* Warna teks produk */
            font-weight: 600;
        }

        .barcode-container .price {
            color: #28a745;
            /* Warna hijau untuk harga */
            font-size: 16px;
            font-weight: bold;
        }

        .barcode-container p:last-child {
            color: #888;
            /* Warna abu-abu untuk kode produk */
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="barcode-container">
        <!-- Nama produk -->
        <p><strong>{{ $produk->nama_produk }}</strong></p>
        <p> <span
                style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block;">
                {{ $produk->kode_produk }}

            </span></p>
        <!-- Barcode -->
        <img src="data:image/png;base64,{{ $barcode }}" alt="{{ $produk->kode_produk }}">
        <!-- Kode produk -->

        <!-- Harga Produk -->
        <p class="price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
    </div>
</body>

</html>
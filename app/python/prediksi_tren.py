import sys
import json
import os
from analisis_tren import AnalisisTrenPenyakit

if __name__ == "__main__":
    # ID user dari command line
    user_id = int(sys.argv[1])

    # Path ke file pembelian_user.json
    input_path = os.path.join(os.path.dirname(__file__), '..', '..', 'storage', 'app', 'public', 'pembelian_user.json')

    # Memuat data pembelian pengguna
    with open(input_path, 'r') as f:
        pembelian_user = json.load(f)

    # Menentukan path model
    model_path = "D:/telu/apotik-main/storage/app/public/tren_optimal1.pkl"

    # Inisialisasi dan prediksi
    analis = AnalisisTrenPenyakit(model_path)
    hasil = analis.prediksi_tren(pembelian_user, user_id)

    # Path untuk menyimpan hasil prediksi
    output_path = os.path.join(os.path.dirname(__file__), '..', '..', 'storage', 'app', 'public', 'hasil_tren_user.json')

    # Menyimpan hasil analisis ke file JSON
    with open(output_path, 'w') as f:
        json.dump(hasil, f)

    print("Analisis selesai dan hasil disimpan.")
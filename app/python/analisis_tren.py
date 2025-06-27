import pickle
import pandas as pd
import os

class AnalisisTrenPenyakit:
    def __init__(self, model_path):
        with open(model_path, 'rb') as f:
            self.model = pickle.load(f)

    def prediksi_tren(self, pembelian_user, user_id):
        # Pembelian_user adalah list of dict
        df_user = pd.DataFrame(pembelian_user)

        # Encode penyakit jadi angka
        df_user['penyakit_num'] = df_user['penyakit'].astype('category').cat.codes

        # Menambahkan kolom tanggal dan fitur lainnya jika diperlukan
        if 'tanggal_pembelian' in df_user.columns:
            df_user['tanggal_pembelian'] = pd.to_datetime(df_user['tanggal_pembelian'])
            df_user['day'] = df_user['tanggal_pembelian'].dt.day
            df_user['month'] = df_user['tanggal_pembelian'].dt.month
            df_user['year'] = df_user['tanggal_pembelian'].dt.year

        # Masukkan id user, jika user_id 0 berarti pengguna belum login
        df_user['nama_pembeli'] = user_id if user_id != 0 else -1

        # Kolom fitur, pastikan sesuai dengan pelatihan
        X_user = df_user[['nama_pembeli', 'jumlah', 'penyakit_num', 'day', 'month', 'year']]

        # Prediksi cluster
        clusters = self.model.predict(X_user)

        # Tambahkan hasil cluster
        df_user['cluster'] = clusters

        # Return hasil dalam format yang diinginkan
        return df_user[['nama_pembeli','nama_obat', 'penyakit', 'cluster', 'day', 'month', 'year','jumlah']].to_dict(orient='records')

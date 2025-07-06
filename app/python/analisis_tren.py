import pickle
import pandas as pd
import os

class AnalisisTrenPenyakit:
    def __init__(self, model_path):
        with open(model_path, 'rb') as f:
            model_bundle = pickle.load(f)
            self.model = model_bundle['kmeans']
            self.pca = model_bundle['pca']
            self.scaler = model_bundle['scaler']
            self.feature_columns = model_bundle['feature_columns']  # Ambil kolom fitur

    def prediksi_tren(self, pembelian_user, user_id):
        df_user = pd.DataFrame(pembelian_user)

        df_user['penyakit_num'] = df_user['penyakit'].astype('category').cat.codes

        if 'tanggal_pembelian' in df_user.columns:
            df_user['tanggal_pembelian'] = pd.to_datetime(df_user['tanggal_pembelian'])
            df_user['day'] = df_user['tanggal_pembelian'].dt.day
            df_user['month'] = df_user['tanggal_pembelian'].dt.month
            df_user['year'] = df_user['tanggal_pembelian'].dt.year

        # Gunakan nama pembeli sebagai string (agar bisa di-one-hot)
        df_user['nama_pembeli'] = f'pembeli_{user_id}' if user_id != 0 else 'pembeli_-1'

        # One-hot encoding nama_pembeli (sama seperti saat training)
        encoded_pembeli = pd.get_dummies(df_user['nama_pembeli'])

        # Gabungkan dengan fitur numerik lainnya
        fitur_lain = df_user[['jumlah', 'penyakit_num', 'day', 'month', 'year']]
        fitur_user = pd.concat([encoded_pembeli, fitur_lain], axis=1)

        # Tambahkan kolom yang hilang agar cocok dengan model
        for col in self.feature_columns:
            if col not in fitur_user.columns:
                fitur_user[col] = 0  # Kolom baru diisi dengan 0

        # Pastikan urutan kolom sama persis
        fitur_user = fitur_user[self.feature_columns]

        # Scaling dan PCA
        X_scaled = self.scaler.transform(fitur_user)
        X_pca = self.pca.transform(X_scaled)

        # Prediksi
        clusters = self.model.predict(X_pca)
        df_user['cluster'] = clusters

        return df_user[['nama_pembeli','nama_obat', 'penyakit', 'cluster', 'day', 'month', 'year','jumlah']].to_dict(orient='records')

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Penjualan;
use App\Models\Prodak;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class AnalisisController extends Controller
{
    // AnalisisController.php
    public function exportSemuaObat()
    {
        // Ambil semua data penjualan dan detail produk
        $penjualans = Penjualan::with(['member', 'detail.produk'])->get();

        // Ambil semua data prodak dan buat mapping nama_produk => kategori
        $prodaks = Prodak::all();
        $prodakMap = $prodaks->pluck('kategori', 'nama'); // ['Paracetamol' => 'Demam', ...]

        $rows = [];

        foreach ($penjualans as $penjualan) {
            $namaPembeli = $penjualan->members->id ?? '0';

            // Format tanggal ke format Indonesia
            $tanggalPembelian = \Carbon\Carbon::parse($penjualan->created_at)->translatedFormat('d F Y');

            foreach ($penjualan->detail as $detail) {
                $produk = $detail->produk;
                $namaObat = $produk->nama_produk ?? 'Tidak Diketahui';

                // Cocokkan nama produk dengan nama di tabel prodaks
                $kategori = $prodakMap[$namaObat] ?? 'Tidak Diketahui';

                // Ambil jumlah obat yang dibeli dari field 'jumlah' di penjualan_detail
                $jumlah = $detail->jumlah ?? 0;

                $rows[] = [
                    'nama_pembeli' => $namaPembeli,
                    'nama_obat' => $namaObat,
                    'jumlah' => $jumlah,
                    'penyakit' => $kategori,
                    'tanggal' => $tanggalPembelian,
                ];
            }
        }

        if (empty($rows)) {
            return back()->with('error', 'Data pembelian tidak ditemukan.');
        }

        // Simpan ke file CSV
        $csvPath = storage_path("app/public/data_semua_user.csv");
        $file = fopen($csvPath, 'w');
        fputcsv($file, ['nama_pembeli', 'nama_obat', 'jumlah', 'penyakit', 'tanggal']);

        foreach ($rows as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        return response()->download($csvPath)->deleteFileAfterSend(true);
    }

    // public function showHasilKmeans()
    // {
    //     $userId = Auth::id();
    //     $path = storage_path('app/public/hasil_cluster_user_2_' . $userId . '.csv');
    //     $data = [];

    //     if (!file_exists($path)) {
    //         return view('users.trend-kmeans', compact('data'))
    //             ->with('error', 'File hasil clustering tidak ditemukan.');
    //     }

    //     if (($handle = fopen($path, 'r')) !== FALSE) {
    //         $header = fgetcsv($handle); // Ambil header
    //         while (($row = fgetcsv($handle)) !== FALSE) {
    //             if (count($row) < 5)
    //                 continue;

    //             if ($row[0] == $userId) {
    //                 // Menyesuaikan urutan untuk blade
    //                 $data[] = [
    //                     $row[1], // nama_obat
    //                     $row[3], // penyakit
    //                     $row[4], // cluster
    //                 ];
    //             }
    //         }
    //         fclose($handle);
    //     }

    //     return view('users.trend-kmeans', compact('data'));
    // }
    // public function uploadCluster(Request $request)
    // {
    //     $request->validate([
    //         'cluster_file' => 'required|file|mimes:csv,txt',
    //     ]);

    //     $filename = 'hasil_cluster_user_2_' . Auth::id() . '.csv';
    //     $path = $request->file('cluster_file')->storeAs('public/hasil', $filename);

    //     return back()->with('success', 'Hasil clustering berhasil diupload.');
    // }


    public function trenPenyakit(Request $request)
    {
        // Cek apakah user login
        $user = auth()->user();
        $user_id = $user ? $user->id : null; // Jika tidak login, user_id menjadi null

        // Ambil data pembelian dari database
        $pembelian = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.id_penjualan', '=', 'penjualan_detail.id_penjualan')
            ->join('produk', 'penjualan_detail.id_produk', '=', 'produk.id_produk')
            ->join('prodaks', 'produk.nama_produk', '=', 'prodaks.nama')
            ->where(function ($query) use ($user_id) {
                if ($user_id) {
                    $query->where('penjualan.id_member', $user_id); // Jika login, ambil berdasarkan user_id
                } else {
                    $query->whereNull('penjualan.id_member'); // Jika tidak login, ambil data dengan id_member null
                }
            })
            ->select(
                'produk.nama_produk as nama_obat',
                'prodaks.gejala as penyakit',
                'penjualan_detail.jumlah',
                'penjualan.created_at'
            )
            ->get()
            ->toArray();

        // Periksa apakah data tersedia
        if (count($pembelian) === 0) {
            // Jika tidak ada data pembelian, kirimkan array kosong
            return view('users.dashboard', ['hasil' => []]);
        }

        // Mengonversi data ke format yang dibutuhkan
        $pembelian_array = array_map(function ($item) use ($user_id) {
            $tanggal = Carbon::parse($item->created_at);
            return [
                'nama_obat' => $item->nama_obat,
                'penyakit' => $item->penyakit,
                'jumlah' => $item->jumlah,
                'day' => $tanggal->day,
                'month' => $tanggal->month,
                'year' => $tanggal->year,
                'nama_pembeli' => $user_id ? $user_id : -1, // Jika user_id null, set -1
            ];
        }, $pembelian);

        // Simpan ke file JSON
        $inputPath = storage_path('app/public/pembelian_user.json');
        file_put_contents($inputPath, json_encode($pembelian_array));

        // Jalankan skrip Python
        $process = new Process([
            'C:\\Program Files\\Python311\\python.exe',
            base_path('app/python/prediksi_tren.py'),
            $user_id ?? 0 // Mengirimkan user_id yang digunakan dalam proses Python, jika null kirimkan 0
        ], null, [
            'PYTHONPATH' => 'C:\\Users\\Rafidatus Salsabilah\\AppData\\Roaming\\Python\\Python311\\site-packages'
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            // Jika proses gagal, tampilkan error
            dd($process->getErrorOutput()); // Tampilkan pesan error
        }

        $hasilPath = storage_path('app/public/hasil_tren_user.json');
        $hasil_array = json_decode(file_get_contents($hasilPath), true);

        if (empty($hasil_array)) {
            return view('users.dashboard', ['hasil' => [], 'paginatedHasil' => null]);
        }

        // Pagination Manual
        $page = $request->input('page', 1);
        $perPage = 10;
        $collection = collect($hasil_array);
        $paginatedHasil = new LengthAwarePaginator(
            $collection->forPage($page, $perPage)->values(),
            $collection->count(),
            $perPage,
            $page,
            ['path' => url()->current(), 'query' => $request->query()]
        );

        return view('users.dashboard', [
            'hasil' => $hasil_array,
            'paginatedHasil' => $paginatedHasil
        ]);
    }






    // public function trenPenyakit()
    // {
    //     $user = auth()->user();

    //     $pembelian = DB::table('penjualan')
    //         ->join('penjualan_detail', 'penjualan.id_penjualan', '=', 'penjualan_detail.id_penjualan')
    //         ->join('produk', 'penjualan_detail.id_produk', '=', 'produk.id_produk')
    //         ->join('prodaks', 'produk.nama_produk', '=', 'prodaks.nama')
    //         ->where('penjualan.id_member', $user->id)
    //         ->select('produk.nama_produk as nama_obat', 'prodaks.kategori as penyakit', 'penjualan_detail.jumlah')
    //         ->get()
    //         ->toArray();

    //     $pembelian_array = array_map(function ($item) {
    //         return [
    //             'nama_obat' => $item->nama_obat,
    //             'penyakit' => $item->penyakit,
    //             'jumlah' => $item->jumlah,
    //         ];
    //     }, $pembelian);

    //     $inputPath = storage_path('app/public/pembelian_user.json');
    //     file_put_contents($inputPath, json_encode($pembelian_array));

    //     $process = new Process([
    //         'C:\\Program Files\\Python311\\python.exe',
    //         base_path('app/python/prediksi_tren.py'),
    //         $user->id
    //     ], null, [
    //         'PYTHONPATH' => 'C:\\Users\\Rafidatus Salsabilah\\AppData\\Roaming\\Python\\Python311\\site-packages'
    //     ]);

    //     $process->run();

    //     if (!$process->isSuccessful()) {
    //         throw new ProcessFailedException($process);
    //     }

    //     $hasilPath = storage_path('app/public/hasil_tren_user.json');
    //     $hasil = json_decode(file_get_contents($hasilPath), true);

    //     return view('users.dashboard', compact('hasil'));
    // }

    // UserController.php
    // public function generateClusterOtomatis()
    // {
    //     $userId = Auth::id();

    //     // Jalankan script Python untuk generate cluster
    //     $process = new Process(['python3', base_path('python/analisis_tren.py'), $userId]);
    //     $process->run();

    //     if (!$process->isSuccessful()) {
    //         return back()->with('error', 'Gagal membuat cluster: ' . $process->getErrorOutput());
    //     }

    //     // Setelah cluster berhasil dibuat, arahkan ke halaman tren penyakit
    //     return redirect()->route('showTrenPenyakit')->with('success', 'Analisis tren penyakit berhasil diperbarui.');
    // }


    // public function showTrenPenyakit()
    // {
    //     $path = storage_path('app/public/hasil_cluster_user_2_' . Auth::id() . '.csv');
    //     $data = [];

    //     if (!file_exists($path)) {
    //         return view('users.dashboard', ['data' => null])
    //             ->with('error', 'File hasil clustering tidak ditemukan.');
    //     }

    //     if (($handle = fopen($path, 'r')) !== false) {
    //         $header = fgetcsv($handle);
    //         if (!$header || count($header) < 5) {
    //             fclose($handle);
    //             return view('users.dashboard', ['data' => null])
    //                 ->with('error', 'File hasil clustering tidak valid.');
    //         }

    //         $temp = [];
    //         while (($row = fgetcsv($handle)) !== false) {
    //             if (count($row) >= 5 && $row[0] == Auth::id()) {
    //                 $penyakit = $row[3];

    //                 if (!isset($temp[$penyakit])) {
    //                     $temp[$penyakit] = [
    //                         'kategori_penyakit' => $penyakit,
    //                         'jumlah' => 1,
    //                         'cluster' => $row[4],
    //                     ];
    //                 } else {
    //                     $temp[$penyakit]['jumlah'] += 1;
    //                 }
    //             }
    //         }
    //         fclose($handle);

    //         $data = array_values($temp);
    //     }

    //     return view('users.dashboard', ['data' => $data]);
    // }
}

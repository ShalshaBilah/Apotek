<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PenjualanController extends Controller
{
    public function index()
    {
        // Ambil data penjualan dengan relasi member
        $penjualan = Penjualan::with('users') // Pastikan relasi 'member' sudah didefinisikan
            ->orderBy('created_at', 'desc') // Sortir data
            ->paginate(5); // Gunakan pagination jika diperlukan

        // Kirim data ke view
        return view('penjualan.index', compact('penjualan'));
    }


    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->id_member = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);
        return redirect()->route('transaksi.index');
    }

    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->id_penjualan);
        $penjualan->id_member = $request->id_member;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->diterima = $request->diterima;
        $penjualan->update();

        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = Produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('transaksi.selesai');
    }


    public function prosesPembelian(Request $request)
    {
        // proses pembelian seperti biasa...

        // Setelah pembelian sukses, generate cluster
        $analisis = new AnalisisController();
        $analisis->generateClusterOtomatis();

        return redirect()->route('dashboard')->with('success', 'Pembelian berhasil dan analisis tren penyakit diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Penjualan tidak ditemukan.'], 404);
            }
            return redirect()->route('penjualan.index')->with('error', 'Penjualan tidak ditemukan.');
        }

        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->save();
            }
            $item->delete();
        }

        $penjualan->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Penjualan berhasil dihapus.']);
        }

        return redirect()->route('penjualan.index')->with('delete', 'Penjualan berhasil dihapus');
    }

    // public function deletepenjualan($id)
    // {
    //     $penjualan = Penjualan::find($id);
    //     $penjualan->delete();
    //     return redirect()->route('penjualan.index')->with('delete', 'Penjualan Berhasil Dihapus');

    // }

    public function selesai()
    {

        return view('penjualan.selesai');
    }

    public function show($id)
    {
        $penjualanDetail = PenjualanDetail::with('produk')
            ->where('id_penjualan', $id)
            ->get();

        if ($penjualanDetail->isEmpty()) {
            return redirect()->route('penjualan.index')->with('error', 'Data detail tidak ditemukan.');
        }

        $penjualan = Penjualan::find($id);

        return view('penjualan.detail', compact('penjualan', 'penjualanDetail'));
    }

    public function notaKecil()
    {
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        return view('penjualan.nota_kecil', compact('penjualan', 'detail'));
    }

    public function notaBesar()
    {
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        $pdf = PDF::loadView('penjualan.nota_besar', compact('penjualan', 'detail'));
        $pdf->setPaper(0, 0, 609, 440, 'potrait');
        return $pdf->stream('Transaksi-' . date('Y-m-d-his') . '.pdf');
    }
    public static function grafik()
    {
        // Ambil data pengeluaran per bulan
        return Penjualan::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    }


    public function dashboard()
    {
        // Mendapatkan data tahun dan bulan yang unik dari hasil penjualan
        $hasil = PenjualanDetail::all(); // Atau sesuaikan dengan query Anda
        $daftar_tahun = collect($hasil)->pluck('year')->unique();
        $daftar_bulan = collect($hasil)->pluck('month')->unique();

        // Menyiapkan daftar bulan untuk dropdown
        $nama_bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Menyertakan data ke dalam view
        return view('dashboard', [
            'daftar_tahun' => $daftar_tahun,
            'daftar_bulan' => $daftar_bulan,
            'nama_bulan' => $nama_bulan,
            'obatPalingLaku' => $this->obatPalingLaku(), // Pastikan metode ini memanggil data dengan benar
        ]);
    }



    public static function obatPalingLaku($bulan = null, $tahun = null, $minggu = null)
    {
        $bulan = $bulan ?: Carbon::now()->month;
        $tahun = $tahun ?: Carbon::now()->year;

        // Hitung minggu ke-N
        $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $mingguanRange = [
            $startOfMonth->copy()->addDays(7 * ($minggu - 1) ?: 0)->startOfDay(),
            $startOfMonth->copy()->addDays(7 * $minggu ?: 7)->endOfDay()
        ];

        return [
            'mingguan' => DB::table('penjualan_detail')
                ->join('produk', 'penjualan_detail.id_produk', '=', 'produk.id_produk')
                ->select('produk.nama_produk', DB::raw('SUM(penjualan_detail.jumlah) as total'))
                ->when($minggu, function ($query) use ($mingguanRange) {
                    $query->whereBetween('penjualan_detail.created_at', $mingguanRange);
                }, function ($query) use ($bulan, $tahun) {
                    $query->whereYear('penjualan_detail.created_at', $tahun)
                        ->whereMonth('penjualan_detail.created_at', $bulan);
                })
                ->groupBy('produk.nama_produk')
                ->orderByDesc('total')
                ->take(5)
                ->get(),

            'bulanan' => DB::table('penjualan_detail')
                ->join('produk', 'penjualan_detail.id_produk', '=', 'produk.id_produk')
                ->select('produk.nama_produk', DB::raw('SUM(penjualan_detail.jumlah) as total'))
                ->whereYear('penjualan_detail.created_at', $tahun)
                ->whereMonth('penjualan_detail.created_at', $bulan)
                ->groupBy('produk.nama_produk')
                ->orderByDesc('total')
                ->take(5)
                ->get(),

            'tahunan' => DB::table('penjualan_detail')
                ->join('produk', 'penjualan_detail.id_produk', '=', 'produk.id_produk')
                ->select('produk.nama_produk', DB::raw('SUM(penjualan_detail.jumlah) as total'))
                ->whereYear('penjualan_detail.created_at', $tahun)
                ->groupBy('produk.nama_produk')
                ->orderByDesc('total')
                ->take(5)
                ->get(),
        ];
    }
}

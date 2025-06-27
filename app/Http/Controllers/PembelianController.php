<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\PembelianDetail;



class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan daftar pembelian
    public function index(Request $request)
    {
        if ($request->has('search')) {
            // Join Pembelian with Supplier and filter by supplier name
            $pembelian = Pembelian::join('supplier', 'pembelian.id_supplier', '=', 'supplier.id_supplier')
                ->where('supplier.nama', 'LIKE', '%' . $request->search . '%')
                ->select('pembelian.*')  // Select only fields from Pembelian table
                ->paginate(5);
        } else {
            $pembelian = Pembelian::paginate(5);
        }

        $supplier = Supplier::all();

        // Jika belum ada pembelian, maka $detail akan kosong
        $detail = collect([]);

        if ($pembelian->isNotEmpty()) {
            $id_pembelian = $pembelian->first()->id_pembelian;
            $detail = PembelianDetail::with('produk')
                ->where('id_pembelian', $id_pembelian)
                ->get();
        }

        return view('pembelian.index', compact('pembelian', 'supplier', 'detail'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->id_supplier = $id;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon = 0;
        $pembelian->bayar = 0;
        $pembelian->save();

        session(['id_pembelian' => $pembelian->id_pembelian]);
        session(['id_supplier' => $pembelian->id_supplier]);

        return redirect()->route('pembelian_detail.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Menyimpan pembelian
    public function store(Request $request)
    {
        $pembelian = Pembelian::findOrFail($request->id_pembelian);
        $pembelian->total_item = $request->total_item;
        $pembelian->total_harga = $request->total;
        $pembelian->diskon = $request->diskon;
        $pembelian->bayar = $request->bayar;
        $pembelian->update();

        // Mengupdate stok produk sesuai dengan jumlah yang dibeli
        $detail = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }
        }

        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     */
    // Menampilkan detail pembelian di modal
    public function show(string $id)
    {
        // Ambil detail pembelian berdasarkan id pembelian
        $detail = PembelianDetail::with('produk')
            ->where('id_pembelian', $id)
            ->get();

        // Ambil juga data pembelian dan supplier terkait untuk ditampilkan di modal jika diperlukan
        $pembelian = Pembelian::find($id);
        $pembelian = Pembelian::with('supplier')->find($id);
        return view('pembelian.detail-new', compact('detail', 'pembelian'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembelian = Pembelian::find($id);

        // Periksa apakah pembelian ditemukan
        if (!$pembelian) {
            return redirect()->route('pembelian.index')->with('delete', 'Pembelian tidak ditemukan');
        }

        $detail = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();

        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok -= $item->jumlah;
                $produk->update();
            }
            $item->delete();
        }

        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('delete', 'Pembelian Berhasil Dihapus');
    }


    public function printPdf(Request $request)
    {
        // Ambil data pembelian berdasarkan ID
        $pembelian = Pembelian::with('supplier')
            ->where('id_pembelian', $request->id_pembelian)
            ->first();

        // Periksa apakah pembelian ditemukan
        if (!$pembelian) {
            return redirect()->route('pembelian.index')->with('delete', 'Pembelian tidak ditemukan');
        }

        // Periksa apakah relasi supplier ada
        if (!$pembelian->supplier) {
            return redirect()->route('pembelian.index')->with('delete', 'Data supplier tidak ditemukan untuk pembelian ini');
        }

        // Ambil detail pembelian
        $detail = PembelianDetail::with('produk')
            ->where('id_pembelian', $request->id_pembelian)
            ->get();

        // Load view untuk PDF
        $pdf = \PDF::loadView('pembelian.cetak', compact('pembelian', 'detail'));
        return $pdf->stream('pembelian_' . $pembelian->id_pembelian . '.pdf');
    }

    public static function grafik()
    {
        // Ambil data pengeluaran per bulan
        return Pembelian::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    }
}

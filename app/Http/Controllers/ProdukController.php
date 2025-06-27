<?php

namespace App\Http\Controllers;

use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use App\Models\Produk;
use App\Models\Kategori;
use Excel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use Picqer\Barcode\BarcodeGeneratorPNG;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

        // Get all products
        if ($request->has('search')) {
            $produk = Produk::where('nama_produk', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $produk = Produk::with('kategori')->paginate(10); // Menampilkan 10 produk per halaman
        }


        // Pass both categories and products to the view
        return view('produk.index', compact('kategori', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        // Generate kode_produk unik
        do {
            $lastId = Produk::max('id_produk') ?? 0;
            $kodeProduk = 'P' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
            $lastId++;
        } while (Produk::where('kode_produk', $kodeProduk)->exists());

        // Tambahkan kode_produk ke dalam request
        $request->merge(['kode_produk' => $kodeProduk]);

        // Simpan data produk
        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }



    public function create()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        return view('produk.create-produk', compact('kategori'));
    }

    public function edit($id)
    {
        $produk = Produk::find($id); // Cari produk berdasarkan ID
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori'); // Ambil semua kategori

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }

        return view('produk.edit-produk', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('suksesupdate', 'Produk berhasil diperbarui');
    }


    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route(route: 'produk.index')->with('delete', 'Produk Berhasil Dihapus');
    }

    public function show($id)
    {
        // Fetch product by ID
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }

        // Generate barcode for this specific product
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($produk->kode_produk, $generator::TYPE_CODE_128));

        return view('produk.barcode', compact('produk', 'barcode'));
    }
    public function cetakBarcode(Request $request)
    {
        $produkIds = $request->input('produk_id');

        if (empty($produkIds)) {
            return redirect()->route('produk.index')->with('error', 'Tidak ada produk yang dipilih untuk mencetak barcode.');
        }

        $produks = Produk::whereIn('id_produk', $produkIds)->get();
        $generator = new BarcodeGeneratorPNG();

        $barcodes = [];
        foreach ($produks as $produk) {
            $barcode = base64_encode($generator->getBarcode($produk->kode_produk, $generator::TYPE_CODE_128));
            $barcodes[] = [
                'nama_produk' => $produk->nama_produk,
                'kode_produk' => $produk->kode_produk,
                'harga_jual' => $produk->harga_jual, // Tambahkan harga jual
                'barcode' => $barcode,
            ];
        }

        return view('produk.cetak-barcode', compact('barcodes'));
    }

    // Fungsi untuk mencetak barcode produk
    public function exportexcel()
    {
        return Excel::download(new ProdukExport, 'dataproduk.xlsx');
    }
    public function importexcel(Request $request)
    {
        $produk = $request->file('file');

        $namafile = $produk->getClientOriginalName();
        $produk->move('ProdukData', $namafile);

        Excel::import(new ProdukImport, public_path('/ProdukData/' . $namafile));
        return redirect()->back();
    }


}

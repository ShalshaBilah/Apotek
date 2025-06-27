<?php

use App\Models\Member;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdakController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\AnalisisController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/product', [FrontController::class, 'product'])->name('product');

Route::get('/kontak', [FrontController::class, 'kontak'])->name('kontak');

Route::middleware(['auth', 'can:manage prodak'])->group(function () {
    Route::resource('prodak', ProdakController::class);
});

Route::get('prodak/detail/{slug}', [FrontController::class, 'show'])->name('show');
Route::post('/prodak/import', [ProdakController::class, 'import'])->name('prodak.import');


Route::middleware(['auth'])->group(function () {
    Route::get('/preferensi', [RekomendasiController::class, 'preferensi'])->name('preferensi');
    Route::post('/preferences/save', [RekomendasiController::class, 'savePreferences'])->name('frontend.savePreferences');
    Route::get('/rekomendasi', [RekomendasiController::class, 'contentBasedFiltering'])->name('rekomendasi');
});

Route::middleware(['auth', 'can:manage dashboard'])->group(function () {
    Route::get('/dashboard', function (Request $request) {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $minggu = $request->input('minggu');

        $jumlahkategori = Kategori::count();
        $jumlahproduk = Produk::count();
        $jumlahmember = Member::count();
        $jumlahsupplier = Supplier::count();

        $pengeluaran = PengeluaranController::grafik();
        $pembelian = PembelianController::grafik();
        $penjualan = PenjualanController::grafik();
        $obatPalingLaku = PenjualanController::obatPalingLaku($bulan, $tahun, $minggu);

        return view('welcome', compact(
            'jumlahkategori',
            'jumlahproduk',
            'jumlahmember',
            'jumlahsupplier',
            'pengeluaran',
            'pembelian',
            'penjualan',
            'obatPalingLaku',
            'minggu',
            'bulan',
            'tahun'
        ));
    });
});


Route::middleware(['auth', 'can:manage users'])->group(function () {
    Route::resource('/users', UserController::class);

});
Route::get('/users/modal', [UserController::class, 'userModalList'])->name('users.modal');
Route::get('/analisis/tren-penyakit', [AnalisisController::class, 'exportUserObat'])->middleware('auth');
Route::get('/export-semua-obat', action: [AnalisisController::class, 'exportSemuaObat']);
Route::get('/trend', action: [AnalisisController::class, 'showHasilKmeans'])->name('user.tren-kmeans');
Route::post('/analisis/upload', [AnalisisController::class, 'uploadCluster'])->name('upload.cluster');
// web.php
Route::get('/tren-penyakit', [AnalisisController::class, 'analisisTren'])->name('analisisTren');
Route::get('/dashboard/tren', [AnalisisController::class, 'trenPenyakit'])->name('tren.penyakit');


// Route::controller(LoginController::class)->group(function () {
//     Route::get('/loginuser', 'loginuser')->name('loginuser');
//     Route::post('/loginproses', 'loginproses')->name('loginproses');
//     Route::get('/registerusers', 'registerusers')->name('registerusers');
//     Route::post('/registeruser', 'registeruser')->name('registeruser');
//     Route::post('/logoutuser', 'logoutuser')->name('logoutuser');
//     Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// });






// Route::middleware(['auth', 'can:manage pengguna'])->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('users.index');
//      Route::get('/telu', 'user')->name('user');
//     Route::get('/about', 'about')->name('about');
//     Route::get('/layanan', 'layanan')->name('layanan');
//     Route::get('/galeri', 'galeri')->name('galeri');
//     Route::get('/kontak', 'kontak')->name('kontak');
// Route::get('/rekomendasi', [RekomendasiController::class, 'rekomendasi'])->name('rekomendasi');



// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::middleware(['auth', 'can:manage kategori'])->group(function () {
    // Route::get('/kategori', action: [KategoriController::class, 'index'])->name(name: 'kategori')->middleware('auth');
    Route::get('/tambahkategori', [KategoriController::class, 'tambahkategori'])->name('tambahkategori');
    Route::get('/delete/{id}', [KategoriController::class, 'delete'])->name('delete');
    Route::get('/deletemember/{id}', action: [MemberController::class, 'deletemember'])->name('deletemember');
    Route::get('/deletesupplier/{id}', action: [SupplierController::class, 'deletesupplier'])->name('deletesupplier');
    Route::get('/deletepengeluaran/{id}', action: [PengeluaranController::class, 'deletepengeluaran'])->name('deletepengeluaran');

    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('/kategori', KategoriController::class);
    // Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('kategori.create');
    // Route::post('/create-kategori', [KategoriController::class, 'store'])->name('kategori.store');
    // Route::get('/edit-kategori/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    // Route::put('/edit-kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
});


Route::middleware(['auth', 'can:manage produk'])->group(function () {
    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.deleteproduk');
    Route::resource('/produk', ProdukController::class);
    // Route::get('/create-produk', [ProdukController::class, 'create'])->name('produk.create');
    // Route::post('/store-produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/edit-produk/{id}', action: [ProdukController::class, 'edit'])->name('edit-produk');
    // Route::put('/update-produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::match(['get', 'post'], '/importproduk', [ProdukController::class, 'import'])->name('importproduk');
    Route::post('/produk/import', [ProdukController::class, 'importexcel'])->name('importexcel');
    Route::get('/exportexcel', action: [ProdukController::class, 'exportexcel'])->name('exportexcel');
    Route::get('/produk/{id}/barcode', [ProdukController::class, 'show'])->name('produk.showBarcode');
    Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetakBarcode');
});

Route::middleware(['auth', 'can:manage member'])->group(function () {
    Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
    Route::match(['get', 'post'], '/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak');
    Route::resource('/member', controller: MemberController::class);
    // Route::get('/create-member', [MemberController::class, 'create'])->name('member.create');
    // Route::post('/create-member', [MemberController::class, 'store'])->name('member.store');
    Route::get('/edit-member/{id}', [MemberController::class, 'edit'])->name('edit-member');
    Route::put('/edit-member/{id}', [MemberController::class, 'update'])->name('update-member');
    Route::post('/produk/cetak-member-select', [MemberController::class, 'cetakMemberSelect'])->name('member.cetakMemberSelect');
});

Route::middleware(['auth', 'can:manage supplier'])->group(function () {
    Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('/supplier', SupplierController::class);
    // Route::get('/create-supplier', [SupplierController::class, 'create'])->name('supplier.create'); // Create Supplier Form
    // Route::post('/store-supplier', [SupplierController::class, 'store'])->name('supplier.store'); // Store Supplier
    // Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    // Route::put('/edit-supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
});

Route::middleware(['auth', 'can:manage pengeluaran'])->group(function () {
    Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
    Route::resource('/pengeluaran', PengeluaranController::class);
    // Route::get('/create-pengeluaran', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    // Route::get('/edit-pengeluaran/{id}', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
});

Route::middleware(['auth', 'can:manage pembelian'])->group(function () {
    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::resource('/pembelian', PembelianController::class)
        ->except('create');
    // Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::get('pembelian/print/{id_pembelian}', [PembelianController::class, 'printPdf'])->name('pembelian.print');
    // Route::get('/pembelian/{id}/show', [PembelianController::class, 'show'])->name('pembelian.show');

    Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
    Route::resource('/pembelian_detail', PembelianDetailController::class)
        ->except('create', 'show', 'edit');
});

Route::middleware(['auth', 'can:manage penjualan'])->group(function () {
    // Rute Penjualan
    Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}/show', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    Route::get('/deletepenjualan/{id}', action: [PenjualanController::class, 'deletepenjualan'])->name('deletepenjualan');

    // Rute Transaksi
    Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
    Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
    Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

    Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)
        ->except('create', 'show', 'edit');
});


Route::middleware(['auth', 'can:manage laporan'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
    Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');
});
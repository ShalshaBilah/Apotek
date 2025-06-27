@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="{{ route('produk.create') }}" class="btn btn-success btn-sm mr-2">
                                <i class="fa fa-plus-circle"></i> Tambah Produk
                            </a>
                            <a href="/exportexcel" class="btn btn-info btn-sm mr-2">
                                <i class="bi bi-file-earmark-arrow-down"></i> Export Excel
                            </a>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa fa-upload"></i> Import Excel
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-3">
                                        <div class="modal-header bg-primary text-white rounded-top">
                                            <h5 class="modal-title" id="exampleModalLabel">Import Produk</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('importexcel') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Pilih File</label>
                                                    <input type="file" class="form-control" id="file" name="file"
                                                        required>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <button type="submit" class="btn btn-primary btn-lg">Import</button>
                                                    <button type="button" class="btn btn-danger btn-lg"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('produk.cetakBarcode') }}" method="POST" id="form-cetak-barcode">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm ml-2">
                                    <i class="fa fa-barcode"></i> Cetak Barcode
                                </button>
                            </form>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('produk.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari produk...">
                                    <button class="btn btn-primary ml-2" type="submit">Cari</button>
                                </form>
                            </div>
                        </div>



                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">{{ $message }}</div>
                            @endif
                            @if ($message = Session::get('suksesupdate'))
                                <div class="alert alert-primary">{{ $message }}</div>
                            @endif
                            @if ($message = Session::get('delete'))
                                <div class="alert alert-danger">{{ $message }}</div>
                            @endif

                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Harga Beli</th>
                                        <th>Diskon</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $index => $item)
                                        <tr>
                                            <td><input type="checkbox" name="produk_id[]" value="{{ $item->id_produk }}">
                                            </td>
                                            <td>{{ $index + $produk->firstItem() }}</td>
                                            <td>{{ $item->kode_produk }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->kategori->nama_kategori }}</td>
                                            <td>{{ $item->merk }}</td>
                                            <td>{{ format_uang($item->harga_beli) }}</td>
                                            <td>{{ $item->diskon }}</td>
                                            <td>{{ format_uang($item->harga_jual) }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>
                                                <a href="{{ route('edit-produk', $item->id_produk) }}"
                                                    class="btn btn-info btn-sm" title="Edit Produk">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('produk.deleteproduk', $item->id_produk) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                                        title="Hapus Produk">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('produk.showBarcode', $item->id_produk) }}"
                                                    class="btn btn-warning btn-sm" target="_blank">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                                {{ $produk->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="produk_id[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('form-cetak-barcode').addEventListener('submit', function (e) {
        const selectedIds = Array.from(document.querySelectorAll('input[name="produk_id[]"]:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            e.preventDefault();
            alert('Silakan pilih produk untuk mencetak barcode.');
        } else {
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'produk_id[]';
                input.value = id;
                this.appendChild(input);
            });
        }
    });
</script>
@endsection
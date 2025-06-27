@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $id => $nama)
                                    <option value="{{ $id }}">{{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control" placeholder="Merk" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon (%)</label>
                            <input type="number" name="diskon" class="form-control" placeholder="Diskon" value="0">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
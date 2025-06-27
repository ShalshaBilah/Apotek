@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <h1>Edit Produk</h1>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                                value="{{ $produk->nama_produk }}" required>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" class="form-control" id="id_kategori">
                                @foreach ($kategori as $id => $nama)
                                    <option value="{{ $id }}" {{ $id == $produk->id_kategori ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control" id="merk"
                                value="{{ $produk->merk }}" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" id="harga_beli"
                                value="{{ $produk->harga_beli }}" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" id="harga_jual"
                                value="{{ $produk->harga_jual }}" required>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon</label>
                            <input type="number" name="diskon" class="form-control" id="diskon"
                                value="{{ $produk->diskon }}">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" class="form-control" id="stok"
                                value="{{ $produk->stok }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

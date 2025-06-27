@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Edit Produk</h3>

                    </div>

                    <div class="card-body">
                        <form action="{{ route('prodak.update', $prodak->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Obat</label>
                                        <input type="text" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $prodak->nama) }}" required>
                                        @error('nama')                           <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <input type="text" name="kategori"
                                            class="form-control @error('kategori') is-invalid @enderror"
                                            value="{{ old('kategori', $prodak->kategori) }}" required>
                                        @error('kategori')          <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="harga"
                                            class="form-control @error('harga') is-invalid @enderror"
                                            value="{{ old('harga', $prodak->harga) }}" required>
                                        @error('harga')                <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi"
                                            class="form-control @error('deskripsi') is-invalid @enderror"
                                            required>{{ old('deskripsi', $prodak->deskripsi) }}</textarea>
                                        @error('deskripsi')                       <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Manfaat</label>
                                        <textarea name="manfaat" class="form-control @error('manfaat') is-invalid @enderror"
                                            required>{{ old('manfaat', $prodak->manfaat) }}</textarea>
                                        @error('manfaat')              <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Dosis</label>
                                        <input type="text" name="dosis"
                                            class="form-control @error('dosis') is-invalid @enderror"
                                            value="{{ old('dosis', $prodak->dosis) }}" required>
                                        @error('dosis')                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Aturan Pakai</label>
                                        <textarea name="aturan_pakai"
                                            class="form-control @error('aturan_pakai') is-invalid @enderror"
                                            required>{{ old('aturan_pakai', $prodak->aturan_pakai) }}</textarea>
                                        @error('aturan_pakai')                           <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>gejala</label>
                                        <textarea name="gejala" class="form-control @error('gejala') is-invalid @enderror"
                                            required>{{ old('gejala', $prodak->gejala) }}</textarea>
                                        @error('gejala')                  <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>usia</label>
                                        <textarea name="usia" class="form-control @error('usia') is-invalid @enderror"
                                            required>{{ old('usia', $prodak->usia) }}</textarea>
                                        @error('usia')        <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Gambar Produk</label>
                                        <input type="file" name="logo"
                                            class="form-control @error('logo') is-invalid @enderror">
                                        @error('logo')             <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        @if ($prodak->logo)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $prodak->logo) }}" alt="Gambar Produk"
                                                    width="100">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                                <a href="{{ route('prodak.index') }}" class="btn btn-secondary ml-2">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Produk</h1>
                        </div>
                        <div class="card-tools">

                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('prodak.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="20%">Nama obat</th>
                                        <td>
                                            <input type="text" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama') }}" required>
                                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Kategori</th>
                                        <td>
                                            <input type="text" name="kategori"
                                                class="form-control @error('kategori') is-invalid @enderror"
                                                value="{{ old('kategori') }}" required>
                                            @error('kategori') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Logo</th>
                                        <td>
                                            <input type="file" name="logo"
                                                class="form-control @error('logo') is-invalid @enderror" accept="image/*"
                                                required>
                                            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Harga</th>
                                        <td>
                                            <input type="number" name="harga"
                                                class="form-control @error('harga') is-invalid @enderror"
                                                value="{{ old('harga') }}" required>
                                            @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dosis</th>
                                        <td>
                                            <input type="text" name="dosis"
                                                class="form-control @error('dosis') is-invalid @enderror"
                                                value="{{ old('dosis') }}" required>
                                            @error('dosis') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>gejala</th>
                                        <td>
                                            <input type="text" name="gejala"
                                                class="form-control @error('dosis') is-invalid @enderror"
                                                value="{{ old('gejala') }}" required>
                                            @error('gejala') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>usia</th>
                                        <td>
                                            <input type="text" name="usia"
                                                class="form-control @error('usia') is-invalid @enderror"
                                                value="{{ old('usia') }}" required>
                                            @error('usia') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>
                                            <textarea name="deskripsi"
                                                class="form-control @error('deskripsi') is-invalid @enderror" rows="3"
                                                required>{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Manfaat</th>
                                        <td>
                                            <textarea name="manfaat"
                                                class="form-control @error('manfaat') is-invalid @enderror" rows="3"
                                                required>{{ old('manfaat') }}</textarea>
                                            @error('manfaat') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Aturan Pakai</th>
                                        <td>
                                            <textarea name="aturan_pakai"
                                                class="form-control @error('aturan_pakai') is-invalid @enderror" rows="3"
                                                required>{{ old('aturan_pakai') }}</textarea>
                                            @error('aturan_pakai') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('prodak.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
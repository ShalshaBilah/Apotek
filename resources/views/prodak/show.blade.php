@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Produk</h3>
                        <div class="card-tools">

                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="20%">Kategori</th>
                                    <td>{{ $prodak->kategori }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>Rp {{ number_format($prodak->harga, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $prodak->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th>Manfaat</th>
                                    <td>{{ $prodak->manfaat }}</td>
                                </tr>
                                <tr>
                                    <th>Dosis</th>
                                    <td>{{ $prodak->dosis }}</td>
                                </tr>
                                <tr>
                                    <th>Aturan Pakai</th>
                                    <td>{{ $prodak->aturan_pakai }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-right mt-3">
                            <a href="{{ route('prodak.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
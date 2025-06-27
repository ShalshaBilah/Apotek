@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penjualan</li>
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
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($penjualanDetail as $detail)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <span
                                                    style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block;">
                                                    {{ optional($detail->produk)->kode_produk ?? 'Produk Tidak Ditemukan' }}
                                                </span>
                                            </td>
                                            <td>{{ optional($detail->produk)->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                            </td>
                                            <td>{{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                            <td>{{ $detail->jumlah }}</td>
                                            <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('penjualan.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar
                                Penjualan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
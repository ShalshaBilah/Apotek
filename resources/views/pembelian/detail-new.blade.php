@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pembelian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pembelian</li>
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
                                        <th width="5%">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                @php $no = 1; @endphp <!-- Inisialisasi variabel $no -->
                                @foreach ($detail as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span
                                                style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block;">
                                                {{ optional($item->produk)->kode_produk ?? 'Kode Produk Tidak Ditemukan' }}
                                            </span>
                                        </td>
                                        <td>{{ optional($item->produk)->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                                        <td>{{ format_uang($item->harga_beli) }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ format_uang($item->subtotal) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('pembelian.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar
                                Pembelian</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
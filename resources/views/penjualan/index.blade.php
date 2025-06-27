@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Penjualan</h1>
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
                            <div class="card-header d-flex justify-content-between align-items-center">

                                <!-- Modal -->


                                <div class="card-tools ml-auto">
                                    <form action="{{ route('penjualan.index') }}" method="GET"
                                        class="d-flex justify-content-end">
                                        <input type="search" name="search" class="form-control"
                                            placeholder="Cari penjualan...">
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


                                <form action="" method="POST" target="_blank">
                                    @csrf
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Pembeli</th>
                                                <th>Total Item</th>
                                                <th>Total Harga</th>
                                                <th>Diskon</th>
                                                <th>Total Bayar</th>
                                                <th>Kasir</th>
                                                <th width="15%"><i class="fa fa-cog"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1; // Jika tidak menggunakan pagination, bisa mulai dari 1
                                            @endphp
                                            @foreach ($penjualan as $index => $row)
                                                <tr>
                                                    <!-- Nomor urut -->
                                                    <th scope="row">{{ $index + $penjualan->firstItem() }}</th>

                                                    <!-- Tanggal -->
                                                    <td>{{ tanggal_indonesia($row->created_at) }}</td>

                                                    <!-- Kode Member -->
                                                    <td>
                                                        <span
                                                            style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block;">
                                                            {{ $row->users->name ?? 'Tidak ada nama' }}
                                                            <!-- Menampilkan nama pembeli jika ada -->
                                                        </span>
                                                    </td>

                                                    <!-- Total Item -->
                                                    <td>{{ $row->total_item }}</td>

                                                    <!-- Total Harga -->
                                                    <td>{{ number_format($row->total_harga, 0, ',', '.') }}</td>

                                                    <!-- Diskon -->
                                                    <td>{{ $row->diskon }}%</td>

                                                    <!-- Total Bayar -->
                                                    <td>{{ number_format($row->bayar, 0, ',', '.') }}</td>

                                                    <!-- Kasir -->
                                                    <td>{{ Auth::user()->name }}</td>

                                                    <!-- Aksi -->
                                                    <td>
                                                        <div class="btn-group">
                                                            <!-- Tombol Lihat Detail -->
                                                            <a href="{{ route('penjualan.show', $row->id_penjualan) }}"
                                                                class="btn btn-sm btn-info">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <!-- Tombol Hapus -->
                                                            <button
                                                                onclick="if(confirm('Yakin ingin menghapus ini?')) { window.location.href='/deletepenjualan/{{ $row->id_penjualan }}'; }"
                                                                class="btn btn-danger btn-sm ml-2" data-toggle="tooltip"
                                                                title="Hapus Pengeluaran">
                                                                <i class="fa fa-trash"></i>
                                                            </button>


                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end" style="margin-top: 20px;">
                                        {{$penjualan->links()}}
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        let table, table1;

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal menghapus data');
                        return response.json();
                    })
                    .then(data => {
                        alert('Data berhasil dihapus');
                        location.reload();
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan: ' + error);
                    });
            }
        }


    </script>
@endpush
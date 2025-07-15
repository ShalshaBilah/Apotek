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

        <!-- Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
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
                                        @foreach ($penjualan as $index => $row)
                                            <tr>
                                                <th scope="row">{{ $index + $penjualan->firstItem() }}</th>
                                                <td>{{ tanggal_indonesia($row->created_at) }}</td>
                                                <td>
                                                    <span
                                                        style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px;">
                                                        {{ $row->users->name ?? 'Tidak ada nama' }}
                                                    </span>
                                                </td>
                                                <td>{{ $row->total_item }}</td>
                                                <td>{{ number_format($row->total_harga, 0, ',', '.') }}</td>
                                                <td>{{ $row->diskon }}%</td>
                                                <td>{{ number_format($row->bayar, 0, ',', '.') }}</td>
                                                <td>{{ Auth::user()->name }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('penjualan.show', $row->id_penjualan) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('penjualan.destroy', $row->id_penjualan) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                            style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>


                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-end mt-3">
                                    {{ $penjualan->links() }}
                                </div>

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
        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal menghapus data');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message); // dari controller
                        location.reload();
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan: ' + error.message);
                    });
            }
        }
    </script>
@endpush
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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <a href="/prodak/create" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus-circle"></i> Tambah Produk
                                </a>

                                <!-- Tombol untuk membuka modal -->
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#importModal">
                                    <i class="fas fa-upload"></i> Impor Produk
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="importModalLabel">Impor Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('prodak.import') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="file">Pilih file Excel</label>
                                                        <input type="file" name="file" class="form-control" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Impor Produk</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-tools ml-auto">
                                    <form action="{{ route('prodak.index') }}" method="GET"
                                        class="d-flex justify-content-end">
                                        <input type="search" name="search" class="form-control"
                                            placeholder="Cari produk...">
                                        <button class="btn btn-primary ml-2" type="submit">Cari</button>
                                    </form>
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="prodakTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Obat</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Gambar</th>
                                                <th>Deskripsi</th>
                                                <th>Gejala</th>
                                                <th>Usia</th>
                                                <th>Manfaat</th>
                                                <th>Dosis</th>
                                                <th>Aturan Pakai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prodaks as $index => $prodak)
                                                <tr>
                                                    <td>{{ $index + $prodaks->firstItem() }}</td>
                                                    <td>{{ $prodak->nama }}</td>
                                                    <td>{{ $prodak->kategori }}</td>
                                                    <td>Rp {{ number_format($prodak->harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if ($prodak->logo)
                                                            <img src="{{ asset('storage/' . $prodak->logo) }}" alt="Logo"
                                                                width="100">
                                                        @else
                                                            <span class="text-muted">Tidak ada gambar</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $prodak->deskripsi }}</td>
                                                    <td>{{ $prodak->gejala }}</td>
                                                    <td>{{ $prodak->usia }}</td>
                                                    <td>{{ $prodak->manfaat }}</td>
                                                    <td>{{ $prodak->dosis }}</td>
                                                    <td>{{ $prodak->aturan_pakai }}</td>
                                                    <td>
                                                        <a href="{{ route('prodak.show', $prodak->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('prodak.edit', $prodak->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('prodak.destroy', $prodak->id) }}" method="POST"
                                                            class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div> <!-- /.table-responsive -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $prodaks->links() }}
                                </div>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.container-fluid -->
                </div> <!-- /.content-header -->
            </div> <!-- /.content-wrapper -->
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#prodakTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endpush
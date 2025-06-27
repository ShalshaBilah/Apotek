@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pembelian</h1>
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
                        <div class="card-header">
                            <button onclick="addForm()" class="btn btn-success btn-sm btn-flat"><i
                                    class="fa fa-plus-circle"></i> Transaksi Baru</button>
                            @empty(!session('id_pembelian'))
                                <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info btn-sm btn-flat"><i
                                        class="fa fa-pencil"></i> Transaksi Aktif</a>
                            @endempty

                            <div class="card-tools">
                                <form action="{{ route('pembelian.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari pembelian...">
                                    <button class="btn btn-primary ml-2" type="submit">Cari</button>
                                </form>
                            </div>

                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    {{$message}}
                                </div>
                            @endif
                            @if ($message = Session::get('suksesupdate'))
                                <div class="alert alert-primary" role="alert">
                                    {{$message}}
                                </div>
                            @endif
                            @if ($message = Session::get('delete'))
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @endif

                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Diskon</th>
                                    <th>Total Bayar</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pembelian as $index => $row)
                                        <tr>
                                            <th scope="row">{{$index + $pembelian->firstItem()}}</th>
                                            <td>{{ tanggal_indonesia($row->created_at) }}</td>
                                            <td>{{ optional($row->supplier)->nama ?? 'Tidak Diketahui' }}</td>
                                            <th>{{$row->total_item}}</th>
                                            <th>{{$row->total_harga}}</th>
                                            <th>{{$row->diskon}}</th>
                                            <th>{{$row->bayar}}</th>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('pembelian.show', $row->id_pembelian) }}"
                                                        class="btn btn-sm btn-info btn-flat">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <!-- Ubah tombol hapus menjadi form -->
                                                    <form action="{{ route('pembelian.destroy', $row->id_pembelian) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-flat ml-2"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                    <a href="{{ route('pembelian.print', ['id_pembelian' => $row->id_pembelian]) }}"
                                                        class="btn btn-sm btn-warning btn-flat ml-2" target="_blank">
                                                        <i class="fa fa-print"></i>
                                                    </a>


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" style="margin-top: 20px;">
                                {{$pembelian->links()}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@includeIf('pembelian.supplier')
@includeIf('pembelian.detail')
@endsection

@push('scripts')
    <script>
        let table, table1;

        $(function () {
            table = $('.table-pembelian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [
                    { data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'tanggal' },
                    { data: 'supplier' },
                    { data: 'total_item' },
                    { data: 'total_harga' },
                    { data: 'diskon' },
                    { data: 'bayar' },
                    { data: 'aksi', searchable: false, sortable: false },
                ]
            });

            $('.table-supplier').DataTable();
            table1 = $('.table-detail').DataTable({
                processing: true,
                bSort: false,
                dom: 'Brt',
                columns: [
                    { data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'kode_produk' },
                    { data: 'nama_produk' },
                    { data: 'harga_beli' },
                    { data: 'jumlah' },
                    { data: 'subtotal' },
                ]
            })
        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function showDetail(url) {
            $('#modal-detail').modal('show');
            $.get(url, function (data) {
                $('.table-detail').html(data); // Hanya baris tabel yang dimuat
            });
        }

    </script>
@endpush
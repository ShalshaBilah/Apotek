@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengeluaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href='{{ route('pengeluaran.create') }}' class=" btn btn-success btn-sm">
                                <i class="fa fa-plus-circle"></i> Tambah Pengeluaran
                            </a>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('pengeluaran.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari pengeluaran...">
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
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pengeluaran as $index => $row)
                                        <tr>
                                            <th scope="row">{{$index + $pengeluaran->firstItem()}}</th>
                                            <td>{{ tanggal_indonesia($row->created_at) }}</td>
                                            <th>{{$row->deskripsi}}</th>
                                            <td>{{ format_uang($row->nominal) }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button
                                                        onclick="window.location.href='{{ route('pengeluaran.edit', $row->id_pengeluaran) }}'"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Edit Pengeluaran">
                                                        <i class="fa fa-pencil-alt"></i>

                                                        <button
                                                            onclick="if(confirm('Yakin ingin menghapus ini?')) { window.location.href='/deletepengeluaran/{{ $row->id_pengeluaran }}'; }"
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
                                {{$pengeluaran->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supplier</li>
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
                            <a href="{{ route('supplier.create') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus-circle"></i> Tambah Supplier
                            </a>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('supplier.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari supplier...">
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
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($supplier as $index => $row)
                                        <tr>
                                            <th scope="row">{{$index + $supplier->firstItem()}}</th>
                                            <th>{{$row->nama}}</th>
                                            <th>{{$row->alamat}}</th>
                                            <th>{{$row->telepon}}</th>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('supplier.edit', $row->id_supplier) }}"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Edit Supplier">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <button
                                                        onclick="if(confirm('Yakin ingin menghapus ini?')) { window.location.href='/deletesupplier/{{ $row->id_supplier }}'; }"
                                                        class="btn btn-danger btn-sm ml-2" data-toggle="tooltip"
                                                        title="Hapus Supplier">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" style="margin-top: 20px;">
                                {{$supplier->links()}}
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
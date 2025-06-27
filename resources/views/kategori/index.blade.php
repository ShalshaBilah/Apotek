@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Kategori</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                            <a href="{{ route('kategori.create') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus-circle"></i> Tambah Kategori
                            </a>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('kategori.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari kategori...">
                                    <button class="btn btn-primary ml-2" type="submit">Cari</button>
                                </form>
                            </div>

                        </div>

                        <div class="card-body">
                            <!-- Success/Update/Delete messages -->
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

                            <!-- Categories Table -->
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="50%">Kategori</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($kategori as $index => $row)
                                        <tr>
                                            <td>{{$index + $kategori->firstItem()}}</td>
                                            <td>{{$row->nama_kategori}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('kategori.edit', $row->id_kategori) }}"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Edit Kategori">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <button
                                                        onclick="if(confirm('Yakin ingin menghapus ini?')) { window.location.href='/delete/{{ $row->id_kategori }}'; }"
                                                        class="btn btn-danger btn-sm ml-2" data-toggle="tooltip"
                                                        title="Hapus Kategori">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" style="margin-top: 20px;">
                                {{$kategori->links()}}
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

@push('scripts')
    <!-- Enable tooltips for buttons -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
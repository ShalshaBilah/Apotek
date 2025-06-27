@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Supplier</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
                            <li class="breadcrumb-item active">Tambah Supplier</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Form for creating a supplier -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('supplier.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama Supplier</label>
                                        <input type="text" name="nama" class="form-control" id="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" name="telepon" class="form-control" id="telepon" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" class="form-control" id="alamat" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Batal</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
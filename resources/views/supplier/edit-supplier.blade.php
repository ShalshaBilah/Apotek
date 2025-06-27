@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Supplier</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('supplier.update', $supplier->id_supplier) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Supplier</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $supplier->nama) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"
                                required>{{ old('alamat', $supplier->alamat) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                value="{{ old('telepon', $supplier->telepon) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-flat">Update</button>
                        <button type="button" class="btn btn-secondary btn-flat"
                            onclick="window.location.href='{{ route('supplier.index') }}'">Batal</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
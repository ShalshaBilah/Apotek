@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Pengeluaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pengeluaran.update', $pengeluaran->id_pengeluaran) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                        required>{{ old('deskripsi', $pengeluaran->deskripsi) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" class="form-control" id="nominal" name="nominal"
                                        value="{{ old('nominal', $pengeluaran->nominal) }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-flat">Update</button>
                                <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary btn-flat">Batal</a>
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
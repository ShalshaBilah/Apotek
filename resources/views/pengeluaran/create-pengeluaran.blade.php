@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Pengeluaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Pengeluaran</li>
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

                            <div class="card-body">
                                <form action="{{ route('pengeluaran.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <input type="text" name="deskripsi" class="form-control" id="deskripsi" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input type="number" name="nominal" class="form-control" id="nominal" required>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-flat">Tambah</button>
                                    <button type="button" class="btn btn-secondary btn-flat"
                                        onclick="window.location.href='{{ route('pengeluaran.index') }}'">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Member</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Member</a></li>
                        <li class="breadcrumb-item active">Edit Member</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update-member', $member->id_member) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="kode_member">Kode Member</label>
                            <input type="text" name="kode_member" id="kode_member" class="form-control" 
                                value="{{ $member->kode_member }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" 
                                value="{{ $member->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" 
                                value="{{ $member->telepon }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required>{{ $member->alamat }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('member.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

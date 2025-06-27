@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengguna</li>
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
                            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus-circle"></i> Tambah Pengguna
                            </a>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('users.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari pengguna...">
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

                            <!-- Users Table -->
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Nama</th>
                                        <th width="25%">Email</th>
                                        <th width="20%">Role</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{$index + $users->firstItem()}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Edit Pengguna">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <button
                                                        onclick="if(confirm('Yakin ingin menghapus pengguna ini?')) { document.getElementById('delete-user-{{ $user->id }}').submit(); }"
                                                        class="btn btn-danger btn-sm ml-2" data-toggle="tooltip"
                                                        title="Hapus Pengguna">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" style="margin-top: 20px;">
                                {{-- {{$users->links()}} --}}
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

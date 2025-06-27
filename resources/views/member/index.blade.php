@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Member</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Member</li>
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
                            <a href="{{ route('member.create') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus-circle"></i> Tambah Member
                            </a>
                            <form action="{{ route('member.cetakMemberSelect') }}" method="POST" id="form-cetak-member">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm ml-2">
                                    <i class="fa fa-barcode"></i> Cetak Member
                                </button>
                            </form>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('member.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Cari member...">
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
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($member as $index => $row)
                                        <tr>
                                            <td><input type="checkbox" name="member_id[]" value="{{ $row->id_member }}">
                                            </td>
                                            <th scope="row">{{$index + $member->firstItem()}}</th>
                                            <td>
                                                <span
                                                    style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block;">
                                                    {{ $row->kode_member }}
                                                </span>
                                            </td>
                                            <th>{{$row->nama}}</th>
                                            <th>{{$row->alamat}}</th>
                                            <th>{{$row->telepon}}</th>

                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('edit-member', $row->id_member) }}"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        title="Edit Member">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <button
                                                        onclick="if(confirm('Yakin ingin menghapus ini?')) { window.location.href='/deletemember/{{ $row->id_member }}'; }"
                                                        class="btn btn-danger btn-sm ml-2" data-toggle="tooltip"
                                                        title="Hapus Member">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <form action="{{ route('member.cetak') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_member[]"
                                                            value="{{ $row->id_member }}">
                                                        <!-- Optionally add checkboxes to select which members to print -->
                                                        <button type="submit" class="btn btn-warning btn-sm ml-2">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" style="margin-top: 20px;">
                                {{$member->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    document.getElementById('select-all').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="member_id[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('form-cetak-member').addEventListener('submit', function (e) {
        const selectedIds = Array.from(document.querySelectorAll('input[name="member_id[]"]:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            e.preventDefault();
            alert('Silakan pilih produk untuk mencetak member.');
        } else {
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'member_id[]';
                input.value = id;
                this.appendChild(input);
            });
        }
    });
</script>
@endsection
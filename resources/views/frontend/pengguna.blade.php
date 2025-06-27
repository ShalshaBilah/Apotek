@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar User</h1>
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
                            <h3 class="card-title"></h3>
                            <div class="card-tools ml-auto">
                                <form action="{{ route('pengguna.index') }}" method="GET"
                                    class="d-flex justify-content-end">
                                    <input type="search" name="search" class="form-control" placeholder="Cari user...">
                                    <button class="btn btn-primary ml-2" type="submit">Cari</button>
                                </form>
                            </div>
                        </div>

                        <!-- Users Table -->
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="45%">Nama</th>
                                        <th width="45%" class="text-center">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = $pengguna->firstItem(); @endphp
                                    @foreach ($pengguna as $row)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td class="text-center">{{ $row->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer d-flex justify-content-end">
                            {{ $pengguna->links() }}
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
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
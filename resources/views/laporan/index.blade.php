@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-size: 19px;">
                            Laporan Pendapatan<br>
                            <span style="font-size: 22px; font-weight: bold;">
                                {{ tanggal_indonesia($tanggalAwal, false) }} s/d
                                {{ tanggal_indonesia($tanggalAkhir, false) }}
                            </span>
                        </h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
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
                                <button onclick="updatePeriode()" class="btn btn-info btn-sm mr-2">
                                    <i class="fa fa-plus-circle"></i> Ubah Periode
                                </button>

                                <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                                    class="btn btn-success btn-sm btn-flat">
                                    <i class="fa fa-file-pdf"></i> Export PDF
                                </a>

                                <div class="card-tools ml-auto">
                                    <form action="{{ route('member.index') }}" method="GET"
                                        class="d-flex justify-content-end">
                                        <input type="search" name="search" class="form-control"
                                            placeholder="Cari laporan...">
                                        <button class="btn btn-primary ml-2" type="submit">Cari</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                @if ($message = Session::get('suksesupdate'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                @if ($message = Session::get('delete'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif

                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Penjualan</th>
                                            <th>Pembelian</th>
                                            <!-- <th>Pengeluaran</th> -->
                                            <th>Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataLaporan as $row)
                                            <tr>
                                                <td>{{ $row['DT_RowIndex'] }}</td>
                                                <td>{{ $row['tanggal'] }}</td>
                                                <td>{{ $row['penjualan'] }}</td>
                                                <td>{{ $row['pembelian'] }}</td>
                                                <!-- <td>{{ $row['pengeluaran'] }}</td> -->
                                                <td>{{ $row['pendapatan'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    @includeIf('laporan.form')

@endsection

@push('scripts')
    <script
        src="{{ asset('/template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>


        $(document).ready(function () {
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd' // Sesuaikan format tanggal dengan kebutuhan Anda
            });
        });


        function updatePeriode() {
            $('#modal-form').modal('show');
        }
    </script>
@endpush
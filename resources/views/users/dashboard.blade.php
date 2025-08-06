@extends('frontend.home')

@section('content')
    <section id="hero" class="hero py-5">
        <div class="container">
            <h2 class="mb-4 text-center text-primary text-white">Analisis Tren Penyakit Anda</h2>

            @if(isset($hasil) && count($hasil) > 0)
                {{-- Ringkasan --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white mb-3 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Obat Dianalisis</h5>
                                <p class="card-text display-4">{{ count($hasil) }} Obat</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $penyakit_terbanyak = collect($hasil)->groupBy('penyakit')->sortByDesc(fn($g) => count($g))->keys()->first();
                    @endphp
                    <div class="col-md-4">
                        <div class="card bg-danger text-white mb-3 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">Penyakit Paling Sering</h5>
                                <p class="card-text display-4">{{ $penyakit_terbanyak }}</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $cluster_terbanyak = collect($hasil)->groupBy('cluster')->sortByDesc(fn($g) => count($g))->keys()->first();
                    @endphp
                    <div class="col-md-4">
                        <div class="card bg-warning text-white mb-3 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">Cluster Dominan</h5>
                                <p class="card-text display-4">Cluster {{ $cluster_terbanyak }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ringkasan Bulanan dan Tahunan --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        @php
                            $tren_bulanan = collect($hasil)->groupBy(function ($item) {
                                return $item['month'] . '-' . $item['year'];
                            });

                            $nama_bulan = [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember'
                            ];

                            $daftar_tahun = collect($hasil)->pluck('year')->unique();
                            $daftar_bulan = collect($hasil)->pluck('month')->unique();
                        @endphp

                        <h5 class="card-title text-center">Pilih Bulan dan Tahun untuk Analisis Tren Penyakit</h5>

                        <form method="GET" action="{{ route('tren.penyakit') }}" class="mt-3">
                            <div class="row">
                                {{-- Bulan --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bulan">Pilih Bulan</label>
                                        <select class="form-control" name="bulan" id="bulan">
                                            @foreach (range(1, 12) as $bulan)
                                                @if($daftar_bulan->contains($bulan))
                                                    <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                                        {{ $nama_bulan[$bulan] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Tahun --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tahun">Pilih Tahun</label>
                                        <select class="form-control" name="tahun" id="tahun">
                                            @foreach ($daftar_tahun as $tahun)
                                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Jumlah Grafik --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="top">Jumlah Grafik Ditampilkan</label>
                                        <select class="form-control" name="top" id="top">
                                            @foreach([5, 10, 15, 20] as $value)
                                                <option value="{{ $value }}" {{ request('top', 10) == $value ? 'selected' : '' }}>
                                                    Top {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3">Tampilkan Tren</button>
                        </form>

                        @if(request('bulan') && request('tahun'))
                            @php
                                $selected_tren = $tren_bulanan->get(request('bulan') . '-' . request('tahun'));
                                $top = request('top', 10); // Default 10
                                $penyakit_obat_grouped = collect($selected_tren)->groupBy(function ($item) {
                                    return $item['penyakit'] . ' (' . $item['nama_obat'] . ')';
                                })->map(fn($g) => count($g))->sortDesc()->take($top);
                                $penyakit_obat_teratas = $penyakit_obat_grouped->keys()->first();
                                $cluster_data = collect($selected_tren)->groupBy('cluster')->map(fn($g) => count($g));
                            @endphp

                            <div class="card mb-4 shadow-sm mt-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        Tren Penyakit untuk {{ $nama_bulan[(int) request('bulan')] }} {{ request('tahun') }}
                                    </h5>
                                    <canvas id="penyakitChart"></canvas>
                                    <ul class="list-group mt-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Penyakit Teratas</strong>
                                            <span>{{ $penyakit_obat_teratas }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Chart Cluster --}}
                            <div class="card mb-4 shadow-sm mt-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Distribusi Cluster K-Means</h5>
                                    <canvas id="clusterChart"></canvas>
                                </div>
                            </div>

                            <script>
                                var ctx = document.getElementById('penyakitChart').getContext('2d');
                                var penyakitChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: @json($penyakit_obat_grouped->keys()),
                                        datasets: [{
                                            label: 'Jumlah Kasus Penyakit (Obat)',
                                            data: @json($penyakit_obat_grouped->values()),
                                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: { display: false },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (tooltipItem) {
                                                        return tooltipItem.label + ': ' + tooltipItem.raw + ' kasus';
                                                    }
                                                }
                                            }
                                        },
                                        scales: {
                                            y: { beginAtZero: true }
                                        }
                                    }
                                });

                                var ctxCluster = document.getElementById('clusterChart').getContext('2d');
                                var clusterChart = new Chart(ctxCluster, {
                                    type: 'bar',
                                    data: {
                                        labels: @json($cluster_data->keys()),
                                        datasets: [{
                                            label: 'Jumlah Data per Cluster',
                                            data: @json($cluster_data->values()),
                                            backgroundColor: 'rgba(255, 205, 86, 0.7)',
                                            borderColor: 'rgba(255, 205, 86, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: { legend: { display: false } },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                title: { display: true, text: 'Jumlah Data' }
                                            },
                                            x: {
                                                title: { display: true, text: 'Cluster' }
                                            }
                                        }
                                    }
                                });
                            </script>
                        @else
                            <div class="alert alert-info text-center mt-4">
                                Silakan pilih bulan dan tahun untuk melihat tren penyakit.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kasus</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Jumlah Kasus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekapPaginated as $data)
                                        <tr>
                                            <td>{{ $data['nama_obat'] }}</td>
                                            <td>{{ $nama_bulan[(int) $data['month']] }}</td>
                                            <td>{{ $data['year'] }}</td>
                                            <td>{{ $data['jumlah_kemunculan'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination link khusus rekap --}}
                            <div class="d-flex justify-content-center">
                                {{ $rekapPaginated->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabel Detail --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Detail Analisis</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Penyakit</th>
                                        <th>Cluster</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paginatedHasil as $item)
                                        <tr>
                                            <td>{{ $item['nama_obat'] }}</td>
                                            <td>{{ $item['penyakit'] }}</td>
                                            <td>{{ $item['cluster'] }}</td>
                                            <td>{{ $item['jumlah'] }}</td>
                                            <td>{{ \Carbon\Carbon::createFromDate($item['year'], $item['month'], $item['day'])->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination Link --}}
                            <div class="d-flex justify-content-center">
                                {{ $paginatedHasil->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="alert alert-info text-center">
                    Tidak ada data analisis.
                </div>
            @endif
        </div>

    </section>
@endsection
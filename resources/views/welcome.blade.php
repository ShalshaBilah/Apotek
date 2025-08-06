@extends('layouts.admin')

@section('content')
    @php
        function namaBulan($bulan)
        {
            return \Carbon\Carbon::createFromDate(null, $bulan, null)->locale('id')->translatedFormat('F');
        }
    @endphp

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jumlahkategori }}</h3>
                                <p>Kategori</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-prescription-bottle-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jumlahproduk }}</h3>
                                <p>Produk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clinic-medical"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-6">
                                                                        <div class="small-box bg-warning">
                                                                            <div class="inner">
                                                                                <h3>{{ $jumlahmember }}</h3>
                                                                                <p>Member</p>
                                                                            </div>y
                                                                            <div class="icon">
                                                                                <i class="fas fa-warehouse"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $jumlahsupplier }}</h3>
                                <p>Supplier</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Pembelian & Penjualan - DITARIK KE ATAS -->
                @foreach ([['Grafik Pembelian Bulanan', 'pembelianChart', $pembelian, 'Pembelian', 'rgba(255, 159, 64, 1)', 'rgba(255, 159, 64, 0.2)'], ['Grafik Penjualan Bulanan', 'penjualanChart', $penjualan, 'Penjualan', 'rgba(153, 102, 255, 1)', 'rgba(153, 102, 255, 0.2)']] as [$title, $chartId, $data, $label, $borderColor, $backgroundColor])
                    <form action="{{ url('/dashboard') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" class="form-select">
                                <option value="">-- Semua Bulan --</option>
                                @foreach(range(1, 12) as $b)
                                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun" class="form-select">
                                <option value="">-- Semua Tahun --</option>
                                @foreach(range(date('Y'), 2020) as $t)
                                    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 align-self-end">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </form>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-gradient-light">
                                    <h3 class="card-title">{{ $title }}</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="{{ $chartId }}" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <form method="GET" action="{{ url('/dashboard') }}" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="minggu" class="form-label">Minggu</label>
                        <select name="minggu" class="form-control">
                            <option value="">Pilih Minggu</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('minggu') == $i ? 'selected' : '' }}>Minggu ke-{{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" class="form-control">
                            <option value="">Pilih Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select name="tahun" class="form-control">
                            <option value="">Pilih Tahun</option>
                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <!-- Mingguan -->
                                <h3 class="card-title mb-0">
                                    Obat Paling Laku
                                    @if($minggu)
                                        Minggu ke-{{ $minggu }}
                                    @endif
                                    @if($bulan)
                                        Bulan {{ namaBulan($bulan) }}
                                    @endif
                                    @if($tahun)
                                        Tahun {{ $tahun }}
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                <canvas id="chart-mingguan" style="height: 350px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <!-- Bulanan -->
                                <h3 class="card-title mb-0">
                                    Obat Paling Laku Bulan
                                    {{ $bulan ? namaBulan($bulan) : '...' }}
                                    {{ $tahun ? 'Tahun ' . $tahun : '' }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <canvas id="chart-bulanan" style="height: 350px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-dark">
                                <!-- Tahunan -->
                                <h3 class="card-title mb-0">
                                    Obat Paling Laku
                                    {{ $tahun ? 'Tahun ' . $tahun : '' }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <canvas id="chart-tahunan" style="height: 350px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        // Warna seragam untuk chart bar obat paling laku
        const barColors = {
            mingguan: {
                background: 'rgba(0, 105, 176, 0.7)',
                hoverBackground: 'rgba(100, 185, 243, 0.9)',
                border: 'rgba(54, 162, 235, 1)'
            },
            bulanan: {
                background: 'rgba(0, 152, 104, 0.7)',
                hoverBackground: 'rgba(138, 241, 195, 0.9)',
                border: 'rgb(158, 230, 191)'
            },
            tahunan: {
                background: 'rgba(249, 197, 67, 0.74)',
                hoverBackground: 'rgb(254, 221, 139)',
                border: 'rgb(248, 211, 138)'
            }
        };


        const chartObat = {
            mingguan: {
                labels: @json($obatPalingLaku['mingguan']->pluck('nama_produk')),
                data: @json($obatPalingLaku['mingguan']->pluck('total')),
            },
            bulanan: {
                labels: @json($obatPalingLaku['bulanan']->pluck('nama_produk')),
                data: @json($obatPalingLaku['bulanan']->pluck('total')),
            },
            tahunan: {
                labels: @json($obatPalingLaku['tahunan']->pluck('nama_produk')),
                data: @json($obatPalingLaku['tahunan']->pluck('total')),
            }
        };

        Object.entries(chartObat).forEach(([key, config]) => {
            const ctx = document.getElementById(`chart-${key}`).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: config.labels,
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: config.data,
                        backgroundColor: barColors[key].background,
                        borderColor: barColors[key].border,
                        hoverBackgroundColor: barColors[key].hoverBackground,
                        borderWidth: 2,
                        borderRadius: 8,
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: ctx => `${ctx.dataset.label}: ${ctx.raw} pcs`
                            }
                        },
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Terjual (pcs)',
                                font: { size: 14 },
                                color: '#444'
                            },
                            ticks: {
                                stepSize: 1,
                                color: '#555'
                            },
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Obat',
                                font: { size: 14 },
                                color: '#444'
                            },
                            ticks: {
                                color: '#555',
                                maxRotation: 40,
                                minRotation: 20
                            }
                        }
                    }
                }
            });
        });

        // Line chart untuk pengeluaran, pembelian, dan penjualan
        const chartConfigs = [
            {
                id: 'pembelianChart',
                labels: @json($pembelian->pluck('bulan')->map(fn($b) => namaBulan($b))),
                data: @json($pembelian->pluck('total')),
                color: ['rgb(218, 4, 83)', 'rgba(255, 159, 64, 0.2)'],
                label: 'Pembelian'
            },
            {
                id: 'penjualanChart',
                labels: @json($penjualan->pluck('bulan')->map(fn($b) => namaBulan($b))),
                data: @json($penjualan->pluck('total')),
                color: ['rgb(4, 196, 100)', 'rgba(153, 102, 255, 0.2)'],
                label: 'Penjualan'
            }
        ];

        chartConfigs.forEach(config => {
            const ctx = document.getElementById(config.id).getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, config.color[0]);
            gradient.addColorStop(1, config.color[1]);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: config.labels,
                    datasets: [{
                        label: config.label,
                        data: config.data,
                        borderColor: config.color[0],
                        backgroundColor: gradient,
                        pointBackgroundColor: config.color[0],
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: config.color[0],
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: '#333',
                                font: { size: 13 }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#222',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            footerColor: '#ddd',
                            callbacks: {
                                label: ctx => `Rp ${Number(ctx.raw).toLocaleString('id-ID')}`,
                                footer: items => {
                                    const total = items.reduce((acc, item) => acc + Number(item.raw), 0);
                                    return `Total: Rp ${total.toLocaleString('id-ID')}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan',
                                font: { size: 13 },
                                color: '#666'
                            },
                            grid: { display: false },
                            ticks: { color: '#444' }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah (Rp)',
                                font: { size: 13 },
                                color: '#666'
                            },
                            grid: {
                                color: 'rgba(180,180,180,0.1)'
                            },
                            ticks: { color: '#444' }
                        }
                    }
                }
            });
        });
    </script>

@endsection
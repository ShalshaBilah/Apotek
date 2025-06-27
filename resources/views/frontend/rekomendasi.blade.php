@extends('frontend.home')

@section('content')
    <div class="container py-5">
        <div class="section-title text-center mb-4">
            <h2 style="color: black; font-weight: bold;">Rekomendasi Produk</h2>
            <p style="color: black;">Produk terbaik sesuai dengan gejala yang Anda alami.</p>
        </div>
        <div class="row justify-content-center">
            @if($recommendedProducts->isNotEmpty())
                @foreach($recommendedProducts as $prodak)
                    <div class="col-md-4 d-flex align-items-stretch mb-4">
                        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $prodak->logo) }}" class="card-img-top" alt="{{ $prodak->nama }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold" style="color: black;">{{ $prodak->nama }}</h5>
                                <p style="color: black;">{{$prodak->deskripsi}}</p>
                                <ul class="list-unstyled mb-3">
                                    <li><strong>Kategori:</strong> {{ $prodak->kategori }}</li>
                                    <li><strong>Gejala:</strong> {{ $prodak->gejala }}</li>
                                    <li><strong>Usia:</strong> {{ $prodak->usia }}</li>
                                    <li><strong>Harga:</strong> <span
                                            class="text-success">Rp{{ number_format($prodak->harga, 0, ',', '.') }}</span></li>
                                    <!-- <li><strong>Skor:</strong> <span
                                                                        class="badge bg-warning text-dark">{{ number_format($prodak->score, 2) }}</span>
                                                                </li> -->
                                </ul>
                                <a href="{{ route('show', $prodak->id) }}" class="btn"
                                    style="background-color: #01796f; border-color: #01796f; color: white;">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="text-muted">Tidak ada rekomendasi produk yang sesuai dengan preferensi Anda.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
@extends('frontend.home')

@section('content')
    <section id="obat" class="obat">
        <div class="container" data-aos="fade-up">
            <div class="section-header text-center">
                <h2>Obat-Obatan</h2>
                <p>Temukan berbagai obat yang tersedia di Apotek Telu</p>
            </div>

            <div class="row gx-lg-0 gy-4">
                @forelse ($prodaks as $prodak)
                    <div class="col-lg-3 col-md-6">
                        <div class="obat-item card shadow-sm">
                            <img src="{{ asset('storage/' . $prodak->logo) }}" alt="{{ $prodak->logo }}"
                                class="img-fluid card-img-top">
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $prodak->nama }}</h4>
                                <p class="card-text"><strong>Harga:</strong> Rp
                                    {{ number_format($prodak->harga, 0, ',', '.') }}
                                </p>
                                <a href="{{ route('show', $prodak->id) }}" class="btn">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada produk yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $prodaks->links() }}
            </div>
        </div>
    </section>
@endsection
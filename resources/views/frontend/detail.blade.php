@extends('frontend.home')

@section('content')
    <section id="produk-detail" class="produk-detail py-5">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="produk-detail">
                        <img src="{{ asset('storage/' . $produk->logo) }}" alt="Logo {{ $produk->nama }}">
                        <div class="detail-info">
                            <h2>{{ $produk->nama }}</h2>
                            <p><strong>Kategori:</strong> {{ $produk->kategori }}</p>
                            <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
                            <p><strong>Manfaat:</strong> {{ $produk->manfaat }}</p>
                            <p><strong>Gejala:</strong> {{ $produk->gejala }}</p>
                            <p><strong>Usia:</strong> {{ $produk->usia }}</p>
                            <p><strong>Dosis:</strong> {{ $produk->dosis }}</p>
                            <p><strong>Aturan Pakai:</strong> {{ $produk->aturan_pakai }}</p>
                            <a href="/product" class="btn"
                                style="background-color: #01796f; border-color: #01796f; color: white;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
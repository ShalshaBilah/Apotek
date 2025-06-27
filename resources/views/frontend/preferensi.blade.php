@extends('frontend.home')

@section('content')

  <section id="rekomendasi" class="rekomendasi py-5">
    <div class="container text-center" data-aos="fade-up">
    <div class="section-title mb-4">
      <h2>Rekomendasi Obat</h2>
      <p>Masukkan gejala Anda untuk mendapatkan rekomendasi obat yang sesuai.</p>
    </div>

    <form action="{{ route('frontend.savePreferences') }}" method="POST" class="bg-white shadow-lg rounded">
      @csrf
      <div class="row g-3">
      <div class="col-md-6">
        <div class="form-group">
        <label for="kategori">Jenis Obat</label>
        <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Jenis Obat" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
        <label for="usia">Usia</label>
        <input type="text" name="usia" id="usia" class="form-control" placeholder="Usia Anda" required>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
        <label for="gejala">Gejala</label>
        <textarea name="gejala" id="gejala" rows="5" class="form-control" placeholder="Deskripsikan gejala Anda..."
          required></textarea>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Dapatkan Rekomendasi</button>
      </div>
      </div>
    </form>
    </div>
  </section>

@endsection
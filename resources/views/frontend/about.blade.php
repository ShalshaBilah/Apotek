@extends('frontend.home')

@section('content')
  <!-- ======= About Us Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>About Us</h2>
    </div>

    <div class="row gy-4">
      <div class="col-lg-6">
      <h3>Apotek Telu Tegal</h3>
      <img src="tema/img/about-3.jpg" class="img-fluid rounded-4 mb-4" alt="">
      <p>
        Program mitra jaringan Apotek Telu terbuka lebar untuk para pemilik apotek konvensional yang ingin
        mengembangkan bisnis
        Apoteknya menjadi lebih baik dengan standarisasi dari manajemen Apotek Telu.
      </p>
      </div>
      <div class="col-lg-6">
      <div class="content ps-0 ps-lg-5">
        <p class="fst-italic">
        Dalam perjalanannya, Apotek Telu selalu berusaha untuk mencetak prestasi dalam memberikan
        pelayanan terbaik bagi masyarakat indonesia
        </p>
        <ul>
        <li><i class="bi bi-check-circle-fill"></i> Melayani Konsultasi</li>
        <li><i class="bi bi-check-circle-fill"></i> Menerima Pesanan </li>
        <li><i class="bi bi-check-circle-fill"></i> Menerima Resep Dokter</li>
        </ul>
        <p>
        Franchise Apotek Telu telah terbukti mempunyai sistem franchise unggul, yaitu brand kuat dan sudah
        dikenal, royalty fee ringan, dukungan terpadu (untuk pendirian gerai, rekrutmen & pelatihan staf,
        support IT online 24 jam, strategi pemasaran, hingga operasional), mendorong kewirausahaan, bisnis
        sekaligus ibadah. Serta
        menjadi berkat dan manfaat dengan memberikan akses obat yang mudah dan terjangkau bagi masyarakat
        Indonesia.
        </p>

        <div class="position-relative mt-4">
        <img src="tema/img/about-2.jpg" class="img-fluid rounded-4" alt="">

        </div>
      </div>
      </div>
    </div>

    </div>
  </section><!-- End About Us Section -->

  <section id="clients" class="clients">
    <div class="container" data-aos="zoom-out">
    <div class="clients-slider swiper">
      <div class="swiper-wrapper align-items-center">
      <div class="swiper-slide"><img src="tema/img/clients/1.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/2.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/3.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/4.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/5.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/6.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/7.png" class="img-fluid" alt=""></div>
      <div class="swiper-slide"><img src="tema/img/clients/8.png" class="img-fluid" alt=""></div>
      </div>
    </div>

    </div>
  </section><!-- End Clients Section -->
  <section id="stats-counter" class="stats-counter">
    <div class="container" data-aos="fade-up">
    <div class="row gy-4 align-items-center">

      <div class="col-lg-6">
      <img src="tema/img/apoteker.png" alt="" class="img-fluid">
      </div>

      <div class="col-lg-6">

      <div class="stats-item d-flex align-items-center">
        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
        class="purecounter"></span>
        <p><strong>Pelayanan</strong> Banyak pelanggan yang berdatangan</p>
      </div><!-- End Stats Item -->

      <div class="stats-item d-flex align-items-center">
        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
        class="purecounter"></span>
        <p><strong>Obat</strong> Tersedia banyak obat</p>
      </div><!-- End Stats Item -->

      </div>

    </div>
  </section><!-- End Stats Counter Section -->

@endsection
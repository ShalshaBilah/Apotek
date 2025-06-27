@extends('frontend.home')

@section('content')
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div
                    class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Welcome to <span>Apotek Telu</span></h2>
                    <p>Your Wellness Is Our Wellspring. Dimana Wellness anda adalah jantung kehidupan kami</p>
                    <div class="d-flex justify-content-center justify-content-lg-start"> <a href="#about"
                            class="btn-get-started">Get Started</a> </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2"> <img src="tema/img/farma.png" class="img-fluid" alt=""
                        data-aos="zoom-out" data-aos-delay="100"> </div>
            </div>
        </div>
    </section>
    <section id="additional-text" class="additional-text py-5" style="background-color: #f8f9fa;">
        <div class="container text-center" data-aos="fade-up">
            <h2 class="fw-bold text-dark mb-4">Solusi Kesehatan Terlengkap untuk Anda</h2>
            <p class="lead text-muted px-3">
                Apotek Telu hadir untuk memberikan layanan kesehatan yang lengkap dan terpercaya bagi Anda dan keluarga.
                Kami menyediakan berbagai jenis obat-obatan, suplemen kesehatan, serta produk perawatan tubuh yang
                berkualitas.
                Dengan tenaga farmasi profesional, kami siap memberikan konsultasi kesehatan dan membantu Anda menemukan
                solusi terbaik sesuai dengan kebutuhan.
            </p>

            <div class="row mt-4">
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card border-0 shadow-lg p-4">
                        <i class="bi bi-capsule text-primary display-4 mb-3"></i>
                        <h5 class="fw-semibold">Obat Berkualitas</h5>
                        <p class="text-muted">Kami menyediakan obat dengan kualitas terbaik dan harga bersaing.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card border-0 shadow-lg p-4">
                        <i class="bi bi-star text-warning display-4 mb-3"></i>
                        <h5 class="fw-semibold">Pelayanan Terbaik</h5>
                        <p class="text-muted">Kami berkomitmen memberikan pelayanan yang ramah, cepat, dan profesional
                            demi kepuasan pelanggan.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card border-0 shadow-lg p-4">
                        <i class="bi bi-heart-pulse text-danger display-4 mb-3"></i>
                        <h5 class="fw-semibold">Konsultasi Kesehatan</h5>
                        <p class="text-muted">Konsultasikan kesehatan Anda dengan tenaga farmasi profesional kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services sections-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Pelayanan</h2>
                <p>Apotek Telu menerima berbagai macam pelayanan kesehatan.</p>
            </div>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h3>Pemeriksaan</h3>
                        <p>Disini pelanggan dapat melakukan berbagai macam pemeriksaan</p>
                        <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-broadcast"></i>
                        </div>
                        <h3>Penerimaan Resep Dokter</h3>
                        <p>Disini bisa menerima resep dari dokter</p>
                        <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-easel"></i>
                        </div>
                        <h3>Obat</h3>
                        <p>Menerima pelayanan obat racikan dan non-racikan</p>
                        <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="produk-obat" class="produk-obat py-5">
        <div class="container" data-aos="fade-up">
            <h2 class="fw-bold text-dark text-center mb-4">Daftar Obat yang Kami Jual</h2>
            <div class="row">
                <!-- Contoh Obat 1 -->
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card border-0 shadow-lg p-3">
                        <img src="tema/img/paracetamol.jpg" class="card-img-top" alt="Paracetamol"
                            style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold">Paracetamol</h5>
                            <p class="text-muted">Obat pereda demam dan nyeri ringan.</p>
                            <p class="fw-bold text-primary">Rp 10.000</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh Obat 2 -->
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card border-0 shadow-lg p-3">
                        <img src="tema/img/amoxicilin.jpg" class="card-img-top" alt="Amoxicillin"
                            style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold">Amoxicillin</h5>
                            <p class="text-muted">Antibiotik untuk infeksi bakteri.</p>
                            <p class="fw-bold text-primary">Rp 25.000</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh Obat 3 -->
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card border-0 shadow-lg p-3">
                        <img src="tema/img/vitaminc.jpg" class="card-img-top" alt="Vitamin C"
                            style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold">Vitamin C</h5>
                            <p class="text-muted">Meningkatkan daya tahan tubuh.</p>
                            <p class="fw-bold text-primary">Rp 15.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Gallery</h2>
                <p>Berikut ini beberapa gallery yang terdapat pada Apotik Telu</p>
            </div>
            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 portfolio-container">

                    <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <a href="{{asset('tema/img/portfolio/image.jpg')}}" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="tema/img/portfolio/image.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.html" title="More Details">Pemeriksaan Berbagai Macam</a>
                                </h4>
                                <p>Disini dapat dilakukan pemeriksaan gula darah, kolesterol, asam urat, dll</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                        <div class="portfolio-wrap">
                            <a href="{{asset('tema/img/portfolio/obat.jpg')}}" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="tema/img/portfolio/obat.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.html" title="More Details">Pelayanan Pembelian Obat</a>
                                </h4>
                                <p>Pembelian Berbagai Macam Obat dapat dilakukan disini</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                        <div class="portfolio-wrap">
                            <a href="{{asset('tema/img/portfolio/dokter.jpg')}}" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="tema/img/portfolio/dokter.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.html" title="More Details">Penerimaan Resep Dokter</a>
                                </h4>
                                <p>Dapat melakukan pelayanan penerimaan resep dokter</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-xl-4 col-md-6 portfolio-item filter-books">
                        <div class="portfolio-wrap">
                            <a href="{{asset('tema/img/portfolio/karyawan.jpg')}}" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="tema/img/portfolio/karyawan.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.html" title="More Details">Karyawan</a></h4>
                                <p>Semua karyawan disini adalah karyawan yang mengetahui tentang obat</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <a href="{{asset('tema/img/portfolio/periksa.jpg')}}" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="tema/img/portfolio/periksa.jpg" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.html" title="More Details">Melakukan Pengecekan Obat</a>
                                </h4>
                                <p>Karyawan selalu melakukan pengecekan kesediaan obat yang ada di apotik ini</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                        <div class="portfolio-wrap">
                            <a href="{{asset('tema/img/portfolio/apotik.png')}}" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="tema/img/portfolio/apotik.png" class="img-fluid" alt=""></a>
                            <div class="portfolio-info">
                                <h4><a href="portfolio-details.html" title="More Details">Apoteker</a></h4>
                                <p>Disini terdapat apoteker yang dapat dipercaya</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->
                </div>
            </div>
    </section><!-- End Our Team Section -->

    </div>
    </section>

@endsection
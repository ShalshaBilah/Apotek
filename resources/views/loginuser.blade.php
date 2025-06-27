<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Apotek Telu</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="tema/img/favicon1.png" rel="icon">
    <link href="tema/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="tema/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="tema/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="tema/vendor/aos/aos.css" rel="stylesheet">
    <link href="tema/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="tema/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="tema/css/main.css" rel="stylesheet">

    <style>
        /* Menambahkan style untuk section auth */
        #auth {
            background-color: rgb(0, 0, 0);
            padding: 80px 0;
        }

        .card-body {
            background-color: #01796f;
            /* Mengubah warna form */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: rgb(219, 230, 230);
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: rgb(10, 100, 100);
        }

        .text-center a {
            color: rgb(0, 0, 0);
            text-decoration: underline;
        }

        .text-center a:hover {
            color: rgb(250, 250, 250);
            /* Warna kuning untuk hover */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/telu" class="logo d-flex align-items-center">
                <h1>Apotek Telu<span>.</span></h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="/telu">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/layanan">Layanan</a></li>
                    <li><a href="/galeri">Gallery</a></li>
                    <li><a href="/kontak">Contact</a></li>
                    <li><a href="/loginuser"
                            style="background-color: white; padding: 10px 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); color: black;">Login/Register</a>
                    </li>
                </ul>
            </nav>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header>

    <section id="auth" class="auth d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-8">
                    <div class="card shadow border-0">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4 text-white">Login</h2>

                            <!-- Menampilkan pesan error -->
                            @if ($errors->has('login'))
                                <div class="alert alert-danger text-center">
                                    {{ $errors->first('login') }}
                                </div>
                            @endif

                            <form action="/loginproses" method="post" class="space-y-4">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="register-email" class="form-label text-white">Email</label>
                                    <input type="email" name="email" id="register-email" class="form-control"
                                        placeholder="Email Anda" required value="{{ old('email') }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="register-password" class="form-label text-white">Password</label>
                                    <input type="password" name="password" id="register-password" class="form-control"
                                        placeholder="Password Anda" required>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit"
                                        class="btn btn-primary w-100 fw-bold text-black">Login</button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <p class="mb-0">Belum Punya Akun? <a href="/registerusers" class="text-white">Daftar di
                                        sini</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="/telu" class="logo d-flex align-items-center">
                        <span>Apotek Telu</span>
                    </a>
                    <p>Your Wellness Is Our Wellspring. Dimana Wellness anda adalah jantung kehidupan kami</p>
                    <div class="social-links d-flex mt-4">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>
                        <strong>Street:</strong> Jalan Serayu Tegal Rt 5 Rw 8 <br>
                        Kecamatan Mintaragen<br>
                        Kelurahan Tegal Timur <br><br>
                        <strong>Phone:</strong> 0897468294759<br>
                        <strong>Email:</strong> telu@gmail.com<br>
                    </p>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Apotek Telu</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="tema/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="tema/vendor/aos/aos.js"></script>
    <script src="tema/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="tema/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="tema/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="tema/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="tema/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="tema/js/main.js"></script>
</body>

</html>
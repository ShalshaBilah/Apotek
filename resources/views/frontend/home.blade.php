<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Apotek Telu</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('tema/img/favicon1.png') }}" rel="icon">
    <link href="{{ asset('tema/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('tema/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('tema/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('tema/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('tema/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('tema/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('tema/css/main.css') }}" rel="stylesheet">
    <style>
        canvas {
            width: 100% !important;
            height: 400px !important;
        }

        #obatChart {
            width: 100%;
            height: 400px;
        }

        .obat-item {
            display: flex;
            flex-direction: column;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        .obat-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .btn {
            background-color: #01796f;
            border-color: #01796f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
        }

        .btn:hover {
            background-color: #015f4d;
            border-color: #015f4d;
        }

        .obat-item .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .produk-detail {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
        }

        .produk-detail img {
            max-width: 40%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .detail-info {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .detail-info h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .detail-info p {
            font-size: 1rem;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .btn-secondary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
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
                    <li><a href="/">Home</a></li>
                    <li><a href="/product">Product</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/kontak">Contact</a></li>
                    @guest
                        <li><a href="{{ route('tren.penyakit') }}">Trend Penyakit</a></li>
                    @endguest
                    <!-- Cek apakah pengguna sudah login -->
                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                style="background-color: white; padding: 10px 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); color: black;">
                                Login/Register
                            </a>
                        </li>
                    @else
                        @hasrole('users')
                        <!-- <li><a href="/preferensi">Rekomendasi</a></li> -->
                        <li><a href="{{ route('tren.penyakit') }}">Trend Penyakit Anda</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-3 py-2" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="background-color: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); color: black;">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endhasrole('users')
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="/telu" class="logo d-flex align-items-center">
                        <span>Apotek Telu</span>
                    </a>
                    <p>Your Wellness Is Our Wellspring. Dimana Wellness anda adalah jantung kehidupan kami</p>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Apotik Telu</span></strong>. All Rights Reserved
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
    <script src="{{ asset('tema/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tema/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('tema/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('tema/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('tema/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('tema/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('tema/js/main.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
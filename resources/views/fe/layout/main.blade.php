<!doctype html>
<html lang="en">

  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset('/be_aset/dist/img/logo/logo.png')}}">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/fe_aset/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('/fe_aset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/fe_aset/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('/fe_aset/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('/fe_aset/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/fe_aset/css/aos.css')}}">
    @yield('peta.css')
    @yield('tabel.css')
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('/fe_aset/css/style.css')}}">
    @yield('maps.css')

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap mb-0" id="home-section">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body">
            </div>
        </div>
        <header class="site-navbar site-navbar-target" role="banner">
            <div class="container mb-3">
                <div class="d-flex align-items-center">
                    <div class="site-logo mr-auto">
                    <a href="index.html">SIG BUGISAN<span class="text-primary">.</span></a>
                    </div>
                    <div class="site-quick-contact d-none d-lg-flex ml-auto ">
                    <div class="d-flex site-info align-items-center mr-5">
                        <span class="block-icon mr-3"><span class="icon-map-marker"></span></span>
                        <span>Jl. Candi Sewu, Cepoko, Bugisan, Kec. Prambanan<br> Kabupaten Klaten, Jawa Tengah</span>
                    </div>
                    <div class="d-flex site-info align-items-center">
                        <span class="block-icon mr-3"><span class="icon-clock-o"></span></span>
                        <span>Senin - Jumat 8:00AM - 2:00PM <br> Sabtu & Minggu TUTUP</span>
                    </div>
                </div>
            </div>
            </div>
            <div class="container">
                <div class="menu-wrap d-flex align-items-center">
                    <span class="d-inline-block d-lg-none"><a href="#" class="text-black site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-black"></span></a></span>
                    <nav class="site-navigation text-left mr-auto d-none d-lg-block" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto ">
                        <li class="@yield('home')"><a href="/" class="nav-link">Home</a></li>
                        <li class="@yield('data')"><a href="/fe/data" class="nav-link">Data Kerusakan</a></li>
                        <li class="@yield('peta')"><a href="/fe/peta" class="nav-link">Peta Kerusakan</a></li>
                        <li class="@yield('profile')"><a href="/fe/profile" class="nav-link">Profile</a></li>
                        <li class="@yield('kontak')"><a href="/fe/kontak" class="nav-link">Kontak</a></li>
                        <li><a href="/login">Admin</a></li>
                        </ul>
                    </nav>

                    <div class="top-social ml-auto">
                        <a href="https://web.facebook.com/bugisan.bugisan.52"><span class="icon-facebook"></span></a>
                        <a href="https://twitter.com/DBugisan"><span class="icon-twitter"></span></a>
                        <a href="https://www.instagram.com/desa_bugisan/"><span class="icon-instagram"></span></a>
                    </div>
                </div>
            </div>
        </header>{{-- Header dan Navigasi --}}

        @yield('content')

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="footer-heading mb-3">Tentang Aplikasi</h2>
                        <p class="mb-5">Kami membuat aplikasi ini bertujuan untuk mempermudah masyarakat dalam mengetahui informasi tentang kerusakan-kerusakan yang ada di Desa Bugisan berbasis pemetaan.</p>
                    </div>
                    <div class="col-lg-8 ml-auto">
                        <div class="row">
                            <div class="col-lg-4 ml-auto">
                                <h2 class="footer-heading mb-4">Kontak</h2>
                                <ul class="list-unstyled footer-link">
                                <li class="d-block mb-3"><span class="d-block text-white">Address: <br> Jl. Candi Sewu, Cepoko, Bugisan, Kec. Prambanan</li>
                                <li class="d-block mb-3"><span class="d-block text-white">Phone: <br> 0816 394 553</li>
                                <li class="d-block mb-3"><span class="d-block text-white">Email: <br> desa_bugisan@gmail.com</li>
                                </ul>
                            </div>
                            <div class="col-lg-4 ml-auto">
                                <h2 class="footer-heading mb-4">Navigasi</h2>
                                <ul class="list-unstyled">
                                <li><a href="/">Home</a></li>
                                <li><a href="/fe/data">Data Kerusakan</a></li>
                                <li><a href="/fe/peta">Peta Kerusakan</a></li>
                                <li><a href="/fe/profile">Profile</a></li>
                                <li><a href="/fe/kontak">Kontak</a></li>
                                <li><a href="/login">Admin</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                        <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{asset('/fe_aset/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/jquery-migrate-3.0.0.js')}}"></script>
    <script src="{{asset('/fe_aset/js/popper.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('/fe_aset/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('/fe_aset/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('/fe_aset/js/aos.js')}}"></script>

    <script src="{{asset('/fe_aset/js/main.js')}}"></script>
    @yield('tabel')
  </body>

</html>
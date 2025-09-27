<header class="header-fixed">
    {{-- 🔝 Topbar --}}
    <div class="topbar py-1 border-bottom">
        <div class="container d-flex flex-wrap justify-content-between align-items-center small"> 
            <div class="d-flex align-items-center gap-3">
                <a href="mailto:thegalleryvilla@gmail.com" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-envelope me-1"></i> thegalleryvilla@gmail.com
                </a>
                <a href="tel:+6285883121699" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-phone me-1"></i> +62 858-8312-1699
                </a>
            </div>
            <div class="social-icons">
                <a href="#" class="me-2 text-dark"><i class="fab fa-facebook"></i></a>
                <a href="#" class="me-2 text-dark"><i class="fab fa-twitter"></i></a>
                <a href="#" class="me-2 text-dark"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-dark"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    {{-- 🏡 Logo --}}
    <div class="logo text-center py-2">
        <a href="/" class="d-inline-block">
            <img src="{{ asset('assets/img/villa/logo.png') }}" alt="The Gallery Villa" class="logo-img">
        </a>
    </div>

    {{-- 📍 Navbar --}}
    <nav class="main-navbar navbar navbar-expand-lg bg-white border-top border-bottom">
        <div class="container justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                <ul class="navbar-nav text-center gap-4">
                    <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.home')}}" href="{{ route('guest.home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.about')}}" href="{{ route('guest.about') }}">Mengenai Kami</a></li>
                    <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.facility')}}" href="{{ route('guest.facility') }}">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.gallery')}}" href="{{ route('guest.gallery') }}">Galeri Foto</a></li>
                    <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.booking')}}" href="{{ route('guest.booking') }}">Pemesanan Online</a></li>
                    <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.contact')}}" href="{{ route('guest.contact') }}">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

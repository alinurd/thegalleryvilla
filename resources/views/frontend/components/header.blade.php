@php
    $set = AppSetting::first();
@endphp

<header>
    {{-- 🔝 Topbar --}}
    <div class="topbar py-1">
        <div class="container d-flex flex-wrap justify-content-between align-items-center small"> 
            <div class="d-flex align-items-center gap-3">
                <a href="mailto:{{$set->email ?? 'thegalleryvilla@gmail.com'}}">
                    <i class="fa-solid fa-envelope me-1"></i> {{$set->email ?? 'thegalleryvilla@gmail.com'}}
                </a>
                <a href="tel:{{$set->mobile_phone ?? '081234567890'}}">
                    <i class="fa-solid fa-phone me-1"></i> {{$set->mobile_phone ?? '081234567890'}}
                </a>
            </div>
            <div class="social-icons">
                @if ($set->status_facebook==1)
                    <a href="{{$set->facebook ?? '#'}}" class="me-2"><i class="fab fa-facebook"></i></a>
                @endif
                @if ($set->status_twitter==1)
                    <a href="{{$set->twitter ?? '#'}}" class="me-2"><i class="fab fa-twitter"></i></a>
                @endif
                @if ($set->status_instagram==1)
                    <a href="{{$set->instagram ?? '#'}}" class="me-2"><i class="fab fa-instagram"></i></a>
                @endif
                @if ($set->status_youtube==1)
                    <a href="{{$set->youtube ?? '#'}}" class="me-2"><i class="fab fa-youtube"></i></a>
                @endif
                @if ($set->status_tiktok==1)
                    <a href="{{$set->tiktok ?? '#'}}" class="me-2"><i class="fab fa-tiktok"></i></a>
                @endif
            </div>
        </div>
    </div>

    {{-- 🏡 Logo Tengah (Desktop) --}}
    <div class="logo text-center py-3 d-none d-lg-block">
        <a href="/" class="d-inline-block">
            <img src="{{ asset('assets/img/villa/logo.png') }}" alt="The Gallery Villa" class="logo-img">
        </a>
    </div>

    {{-- 📍 Navbar --}}
    <nav class="main-navbar navbar navbar-expand-lg">
        <div class="container d-flex align-items-center justify-content-between">

            {{-- Brand Mobile (Logo + Text) --}}
            <div class="d-flex align-items-center gap-2 mobile-brand d-lg-none">
                <a href="/" class="d-inline-block">
                    <img src="{{ asset('assets/img/villa/logo.png') }}" alt="The Gallery Villa" class="logo-img-small">
                </a>
                <a href="/" class="brand-text">The Gallery Villa</a>
            </div>

            {{-- Tombol Hamburger --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu Navigasi --}}
            <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
                <ul class="navbar-nav text-center">
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


<script>
document.addEventListener("scroll", function() {
    const navbar = document.querySelector(".main-navbar");
    if (window.scrollY > 80) {
        navbar.classList.add("fixed");
        document.body.classList.add("has-fixed-navbar");
    } else {
        navbar.classList.remove("fixed");
        document.body.classList.remove("has-fixed-navbar");
    }
});
</script>

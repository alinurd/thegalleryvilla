@php
    $set = AppSetting::first();
@endphp

<header>
    {{-- 🔝 Topbar --}}
    <div class="topbar py-1">
        <div class="container d-flex flex-wrap justify-content-between align-items-center small"> 
            <div class="d-flex align-items-center gap-3">
                <a href="mailto:{{$set->email??'thegalleryvilla@gmail.com'}}">
                    <i class="fa-solid fa-envelope me-1"></i> {{$set->email??'thegalleryvilla@gmail.com'}}
                </a>
                <a href="tel:{{$set->mobile_phone??'thegalleryvilla@gmail.com'}}">
                    <i class="fa-solid fa-phone me-1"></i> {{$set->mobile_phone??'thegalleryvilla@gmail.com'}}
                </a>
            </div>
            <div class="social-icons">
                                @if ($set->status_facebook==1)

                <a href="#" class="me-2"><i class="fab fa-facebook"></i></a>
                                @endif
@if ($set->status_twitter==1)
                <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                 @endif
                <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                                @if ($set->status_instagram==1)
                 @endif
                 @if ($set->status_youtube==1)
                    <a class="me-2" href="{{$set->youtube}}"><i class="fab fa-youtube"></i></a>
                 @endif
                @if ($set->status_tiktok==1)
                    <a class="me-2" href="{{$set->tiktok}}"><i class="fab fa-tiktok"></i></a>
                 @endif

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
   <nav class="main-navbar navbar navbar-expand-lg">
    <div class="container justify-content-center">
        <ul class="navbar-nav text-center gap-4">
            <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.home')}}" href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.about')}}" href="{{ route('guest.about') }}">Mengenai Kami</a></li>
            <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.facility')}}" href="{{ route('guest.facility') }}">Fasilitas</a></li>
            <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.gallery')}}" href="{{ route('guest.gallery') }}">Galeri Foto</a></li>
            <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.booking')}}" href="{{ route('guest.booking') }}">Pemesanan Online</a></li>
            <li class="nav-item"><a class="nav-link {{isActiveRoute('guest.contact')}}" href="{{ route('guest.contact') }}">Hubungi Kami</a></li> 
        </ul>
         
    </div>
</nav>

</header>
 

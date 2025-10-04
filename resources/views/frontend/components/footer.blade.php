@php
    $set = AppSetting::first();
@endphp
 <footer>
    <div class="container footer-content">
        <!-- Kolom 1 -->
        <div class="footer-left">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="footer-logo">
            <p>Nikmati suasana sejuk pegunungan dan pemandangan indah khas Puncak Bogor di Villa Aurora, vila eksklusif dengan kapasitas besar (60-100 orang). Cocok untuk acara keluarga, gathering kantor, retret, reuni, maupun kegiatan komunitas.</p>
        </div>

        <!-- Kolom 2 -->
        <div class="footer-links">
            <h4>Link Terkait</h4>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Terms of service</a></li>
                <li><a href="#">Privacy policy</a></li>
            </ul>
        </div>

        <!-- Kolom 3 -->
        <div class="footer-villa">
            <h4>The Gallery Villa</h4>
            <ul>
                <li><a href="#">Villa Aurora</a></li>
                <li><a href="#">Villa Esperanza</a></li>
            </ul>
        </div>

        <!-- Kolom 4 -->
        <div class="footer-social">
            <h4>Our Social Network</h4>
            <ul>
                 @if ($set->status_twitter==1)
                    <li><a href="{{$set->twitter}}"><i class="fab fa-twitter"></i></a></li>
                @endif
                @if ($set->status_facebook==1)
                    <li><a href="{{$set->facebook}}"><i class="fab fa-facebook"></i></a></li>
                @endif
                @if ($set->status_instagram==1)
                    <li><a href="{{$set->instagram}}"><i class="fab fa-instagram"></i></a></li>
                 @endif
                @if ($set->status_youtube==1)
                    <li><a href="{{$set->youtube}}"><i class="fab fa-youtube"></i></a></li>
                 @endif
                @if ($set->status_tiktok==1)
                    <li><a href="{{$set->tiktok}}"><i class="fab fa-tiktok"></i></a></li>
                 @endif
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p> {{$set->footer_text}}</p>
    </div>
</footer>
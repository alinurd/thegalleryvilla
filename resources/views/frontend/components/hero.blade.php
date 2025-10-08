<section id="hero" class="hero" aria-label="Foto Villa">
    <section class="hero-section">
        <div class="carousel-container position-relative">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="8000">
                <div class="carousel-inner">
                    @foreach ($banner as $index => $b)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset($b->image) }}" alt="{{ $b->title }}" class="carousel-img">
                        </div>
                    @endforeach
                </div> 
                <div class="carousel-dot-heros-container dots">
                    @foreach ($banner as $index => $b)
                        <div class="dot-hero" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}">
                            <div class="dot-hero-fill {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <div class="about container mt-5">
        <span class="title1 highlight">Tentang Kami</span>
        <p>
            Nikmati suasana sejuk pegunungan dan pemandangan indah di Villa Aurora & Villa Esperanza.
            Cocok untuk acara keluarga, gathering, retreat, meeting, maupun kegiatan komunitas.
        </p>
        <a href="#contact" class="btn">Get Started</a>
    </div>
</section>

<!-- CSS -->
<style> 

/* Outer dot-hero */
.dot-hero {
    width: 12px;
    height: 12px;
    background-color: #c4a88a;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    cursor: pointer;
}

/* Inner fill animation */
.dot-hero-fill {
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: #9b6a45;
    border-radius: 50%;
    transition: width 0s;
}

.dot-hero-fill.active {
    animation: fillDotHero 8s linear forwards;
}

@keyframes fillDotHero {
    from { width: 0%; }
    to { width: 100%; }
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('#heroCarousel');
    const bsCarousel = new bootstrap.Carousel(carousel, { interval: 8000 });
    const dotHeroFills = document.querySelectorAll('.dot-hero-fill');
    const dotHeroes = document.querySelectorAll('.dot-hero');
    let currentIndex = 0;

    // Fungsi memulai animasi dot
    const startProgress = (index) => {
        dotHeroFills.forEach((fill, i) => {
            fill.classList.remove('active');
            fill.style.width = i < index ? '100%' : '0%';
        });
        dotHeroFills[index].classList.add('active');
    };

    // Update animasi setiap kali slide berubah
    carousel.addEventListener('slide.bs.carousel', function(e) {
        currentIndex = e.to;
        startProgress(currentIndex);
    });

    // Klik manual pada dot untuk pindah slide
    dotHeroes.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            bsCarousel.to(i);
            startProgress(i);
        });
    });

    // Jalankan animasi pertama kali
    startProgress(0);
});
</script>

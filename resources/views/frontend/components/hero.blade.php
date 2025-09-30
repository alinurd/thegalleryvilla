    <section id="hero" class="hero" aria-label="Foto Villa">
        <section class="hero-section">
            <div class="carousel-container">
                <div id="heroCarousel" class="carousel carousel-fade slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
                    
                    <!-- Progress Bar Instagram Style -->
                    <div class="carousel-progress-container">
                        @foreach ($banner as $index => $b)
                            <div class="progress-bar">
                                <div class="progress-fill {{ $index === 0 ? 'active' : '' }}" 
                                     data-slide="{{ $index }}"></div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Title Overlay -->
                    <div class="carousel-overlay">
                        @foreach ($banner as $index => $b)
                            <div class="carousel-title {{ $index === 0 ? 'active' : '' }}" 
                                 data-slide="{{ $index }}">
                                <span class="typing-animation">{{ $b->title }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- isi slide -->
                    <div class="carousel-inner">
                        @foreach ($banner as $index => $b)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" 
                                 data-bs-interval="5000">
                                <img src="{{ asset($b->image) }}" alt="{{ $b->title }}" class="carousel-img">
                            </div>
                        @endforeach
                    </div>

                    <!-- tombol navigasi -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <div class="about container">
            <span class="title1 highlight">Tentang Kami</span>
            <p>
                Nikmati suasana sejuk pegunungan dan pemandangan indah di Villa Aurora & Villa Esperanza.
                Cocok untuk acara keluarga, gathering, retreat, meeting, maupun kegiatan komunitas.
            </p>
            <a href="#contact" class="btn">Get Started</a>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CDN GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const carousel = document.getElementById('heroCarousel');
            const progressBars = document.querySelectorAll('.progress-fill');
            const titles = document.querySelectorAll('.carousel-title');
            let currentProgress = 0;
            let progressInterval;

            // Fungsi untuk reset semua progress bars
            function resetAllProgress() {
                progressBars.forEach(bar => {
                    bar.style.width = '0%';
                    bar.classList.remove('active', 'paused');
                    bar.style.animation = 'none';
                });
            }

            // Fungsi untuk reset semua titles
            function resetAllTitles() {
                titles.forEach(title => {
                    title.classList.remove('active');
                });
            }

            // Fungsi untuk memulai progress bar
            function startProgress(slideIndex) {
                resetAllProgress();
                resetAllTitles();
                
                if (progressBars[slideIndex]) {
                    progressBars[slideIndex].style.animation = 'progress 5s linear forwards';
                    progressBars[slideIndex].classList.add('active');
                }
                
                if (titles[slideIndex]) {
                    titles[slideIndex].classList.add('active');
                    
                    // Reset dan mulai ulang animasi ketik
                    const typingElement = titles[slideIndex].querySelector('.typing-animation');
                    if (typingElement) {
                        typingElement.style.animation = 'none';
                        setTimeout(() => {
                            typingElement.style.animation = 'typing 2s steps(20, end), blink-caret 0.75s step-end infinite';
                        }, 100);
                    }
                }
            } 
            startProgress(0);

            // Saat slide akan berganti
            carousel.addEventListener('slide.bs.carousel', function (event) {
                const currentImage = event.from !== undefined 
                    ? carousel.querySelectorAll('.carousel-item')[event.from].querySelector("img") 
                    : null;
                const nextImage = event.relatedTarget.querySelector("img");
                const nextIndex = Array.from(carousel.querySelectorAll('.carousel-item')).indexOf(event.relatedTarget);

                if (currentImage) {
                    // animasi fadeOut gambar lama
                    gsap.to(currentImage, {
                        opacity: 0,
                        scale: 0.95,
                        duration: 0.8,
                        ease: "power2.inOut"
                    });
                }

                // animasi fadeIn + zoomOut gambar baru
                gsap.fromTo(nextImage,
                    { opacity: 0, scale: 1.1 },
                    { opacity: 1, scale: 1, duration: 1.2, ease: "power3.out" }
                );

                 startProgress(nextIndex);
            });
 
            carousel.addEventListener('mouseenter', () => {
                progressBars.forEach(bar => {
                    if (bar.classList.contains('active')) {
                        bar.style.animationPlayState = 'paused';
                    }
                });
            });
 
            carousel.addEventListener('mouseleave', () => {
                progressBars.forEach(bar => {
                    if (bar.classList.contains('active')) {
                        bar.style.animationPlayState = 'running';
                    }
                });
            });

             document.querySelectorAll('.progress-bar').forEach((bar, index) => {
                bar.addEventListener('click', () => {
                    carouselInstance.to(index);
                });
            });
             
            progressBars.forEach((bar, index) => {
                bar.addEventListener('click', () => {
                    const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                    carouselInstance.to(index);
                });
            });
        });
    </script>

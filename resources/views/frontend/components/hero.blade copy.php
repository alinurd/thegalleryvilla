    <section id="hero" class="hero" aria-label="Foto Villa">
        <section class="hero-section">
            <div class="carousel-container">
                <div id="heroCarousel" class="carousel carousel-fade slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
                    
                    <!-- Progress Bar Instagram Style -->
                    {{-- <div class="carousel-progress-container">
                        @foreach ($banner as $index => $b)
                            <div class="progress-bar">
                                <div class="progress-fill {{ $index === 0 ? 'active' : '' }}" 
                                     data-slide="{{ $index }}"></div>
                            </div>
                        @endforeach
                    </div> --}}

                    <!-- Title Overlay -->
                    {{-- <div class="carousel-overlay">
                        @foreach ($banner as $index => $b)
                            <div class="carousel-title {{ $index === 0 ? 'active' : '' }}" 
                                 data-slide="{{ $index }}">
                                <span class="typing-animation">{{ $b->title }}</span>
                            </div>
                        @endforeach
                    </div> --}}

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
 
    
  

 
<section id="gallery" class="py-5">
    <div class="container text-center">
        <h3 class="section-title text-center mb-1 title">
            Galeri <span class="highlight">Foto</span>
        </h3>


        <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
            Kegiatan kami mencakup beragam galeri menarik, yang menampilkan kreasi luar biasa para peserta,
            proyek inovatif, dan pertunjukan luar biasa, yang menumbuhkan rasa bangga dan pencapaian
            di antara semua yang terlibat.
        </p>

        <!-- Pilihan villa -->
        <div class="mb-4">
            @foreach ($villas as $index => $villa)
                <button class="btn-outline-brown {{ $index === 0 ? 'active' : '' }}"
                    data-villa="{{ $villa['slug'] }}">
                    {{ sprintf('%02d', $index + 1) }}. {{ $villa['name'] }}
                </button>
            @endforeach
        </div>

        <!-- Gallery container -->
        @foreach ($villas as $index => $villa)
            <div class="row g-3 gallery-wrapper {{ $index !== 0 ? 'd-none' : '' }}" id="gallery-{{ $villa['slug'] }}">
                @foreach ($villa['facilities'] as $facility)
                    <div class="col-6 col-md-3">
                        <div class="card shadow-sm h-100">
                            <a href="{{ asset('assets/img/villa/fasility/' . $facility['image']) }}" class="glightbox"
                                data-gallery="{{ $villa['slug'] }}" data-title="{{ $facility['name'] }}">
                                <img src="{{ asset('assets/img/villa/fasility/' . $facility['image']) }}"
                                    class="card-img-top" alt="{{ $facility['name'] }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('[data-villa]');
        const galleries = document.querySelectorAll('.gallery-wrapper');

        // toggle gallery berdasarkan tombol
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                galleries.forEach(g => g.classList.add('d-none'));
                document.getElementById('gallery-' + btn.dataset.villa).classList.remove(
                    'd-none');
            });
        });

        // aktifkan GLightbox
        GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            closeButton: true,
            autoplayVideos: false
        });
    });
</script>

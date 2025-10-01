<section id="gallery" class="py-5">
    <div class="container text-center">
        <h3 class="section-title text-center mb-1 title">
            Galeri <span class="highlight">Foto</span>
        </h3>

        <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
            Berikut beberapa dokumentasi kegiatan terbaik kami.
        </p>

        @foreach ($pageDetail as $index => $villa)
            <div class="masonry-grid {{ $index !== 0 ? 'd-none' : '' }}" id="gallery-{{ $villa['slug'] }}">
                @foreach (collect($villa['galleries'])->shuffle()->take(10) as $gallery)
                    <div class="masonry-item size-{{ rand(1,3) }}">
                        <a href="{{ asset($gallery['image']) }}" 
                           class="glightbox" 
                           data-gallery="{{ $villa['slug'] }}" 
                           data-title="{{ $gallery['title'] }}">
                            <img src="{{ asset($gallery['image']) }}" alt="{{ $gallery['title'] }}">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

<style>
/* === Masonry Random Grid === */
.masonry-grid {
  column-count: 4;
  column-gap: 15px;
}

.masonry-item {
  display: inline-block;
  margin-bottom: 15px;
  width: 100%;
  transition: transform 0.3s ease;
}

.masonry-item img {
  width: 100%;
  height: auto;
  border-radius: 12px;
  display: block;
}

.masonry-item:hover {
  transform: scale(1.05);
}

/* Ukuran random */
.size-1 img { height: 160px; object-fit: cover; }
.size-2 img { height: 220px; object-fit: cover; }
.size-3 img { height: 280px; object-fit: cover; }

@media (max-width: 992px) {
  .masonry-grid { column-count: 3; }
}
@media (max-width: 576px) {
  .masonry-grid { column-count: 2; }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true
        });
    });
</script>

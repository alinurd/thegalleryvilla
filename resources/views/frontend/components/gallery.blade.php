<style>
/* === Grid Galeri Masonry dengan CSS Grid === */
#gallery{
    background: #ffffff;
}
.grid-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: 8px; /* tinggi dasar untuk kalkulasi */
    gap: 10px;
}

.grid-item {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.grid-item img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
    transition: transform 0.3s ease;
    cursor: pointer;
}

/* Hover effect */
.grid-item:hover {
    transform: translateY(-3px);
}
.grid-item:hover img {
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 768px) {
    .grid-gallery {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 8px;
    }
}
@media (max-width: 576px) {
    .grid-gallery {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 6px;
    }
}
</style>

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

        <div class="button-container mb-4">
            @foreach ($pageDetail as $index => $villa)
                <button class="btn-outline-brown {{ $index === 0 ? 'active' : '' }}"
                        data-villa="{{ $villa['slug'] }}">
                    {{ sprintf('%02d', $index + 1) }}. {{ $villa['name'] }}
                </button>
            @endforeach
        </div>

        <div id="gallery-container">
         </div>
    </div>
</section>
 {{-- <div class="about text-center" style="padding-bottom: 20px"> 
    <a href="{{ route('guest.gallery') }}" class="btn">Load Image</a>
</div> --}}

 <script>
    const pageDetail = @json($pageDetail);

    // Shuffle array helper
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    // Fungsi resize masonry untuk tiap item
    function resizeMasonryItem(item) {
        const grid = item.closest('.grid-gallery');
        const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('gap'));
        const img = item.querySelector('img');
        if (img) {
            const rowSpan = Math.ceil((img.getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
            item.style.gridRowEnd = "span " + rowSpan;
        }
    }

    function resizeAllMasonryItems() {
        document.querySelectorAll('.grid-item').forEach(item => {
            resizeMasonryItem(item);
        });
    }

    // Generate gallery
   // Generate gallery
function generateGallery() {
    const galleryContainer = document.getElementById('gallery-container');
    galleryContainer.innerHTML = '';

    pageDetail.forEach((villa, index) => {
        const galleryDiv = document.createElement('div');
        galleryDiv.className = `grid-gallery ${index !== 0 ? 'd-none' : ''} fade-in`;
        galleryDiv.id = `gallery-${villa.slug}`;

        if (!villa.galleries || villa.galleries.length === 0) {
            const emptyMsg = document.createElement('p');
            emptyMsg.className = "text-muted";
            emptyMsg.textContent = `Belum ada foto untuk ${villa.name}`;
            galleryDiv.appendChild(emptyMsg);
        } else {
            const shuffledGalleries = shuffleArray([...villa.galleries]).slice(0, 30);

            shuffledGalleries.forEach(gallery => {
                const itemDiv = document.createElement('div');
                itemDiv.className = "grid-item";

                // 🔍 Jika punya link (YouTube)
                if (gallery.link && gallery.media === "YouTube") {
                    const link = document.createElement('a');
                    link.href = gallery.link.includes("youtube.com/embed")
                        ? gallery.link
                        : gallery.link.replace("watch?v=", "embed/");
                    link.className = 'glightbox';
                    link.setAttribute('data-gallery', villa.slug);
                    link.setAttribute('data-type', 'video'); // penting untuk GLightbox
                    link.setAttribute('data-title', gallery.title || "Video");

                    // Thumbnail default
                    const thumb = document.createElement('img');
                    if (gallery.image) {
                        thumb.src = `/${gallery.image}`;
                    } else {
                        // Thumbnail otomatis dari YouTube
                        const ytId = link.href.split('/embed/')[1]?.split('?')[0];
                        thumb.src = `https://img.youtube.com/vi/${ytId}/hqdefault.jpg`;
                    }
                    thumb.alt = gallery.title;
                    thumb.loading = 'lazy';
                    thumb.onload = () => resizeMasonryItem(itemDiv);

                    link.appendChild(thumb);
                    itemDiv.appendChild(link);
                } 
                // 🎨 Jika hanya gambar biasa
                else if (gallery.image) {
                    const link = document.createElement('a');
                    link.href = `/${gallery.image}`;
                    link.className = 'glightbox';
                    link.setAttribute('data-gallery', villa.slug);
                    link.setAttribute('data-title', gallery.title || "Foto");

                    const img = document.createElement('img');
                    img.src = `/${gallery.image}`;
                    img.alt = gallery.title;
                    img.loading = 'lazy';
                    img.onload = () => resizeMasonryItem(itemDiv);

                    link.appendChild(img);
                    itemDiv.appendChild(link);
                }

                galleryDiv.appendChild(itemDiv);
            });
        }

        galleryContainer.appendChild(galleryDiv);
    });

    // 🔄 Re-init Lightbox
    if (window.lightbox) {
        window.lightbox.destroy();
    }
    window.lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        openEffect: 'zoom',
        closeEffect: 'fade',
        zoomable: true,
        plyr: {
            css: 'https://cdn.plyr.io/3.6.8/plyr.css',
            js: 'https://cdn.plyr.io/3.6.8/plyr.js'
        }
    });

    resizeAllMasonryItems();
}


    document.addEventListener('DOMContentLoaded', () => {
        generateGallery();

        // Tombol filter villa
        const villaButtons = document.querySelectorAll('.btn-outline-brown');
        villaButtons.forEach(button => {
            button.addEventListener('click', function() {
                villaButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const villaSlug = this.getAttribute('data-villa');
                document.querySelectorAll('.grid-gallery').forEach(gallery => {
                    gallery.classList.add('d-none');
                });
                const targetGallery = document.getElementById(`gallery-${villaSlug}`);
                if (targetGallery) {
                    targetGallery.classList.remove('d-none');
                    resizeAllMasonryItems();
                }
            });
        });

        window.addEventListener('resize', resizeAllMasonryItems);
    });
</script>

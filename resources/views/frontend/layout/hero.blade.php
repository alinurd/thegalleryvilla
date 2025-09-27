<section id="hero" class="hero" aria-label="Foto Villa">
  <div class="hero-images">
    <img src="{{ asset('assets/img/villa/hero.png') }}" alt="Foto Villa 1" /> 
  </div>
  
  <div class="about container">
    <h2>Tentang Kami</h2>
    <p>
      Nikmati suasana sejuk pegunungan dan pemandangan indah di Villa Aurora & Villa Esperanza.
      Cocok untuk acara keluarga, gathering, retreat, meeting, maupun kegiatan komunitas.
    </p>
    <a href="#contact" class="btn">Get Started</a>
  </div>
</section>

<section id="facilities" class="facilities">
  <div class="container">
    <div class="row align-items-center">

      <!-- Text -->
      <div class="col-lg-5 mb-4 mb-lg-0">
        <span class="title">
          Villa yang kami <span class="highlight">sediakan</span><br>
          dengan <span class="highlight">berbagai fasilitas</span>
        </span>
        <p class="desc">
          Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga,
          acara gathering kantor, atau acara lainnya.
        </p>

        <div class="villa-list">
            <span class="villa-item active">01. Villa Aurora</span>
            <span class="villa-item ">02. Villa Esperanza</span>
        </div>
      </div>

      <!-- Images -->
      <div class="col-lg-7 text-center">
        <div class="facilities-images">
          <img src="{{ asset('assets/img/villa/fasility.png') }}" alt="Foto Villa 1" />
        </div>
      </div>

    </div>
  </div>
</section>

@php
$villas = [
    [
        "slug" => "aurora",
        "name" => "Villa Aurora",
        "facilities" => [
            ["name" => "20 Kamar Tidur", "image" => "1.png"],
            ["name" => "Kolam Renang", "image" => "2.png"],
            ["name" => "Lapangan Basket", "image" => "3.png"],
            ["name" => "Taman Bermain", "image" => "4.png"],
            ["name" => "Gazebo", "image" => "5.png"],
        ]
    ],
    [
        "slug" => "esperanza",
        "name" => "Villa Esperanza",
        "facilities" => [
            ["name" => "Ruang Meeting", "image" => "6.png"],
            ["name" => "Kolam Renang", "image" => "7.png"],
            ["name" => "Area BBQ", "image" => "8.png"],
            ["name" => "Lapangan Tenis", "image" => "9.png"],
        ]
    ]
];
@endphp

<section class="container py-5 fasilitas" id="fasilitas">
  <h3 class="section-title text-center mb-3 title">
    Fasilitas <span class="fw-bold">Villa Kami</span>
  </h3>
  <p class="text-center mb-4 px-3 px-md-5 mx-auto" style="max-width: 720px;">
    Villa-villa kami dilengkapi dengan berbagai fasilitas yang cocok untuk mengisi liburan
    keluarga, acara gathering perusahaan, acara ulang tahun, ataupun acara lainnya.
  </p>

  <!-- Tombol Switch -->
  <div class="d-flex justify-content-center gap-2 mb-5">
    @foreach ($villas as $i => $villa)
      <button class="btn-villa {{ $i == 0 ? 'active' : '' }}" 
              onclick="showFacility('{{ $villa['slug'] }}', this)">
        {{ sprintf('%02d', $i+1) }}. {{ $villa['name'] }}
      </button>
    @endforeach
  </div>

  <!-- Wrapper untuk masing-masing villa -->
  @foreach ($villas as $i => $villa)
    <div class="facility-wrapper {{ $i > 0 ? 'd-none' : 'active' }}" 
         id="facility-{{ $villa['slug'] }}">
      
      @php
        $chunks = array_chunk($villa['facilities'], 3);
      @endphp
 @foreach ($chunks as $j => $chunk)
  <div class="row text-center facility-slide {{ $j > 0 ? 'd-none' : '' }}">
    @foreach ($chunk as $facility)
      <div class="col-md-4 mb-4 facility-card">
        <div class="facility-img-wrapper">
          <!-- Gambar -->
          <img src="{{ asset('assets/img/villa/fasility/' . $facility['image']) }}" class="facility-img"/>
          <!-- Label nama villa -->
          <div class="facility-villa-label">{{ $villa['name'] }}</div>
        </div>
        <!-- Nama fasilitas -->
        <p class="fw-semibold">{{ $facility['name'] }}</p>
      </div>
    @endforeach
  </div>
@endforeach


      <!-- Dots -->
      <div class="dots text-center mt-3">
        @foreach ($chunks as $j => $chunk)
          <span class="dot {{ $j == 0 ? 'active' : '' }}" 
                onclick="showSlide('{{ $villa['slug'] }}', {{ $j }}, true)"></span>
        @endforeach
      </div>
    </div>
  @endforeach
</section>

<script>
let slideIntervals = {}; // simpan interval per villa
 function showFacility(villa, el) {
  // sembunyikan semua wrapper
  document.querySelectorAll('.facility-wrapper').forEach(f => {
    f.classList.add('d-none');
    f.classList.remove('active');
  })

  // tampilkan yang dipilih
  const target = document.getElementById('facility-' + villa);
  target.classList.remove('d-none');
  target.classList.add('active');

  // reset tombol
  document.querySelectorAll('.btn-villa').forEach(btn => btn.classList.remove('active'));
  el.classList.add('active');

  // restart auto slide
  startAutoSlide(villa);
}


function showSlide(villa, index, manual = false) {
  const wrapper = document.getElementById('facility-' + villa);
  const slides = wrapper.querySelectorAll('.facility-slide');
  const dots = wrapper.querySelectorAll('.dot');

  // sembunyikan semua slide
  slides.forEach(s => s.classList.add('d-none'));
  dots.forEach(d => d.classList.remove('active'));

  // tampilkan slide sesuai index
  slides[index].classList.remove('d-none');
  dots[index].classList.add('active');

  // simpan index aktif di dataset
  wrapper.dataset.activeIndex = index;

  // kalau manual klik dot → restart interval
  if (manual) startAutoSlide(villa);
}

function startAutoSlide(villa) {
  const wrapper = document.getElementById('facility-' + villa);
  const slides = wrapper.querySelectorAll('.facility-slide');
  let index = parseInt(wrapper.dataset.activeIndex || 0);

  // hentikan interval lama
  if (slideIntervals[villa]) clearInterval(slideIntervals[villa]);

  // buat interval baru
  slideIntervals[villa] = setInterval(() => {
    index = (index + 1) % slides.length;
    showSlide(villa, index);
  }, 4000); // ganti slide tiap 4 detik
}

// mulai auto-slide pertama kali
document.addEventListener("DOMContentLoaded", () => {
  const firstVilla = document.querySelector(".facility-wrapper.active");
  if (firstVilla) startAutoSlide(firstVilla.id.replace("facility-",""));
});
</script>



<section id="minat" class="minat">
  <div class="container">
    <div class="content-text">
      <h4 class="fw-bold mb-3">
        Apakah <span class="text-dark">Anda Berminat</span>?
      </h4>
      <p class="mb-4">
        Kami menghadirkan fasilitas lengkap dengan kenyamanan layaknya rumah sendiri, 
        dilengkapi udara segar pegunungan dan suasana nyaman setiap momen menjadi berkesan.
      </p>
    </div>
    <div class="content-btn">
      <button class="btn btn-brown btn-lg" onclick="alert('Terima kasih atas minat Anda!')">
        Berminat
      </button>
    </div>
  </div>
</section>



@php
$villas = [
    [
        "slug" => "aurora",
        "name" => "Villa Aurora",
        "facilities" => [
            ["name" => "20 Kamar Tidur", "image" => "1.png"],
            ["name" => "Kolam Renang", "image" => "2.png"],
            ["name" => "Lapangan Basket", "image" => "3.png"],
            ["name" => "Taman Bermain", "image" => "4.png"],
            ["name" => "Gazebo", "image" => "5.png"],
        ]
    ],
    [
        "slug" => "esperanza",
        "name" => "Villa Esperanza",
        "facilities" => [
            ["name" => "Ruang Meeting", "image" => "6.png"],
            ["name" => "Kolam Renang", "image" => "7.png"],
            ["name" => "Area BBQ", "image" => "8.png"],
            ["name" => "Lapangan Tenis", "image" => "9.png"],
        ]
    ]
];
@endphp

<section id="gallery" class="py-5">
  <div class="container text-center">
    <h4 class="fw-bold mb-3">
      Galeri <span class="text-brown">Foto</span>
    </h4>
    <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
      Kegiatan kami mencakup beragam galeri menarik, yang menampilkan kreasi luar biasa para peserta,
      proyek inovatif, dan pertunjukan luar biasa, yang menumbuhkan rasa bangga dan pencapaian
      di antara semua yang terlibat.
    </p>

    <!-- Pilihan villa -->
    <div class="mb-4">
      @foreach($villas as $index => $villa)
        <button class="btn btn-sm btn-outline-brown {{ $index === 0 ? 'active' : '' }}" data-villa="{{ $villa['slug'] }}">
          {{ sprintf('%02d', $index+1) }}. {{ $villa['name'] }}
        </button>
      @endforeach
    </div>

    <!-- Gallery container -->
    @foreach($villas as $index => $villa)
      <div class="row g-3 gallery-wrapper {{ $index !== 0 ? 'd-none' : '' }}" id="gallery-{{ $villa['slug'] }}">
        @foreach($villa['facilities'] as $facility)
          <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100">
              <a href="{{ asset('assets/img/villa/fasility/'.$facility['image']) }}" 
                 class="glightbox" 
                 data-gallery="{{ $villa['slug'] }}" 
                 data-title="{{ $facility['name'] }}">
                <img src="{{ asset('assets/img/villa/fasility/'.$facility['image']) }}" 
                     class="card-img-top" alt="{{ $facility['name'] }}">
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>
</section>

<!-- GLightbox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

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
        document.getElementById('gallery-' + btn.dataset.villa).classList.remove('d-none');
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

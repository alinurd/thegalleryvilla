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
  <h3 class="section-title text-center mb-1 title">
    Fasilitas <span class="highlight">Villa Kami</span>
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
      <h4 class=" minatTitle">
        Apakah <span class="minatHighlight">Anda Berminat</span>?
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
      @foreach($villas as $index => $villa)
        <button class="btn-outline-brown {{ $index === 0 ? 'active' : '' }}" data-villa="{{ $villa['slug'] }}">
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


@php
$customer = [
    ["name" => "Bank CBN","img" => "1.png"],
    ["name" => "Tree House","img" => "2.png"],
    ["name" => "CS Finansial","img" => "3.png"],
    ["name" => "CS 4","img" => "4.png"],
    ["name" => "CS 5","img" => "5.png"],
    ["name" => "Tree House","img" => "2.png"],
    ["name" => "CS 7","img" => "7.png"],
    ["name" => "Tree House","img" => "2.png"],
    ["name" => "Bank CBN","img" => "1.png"],
    ["name" => "CS Finansial","img" => "3.png"],
    ["name" => "CS 4","img" => "4.png"],
];
@endphp

<section id="customer" class="customer">
  <div class="container text-center">

    <!-- Title & Desc -->
     <h3 class="section-title text-center mb-1 title">
    Siapa <span class="highlight">Pelanggan Kami</span>
  </h3>

    
    <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
      Loyalitas pelanggan kami merupakan bukti komitmen teguh kami untuk 
      menyediakan produk dan layanan yang luar biasa, membangun hubungan yang kuat, 
      dan secara konsisten melampaui harapan pelanggan kami.
    </p>

    <!-- Logo slider -->
    <div class="customer-logos" id="customer-logos">
      <div class="customer-logos-inner">
        @foreach ($customer as $c)
          <div class="logo-item">
            <img src="{{ asset('assets/img/villa/customer/' . $c['img']) }}" alt="{{ $c['name'] }}">
          </div>
        @endforeach
      </div>
    </div>
    <div class="customer-dots" id="customer-dots"></div>
  </div>
</section>

 <script>
document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("customer-logos");
  const track = container.querySelector(".customer-logos-inner");
  const items = Array.from(track.querySelectorAll(".logo-item"));
  const dotsWrap = document.getElementById("customer-dots");

  let perSlide = getPerSlide();
  let totalSlides = Math.ceil(items.length / perSlide);
  let current = 0;
  let autoplayTimer;
  const interval = 4000; // 4 detik

  function getPerSlide() {
    const w = window.innerWidth;
    if (w < 576) return 2;
    if (w < 992) return 3;
    return 4;
  }

  function setup() {
    perSlide = getPerSlide();
    totalSlides = Math.ceil(items.length / perSlide);

    track.style.width = `${totalSlides * 100}%`;
    items.forEach(item => {
      item.style.flex = `0 0 ${100 / (perSlide * totalSlides)}%`;
      item.style.maxWidth = `${100 / (perSlide * totalSlides)}%`;
    });

    buildDots();
    goTo(0);
    startAutoplay();
  }

  function buildDots() {
    dotsWrap.innerHTML = '';
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("span");
      const bar = document.createElement("span");
      bar.classList.add("progress");
      dot.appendChild(bar);
      dot.dataset.index = i;
      dot.addEventListener("click", () => {
        goTo(i);
        restartAutoplay();
      });
      dotsWrap.appendChild(dot);
    }
  }

  function goTo(index) {
    current = index;
    const shift = (100 / totalSlides) * current;
    track.style.transform = `translateX(-${shift}%)`;
    resetProgress();
  }

  function nextSlide() {
    let next = current + 1;
    if (next >= totalSlides) next = 0;
    goTo(next);
  }

  function startAutoplay() {
    stopAutoplay();
    autoplayTimer = setInterval(nextSlide, interval);
    resetProgress();
  }

  function stopAutoplay() {
    if (autoplayTimer) clearInterval(autoplayTimer);
  }

  function restartAutoplay() {
    stopAutoplay();
    startAutoplay();
  }

  function resetProgress() {
    const bars = dotsWrap.querySelectorAll(".progress");
    bars.forEach((bar, idx) => {
      bar.style.transition = "none";
      bar.style.width = idx < current ? "100%" : "0"; // prev full
    });

    setTimeout(() => {
      const activeBar = dotsWrap.querySelectorAll(".progress")[current];
      activeBar.style.transition = `width ${interval}ms linear`;
      activeBar.style.width = "100%";
    }, 50);
  }

  window.addEventListener("resize", () => {
    setup();
  });

  setup();
});
</script>


<section id="contact" class="contact">
  <div class="container">
    <div class="text-center">
      <span class="section-title text-center mb-1 title">
 Hubungi <span class="highlight">Kami</span>
</span>
 <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
      Loyalitas pelanggan kami merupakan bukti komitmen teguh kami untuk 
      menyediakan produk dan layanan yang luar biasa, membangun hubungan yang kuat, 
      dan secara konsisten melampaui harapan pelanggan kami.
    </p>
    </div>
    <div class="row">

    
   
      <!-- Info -->
      <div class="col info">
        
        <div class="card">
      <div class="card-body">
        <div class="info-item">
          <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
          <div class="info-content">
            <h4>Lokasi</h4>
            <p><strong>Villa Aurora</strong><br>Jl. Kampung Brujul RT 1 RW 2 No. 5, Gang Aek Sarula<br>
              <a href="https://maps.google.com" target="_blank">Lihat peta</a>
            </p>
            <p><strong>Villa Esperanza</strong><br>Jalan Raya Puncak Cisarua, Gang Aek no. 100<br>
              <a href="https://maps.google.com" target="_blank">Lihat peta</a>
            </p>
          </div>
        </div>

        <div class="info-item">
          <span class="icon"><i class="fas fa-envelope"></i></span>
          <div class="info-content">
            <h4>Website/eMail</h4>
            <p>www.thegalleryvilla.id<br>thegalleryvilla@gmail.com</p>
          </div>
        </div>

        <div class="info-item">
          <span class="icon"><i class="fab fa-whatsapp"></i></span>
          <div class="info-content">
            <h4>Whatsapp</h4>
            <p>+62 813-1762-3475</p>
          </div>
        </div>
      </div>
        </div>
      </div>

      <!-- Form -->
      
      <div class="col form">
        <div class="card">
      <div class="card-body">
        <form action="{{ route('guest.contact.send') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col"><input type="text" name="name" placeholder="Your Name" required></div>
            <div class="col"><input type="email" name="email" placeholder="Your e-mail" required></div>
          </div>
          <input type="text" name="subject" placeholder="Subject" required>
          <textarea name="message" placeholder="Messages" required></textarea>
          <button type="submit" class="btn">Submit</button>
        </form>
      </div>
      </div>
      </div>

    </div>
  </div>
</section>






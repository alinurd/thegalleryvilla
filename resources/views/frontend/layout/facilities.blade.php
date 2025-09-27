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
              <img src="{{ asset('assets/img/villa/fasility/'.$facility['image']) }}" 
                   class="card-img-top" alt="{{ $facility['name'] }}">
              <div class="card-body p-2">
                <small class="text-muted">{{ $facility['name'] }}</small>
              </div>
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

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        // toggle tombol active
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // tampilkan gallery sesuai villa
        galleries.forEach(g => g.classList.add('d-none'));
        document.getElementById('gallery-' + btn.dataset.villa).classList.remove('d-none');
      });
    });
  });
</script>

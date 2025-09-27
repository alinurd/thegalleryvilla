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
  <div class="title text-center coreTitle">Galeri <span class="highlight">Foto </span></div>
  <div class="container text-center">
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
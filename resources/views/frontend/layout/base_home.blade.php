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

@include('frontend.components.facility')
@include('frontend.components.facility1')


@include('frontend.components.minat')


@php
    $villas = [
        [
            'slug' => 'aurora',
            'name' => 'Villa Aurora',
            'facilities' => [
                ['name' => '20 Kamar Tidur', 'image' => '1.png'],
                ['name' => 'Kolam Renang', 'image' => '2.png'],
                ['name' => 'Lapangan Basket', 'image' => '3.png'],
                ['name' => 'Taman Bermain', 'image' => '4.png'],
                ['name' => 'Gazebo', 'image' => '5.png'],
            ],
        ],
        [
            'slug' => 'esperanza',
            'name' => 'Villa Esperanza',
            'facilities' => [
                ['name' => 'Ruang Meeting', 'image' => '6.png'],
                ['name' => 'Kolam Renang', 'image' => '7.png'],
                ['name' => 'Area BBQ', 'image' => '8.png'],
                ['name' => 'Lapangan Tenis', 'image' => '9.png'],
            ],
        ],
    ];
@endphp



 
@include('frontend.components.gallery')
@include('frontend.components.client')
@include('frontend.components.contact')
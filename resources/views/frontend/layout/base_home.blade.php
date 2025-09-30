{{-- <section id="hero" class="hero" aria-label="Foto Villa">
    <div class="hero-images">
        <img src="{{ asset('assets/img/villa/hero.png') }}" alt="Foto Villa 1" />
    </div>

    <div class="about container">
        <h2>Tentang Kami</h2>
        <p>
            Nikmati suasana sejuk pegunungan dan pemandangan indah di Villa Aurora & Villa Esperanza.
            Cocok untuk acara keluarga, gathering, retreat, meeting, maupun kegiatan komunitas.
        </p>
        <a href="#contact" class="btn">Gsset Started</a>
    </div>
</section> --}}

@include('frontend.components.hero', ['banner'=>$banner])
@include('frontend.components.facility')
@include('frontend.components.facility1')


@include('frontend.components.minat')


@include('frontend.components.gallery')
@include('frontend.components.client')


@include('frontend.components.contact')
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
                {{ sprintf('%02d', $i + 1) }}. {{ $villa['name'] }}
            </button>
        @endforeach
    </div>

    <!-- Wrapper untuk masing-masing villa -->
    @foreach ($villas as $i => $villa)
        <div class="facility-wrapper {{ $i > 0 ? 'd-none' : 'active' }}" id="facility-{{ $villa['slug'] }}">

            @php
                $chunks = array_chunk($villa['facilities'], 3);
            @endphp
            @foreach ($chunks as $j => $chunk)
                <div class="row text-center facility-slide {{ $j > 0 ? 'd-none' : '' }}">
                    @foreach ($chunk as $facility)
                        <div class="col-md-4 mb-4 facility-card">
                            <div class="facility-img-wrapper">
                                <!-- Gambar -->
                                <img src="{{ asset('assets/img/villa/fasility/' . $facility['image']) }}"
                                    class="facility-img" />
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

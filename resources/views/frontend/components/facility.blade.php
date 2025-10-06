<section id="facilities" class="facilities ">
    <div class="container">
        <div class="row align-items-center">

            <!-- Images -->
            <div class="col-lg-7 text-center order-1 order-lg-2">
                <div class="facilities-images mb-4 mb-lg-0">
                    <img src="{{ asset('assets/img/villa/fasility.png') }}" alt="Foto Villa 1" class="img-fluid rounded" />
                </div>
            </div>

            <!-- Text -->
            <div class="col-lg-5 order-2 order-lg-1">
                <span class="title d-block mb-3">
                    Villa yang kami <span class="highlight">sediakan</span><br>
                    dengan <span class="highlight">berbagai fasilitas</span>
                </span>
                <p class="desc mb-4">
                    Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga,
                    acara gathering kantor, atau acara lainnya.
                </p>

                <div class="villa-list mb-5">
                    @foreach ($pageDetail as $index => $p)
                        <span class="villa-item {{ $index === 0 ? 'active' : '' }}">
                            {{ $index + 1 }}. {{ $p['name'] }}
                        </span> 
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

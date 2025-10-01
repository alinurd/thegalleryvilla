{{-- {{dd($pageDetail)}} --}}
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
                    @foreach ($pageDetail as $index=> $p)
                    <span class="villa-item {{ $index === 0 ? 'active' : '' }}">{{$index+1}}. {{$p['name']}}</span> 
                    @endforeach
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
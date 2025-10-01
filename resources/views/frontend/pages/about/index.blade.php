@extends('frontend.layout.app')


@php
    $x = [
        [
            'id' => '1',
            'name' => 'Villa Aurora',
            'dcs' => 'Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga,
                    acara gathering kantor, atau acara lainnya',
        ],
        [
            'id' => '2',
            'name' => 'Villa  ',
            'dcs' => 'Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga,
                    acara gathering kantor, atau acara lainnya Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga, acara gathering kantor, atau acara lainnya.  Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga, acara gathering kantor, atau acara lainnya.  Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga, acara gathering kantor, atau acara lainnya. ',
        ],
        [
            'id' => '3',
            'name' => 'Aurora Villa',
            'dcs' => 'Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga,
                    acara gathering kantor, atau acara lainnya',
        ],
    ];
@endphp


<section id="facilities" class="root">
    <div class="container">
        <div class="row align-items-center">
            {{-- Gambar tetap (diam) --}}
            <div class="col-lg-5 text-center">
                <div class="facilities-images">
                    <img src="{{ asset('assets/img/villa/fasility.png') }}" alt="Foto Villa" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-7 mb-4 mb-lg-0">
                 <span class="title1 highlight">sediakan</span>  
                <p class="title1desc">
                    Kami menyediakan beberapa villa yang dapat menyesuaikan kebutuhan Anda baik liburan keluarga,
                    acara gathering kantor, atau acara lainnya.
                </p>

                <div class="accordion" id="accordionExample">
                    @foreach ($x as $index => $p)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $p['id'] }}">
                                <button class="accordion-button title1 {{ $index !== 0 ? 'collapsed' : '' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#Collapse{{ $p['id'] }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="Collapse{{ $p['id'] }}">
                                    {{ $p['name'] }}
                                </button>
                            </h2>
                            <div id="Collapse{{ $p['id'] }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading{{ $p['id'] }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body title1desc">
                                    {{ $p['dcs'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
</section>

@include('frontend.components.minat')

<section id="facilities" class="root">
    <div class="container">
        <div class="row align-items-center">
            {{-- Accordion kedua --}}
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="accordion" id="accordionSecondExample">
                    @foreach ($x as $index => $p)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSecond{{ $p['id'] }}">
                                <button class="accordion-button title1 {{ $index !== 0 ? 'collapsed' : '' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#secondCollapse{{ $p['id'] }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="secondCollapse{{ $p['id'] }}">
                                    {{ $p['name'] }}
                                </button>
                            </h2>
                            <div id="secondCollapse{{ $p['id'] }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="headingSecond{{ $p['id'] }}"
                                data-bs-parent="#accordionSecondExample">
                                <div class="accordion-body title1desc">
                                    {{ $p['dcs'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Gambar tetap diam --}}
            <div class="col-lg-5 text-center">
                <div class="facilities-images">
                    <img src="{{ asset('assets/img/villa/fasility.png') }}" alt="Foto Villa" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.header')
@extends('frontend.layout.app')

<!-- SECTION 1: VILLA AURORA (ID 1) -->
<section id="facilities" class="root">
    <div class="container mb-5">
        <div class="row">
            {{-- Gambar tetap (diam) --}}
            <div class="col-lg-5 text-center">
                <div class="facilities-images">
                    <img src="{{ asset('assets/img/villa/about-1.png') }}" alt="Foto Villa" class="img-fluid" />
                </div>
            </div>
            
            <div class="col-lg-7 mb-4 mb-lg-0">
                <!-- About Section -->
                <div class="accordion" id="aboutAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="aboutHeading{{ $PageDetail[0]['id'] }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#aboutCollapse{{ $PageDetail[0]['id'] }}"
                                aria-expanded="true"
                                aria-controls="aboutCollapse{{ $PageDetail[0]['id'] }}">
                                Tentang {{ $PageDetail[0]['title'] }}
                            </button>
                        </h2>
                        <div id="aboutCollapse{{ $PageDetail[0]['id'] }}"
                            class="accordion-collapse collapse show"
                            aria-labelledby="aboutHeading{{ $PageDetail[0]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[0]['about'])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities Section -->
                <div class="accordion mt-3" id="facilityAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="facilityHeading{{ $PageDetail[0]['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#facilityCollapse{{ $PageDetail[0]['id'] }}" aria-expanded="false"
                                aria-controls="facilityCollapse{{ $PageDetail[0]['id'] }}">
                                Fasilitas {{ $PageDetail[0]['title'] }}
                            </button>
                        </h2>
                        <div id="facilityCollapse{{ $PageDetail[0]['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="facilityHeading{{ $PageDetail[0]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[0]['facility'])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Section -->
                <div class="accordion mt-3" id="locationAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="locationHeading{{ $PageDetail[0]['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#locationCollapse{{ $PageDetail[0]['id'] }}" aria-expanded="false"
                                aria-controls="locationCollapse{{ $PageDetail[0]['id'] }}">
                                Lokasi {{ $PageDetail[0]['title'] }}
                            </button>
                        </h2>
                        <div id="locationCollapse{{ $PageDetail[0]['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="locationHeading{{ $PageDetail[0]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[0]['location'])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Type Section -->
                <div class="accordion mt-3" id="eventAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="eventHeading{{ $PageDetail[0]['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#eventCollapse{{ $PageDetail[0]['id'] }}" aria-expanded="false"
                                aria-controls="eventCollapse{{ $PageDetail[0]['id'] }}">
                                Jenis Acara {{ $PageDetail[0]['title'] }}
                            </button>
                        </h2>
                        <div id="eventCollapse{{ $PageDetail[0]['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="eventHeading{{ $PageDetail[0]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[0]['event_type'])) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.minat')

<!-- SECTION 2: VILLA LAIN (ID 2) -->
<!-- SECTION 2: VILLA LAIN (ID 2) -->
<section id="facilities2" class="root">
    <div class="container mt-5">
        <div class="row">

            {{-- Gambar (akan pindah ke atas di mobile) --}}
            <div class="col-lg-5 text-center order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="facilities-images">
                    <img src="{{ asset('assets/img/villa/about-2.png') }}" alt="Foto Villa" class="img-fluid" />
                </div>
            </div>

            {{-- Accordion untuk Villa Lain --}}
            <div class="col-lg-7 order-2 order-lg-1">
                <!-- About Section -->
                <div class="accordion" id="aboutAccordion2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="aboutHeading{{ $PageDetail[1]['id'] }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#aboutCollapse{{ $PageDetail[1]['id'] }}"
                                aria-expanded="true"
                                aria-controls="aboutCollapse{{ $PageDetail[1]['id'] }}">
                                Tentang {{ $PageDetail[1]['title'] }}
                            </button>
                        </h2>
                        <div id="aboutCollapse{{ $PageDetail[1]['id'] }}"
                            class="accordion-collapse collapse show"
                            aria-labelledby="aboutHeading{{ $PageDetail[1]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[1]['about'])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facilities Section -->
                <div class="accordion mt-3" id="facilityAccordion2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="facilityHeading{{ $PageDetail[1]['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#facilityCollapse{{ $PageDetail[1]['id'] }}" aria-expanded="false"
                                aria-controls="facilityCollapse{{ $PageDetail[1]['id'] }}">
                                Fasilitas {{ $PageDetail[1]['title'] }}
                            </button>
                        </h2>
                        <div id="facilityCollapse{{ $PageDetail[1]['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="facilityHeading{{ $PageDetail[1]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[1]['facility'])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Section -->
                <div class="accordion mt-3" id="locationAccordion2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="locationHeading{{ $PageDetail[1]['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#locationCollapse{{ $PageDetail[1]['id'] }}" aria-expanded="false"
                                aria-controls="locationCollapse{{ $PageDetail[1]['id'] }}">
                                Lokasi {{ $PageDetail[1]['title'] }}
                            </button>
                        </h2>
                        <div id="locationCollapse{{ $PageDetail[1]['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="locationHeading{{ $PageDetail[1]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[1]['location'])) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Type Section -->
                <div class="accordion mt-3" id="eventAccordion2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="eventHeading{{ $PageDetail[1]['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#eventCollapse{{ $PageDetail[1]['id'] }}" aria-expanded="false"
                                aria-controls="eventCollapse{{ $PageDetail[1]['id'] }}">
                                Jenis Acara {{ $PageDetail[1]['title'] }}
                            </button>
                        </h2>
                        <div id="eventCollapse{{ $PageDetail[1]['id'] }}" class="accordion-collapse collapse"
                            aria-labelledby="eventHeading{{ $PageDetail[1]['id'] }}">
                            <div class="accordion-body">
                                {!! nl2br(e($PageDetail[1]['event_type'])) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

 
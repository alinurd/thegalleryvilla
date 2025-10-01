<style>
    /* .honeycomb {
        display: flex;
        flex-wrap: wrap;
        width: 600px;
         
    } */
.honeycomb {
    display: none; /* default sembunyi */
   
}

.honeycomb.active {
    display: flex; /* hanya yang active muncul */
    flex-wrap: wrap;
    width: 600px;
    margin: 0 auto;
    
}

    .hex-row {
        display: flex;
        justify-content: center;
        margin-bottom: -35px;
        /* rapatin ke bawah */
    }

    .hex-row:nth-child(even) {
        margin-left: 62px;
        /* geser setengah hex */
    }

    .hex {
        width: 120px;
        height: 138px;
        margin: 1px;
        background: gray;
        clip-path: polygon(50% 0%,
                100% 25%,
                100% 75%,
                50% 100%,
                0% 75%,
                0% 25%);
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }

    .hex:hover {
        transform: scale(1.05);
    }

    .hex img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .hex-row.two-center {
    justify-content: center;
    margin-left: 62px; /* geser supaya pas di tengah */
}

</style>
 

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

        <!-- Tombol pilih villa -->
        <div class="mb-4">
            @foreach ($pageDetail as $index => $villa)
                <button class="btn-outline-brown {{ $index === 0 ? 'active' : '' }}"
                        data-villa="{{ $villa['slug'] }}">
                    {{ sprintf('%02d', $index + 1) }}. {{ $villa['name'] }}
                </button>
            @endforeach
        </div>

        <!-- Galeri per villa -->
        @foreach ($pageDetail as $i => $villa)
            @php
                $galleries = array_slice($villa['galleries'], 0, 8);
                //$galleries = $villa['galleries']; // ambil semua foto
            @endphp

            <div class="honeycomb {{ $i === 0 ? 'active' : '' }}" id="{{ $villa['slug'] }}">
                @php
                    $row = 1;
                    $offset = 0;
                @endphp
                @while ($offset < count($galleries))
                    @if ($row % 2 === 1) 
                        <div class="hex-row">
                            @foreach (array_slice($galleries, $offset, 3) as $facility)
                                <div class="hex">
                                    <img src="{{ asset($facility['image']) }}" alt="Gallery Image">
                                </div>
                            @endforeach
                        </div>
                        @php $offset += 3; @endphp
                    @else 
                        <div class="hex-row two-center">
                            @foreach (array_slice($galleries, $offset, 2) as $facility)
                                <div class="hex">
                                    <img src="{{ asset($facility['image']) }}" alt="Gallery Image">
                                </div>
                            @endforeach
                        </div>
                        @php $offset += 2; @endphp
                    @endif
                    @php $row++; @endphp
                @endwhile
            </div>
        @endforeach
    </div>
</section>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll("[data-villa]");
        const honeycombs = document.querySelectorAll(".honeycomb");

        buttons.forEach(btn => {
            btn.addEventListener("click", () => {
                // reset tombol
                buttons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                // tampilkan honeycomb sesuai slug
                let slug = btn.dataset.villa;
                honeycombs.forEach(h => {
                    h.classList.remove("active");
                    if (h.id === slug) {
                        h.classList.add("active");
                    }
                });
            });
        });
    });
</script>
<section class="container py-5 fasilitas" id="fasilitas">
    <h3 class="section-title text-center mb-1 title">
        Fasilitas <span class="highlight">Villa Kami</span>
    </h3>
    <p class="text-center mb-4 px-3 px-md-5 mx-auto" style="max-width: 720px;">
        Villa-villa kami dilengkapi dengan berbagai fasilitas yang cocok untuk mengisi liburan
        keluarga, acara gathering perusahaan, acara ulang tahun, ataupun acara lainnya.
    </p>

    <!-- Tombol Switch -->
    <div class="d-flex justify-content-center gap-2 mb-5">
        @foreach ($pageDetail as $i => $villa)
            <button class="btn-villa {{ $i == 0 ? 'active' : '' }}"
                onclick="showFacility('{{ $villa['slug'] }}', this)">
                {{ sprintf('%02d', $i + 1) }}. {{ $villa['name'] }}
            </button>
        @endforeach
    </div>

    <!-- Wrapper untuk masing-masing villa -->
    @foreach ($pageDetail as $i => $villa)
        <div class="facility-wrapper {{ $i > 0 ? 'd-none' : 'active' }}" id="facility-{{ $villa['slug'] }}">

            @php
                $chunks = array_chunk($villa['facilities'], 3);
            @endphp
            @foreach ($chunks as $j => $chunk)
                <div class="row text-center facility-slide {{ $j > 0 ? 'd-none' : '' }}">
                    @foreach ($chunk as $facility)
                        <div class="col-4 col-md-4 mb-2    facility-card">
                            <div class="facility-img-wrapper">
                                <!-- Gambar -->
                                <img src="{{ asset($facility['image']) }}"
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
</section>

<script>
    let slideIntervals = {}; // simpan interval per villa
    function showFacility(villa, el) {
        // sembunyikan semua wrapper
        document.querySelectorAll('.facility-wrapper').forEach(f => {
            f.classList.add('d-none');
            f.classList.remove('active');
        })

        // tampilkan yang dipilih
        const target = document.getElementById('facility-' + villa);
        target.classList.remove('d-none');
        target.classList.add('active');

        // reset tombol
        document.querySelectorAll('.btn-villa').forEach(btn => btn.classList.remove('active'));
        el.classList.add('active');

        // restart auto slide
        startAutoSlide(villa);
    }


    function showSlide(villa, index, manual = false) {
        const wrapper = document.getElementById('facility-' + villa);
        const slides = wrapper.querySelectorAll('.facility-slide');
        const dots = wrapper.querySelectorAll('.dot');

        // sembunyikan semua slide
        slides.forEach(s => s.classList.add('d-none'));
        dots.forEach(d => d.classList.remove('active'));

        // tampilkan slide sesuai index
        slides[index].classList.remove('d-none');
        dots[index].classList.add('active');

        // simpan index aktif di dataset
        wrapper.dataset.activeIndex = index;

        // kalau manual klik dot → restart interval
        if (manual) startAutoSlide(villa);
    }

    function startAutoSlide(villa) {
        const wrapper = document.getElementById('facility-' + villa);
        const slides = wrapper.querySelectorAll('.facility-slide');
        let index = parseInt(wrapper.dataset.activeIndex || 0);

        // hentikan interval lama
        if (slideIntervals[villa]) clearInterval(slideIntervals[villa]);

        // buat interval baru
        slideIntervals[villa] = setInterval(() => {
            index = (index + 1) % slides.length;
            showSlide(villa, index);
        }, 4000); // ganti slide tiap 4 detik
    }

    // mulai auto-slide pertama kali
    document.addEventListener("DOMContentLoaded", () => {
        const firstVilla = document.querySelector(".facility-wrapper.active");
        if (firstVilla) startAutoSlide(firstVilla.id.replace("facility-", ""));
    });
</script>
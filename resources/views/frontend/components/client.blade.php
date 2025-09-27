
@php
    $customer = [
        ['name' => 'Bank CBN', 'img' => '1.png'],
        ['name' => 'Tree House', 'img' => '2.png'],
        ['name' => 'CS Finansial', 'img' => '3.png'],
        ['name' => 'CS 4', 'img' => '4.png'],
        ['name' => 'CS 5', 'img' => '5.png'],
        ['name' => 'Tree House', 'img' => '2.png'],
        ['name' => 'CS 7', 'img' => '7.png'],
        ['name' => 'Tree House', 'img' => '2.png'],
        ['name' => 'Bank CBN', 'img' => '1.png'],
        ['name' => 'CS Finansial', 'img' => '3.png'],
        ['name' => 'CS 4', 'img' => '4.png'],
    ];
@endphp

<section id="customer" class="customer">
    <div class="container text-center">
 
            <span class="section-title text-center mb-1 title">
                Siapa <span class="highlight">Pelanggan Kami</span>
            </span>
            <p class="mb-4" style="max-width: 700px; margin: 0 auto;">
                 Loyalitas pelanggan kami merupakan bukti komitmen teguh kami untuk
            menyediakan produk dan layanan yang luar biasa, membangun hubungan yang kuat,
            dan secara konsisten melampaui harapan pelanggan kami.
            </p> 

        <!-- Logo slider -->
        <div class="customer-logos" id="customer-logos">
            <div class="customer-logos-inner">
                @foreach ($customer as $c)
                    <div class="logo-item">
                        <img src="{{ asset('assets/img/villa/customer/' . $c['img']) }}" alt="{{ $c['name'] }}">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="customer-dots" id="customer-dots"></div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById("customer-logos");
        const track = container.querySelector(".customer-logos-inner");
        const items = Array.from(track.querySelectorAll(".logo-item"));
        const dotsWrap = document.getElementById("customer-dots");

        let perSlide = getPerSlide();
        let totalSlides = Math.ceil(items.length / perSlide);
        let current = 0;
        let autoplayTimer;
        const interval = 4000; // 4 detik

        function getPerSlide() {
            const w = window.innerWidth;
            if (w < 576) return 2;
            if (w < 992) return 3;
            return 4;
        }

        function setup() {
            perSlide = getPerSlide();
            totalSlides = Math.ceil(items.length / perSlide);

            track.style.width = `${totalSlides * 100}%`;
            items.forEach(item => {
                item.style.flex = `0 0 ${100 / (perSlide * totalSlides)}%`;
                item.style.maxWidth = `${100 / (perSlide * totalSlides)}%`;
            });

            buildDots();
            goTo(0);
            startAutoplay();
        }

        function buildDots() {
            dotsWrap.innerHTML = '';
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement("span");
                const bar = document.createElement("span");
                bar.classList.add("progress");
                dot.appendChild(bar);
                dot.dataset.index = i;
                dot.addEventListener("click", () => {
                    goTo(i);
                    restartAutoplay();
                });
                dotsWrap.appendChild(dot);
            }
        }

        function goTo(index) {
            current = index;
            const shift = (100 / totalSlides) * current;
            track.style.transform = `translateX(-${shift}%)`;
            resetProgress();
        }

        function nextSlide() {
            let next = current + 1;
            if (next >= totalSlides) next = 0;
            goTo(next);
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(nextSlide, interval);
            resetProgress();
        }

        function stopAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
        }

        function restartAutoplay() {
            stopAutoplay();
            startAutoplay();
        }

        function resetProgress() {
            const bars = dotsWrap.querySelectorAll(".progress");
            bars.forEach((bar, idx) => {
                bar.style.transition = "none";
                bar.style.width = idx < current ? "100%" : "0"; // prev full
            });

            setTimeout(() => {
                const activeBar = dotsWrap.querySelectorAll(".progress")[current];
                activeBar.style.transition = `width ${interval}ms linear`;
                activeBar.style.width = "100%";
            }, 50);
        }

        window.addEventListener("resize", () => {
            setup();
        });

        setup();
    });
</script>
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
  if (firstVilla) startAutoSlide(firstVilla.id.replace("facility-",""));
}); 








  document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('[data-villa]');
    const galleries = document.querySelectorAll('.gallery-wrapper');

    // toggle gallery berdasarkan tombol
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        galleries.forEach(g => g.classList.add('d-none'));
        document.getElementById('gallery-' + btn.dataset.villa).classList.remove('d-none');
      });
    });

    // aktifkan GLightbox
    GLightbox({
      selector: '.glightbox',
      touchNavigation: true,
      loop: true,
      closeButton: true,
      autoplayVideos: false
    });
  });





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




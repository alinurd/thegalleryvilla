 document.addEventListener("DOMContentLoaded", () => {
            const carousel = document.getElementById('heroCarousel');
            const progressBars = document.querySelectorAll('.progress-fill');
            const titles = document.querySelectorAll('.carousel-title');
            let currentProgress = 0;
            let progressInterval;

            // Fungsi untuk reset semua progress bars
            function resetAllProgress() {
                progressBars.forEach(bar => {
                    bar.style.width = '0%';
                    bar.classList.remove('active', 'paused');
                    bar.style.animation = 'none';
                });
            }

            // Fungsi untuk reset semua titles
            function resetAllTitles() {
                titles.forEach(title => {
                    title.classList.remove('active');
                });
            }

            // Fungsi untuk memulai progress bar
            function startProgress(slideIndex) {
                resetAllProgress();
                resetAllTitles();
                
                if (progressBars[slideIndex]) {
                    progressBars[slideIndex].style.animation = 'progress 5s linear forwards';
                    progressBars[slideIndex].classList.add('active');
                }
                
                if (titles[slideIndex]) {
                    titles[slideIndex].classList.add('active');
                    
                    // Reset dan mulai ulang animasi ketik
                    const typingElement = titles[slideIndex].querySelector('.typing-animation');
                    if (typingElement) {
                        typingElement.style.animation = 'none';
                        setTimeout(() => {
                            typingElement.style.animation = 'typing 2s steps(20, end), blink-caret 0.75s step-end infinite';
                        }, 100);
                    }
                }
            } 
            startProgress(0);

            // Saat slide akan berganti
            carousel.addEventListener('slide.bs.carousel', function (event) {
                const currentImage = event.from !== undefined 
                    ? carousel.querySelectorAll('.carousel-item')[event.from].querySelector("img") 
                    : null;
                const nextImage = event.relatedTarget.querySelector("img");
                const nextIndex = Array.from(carousel.querySelectorAll('.carousel-item')).indexOf(event.relatedTarget);

                if (currentImage) {
                    // animasi fadeOut gambar lama
                    gsap.to(currentImage, {
                        opacity: 0,
                        scale: 0.95,
                        duration: 0.8,
                        ease: "power2.inOut"
                    });
                }

                // animasi fadeIn + zoomOut gambar baru
                gsap.fromTo(nextImage,
                    { opacity: 0, scale: 1.1 },
                    { opacity: 1, scale: 1, duration: 1.2, ease: "power3.out" }
                );

                 startProgress(nextIndex);
            });
 
            carousel.addEventListener('mouseenter', () => {
                progressBars.forEach(bar => {
                    if (bar.classList.contains('active')) {
                        bar.style.animationPlayState = 'paused';
                    }
                });
            });
 
            carousel.addEventListener('mouseleave', () => {
                progressBars.forEach(bar => {
                    if (bar.classList.contains('active')) {
                        bar.style.animationPlayState = 'running';
                    }
                });
            });

             document.querySelectorAll('.progress-bar').forEach((bar, index) => {
                bar.addEventListener('click', () => {
                    carouselInstance.to(index);
                });
            });
             
            progressBars.forEach((bar, index) => {
                bar.addEventListener('click', () => {
                    const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                    carouselInstance.to(index);
                });
            });
        });

        

//header 
document.addEventListener("scroll", function() {
    const navbar = document.querySelector(".main-navbar");
    const body = document.body;
    const triggerHeight = document.querySelector(".topbar").offsetHeight + document.querySelector(".logo").offsetHeight;

    if (window.scrollY > triggerHeight) {
        if(!navbar.classList.contains("fixed")){
            navbar.classList.add("fixed");
            body.classList.add("has-fixed-navbar");
        }
    } else {
        if(navbar.classList.contains("fixed")){
            navbar.classList.remove("fixed");
            body.classList.remove("has-fixed-navbar");
        }
    }
}); 

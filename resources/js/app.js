import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

let lastScrollTop = 0;
const nav = document.querySelector('.navigation');
const secondNav = document.querySelector('.second-nav');

window.addEventListener('scroll', function () {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        nav.style.transform = 'translateY(-100%)';
        secondNav.style.transform = 'translateY(-100%)';
    } else {
        nav.style.transform = 'translateY(0)';
        secondNav.style.transform = 'translateY(0)';
    }

    lastScrollTop = Math.max(0, currentScroll);
});

// Logo Fade-In and Transition Animation on Page Load
window.onload = function () {
    const logo = document.getElementById('logo');

    if (logo) {
        let isLogo1 = true;

        setInterval(() => {
            logo.style.opacity = 0; // Fade out

            setTimeout(() => {
                logo.src = isLogo1 ? '/storage/logo2.png' : '/storage/logo.png';
                isLogo1 = !isLogo1;

                logo.style.opacity = 1; 
            }, 500); 
        }, 2500);
    } else {
        console.warn("Logo not found.");
    }

    // Trigger Scroll Animations Immediately
    handleScroll();
};

// Function to detect if an element is in the viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top < window.innerHeight * 0.9 && rect.bottom > 0
    );
}

// Function to handle scroll animations
function handleScroll() {
    document.querySelectorAll('.features-container, .best-sellers-title, .products, .about-bakery, .section-about, .footer')
        .forEach(section => {
            if (isInViewport(section)) {
                section.classList.add('fade-in');
            }
        });
}

// Event listener for scroll event
window.addEventListener('scroll', handleScroll);

// Trigger on page load to ensure animations start immediately
handleScroll();

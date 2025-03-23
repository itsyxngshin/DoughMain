import './bootstrap';

let lastScrollTop = 0;
const nav = document.querySelector('.navigation');
const secondNav = document.querySelector('.second-nav');

window.addEventListener('scroll', function() {
  let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop) {
    nav.style.transform = 'translateY(-100%)';
    secondNav.style.transform = 'translateY(-100%)';
  } else {
    nav.style.transform = 'translateY(0)';
    secondNav.style.transform = 'translateY(0)';
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

window.onload = function() {
  const logo = document.getElementById('logo');
  
  if (logo) {
    let isLogo1 = true; // Flag to keep track of which logo is currently displayed.

    setInterval(function() {
      // Fade out the current logo
      logo.style.opacity = 0;

      // After 1 second (fade-out duration), change the logo image
      setTimeout(function() {
        if (isLogo1) {
          logo.src = '/storage/logo2.png'; // Change to logo2
        } else {
          logo.src = '/storage/logo.png'; // Change back to logo1
        }
        
        // Toggle the logo flag
        isLogo1 = !isLogo1;

        // Fade in the new logo
        logo.style.opacity = 1;
      }, 2000); // Wait for the fade-out to complete before changing the image
    }, 2000); // Change the logo every 2.5 seconds
  } else {
    console.log("Logo not found.");
  }
};

// Function to detect if an element is in the viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }
  
  // Function to trigger fade-in animation on scroll
  function handleScroll() {
    const sections = document.querySelectorAll('.features-container, .best-sellers-title, .products, .about-bakery, .section-about, .footer');
    
    sections.forEach(section => {
      if (isInViewport(section) && !section.classList.contains('fade-in')) {
        // Add the fade-in class to trigger animation
        section.classList.add('fade-in');
      }
    });
  }
  
  // Event listener for scroll event
  window.addEventListener('scroll', handleScroll);
  
  // Trigger on page load to ensure animations are checked immediately
  handleScroll();
  

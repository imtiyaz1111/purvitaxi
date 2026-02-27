var swiper = new Swiper(".testimonialSwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      992: {
        slidesPerView: 3
      }
    }
  });



document.addEventListener("DOMContentLoaded", function () {

    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll(".navbar-nav .nav-link");

    menuItems.forEach(link => {
        if(link.getAttribute("href") === currentLocation){
            link.classList.add("active");

            // If inside dropdown, activate parent
            const parentDropdown = link.closest(".dropdown");
            if(parentDropdown){
                parentDropdown.querySelector(".nav-link").classList.add("active");
            }
        }
    });

});


const scrollTopBtn = document.getElementById("scrollTopBtn");

  // Show button after scrolling 300px
  window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
      scrollTopBtn.classList.add("show");
    } else {
      scrollTopBtn.classList.remove("show");
    }
  });

  // Smooth scroll to top
  scrollTopBtn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });


  });



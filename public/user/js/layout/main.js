(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Courses carousel
    $(".courses-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        loop: true,
        dots: false,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Team carousel
    if ($(".team-carousel .team-item").length <= 2) {
        // Tắt Owl và dùng flex khi không đủ số lượng
        $(".team-carousel").addClass("d-flex justify-content-center gap-3");
    } else {
        // Bật Owl khi đủ số lượng
        let $carousel = $(".team-carousel").owlCarousel({
            autoplay: true,
            smartSpeed: 1000,
            margin: 30,
            dots: false,
            loop: $(".team-carousel .team-item").length > 3,
            nav: $(".team-carousel .team-item").length > 3,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                576: { items: 1 },
                768: { items: 2 },
                992: { items: 3 }
            }
        });

        // Khi hover vào thì dừng
        $carousel.on('mouseenter', function () {
            $carousel.trigger('stop.owl.autoplay');
        });

        // Khi rời chuột thì chạy tiếp
        $carousel.on('mouseleave', function () {
            $carousel.trigger('play.owl.autoplay');
        });
    }


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
    });


    // Related carousel
    $(".related-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 30,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            }
        }
    });
    
})(jQuery);

document.addEventListener('DOMContentLoaded', function () {
    const userDropdown = document.querySelector('.user-profile-dropdown');
    const dropdownMenu = userDropdown.querySelector('.dropdown-menu');

    userDropdown.addEventListener('click', function (e) {
        dropdownMenu.classList.toggle('show');
        e.stopPropagation();
    });

    document.addEventListener('click', function () {
        dropdownMenu.classList.remove('show');
    });
});


function updateDateTime() {
    const now = new Date();
  
    const days = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
    const dayName = days[now.getDay()];
    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const year = now.getFullYear();
  
    const hour = String(now.getHours()).padStart(2, '0');
    const minute = String(now.getMinutes()).padStart(2, '0');
  
    const formatted = `${dayName}, ${day}/${month}/${year}, ${hour}:${minute}`;
    document.getElementById('datetime').textContent = formatted;
  }
  
  // Gọi lần đầu
  updateDateTime();
  
  // Cập nhật đúng đầu phút
  const now = new Date();
  const msToNextMinute = (60 - now.getSeconds()) * 1000;
  setTimeout(() => {
    updateDateTime();
    setInterval(updateDateTime, 60000);
  }, msToNextMinute);


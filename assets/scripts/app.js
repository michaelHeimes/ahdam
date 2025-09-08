/**
 * Required
 */
 
 //@prepros-prepend vendor/foundation/js/plugins/foundation.core.js

/**
 * Optional Plugins
 * Remove * to enable any plugins you want to use
 */
 
 // What Input
 //@*prepros-prepend vendor/whatinput.js
 
 // Foundation Utilities
 // https://get.foundation/sites/docs/javascript-utilities.html
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.box.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.imageLoader.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.keyboard.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.mediaQuery.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.motion.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.nest.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.timer.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.touch.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.triggers.min.js


// JS Form Validation
//@*prepros-prepend vendor/foundation/js/plugins/foundation.abide.js

// Tabs UI
//@prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// Accordian
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

// Menu enhancements
//@prepros-prepend vendor/foundation/js/plugins/foundation.drilldown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdownMenu.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.responsiveMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveToggle.js

// Equalize heights
//@*prepros-prepend vendor/foundation/js/plugins/foundation.equalizer.js

// Responsive Images
//@*prepros-prepend vendor/foundation/js/plugins/foundation.interchange.js

// Anchor Link Scrolling
//@prepros-prepend vendor/foundation/js/plugins/foundation.smoothScroll.js

// Navigation Widget
//@prepros-prepend vendor/foundation/js/plugins/foundation.magellan.js

// Offcanvas Naviagtion Option
//@prepros-prepend vendor/foundation/js/plugins/foundation.offcanvas.js

// Carousel (don't ever use)
//@*prepros-prepend vendor/foundation/js/plugins/foundation.orbit.js

// Modals
//@prepros-prepend vendor/foundation/js/plugins/foundation.reveal.js

// Form UI element
//@*prepros-prepend vendor/foundation/js/plugins/foundation.slider.js



// Sticky Elements
//@prepros-prepend vendor/foundation/js/plugins/foundation.sticky.js

// On/Off UI Switching
//@*prepros-prepend vendor/foundation/js/plugins/foundation.toggler.js

// Tooltips
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tooltip.js

// What Input
//@prepros-prepend vendor/what-input.js

// Swiper
//@prepros-prepend vendor/swiper-bundle.js

// DOM Ready
(function($) {
	'use strict';
    
    var _app = window._app || {};
    
    _app.foundation_init = function() {
        $(document).foundation();
    }
        
    _app.emptyParentLinks = function() {
            
        $('.menu li a[href="#"]').click(function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;
        });	
        
    };
    
    _app.fixed_nav_hack = function() {
        $('.off-canvas').on('opened.zf.offCanvas', function() {
            $('header.site-header').addClass('off-canvas-content is-open-right has-transition-push');		
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').addClass('clicked');	
        });
        
        $('.off-canvas').on('close.zf.offCanvas', function() {
            $('header.site-header').removeClass('off-canvas-content is-open-right has-transition-push');
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
        });
        
        $(window).on('resize', function() {
            if ($(window).width() > 1023) {
                $('.off-canvas').foundation('close');
                $('header.site-header').removeClass('off-canvas-content has-transition-push');
                $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
            }
        });    
    }
    
    _app.display_on_load = function() {
        $('.display-on-load').css('visibility', 'visible');
    }
    
    _app.scroll_to_anchor = function() {
        
        const offset = 180;
        
        const hash = window.location.hash;
        if (hash) {
            const target = document.querySelector(hash);
            if (target) {
                const offset = 180;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
        
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }
        
        // Smooth scroll on hash link clicks
        document.querySelectorAll('a[href*="#"]:not([href="#"])').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.hash.slice(1);
                const target = document.getElementById(targetId);
          
             if (target) {
                    e.preventDefault();
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
            
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
            
                    history.pushState(null, null, `#${targetId}`);
                }
            });
        });
        
    }
    
    _app.equal_width = function() {
        
        function setEqualWidths() {
            document.querySelectorAll('[data-equal-width]').forEach(container => {
                const items = container.querySelectorAll('.equal-width');
                if (!items.length) return;
            
                // Reset first so shrinking works on resize
                items.forEach(item => {
                item.style.minWidth = '';
                });
            
                // Find max width
                let maxWidth = 0;
                items.forEach(item => {
                const itemWidth = item.offsetWidth;
                if (itemWidth > maxWidth) {
                    maxWidth = itemWidth;
                }
                });
            
                // Apply min-width
                items.forEach(item => {
                item.style.minWidth = `${maxWidth}px`;
                });
            });
        }
    
        // Debounce utility
        function debounce(fn, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => fn.apply(this, args), delay);
        };
        }
        
        setEqualWidths();
        
        window.addEventListener('resize', debounce(setEqualWidths, 150));

    }
    
    _app.nm_banner_slider = function() {
        const slider = document.querySelector('.nm-banner-slider');
        
        if( !slider ) return;
        
        const delay = slider.getAttribute('data-delay');
        
        // Initialize Swiper with fade effect
        const nonMemberSwiper = new Swiper(slider, {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: delay,
                disableOnInteraction: false,
            },
            speed: 600,
            loop: false,
            pagination: false,
            navigation: false
        });
    }
    
    _app.member_spotlight_slider = function() {
        const slider = document.querySelector('.member-spotlights .member-spotlight-slider');
        
        if( !slider ) return;
                
        // Initialize Swiper with fade effect
        const memberSwiper = new Swiper(slider, {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 600,
            loop: false,
            pagination: false,
            navigation: false
        });
        
        // Click .swiper-page to go to slide
        $(slider).find('.swiper-page').on('click', function() {
            const index = parseInt($(this).attr('data-slide'), 10);
            if (!isNaN(index)) {
                memberSwiper.slideTo(index);
            }
        });
        
        memberSwiper.on('slideChange', function () {
            const activeIndex = memberSwiper.realIndex;
            $(slider).find('.swiper-page').removeClass('active');
            $(slider).find('.swiper-page[data-slide="'+activeIndex+'"]').addClass('active');
        });
        
    }
    
    _app.partnerships_slider = function() {
        const slider = document.querySelector('.partnerships .partnerships-slider');
        
        if( !slider ) return;
        
        // Initialize Swiper with fade effect
        const memberSwiper = new Swiper(slider, {
            speed: 600,
            loop: false,
            pagination: false,
            navigation: false
        });

        // Click .swiper-page to go to slide
        $(slider).parent().parent().find('.swiper-page').on('click', function() {
            const index = parseInt($(this).attr('data-slide'), 10);
            if (!isNaN(index)) {
                memberSwiper.slideTo(index);
            }
        });
        
        memberSwiper.on('slideChange', function () {
            const activeIndex = memberSwiper.realIndex;
            $(slider).parent().parent().find('.swiper-page').removeClass('active');
            $(slider).parent().parent().find('.swiper-page[data-slide="'+activeIndex+'"]').addClass('active');
        });
        
    }
    
    _app.testimonials_slider = function() {
        const testimonialSlider = document.querySelector('.testimonials-slider');
        
        if( !testimonialSlider ) return;
        
        const testimonialSwiper = new Swiper(testimonialSlider, {
            loop: true,
            pagination: false,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
        
    }
    
    // Custom Functions
    
    _app.mobile_takover_nav = function() {
        const offCanvas = $('.off-canvas');
        $(offCanvas).fadeOut(0);
    
        const closeMobileNav = function() {
            $('a#menu-toggle').removeClass('clicked');
            $(offCanvas).fadeOut(200);
        }
    
        $(document).on('click', 'a#menu-toggle', function(){
            if ($(this).hasClass('clicked')) {
                closeMobileNav();
            } else {
                $(this).addClass('clicked');
                $(offCanvas).fadeIn(200);
            }
        });
    
        $(window).on('resize', function() {
            if ($(window).width() > 1023) {
                closeMobileNav();
            }
        });
    }
            
    _app.init = function() {
        
        // Standard Functions
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.fixed_nav_hack();
        _app.display_on_load();
        _app.scroll_to_anchor();
        // Custom Functions
        _app.mobile_takover_nav();
        _app.equal_width();
        _app.nm_banner_slider();
        _app.member_spotlight_slider();
        _app.partnerships_slider();
        _app.testimonials_slider();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);
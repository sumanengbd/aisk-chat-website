(function ($) {
    var ua = window.navigator.userAgent;
    var isIE = /MSIE|Trident/.test(ua);

    if ( !isIE ) {
        "use strict";
    }

    $('[data-toggle="tooltip"]').tooltip();

    /** Adobe typekit font */
    try{Typekit.load({ async: true });}catch(e){};

    /*** Sticky header */
    $(window).scroll(function(){
        if($("body").scrollTop() > 0 || $("html").scrollTop() > 0) {
            $(".header").addClass("stop");
            $(".header .noticebar").hide('.d-none');
        } else {
            $(".header").removeClass("stop");
            $(".header .noticebar").show(".d-block");
        }
    });

    /*** Sticky header */
    const body = document.body;
    const scrollUp = "scroll-up";
    const scrollDown = "scroll-down";
    let lastScroll = 100;

    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll <= 0) 
        {
            body.classList.remove(scrollUp);
            return;
        }

        if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) 
        {
            // down
            body.classList.remove(scrollUp);
            body.classList.add(scrollDown);
        } 
        else if ( currentScroll < lastScroll && body.classList.contains(scrollDown) ) 
        {
            // up
            body.classList.remove(scrollDown);
            body.classList.add(scrollUp);
        }

        lastScroll = currentScroll;
    });

    /*** Navbar Menu */
    $('.navbar-toggle').sidr({
        name: 'sidr-main',
        side: 'right',
        source: '#sidr',
        displace: false,
        renaming: false,
    });

    $('.navbar-toggle.in').on('click', function(e){
        e.preventDefault();
        $.sidr('close', 'sidr-main');
    });

    $(window).scroll(function(){
        if($("body").scrollTop() > 0 || $("html").scrollTop() > 0) {
            $.sidr('close', 'sidr-main');
        }
    });

    function goingClearMobileMenu() {
        var $nav = $(".navbar-mobile"),
            $back_btn = $nav.find(" > li.dropdown > ul.dropdown-menu").prepend("<li class='dropdown-back'><div class='control'>Back<span class='icon-arrow-right'></span></div></li>");

        // For Title
        $('.navbar-mobile li.dropdown > a').each(function(){
            $(this).siblings("ul").find("li.dropdown-back").prepend("<div class='title'><a>" + $(this).text() +"</a></div>");
        });

        // open sub-level
        $('.navbar-mobile li.dropdown > a .dropdown-toggle').on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();

            $(this).parent().parent().addClass("is-open");
            $(this).parents().find( '.navbar-mobile' ).addClass("is-parent");

            var header = $(this).parent().parent().find('ul.dropdown-menu').height(),
                gutter = $('.gc-mobile-nav');

            if ( gutter ) 
            {
                gutter.height(header);
            }
        });

        // go back
        $back_btn.on("click", ".dropdown-back", function(e) {
            e.stopPropagation();
            $(this)
            .parents(".is-open")
            .first()
            .removeClass("is-open");

            var header = $(this).parents(".is-parent").first().height();

            $(this)
            .parents(".is-parent")
            .first()
            .removeClass("is-parent");

            var gutter = $('.gc-mobile-nav');

            setTimeout(function() {
                if (gutter) {
                    gutter.height(header);
                } 
            }, 200);
        });
    }

    goingClearMobileMenu();

    /*** Header height = gutter height */
    function setGutterHeight(){
        var header = document.querySelector('.header'),
              gutter = document.querySelector('.header-gutter');
        if (gutter) {
            gutter.style.height = header.offsetHeight + 'px';
        }
    }
    window.onload = setGutterHeight;
    window.onresize = setGutterHeight;

    /*** ScrollDown */
    $('.scrollDown').click(function() {
        var currentSection = $('section:visible'); 
        var nextSection = currentSection.next('section');

        console.log(nextSection);

        if (nextSection.length) {
            var space = $(this).data('space');
            $('html, body').animate({
                scrollTop: nextSection.offset().top - space
            }, 1000, "easeInOutExpo");
        }
    });

    /*** Smooth scroll */
    $('.sscroll, .sscroll a').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                   scrollTop: target.offset().top - 60
                }, 1e3, "easeInOutExpo");

               return false;
            }
        }
    });

    // Animate benefit items on scroll
    function animateBenefitItems() {
        const items = document.querySelectorAll(".our-benefits__item .right_area");
        const viewHeight = window.innerHeight;

        items.forEach(item => {
            const rect = item.getBoundingClientRect();
            if (rect.top <= viewHeight * 0.8 && rect.bottom >= 0) {
                item.style.transform = "translateX(0%)";
                item.style.transition = "transform 1s ease";
            }
        });
    }
    
    document.addEventListener("DOMContentLoaded", () => {
        animateBenefitItems();
        window.addEventListener("scroll", animateBenefitItems);
    });


    /*** Image to SVG */
    $('img.svg').each(function(){
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        $.get(imgURL, function(data) {
            var $svg = $(data).find('svg');
    
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }

            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            $svg = $svg.removeAttr('xmlns:a');
            
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            $img.replaceWith($svg);
    
        }, 'xml');
    
    });

    /*** Get OS */
    var os = ['iphone', 'ipad', 'windows', 'mac', 'linux'];
    var match = navigator.appVersion.toLowerCase().match(new RegExp(os.join('|')));
    if (match) {
        $('body').addClass(match[0]);
    };

    /*** BrowserDetect */
    var BrowserDetect = {
        init: function () {
            this.browser = this.searchString(this.dataBrowser) || "Other";
            this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
        },
        searchString: function (data) {
            for (var i = 0; i < data.length; i++) {
                var dataString = data[i].string;
                this.versionSearchString = data[i].subString;

                if (dataString.indexOf(data[i].subString) !== -1) {
                    return data[i].identity;
                }
            }
        },
        searchVersion: function (dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index === -1) {
                return;
            }

            var rv = dataString.indexOf("rv:");
            if (this.versionSearchString === "Trident" && rv !== -1) {
                return parseFloat(dataString.substring(rv + 3));
            } else {
                return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
            }
        },

        dataBrowser: [
            {string: navigator.userAgent, subString: "Edge", identity: "MSEdge"},
            {string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
            {string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
            {string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
            {string: navigator.userAgent, subString: "Opera", identity: "Opera"},  
            {string: navigator.userAgent, subString: "OPR", identity: "Opera"},  

            {string: navigator.userAgent, subString: "Chrome", identity: "Chrome"}, 
            {string: navigator.userAgent, subString: "Safari", identity: "Safari"}       
        ]
    };
    
    BrowserDetect.init();
    document.body.classList.add( BrowserDetect.browser );

    /*** Cursor */
    const cursor = document.querySelector('#cursor');

    if ( cursor ) {
        
        const cursorCircle = cursor.querySelector('.cursor__circle');

        const mouse = { x: -100, y: -100 }; // mouse pointer's coordinates
        const pos = { x: 0, y: 0 }; // cursor's coordinates
        const speed = 0.4; // between 0 and 1

        const updateCoordinates = e => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        }

        window.addEventListener('mousemove', updateCoordinates);

        function getAngle(diffX, diffY) {
            return Math.atan2(diffY, diffX) * 180 / Math.PI;
        }

        function getSqueeze(diffX, diffY) {
            const distance = Math.sqrt(
                Math.pow(diffX, 2) + Math.pow(diffY, 2)
            );
            const maxSqueeze = 0.15;
            const accelerator = 1500;
            return Math.min(distance / accelerator, maxSqueeze);
        }

        const updateCursor = () => {
            const diffX = Math.round(mouse.x - pos.x);
            const diffY = Math.round(mouse.y - pos.y);

            pos.x += diffX * speed;
            pos.y += diffY * speed;

            const angle = getAngle(diffX, diffY);
            const squeeze = getSqueeze(diffX, diffY);

            const rotate = 'rotate(' + angle +'deg)';
            const translate = 'translate3d(' + pos.x + 'px ,' + pos.y + 'px, 0)';

            cursor.style.transform = translate;
        };

        function loop() {
            updateCursor();
            requestAnimationFrame(loop);
        }

        requestAnimationFrame(loop);

        const cursorModifiers = document.querySelectorAll('[cursor-class]');

        cursorModifiers.forEach(curosrModifier => {
            curosrModifier.addEventListener('mouseenter', function() {
                const className = this.getAttribute('cursor-class');
                cursor.classList.add(className);
            });

            curosrModifier.addEventListener('mouseleave', function() {
                const className = this.getAttribute('cursor-class');
                cursor.classList.remove(className);
            });
        });

        const anchorLinks = document.querySelectorAll('a[href], button');

        anchorLinks.forEach(curosrModifier => {
            curosrModifier.addEventListener('mouseenter', function() {
                const className = 'anchor';
                cursor.classList.add(className);
            });

            curosrModifier.addEventListener('mouseleave', function() {
                const className = 'anchor';
                cursor.classList.remove(className);
            });
        });
    }

    // /*** carouselTicker Slider */
    // $('.carouselTicker').each(function () {
    //     var $slider = $(this);
    //     var speed = $slider.data('speed');
    //     var direction = $slider.data('direction');

    //     $slider.carouselTicker({
    //         speed: speed,
    //         mode: 'vertical',
    //         direction: direction
    //     });
    // });

    /*** carouselTicker Slider */
    $('.carouselTicker').each(function () {
        var $slider = $(this);
        var speed = $slider.data('speed');
        var direction = $slider.data('direction');
        
        var isBanner = $slider.closest('.banner').length > 0;
        var mode = isBanner ? 'vertical' : 'horizontal';

        $slider.carouselTicker({
            mode: mode,
            speed: speed,
            direction: direction
        });
    });

}(jQuery));
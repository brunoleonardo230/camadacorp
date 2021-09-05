/*global jQuery */
/* Contents
// ------------------------------------------------>
1.  MENU SMOOTH SCROLL DWON PAGE
2.  LOADING SCREEEN
3.  SMOOTH SCROLL
4.  CHANGE HEADER STYLE
5.  NAVBAR
6.  SLIDER
7.  SEARCH BUTTON
8.  NAV_BAR ACTIVE CLASS
9.  TIMETABLE FILTER
10. VIDEO
11. COURSE SLIER
12. TRAINER SLIDER 
13. BLOG SLIDER
14. HOME NAV SMOOTH SCROLL
15. SCROLL TO TOP
16. ABOUT PROCESS BAR
17. TESTIMONIALS SLIDER
18. HEADER CLASS CHANGE
19. TIMETABLE
20. OVERLAY
21. CONTACT FORM
21. PROGRESS BAR
*/
(function($) {
    "use strict";
    /*---------------- MENU SMOOTH SCROLL DWON PAGE ------------------*/
    $(window).on('scroll', function() {
        headerStyle();
    });
    /*---------------- LOADING SCREEEN ------------------*/
    $(window).on('load', function() {
        handlePreloader();
    });
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(500).fadeOut(500);
        }
    }
	$('.carousel').carousel({
  		interval: 4000
	})
    /*---------------- SMOOTH SCROLL ------------------*/
    $("a[href^='#']").on("click", function(e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $("html, body").animate({
            "scrollTop": $target.offset().top - 90
        }, 1000, "swing");
    });
    /*---------------- CHANGE HEADER STYLE ------------------*/
    function headerStyle() {
        if ($('.main-header').length) {
            var topbarHeight = $('.header-top').innerHeight();
            var windowpos = $(window).scrollTop();
            if (windowpos >= topbarHeight) {
                $('.main-header').addClass('header-fixed');
            } else {
                $('.header-fixed').removeClass('main-header');
            }
        }
    }
    /*---------------- NAVBAR ------------------*/
    if (screen.width <= parseInt(767)) {
        $('.menu_btn').on('click', function(e) {
            $('.navbar-collapse').toggleClass('in');
            $('.navbar-collapse').toggleClass('slideInLeft');

            $('.icon-bar').toggleClass('cross');
        });
    }
    $(window).on('scroll', function(e) {
        var scroll = $(window).scrollTop();
        if (scroll > parseInt(100)) {
            $(".header-lower").css("background", "rgba(9, 9, 9, 0.90)");
        } else {
            $(".header-lower").css("background", "transparent");
        }
    })
    /*---------------- SLIDER ------------------*/
    var bannerslide = $('.banner-slide');
    bannerslide.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000 // 1000 = 1 second
    });

    bannerslide.on('translate.owl.carousel', function() {
        $('.slide-content h1').removeClass('fadeInLeft animated').hide();
        $('.slide-content img').removeClass('fadeInRight animated').hide();
        $('.slide-content p').removeClass('zoomIn animated').hide();
        $('.slide-content a.theme-btn').removeClass('fadeInLeft animated').hide();
        $('.slide-content a.theme-btn-alt').removeClass('fadeInRight animated').hide();
    });

    bannerslide.on('translated.owl.carousel', function() {
        $('.owl-item.active .slide-content h1').addClass('fadeInLeft animated').show();
        $('.owl-item.active .slide-content img').addClass('fadeInRight animated').show();
        $('.owl-item.active .slide-content p').addClass('zoomIn animated').show();
        $('.owl-item.active .slide-content a.theme-btn').addClass('fadeInLeft animated').show();
        $('.owl-item.active .slide-content a.theme-btn-alt').addClass('fadeInRight animated').show();
    });

    var dot = $('.banner-slide .owl-dot');
    dot.each(function() {
        var index = $(this).index();
        $(this).text(index + 1);
    });
    /*---------------- SEARCH BUTTON ------------------*/
    $('#search-btn').on('click', function(e) {
        $('.searc-form').fadeToggle(500);
    });
    /*---------------- BARND_SLDIIER ------------------*/
    var brandCaro = $('.our-barnd-caro');
    brandCaro.owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000, // 1000 = 1 second
        responsive: {
            0: {
                items: 1
            },
            360: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            1200: {
                items: 6
            }
        }
    });
    /*---------------- NAV_BAR ACTIVE CLASS ------------------*/
    var header = document.getElementById("onenav");
    var btns = header.getElementsByClassName("nav-link");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("current");
            current[0].className = current[0].className.replace(" current", "");
            this.className += " current";
        });
    }
    /*----------------TIMETABLE FILTER ------------------*/
    var $container = $('.projects-container');
    $('.filter-tabs .filter').on('click', function(e) {
        $('.filter-tabs .active').removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        return false;
    });
    /*---------------- VIDEO ------------------*/
    var $iframe = $('iframe'),
    $videoLink = $('.video-link'),
    playerTemplate = '<div class="player"><div class="player__video"><div class="video-filler"></div><button class="video-close">&times;</button><iframe class="video-iframe" src="{{iframevideo}}" frameborder="0" allowfullscreen></iframe></div><div/>';

    $videoLink.on('click', function(e) {
        var localTemplate = '',
            videoWidth = parseInt($(this).data('width')),
            videoHeight = parseInt($(this).data('height')),
            videoAspect = (videoHeight / videoWidth) * 100,
            // elements
            $player = null,
            $video = null,
            $close = null,
            $iframe = null;

        e.preventDefault();

        localTemplate = playerTemplate.replace('{{iframevideo}}', $(this).prop('href'));

        $player = $(localTemplate);

        $player
            .find('.video-filler')
            .css('padding-top', videoAspect + '%');

        $close = $player
            .find('.video-close')
            .on('click', function() {
                $(this).off().closest('.player').hide().remove();
            });

        $player.appendTo('body').addClass('js--show-video');
    });

    /*---------------- COURSE SLIER ------------------*/

    var owl = $('#slider1');
    owl.owlCarousel({
        loop: true,
        margin: 20,
        autoplayTimeout: 5000,
        smartSpeed: 450,
        dots: true,

        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            1025: {
                items: 3
            }
        }
    })
    /*---------------- TRAINER SLIDER ------------------*/
    var owl = $('#slider3');
    owl.owlCarousel({
        loop: true,
        margin: 20,
        autoplayTimeout: 5000,
        smartSpeed: 450,
        dots: true,

        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    /*---------------- BLOG SLIDER ------------------*/
    var owl = $('#slider2');
    owl.owlCarousel({
        loop: true,
        margin: 20,
        autoplayTimeout: 5000,
        smartSpeed: 450,
        dots: true,

        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    /*---------------- HOME NAV SMOOTH SCROLL ------------------*/
    $('.ToTop').on('click', function(e) {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        $('.nav-link').removeClass('current');
        $('.home').addClass('current');
        return false;
    });
    /*---------------- SCROLL TO TOP ------------------*/
    $('.scrollToTop').on('click', function(e) {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $(window).on('scroll', function(e) {
        if ($(this).scrollTop() > parseInt(100)) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    
    /*---------------- ABOUT PROCESS BAR ------------------*/
    $(".grow90").animate({
        width: "90%"
    }, 1200);
    $(".grow85").animate({
        width: "85%"
    }, 1200);

    $(".grow95").animate({
        width: "95%"
    }, 1200);

    $(".grow80").animate({
        width: "80%"
    }, 1200);
    /*---------------- TESTIMONIALS SLIDER ------------------*/
    var owl = $('#slider4');
    owl.owlCarousel({
        loop: true,
        margin: 20,
        autoplayTimeout: 5000,
        smartSpeed: 450,
        dots: true,

        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    /*---------------- HEADER CLASS CHANGE ------------------*/

    $(window).on('scroll', function(e) {
        var scroll = $(window).scrollTop();
        var header = $(".main-header");
        if (scroll >= parseInt(1)) {
            header.removeClass('jj_position_absolute').addClass("jj_position_absolute1");
        } else {
            header.removeClass("jj_position_absolute1").addClass('jj_position_absolute');
        }
    });
})(window.jQuery);

/*---------------- TIMETABLE ------------------*/
    filterSelection("all")

    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("text-content");
        if (c === "all") c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }
    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }
    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }
	
	
/*---------------- OVERLAY ------------------*/	
function openSearch() {
	document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
	document.getElementById("myOverlay").style.display = "none";
}


/*---------------Contact_Form--------------*/

$('#contactForm').submit(function() {
      var form = $(this);
      var formData = $(this).serialize();
     
      $.post('../mail.php', formData, function(data) {
        //form.find('.send_mes').val('');
        form.append('<div class="success-msg" style="color:#fff; font-weight:bold;">Mail Sent.</div>');
      }).fail(function() {
        //form.find('.required-field').val('');
        form.append('<div class="error-msg">Error occurred.</div>');
      });

      return false;

  });


/*---------------- PROGRESS BAR ------------------*/	
$('.progressbar1').progressBar({
		shadow : true,
		percentage : false,
		animation : true,
});
$('.progressbar2').progressBar({
	shadow : true,
	percentage : false,
	animation : true,
	barColor : "#527AF9",
});
$('.progressbarPhp').progressBar({
	shadow : true,
	percentage : false,
	animation : true,
	animateTarget : true,
	barColor : "#52ADF9",
});
$('.progressbarGit').progressBar({
	shadow : true,
	percentage : false,
	animation : true,
	barColor : "#52ADF9",
});
$('.progressbar3').progressBar({
	shadow : true,
	percentage : false,
	animation : true,
	animateTarget : true,
	barColor : "#C3B238",
});
$(".spinDown").click(function() {
	var target = $(this).data("target");
	var scrollFix = -80;
	target = "#" + target;
	$("html,body").animate({
		scrollTop : $(target).offset().top + scrollFix
	}, 1000);
	return false;
});
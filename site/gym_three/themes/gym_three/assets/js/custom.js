/*global jQuery */
/* Contents
// ------------------------------------------------>
1.  document is ready
2.  Scrollig
3.  Loader
4.  SMOOTH SCROLL
5.  CHANGE HEADER STYLE
6.  NAV_BAR ACTIVE CLASS
7.  TIMETABLE FILTER
8.  VIDEO
9.  GALLERY
10. TEAM SLIDER
11. BLOG SLIDER 
12. TESTIMONIALS SLIDER
13. SMOOTH SECTION SCROLL
14. HEADER STICKY
15. CLASSES FILTER
16. CONCTACT FORM
17. TIMETABLE FILTER
*/
(function($) {
  "use strict";
  /*----------------- document is ready -----------------*/
  headerStyle();
  
  /*----------------- Scrollig -----------------*/
  $(window).on('scroll', function() {
    headerStyle();
  });
  /*----------------- Loader -----------------*/
  $(window).on('load', function() {
    handlePreloader();
  });
  function handlePreloader() {
      if($('.preloader').length){
          $('.preloader').delay(500).fadeOut(500);
      }
  }
$('.carousel').carousel({
  interval: 4000
})
  /*----------------- SMOOTH SCROLL -----------------*/
  /*$("a[href^='#']").on("click", function(e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $("html, body").animate({
            "scrollTop": $target.offset().top - 90
        }, 1000, "swing");
  });*/
  /*----------------- CHANGE HEADER STYLE -----------------*/
  function headerStyle() {
    if($('.main-header').length){
        var topbarHeight = $('.header-top').innerHeight();
        var windowpos = $(window).scrollTop();
        if (windowpos >= topbarHeight) {
            $('.main-header').addClass('header-fixed');
        } else {
            $('.main-header').removeClass('header-fixed');
        }
    }
  }
  /*----------------- NAV_BAR ACTIVE CLASS -----------------*/
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
  /*----------------- VIDEO -----------------*/
  var $iframe = $('iframe'),
    $videoLink = $('.video-link'),
    playerTemplate = '<div class="player"><div class="player__video"><div class="video-filler"></div><button class="video-close">&times;</button><iframe class="video-iframe" src="{{iframevideo}}" frameborder="0" allowfullscreen></iframe></div><div/>';
  
  $videoLink.on('click', function(e) {
    var localTemplate = '',
        videoWidth = parseInt($(this).data('width')),
        videoHeight = parseInt($(this).data('height')),
        videoAspect = ( videoHeight / videoWidth ) * 100,
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
  /*----------------- GALLERY -----------------*/
  var owl = $('#slider2');
    owl.owlCarousel({
    loop:true,
    margin: 0,
    autoplayTimeout:5000,
    smartSpeed:450,
    dots:false,
    nav: false,
    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 4
      },
      1000: {
        items: 5
      }
    }
  })
  /*----------------- TEAM SLIDER -----------------*/
  var owl = $('#slider1');
    owl.owlCarousel({
    loop:true,
    margin: 20,
    autoplayTimeout:5000,
    smartSpeed:450,
    dots:true,
    nav: true,
    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
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
  /*----------------- BLOG SLIDER -----------------*/
  var owl = $('#slider3');
    owl.owlCarousel({
    loop:true,
    margin: 20,
    autoplayTimeout:5000,
    smartSpeed:450,
    dots:true,
    nav: true,
    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
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
  /*----------------- TESTIMONIALS SLIDER -----------------*/
  var owl = $('#slider5');
    owl.owlCarousel({
    loop:true,
    margin: 20,
    autoplayTimeout:5000,
    smartSpeed:450,
    dots:false,
    nav: true,
    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })
  /*----------------- SMOOTH SECTION SCROLL -----------------*/
  $('.ToTop').on('click', function(e) {
    $('html, body').animate({scrollTop : 0},800);
    $('.nav-link').removeClass('current');
    $('.home').addClass('current');
    return false;
  });
  
  $('.scrollToTop').on('click', function(e) {
    $('html, body').animate({scrollTop : 0},800);
    return false;
  });
  /*--------------- HEADER STICKY ---------------*/
  $(window).on('scroll', function(e) {
    if ($(this).scrollTop() > parseInt(15)) {
      $('.wrap_header').addClass('top_fix');
    }
    else {
      $('.wrap_header').removeClass('top_fix');
    }

    if ($(this).scrollTop() > parseInt(100)) {
      $('.scrollToTop').fadeIn();
    } else {
      $('.scrollToTop').fadeOut();
    }
  });
  
  /*--------------- CLASSES FILTER ---------------*/
  $(function() {
    var selectedClass = "";
    $(".fil-cat").on('click', function(e) {
      selectedClass = $(this).attr("data-rel"); 
      $("#portfolio").fadeTo(100, 0.1);
      $("#portfolio div").not("."+selectedClass).fadeOut().removeClass('scale-anm');
      setTimeout(function() {
        $("."+selectedClass).fadeIn().addClass('scale-anm');
        $("#portfolio").fadeTo(300, 1);
      }, 300); 
    });
  });

  $(window).load(function(){
  var $container = $('.portfolioContainer');
  $container.isotope({
    filter: '*',
    animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false
    }
  });

  $('.portfolioFilter a').on('click', function(e) {
    $('.portfolioFilter .current').removeClass('current');
    $(this).addClass('current');
    var selector = $(this).attr('data-filter');
    $container.isotope({
      filter: selector,
      animationOptions: {
        duration: 750,
        easing: 'linear',
        queue: false
      }
     });
     return false;
    }); 
  });

})(window.jQuery);

/*--------------- TIMETABLE FILTER ---------------*/
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
      if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
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
  
  var $container = $('.projects-container');
    $('.filter-tabs .filter').on('click', function(e) {
        $('.filter-tabs .active').removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        return false;
    });
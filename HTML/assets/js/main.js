/******** Header on Scroll *******/

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = jQuery('.have-scroll').outerHeight();

jQuery(window).scroll(function(event) {
  didScroll = true;
});

function hasScrolled() {
  var st = jQuery(this).scrollTop();

  // Make sure they scroll more than delta
  if (Math.abs(lastScrollTop - st) <= delta)
    return;

  // If they scrolled down and are past the navbar, add class .nav-up.
  // This is necessary so you never see what is "behind" the navbar.
  if (st > lastScrollTop && st > navbarHeight) {
    // Scroll Down
    //jQuery('.have-scroll').removeClass('header-scroll-fixed').addClass('header-scroll-up');
    jQuery('.have-scroll').addClass('header-scroll-fixed');
  } else {
    // Scroll Up 
    if (st + jQuery(window).height() < jQuery(document).height()) {
      //jQuery('.have-scroll').removeClass('nav-up').addClass('header-scroll-fixed');
      jQuery('.have-scroll').addClass('header-scroll-fixed');
    }
  }

  if (st < 50) {
    jQuery('.have-scroll').removeClass('header-scroll-fixed').removeClass('header-scroll-up').removeClass('header-scroll-alltime');
  }

  //if (st > 350) {
    //jQuery('.sticky-header-alltime').addClass('header-scroll-alltime');
  //}

  lastScrollTop = st;
}


jQuery(document).ready(function($) {
  "use strict";


  /* ---------------------------------------------
     Scroll navigation For One Page Web
     --------------------------------------------- */

  function init_scroll_navigate() {

    $(".local-scroll").localScroll({
      target: "body",
      duration: 1500,
      offset: -100,
      easing: "easeInOutExpo"
    });

    var sections = $(".full-width-row-bg");
    var menu_links = $(".scroll-nav li a");

    $(window).scroll(function() {

      sections.filter(":in-viewport:first").each(function() {
        var active_section = $(this);
        var active_link = $('.sf-menu li [href="#' + active_section.attr("id") + '"]');
        menu_links.removeClass("current");
        active_link.addClass("current");
      });

    });

  }
  init_scroll_navigate();
  /*=================================================
  1 - Nav Menu
  =================================================*/

  jQuery('ul.sf-menu').superfish({
    animation: {
      height: 'show'
    }, // slide-down effect without fade-in

  });

  jQuery("#mobnav-btn").on('click', function() {
    jQuery(".sf-menu").slideToggle("slow");
  });
 
  if(window.innerWidth <= 769 ) {  
    jQuery(".sf-menu a").on('click', function() {
      jQuery(".sf-menu").slideToggle("slow");
    });
  } 

  jQuery('.mobnav-subarrow').on('click', function() {
    jQuery(this).parent().toggleClass("xpopdrop");
  });

  jQuery("#search-label").on('click', function() {
    jQuery(".search-bar").slideToggle("slow");
  });

  jQuery('.nav-button, .overlay-content-wrap').on('click', function() {
    jQuery('.nav-button').toggleClass("active");
    jQuery('.menu-content').toggleClass("active-menu");
    jQuery('.overlay-content-wrap').toggleClass("overlay-active");
    jQuery('body').toggleClass("overflow-hidden-header-three");
  });

  setInterval(function() {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  /*=================================================
  2 - isotope
  =================================================*/


  /*=================================================
  3 - OWl Slide 
  =================================================*/

  var owl = jQuery("#owl-single-port");

  owl.owlCarousel({
    navigation: false, // Show next and prev buttons
    slideSpeed: 1000,
    autoPlay: 10000,
    paginationSpeed: 2000,
    singleItem: true,
    pagination: false,
  });

  // Custom Navigation Events
  jQuery(".next").click(function() {
    owl.trigger('owl.next');
  })
  jQuery(".prev").click(function() {
    owl.trigger('owl.prev');
  })


  /*=================================================
  4 - Colorbox lightbox
  =================================================*/

  //masonry-portfolios of how to assign the Colorbox event to elements
  jQuery(".colorlightbox").colorbox({
    rel: 'colorlightbox',
    opacity: 0.92,
    scalePhotos: true,
    maxHeight: "90%",
    maxWidth: "90%",
    title: function() {
      var url = jQuery(this).attr("attachment-link");
      var title = jQuery(this).attr("title");
      var attachment_page = '<span id="image-info"><a href="' + url + '" title="Download This Image"><i class="icon-info-sign"></i> More Info & Comments</a></span>';
      if (url == undefined) {
        return '<span id="cboxTitleLeft">' + title + '</span>';
      } else {
        return '<span id="cboxTitleLeft">' + title + '</span>' + attachment_page;
      }
    }
  });

  // Make ColorBox responsive
  jQuery.colorbox.settings.maxWidth = '95%';
  jQuery.colorbox.settings.maxHeight = '95%';

  // ColorBox resize function
  var resizeTimer;

  function resizeColorBox() {
    if (resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      if (jQuery('#cboxOverlay').is(':visible')) {
        jQuery.colorbox.load(true);
      }
    }, 300);
  }

  // Resize ColorBox when resizing window or changing mobile device orientation
  jQuery(window).resize(resizeColorBox);
  window.addEventListener("orientationchange", resizeColorBox, false);

  /*=================================================
  5 - FitVids.js
  =================================================*/

  // Target your .container, .wrapper, .post, etc.
  jQuery(".fit").fitVids();

  /*=================================================
  6 - Animate  on scroll 
  =================================================*/

  var wow = new WOW({
    boxClass: 'wow', // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset: 50, // distance to the element when triggering the animation (default is 0) 
    mobile: false
  });
  wow.init();

  /*=================================================
  9 - Full with bg
  =================================================*/

  var viewportWidth = jQuery(window).width();
  var colWidth = jQuery(".container").width();
  var viewportHeight = jQuery(window).height();
  var divideval = 2;
  var marginslidebg = (viewportWidth - colWidth) / divideval;

  jQuery(".full-width-row-bg").css({
    "width": viewportWidth,
    "max-width": viewportWidth,
    "margin-left": "-" + marginslidebg + "px",
    "padding-left": marginslidebg + "px",
    "padding-right": marginslidebg + "px"
  });

  jQuery(window).resize(function() {

    var viewportWidth = jQuery(window).width();
    var colWidth = jQuery(".container").width();
    var viewportHeight = jQuery(window).height();
    var divideval = 2;
    var marginslidebg = (viewportWidth - colWidth) / divideval;

    jQuery(".full-width-row-bg").css({
      "width": viewportWidth,
      "max-width": viewportWidth,
      "margin-left": "-" + marginslidebg + "px",
      "padding-left": marginslidebg + "px",
      "padding-right": marginslidebg + "px"
    });
  });


}(jQuery));

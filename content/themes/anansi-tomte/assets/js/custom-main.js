
// Isotope for Masonry Portfolio
 var $mp_container = jQuery('.masonry-portfolio');
 $mp_container.isotope({
  filter: '*',
  animationOptions: {
  duration: 750,
  easing: 'linear',
  queue: false
  },
  layoutMode: 'masonry'
 });

  jQuery('.m-port-filter li a').click(function(){
    jQuery('.m-port-filter li').removeClass('active');
    jQuery(this).parent().addClass('active');
    var selector = jQuery(this).attr('data-filter');
    $mp_container.isotope({
      filter: selector,
      animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false
      },
      layoutMode: 'masonry'
    });
      return false;
  });


jQuery(window).load(function() {
  "use strict";
  
  $mp_container.isotope('reLayout');
   
});

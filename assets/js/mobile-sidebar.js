(function($) {
  'use strict';
  
  $(function() {
    var body = $('body');
    var sidebar = $('.sidebar');
    var overlay = $('.sidebar-overlay');
    
    // Create overlay element if not exists
    if (!$('.sidebar-overlay').length) {
      $('body').append('<div class="sidebar-overlay"></div>');
      overlay = $('.sidebar-overlay');
    }
    
    // Toggle sidebar on mobile
    $('[data-toggle="offcanvas"]').on('click', function() {
      body.toggleClass('sidebar-open');
      sidebar.toggleClass('toggled');
      overlay.toggleClass('show');
    });
    
    // Close sidebar when clicking overlay
    overlay.on('click', function() {
      body.removeClass('sidebar-open');
      sidebar.removeClass('toggled');
      overlay.removeClass('show');
    });
    
    // Close sidebar when clicking a nav link
    $('.sidebar .nav-link').on('click', function() {
      if ($(window).width() < 992) {
        body.removeClass('sidebar-open');
        sidebar.removeClass('toggled');
        overlay.removeClass('show');
      }
    });
    
    // Close sidebar on window resize
    $(window).on('resize', function() {
      if ($(window).width() >= 992) {
        body.removeClass('sidebar-open');
        sidebar.removeClass('toggled');
        overlay.removeClass('show');
      }
    });
  });
})(jQuery);
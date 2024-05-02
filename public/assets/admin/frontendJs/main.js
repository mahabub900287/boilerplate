(function ($) {
  ("use strict");

  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').css({ bottom: '20px' });
    } else {
      $('.back-to-top').css({ bottom: '-100px' });
    }
  });


  // loader

  $(window).on("load", function () {
    $(".ic-loading").fadeOut(500);
  });

  /**Mobile menu activation**/

  $(".ic-mobile-menu-open,.ic-mobile-menu-overlay").on("click", function () {
    $(".ic-mobile-menu-warper,.ic-mobile-menu-overlay").addClass("active");
  });
  $(".ic-menu-close,.ic-mobile-menu-overlay").on("click", function () {
    $(".ic-mobile-menu-warper,.ic-mobile-menu-overlay").removeClass("active");
  });

  $(".ic-dropdown-toggle").click(function () {
    $(this).children('.ic-dropdown-menu').toggleClass("mobile_menu_active");
  });

 

})(jQuery);
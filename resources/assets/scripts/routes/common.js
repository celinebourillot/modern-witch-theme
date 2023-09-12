export default {
  init() {
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 1;
    var navbarHeight = $('.navbar').outerHeight();

    $(window).scroll(function(){
        didScroll = true;
        
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(document).scrollTop();

        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;
        
        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            $('.navbar').addClass('nav-up');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('.navbar').removeClass('nav-up');
            }
        }
        
        lastScrollTop = st;
    }

    //ACCORDION
     $(function () {
      $('.js-accordion').accordion();
    });

  
    //MOBILE MENU
    $('.navbar-burger').click(function() {
      $('.nav-mobile').show(1000);
      $('body').addClass('body-lock');
    });

    $('.close-btn').click(function() {
      $('.nav-mobile').hide(1000);
      $('body').removeClass('body-lock');
    });

    //MODAL

    $('.newsletter-heart').click(function(){
      $('.modal--newsletter').fadeIn(1000);
      $('body').addClass('body-lock');
    });

    $('.btn--login').click(function(){
      $('.modal--login').fadeIn(1000);
      $('body').addClass('body-lock');
    });

    $('.btn--close').click(function(){
      $('.modal--newsletter').fadeOut(1000);
      $('.modal--login').fadeOut(1000);
      $('.nav-mobile').fadeOut(1000);
      $('body').removeClass('body-lock');
    });

    //NAV SUBMENUS

    $(function($) {
      $('.nav-mobile .menu-item-has-children').children('a').attr('href', 'javascript:void(0)');
    });

    $('.nav-mobile .menu-item-has-children').click(function(){
      $(this).children( '.sub-menu' ).toggle();
    });

    /*Scroll to top when arrow up clicked END*/
    $(window).scroll(function(){
      if ($(this).scrollTop() > 50) {
          $('.navbar').addClass('dark-bg');
    
      } else {
          $('.navbar').removeClass('dark-bg');
    
      }
    });
    
  },
  finalize() {
  },
};

//AJAX SEARCH 

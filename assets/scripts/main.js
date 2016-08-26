/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {

  /**
   * Defer Global Function
   */
  function defer(method) {
    if (window.jQuery) {
      method();
    } else {
      setTimeout(function () {
        defer(method);
      }, 50);
    }
  }

  /**
   * Caching Global Selectors
   */
  var $window = $(window);
  var $document = $(document);

  // Use this variable to set up the base and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function () {
        // JavaScript to be fired on all pages

        // Automatic Footer Columns
        function footerColumns() {
          var footerCols = $('footer section');
          var footerColsNum = parseInt(footerCols.length);
          var columnWidth = (footerColsNum === '5') ? '15' : 12 / footerColsNum;
          footerCols.each(function () {
            $(this).addClass('col-md-' + columnWidth);
          });
        }

        footerColumns();

        // outerHTML function
        $.fn.outerHTML = function () {
          return (this[0]) ? this[0].outerHTML : '';
        };
      },
      finalize: function () {
        // JavaScript to be fired on all pages, after page specific JS is fired

        /**
         * Fixed Navbar
         */
        var $nav = $('.navbar');
        var navbarHeight = $nav.innerHeight();

        $nav.affix({
          offset: {
            top: navbarHeight
          }
        });


        // Back To Top
        var offset = 300,
          //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
          offset_opacity = 1200,
          //duration of the top scrolling animation (in ms)
          scroll_top_duration = 700,
          //grab the "back to top" link
          $back_to_top = $('.back-to-top');

        //hide or show the "back to top" link
        $window.scroll(function () {
          if ($(this).scrollTop() > offset) {
            $back_to_top.addClass('cd-is-visible');
          } else {
            $back_to_top.removeClass('cd-is-visible cd-fade-out');
          }
          if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('cd-fade-out');
          }
        });

        /**
         * Smooth scroll to top
         */
        $back_to_top.on('click', function (event) {
          event.preventDefault();
          $('body,html').animate({
              scrollTop: 0,
            }, scroll_top_duration
          );
        });

      }
    },
    // Home page
    'home': {
      init: function () {
        // JavaScript to be fired on the home page
      },
      finalize: function () {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function () {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function (func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function () {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

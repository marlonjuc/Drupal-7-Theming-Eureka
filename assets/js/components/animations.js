(function($){
  'use strict';

  var APP = window.APP = window.APP || {};

  APP.addAnimation = (function () {
    var init = function() {
        // Class added to animate thumbs on desktop
        //$("[data-animate]").addClass('start-animation');

        _sections = $("[data-animate]");

        onScroll();
    }

    var _sections,
        ticking = false;

    var onScroll = function onScroll() {
      requestTick();
    }

    /**
     * Calls rAF if it's not already
     * been done already
     */
    var requestTick = function requestTick() {
        if(!ticking && _sections.length>0) {
            requestAnimFrame(loopSections);
            ticking = true;
        }
    }

    var loopSections = function loopSections(){
      _sections.each(function() {
        var $t = $(this),
          $w = $(window),
          viewTop = $w.scrollTop(),
          viewBottom = viewTop + $w.height(),
          _top = $t.offset().top,
          _bottom = _top + $t.height();
        

        if ((_top <= viewBottom) && (_bottom >= viewTop)) {
          if (((viewBottom - _top) >= ($t.height() * .05)) || ((viewTop - _bottom) >= ($t.height() * .05))) {
            _sections = _sections.not($t);
            if (!$t.hasClass($t.attr("data-animate"))) {
              $t.addClass($t.attr("data-animate"));
            }
          }
          
        }
      });
      ticking = false;
    };

    return {
      init:init
    }


  }())


})(jQuery);

jQuery(function(){

  APP.addAnimation.init();

});

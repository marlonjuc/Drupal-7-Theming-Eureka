(function($){
    'use strict';

    var APP = window.APP = window.APP || {};

    APP.globalNav = (function () {

        var navMovementSpeed,
            $mobileNav,
            $mobileNavTrigger,
            $navMenu,
            $navSecondary,
            $navTertiary,
            $navFirstChild,
            $navSecondChild,
            $utilityNav,
            $body,
            $mobileSearch,
            $searchBox;



        var bindEventsToUI = function () {

            $mobileNavTrigger.on('click', function(){
                $(this).toggleClass('icon-icon-menu icon-icon-menu-open open',function(){
                    if($(this).hasClass('open')){
                        $body.addClass('noScroll');
                    }else{
                        $body.removeClass('noScroll');
                    }
                });
                $navMenu.toggle();
            });

            $navFirstChild.on('click mouseover', function(e){
                if(hasDeepLevels(this)){

                    var $this = $(this),
                        $primaryNavItem = $this.parent();

                    $navSecondary.removeClass('open');
                    $navFirstChild.removeClass('open');

                    $primaryNavItem.find('> a').addClass('open');
                    //Fixed issue on over event desktop-mobile version
                    if(!$body.hasClass('mobileBody')) {
                        $primaryNavItem.find('.nav__secondary').show().addClass('open');
                    }

                    if( is_touch_device() || (e.type === 'click' && $body.hasClass('mobileBody'))) {
                        $primaryNavItem.find('.nav__secondary').show().addClass('open');
                        showMobileSecoundNav($this, 'level2');
                    }

                    e.preventDefault();
                }
            });

            $navSecondary.on('mouseleave',function() {
                var $this = $(this);
                $this.parent().find('> a').removeClass('open');
                $this.removeClass('open');
            });


            $navSecondChild.on('click', function(e){
                if(hasDeepLevels(this)){
                    openTertiaryNav(this,e);
                    e.preventDefault();
                }
            });

            $navSecondChild.on('mouseenter', function(e){
                if(hasDeepLevels(this)){
                    if(!$body.hasClass('mobileBody')) {
                        openTertiaryNav(this,e);
                        e.preventDefault();
                    }
                }
            });

            $navSecondChild.parents('li').on('mouseleave',function(){
                $(this).parent().find('li').removeClass('hover');
                $navTertiary.removeClass('open');
                $navTertiary.find('li').removeClass('show');
            });


            $navSecondary.find('.nav__secondary_back').on('click', function(){
                $navMenu.removeClass('level2');
                setTimeout(function(){
                    $navSecondary.hide();
                }, navMovementSpeed);
            });

            $navTertiary.find('.nav__tertiary_back').on('click', function(){
                $navMenu.removeClass('level3').addClass('level2');
                setTimeout(function(){
                    $navTertiary.hide();
                }, navMovementSpeed);
            });

            //Global Navigation Block Brands Fuctionality
            $utilityNav.find('a.dropdown').on('click',function(){
                var $this = $(this);

                $this.parents('.utility-container').toggleClass('open',function(){
                    if($(this).hasClass('open')){
                        $this.addClass('turn-arrow');
                    }else{
                        $this.removeClass('turn-arrow');
                    }
                });
            });

            //Open mobile search
            $mobileSearch.on('click',function(e){
                e.preventDefault();
                $(this).toggleClass('open');
                $searchBox.toggleClass('open');
            });

            // Match media Query to detect the device or device screen size
            UTIL.media.on('md',function(){
                $body.removeClass('mobileBody');
                //Set Margin left only on desktop version
                setMarginleftSecondNav();
                //Remove all class and styles for mobile
                removeMobileAnimation();
            },function(){
                $body.addClass('mobileBody');
                // Will remove arrows icon from link into Nav when link doesn't has submenu or sublevel
                removeitemsArrows();
                //Fix issue on close mobile version on resize
                closeNavMobile();
                //Rest Margin left on Mobile
                $navSecondary.find(' > ul').attr('style','');
            });
            // Resize event to calculate positions on resize
            var resizeTimer;
            $(window).resize(function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function(){
                    //Set Margin left only on desktop version
                    if(!$body.hasClass('mobileBody')) {
                        setMarginleftSecondNav();
                    }
                }, 250);
            });

            menuBehaviourOnScroll();

        };

        var menuBehaviourOnScroll = function(){
            // Hide Header on scroll down
            var $header = $('.header'),
                $utility = $('.utility-container'),
                $window = $(window),
                _lastState = false,
                _scrollingAmount = $utility.height();

            var detectScrollPosition = function detectScrollPosition(){

                if( $window.scrollTop() > _scrollingAmount ){

                    if(_lastState) return true;

                    $header.addClass('page-scrolled-state');
                    $body.addClass('page-scrolled-state');
                    _lastState = 'page-scrolled-state';

                }else{

                    if(!_lastState) return true;

                    $header.removeClass('page-scrolled-state');
                    $body.removeClass('page-scrolled-state');
                    _lastState = false;

                }

            };

            $window.scroll( detectScrollPosition );
        };
        var openTertiaryNav = function(element,e){
            var $this = $(element),
                $tertiary = $this.parent().find('.nav__tertiary');

            $tertiary.show().addClass('open');

            if (is_touch_device()) {
                showMobileSecoundNav($this, 'level3');
            } else {
                $navTertiary.hide();
                $tertiary.show();
                $this.parent().addClass('hover');
            }
            e.preventDefault();
        };
        // Add margin to second nav  acording to the position of the first item of first nav
        var  setMarginleftSecondNav = function(){
            var leftPerimaryNav = $navMenu.find('li').eq(0).position().left;
            $navSecondary.find(' > ul').css('margin-left',leftPerimaryNav);
        };
        var  showMobileSecoundNav = function(element,level){
            element.parents('.nav__menu').addClass(level);
        };
        var removeMobileAnimation = function(){
            $navMenu.show().removeClass('level3 level2');
        };
        var hasDeepLevels = function(btn){
            var subMenu = $(btn).parent().find('.nav__submenu');
            if(subMenu.length > 0 && subMenu.find('li').length > 1){
                return true;
            }else{
                return false;
            }
        };

        var is_touch_device = function() {
            return 'ontouchstart' in window        // works on most browsers
                || navigator.maxTouchPoints;
        };
        // Will remove arrows icon from link into Nav when link doesn't has submenu or sublevel
        var removeitemsArrows = function(){
            var itemsNav = $navMenu.find('li');
            itemsNav.each(function(){
                var link = $(this).find('a');
                if(!hasDeepLevels(link)){
                    link.addClass('no-levels');
                }

            });
        };

        var _updateProductsCount = function(count){
            $utilityNav.find('.count').html(count);
        };

        var closeNavMobile = function(){
            if(!$mobileNavTrigger.hasClass('open')) {
                $body.removeClass('noScroll');
                $mobileNavTrigger.removeClass('icon-icon-menu-open open').addClass('icon-icon-menu');
                $navMenu.hide();
            }
        };

        var init = function () {
                //call variables when DOM is ready
                navMovementSpeed  = 300,
                $mobileNav        = $('.mobileNav'),
                $mobileNavTrigger = $('.mobileNav__trigger'),
                $navMenu          = $('.nav__menu'),
                $navSecondary     = $('.nav__secondary'),
                $navTertiary      = $('.nav__tertiary'),
                $navFirstChild    = $('.nav__menu a.dropdown'),
                $navSecondChild   = $('.nav__menu .child__lvl1 > a'),
                $utilityNav       = $('.utility-container'),
                $body             = $('body'),
                $mobileSearch     = $('.mobileNav__search'),
                $searchBox        = $('.searchBox');

                bindEventsToUI();
        };

        /**
         * interfaces to public functions
         */
        return {
            init: init,
            updateProductsCount:_updateProductsCount
        };

    }());
})(jQuery);

jQuery(function(){
    try{
        APP.globalNav.init();    
    }catch(e){
        console.log('Error:', e);
    }
    
});

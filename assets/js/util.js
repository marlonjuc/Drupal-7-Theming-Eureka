(function($){
    'use strict';

    var APP = window.APP = window.APP || {};
    var UTIL = window.UTIL = window.UTIL || {};

    //TODO: APP.Util shouldn't exist. All of this below should go inside of UTIL.
    //TODO: replace _isDesktop, _isMobile, _isTablet with real functions that detect the user agent and don't rely in the window's width for determing the type of device. Once this is ready we need to go back and check every single component that uses it and fix it.
    APP.util = (function () {

        var _isiPad = function(){
            return navigator.userAgent.indexOf('iPad')>0;
        };
        var _isDesktop = function(){
            return $(window).width() > 1024;
        };
        var _isMobile = function() {
            return $(window).width() < 768;
        };
        var _isTablet = function() {
            return (!_isDesktop() && !_isMobile());
        }

        /**
         * interfaces to public functions
         */
        return {
            isiPad: _isiPad,
            isDesktop: _isDesktop,
            isMobile: _isMobile,
            isTablet: _isTablet
        };

    }());

    Object.defineProperty(UTIL, 'BREAKPOINTS', {
        value: {
            xs_min: 320,
            sm_min: 768,
            md_min: 1025,
            lg_min: 1200
        },
        writable: false,
        enumerable: true,
        configurable: false
    });


    UTIL.media = (function util_match() {

        var THIS = {},
            media_queries = {
                xs: "(min-width: "+ UTIL.BREAKPOINTS.xs_min +"px)",
                sm: "(min-width: "+ UTIL.BREAKPOINTS.sm_min +"px)",
                md: "(min-width: "+ UTIL.BREAKPOINTS.md_min +"px)",
                lg: "(min-width: "+ UTIL.BREAKPOINTS.lg_min +"px)",
                xs_only: "(max-width: "+ (UTIL.BREAKPOINTS.sm_min-1) + "px)",
                sm_only: "(min-width: "+ UTIL.BREAKPOINTS.sm_min +"px) and (max-width: "+ (UTIL.BREAKPOINTS.md_min-1) + "px)",
                md_only: "(min-width: "+ UTIL.BREAKPOINTS.md_min +"px) and (max-width: "+ (UTIL.BREAKPOINTS.lg_min-1) + "px)",
                landscape: "(orientation: landscape)",
                portrait: "(orientation: portrait)"
            };

        var handleQuery = function handle_query(mediaQuery, matchesCallback, doesntMatchCallback){

            if ( mediaQuery.matches ) {
                if(matchesCallback)
                    matchesCallback();
            } else {
                if(doesntMatchCallback)
                    doesntMatchCallback();
            }

        };

        var setUpQuery = function set_up_query(screen_size, matchesCallback, doesntMatchCallback, orientation){

            orientation = orientation || '';

            var size_query = media_queries[screen_size] || '',
                orientation_query = media_queries[orientation] || '',
                query = size_query,
                mediaQuery;

            if(query == ''){

                throw "The screen size provided is not defined";

            } else if(orientation_query != ''){

                query += ' and ' + orientation_query;

            }

            mediaQuery = window.matchMedia(query);

            return mediaQuery;
        };


        THIS.on = function match_on(screen_size, matchesCallback, doesntMatchCallback, orientation){
            //get the match media object
            var mediaQuery = THIS.once(screen_size, matchesCallback, doesntMatchCallback, orientation);

            //listen for future changes
            mediaQuery.addListener( function(){
                handleQuery(mediaQuery, matchesCallback, doesntMatchCallback);
            });
        };


        THIS.once = function match_once(screen_size, matchesCallback, doesntMatchCallback, orientation){
            //get the match media object
            var mediaQuery = setUpQuery(screen_size, matchesCallback, doesntMatchCallback, orientation);
            //execute the query handler
            handleQuery(mediaQuery, matchesCallback, doesntMatchCallback);

            return mediaQuery;
        }

        return THIS;
    })();


    UTIL.getOrdinalDateSuffix_of = function (i) {
        var j = i % 10,
            k = i % 100;
        if (j == 1 && k != 11) {
            return i + "st";
        }
        if (j == 2 && k != 12) {
            return i + "nd";
        }
        if (j == 3 && k != 13) {
            return i + "rd";
        }
        return i + "th";
    };

    UTIL.getMonthName = function (month) {
        var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
        return months[month];
    };

    //PubSub implementation
    Drupal.behaviors.events = (function(){
      var topics = {};
      var hOP = topics.hasOwnProperty;

      return {
        subscribe: function(topic, listener) {
          // Create the topic's object if not yet created
          if(!hOP.call(topics, topic)) topics[topic] = [];

          // Add the listener to queue
          var index = topics[topic].push(listener) -1;

          // Provide handle back for removal of topic
          return {
            remove: function() {
              delete topics[topic][index];
            }
          };
        },
        emit: function(topic, info) {
          // If the topic doesn't exist, or there's no listeners in queue, just leave
          if(!hOP.call(topics, topic)) return;

          // Cycle through topics queue, fire!
          topics[topic].forEach(function(item) {
            item(info != undefined ? info : {});
          });
        }
      };
    })();

    UTIL.tooltip = (function(){

        var buttonClose = '.tooltip-close';

        var _open = function(selector){
            if(!UTIL.isMobile.any){
                selector.tooltip({
                    trigger:'manual',
                    template:'<div class="tooltip" role="tooltip"><a href="#" class="tooltip-close">X</a><div class="tooltip-bg"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                }).on('mouseover mouseleave', function(e){
                    $(this).tooltip('toggle');
                    e.stopPropagation();
                });
            }else{
                selector.tooltip({
                    trigger:'manual',
                    template:'<div class="tooltip" role="tooltip"><a href="#" class="tooltip-close">X</a><div class="tooltip-bg"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                }).on('click', function(e){
                    $(this).tooltip('toggle');
                    e.stopPropagation();
                });
            }
        };

        var _bindEvents = function(context,selector){
            //Close tooltip
            context.on('click',buttonClose,function(e){
                e.preventDefault();
                selector.tooltip('hide');
            });

            //Close tooltip on media match to avoid issues
            UTIL.media.on('md',function(){
                selector.tooltip('hide');
            },function(){
                selector.tooltip('hide');
            });
        };

        var _init = function(context,selector){
            var selector = context.find(selector);
            _open(selector);
            _bindEvents(context,selector);
        };

        return {
            init:_init
        }
    })();

    UTIL.loader = (function() {
        var THIS = {};

        THIS.show = function() {
            $('.global-loader').show();
        };

        THIS.hide = function(){
            $('.global-loader').hide();
        };
        return THIS;
    }());

    //Request animation
    window.requestAnimFrame = (function(){
        return  window.requestAnimationFrame       ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame    ||
                window.oRequestAnimationFrame      ||
                window.msRequestAnimationFrame     ||
                function( callback ){
                    window.setTimeout(callback, 1000 / 60);
                };
    })();

//UTIL.isMobile implementation
!function(a){var b=/iPhone/i,c=/iPod/i,d=/iPad/i,e=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,f=/Android/i,g=/(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,h=/(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,i=/IEMobile/i,j=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,k=/BlackBerry/i,l=/BB10/i,m=/Opera Mini/i,n=/(CriOS|Chrome)(?=.*\bMobile\b)/i,o=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,p=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),q=function(a,b){return a.test(b)},r=function(a){var r=a||navigator.userAgent,s=r.split("[FBAN");return"undefined"!=typeof s[1]&&(r=s[0]),this.apple={phone:q(b,r),ipod:q(c,r),tablet:!q(b,r)&&q(d,r),device:q(b,r)||q(c,r)||q(d,r)},this.amazon={phone:q(g,r),tablet:!q(g,r)&&q(h,r),device:q(g,r)||q(h,r)},this.android={phone:q(g,r)||q(e,r),tablet:!q(g,r)&&!q(e,r)&&(q(h,r)||q(f,r)),device:q(g,r)||q(h,r)||q(e,r)||q(f,r)},this.windows={phone:q(i,r),tablet:q(j,r),device:q(i,r)||q(j,r)},this.other={blackberry:q(k,r),blackberry10:q(l,r),opera:q(m,r),firefox:q(o,r),chrome:q(n,r),device:q(k,r)||q(l,r)||q(m,r)||q(o,r)||q(n,r)},this.seven_inch=q(p,r),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},s=function(){var a=new r;return a.Class=r,a};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=r:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=s():"function"==typeof define&&define.amd?define("isMobile",[],a.isMobile=s()):a.isMobile=s()}(UTIL);

})(jQuery);
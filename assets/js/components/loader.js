( function($) {
    'use strict';

    Drupal.behaviors.loader = (function(){
        var _attach = function(context, settings){
            $( document ).ajaxStart(function() {
                UTIL.loader.show();
            }).ajaxStop(function() {
                UTIL.loader.hide();
            });
        };

        return {
            attach: _attach
        };
    })();

})(jQuery);
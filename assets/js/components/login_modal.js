(function($){

    var APP = window.APP = window.APP || {};

    APP.loginModal = (function () {
        'use strict';

        function loginModal($modal){
            this.$el = $modal;
            return this;
        }

        loginModal.prototype.show = function(){
            this.$el.modal('show');
            return this;
        };

        var show = function () {
            (new loginModal($('#login-modal'))).show();
        };

        return {
            show: show
        };

    }());

})(jQuery);

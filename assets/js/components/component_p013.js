//Related products component
(function($){
    'use strict';

    var APP = window.APP = window.APP || {};

    APP.viewP013 = (function () {

        var $sections = "";

        function CartSummary($section){
            this.$el = $section;
            return this;
        }

        CartSummary.prototype.init = function(){

           this.zip = "00000";

            if(this.$el.length > 0) {
                this.bindEventsToUI();
            }

            return this;
            
        };

        CartSummary.prototype.isValidUSZip = function(){
		    return /^\d{5}(-\d{4})?$/.test(this.zip);
		};
        

        CartSummary.prototype.bindEventsToUI = function(){
            var obj = this;
			var $section = obj.$el;

			$section.find(".items-list .plus").on("click", function(){
				var $this = $(this);
				$this.parent().find(".detail-box").slideToggle();
                $this.toggleClass("open");
			});

            $section.find("#update_zip").on("click", function(){
				var $this = $(this);
				obj.zip = $section.find("#zipcode").val();
                if (!obj.isValidUSZip()){
                    $this.parent().find(".error").remove();
                    $this.after("<p class='error'>Invalid zip code</p>");
                }else{
                    $this.parent().find(".error").remove();
                }
			});    

            $section.find("#update_promocode").on("click", function(){
				var $this = $(this);
				var promo = $section.find("#promocode").val();
                if (promo.length < 1){
                    $this.parent().find(".error").remove();
                    $this.after("<p class='error'>Invalid code</p>");
                }else{
                    $this.parent().find(".error").remove();
                }
			});

			return obj;

        };

        		

        var _main = function(i, section){
            (new CartSummary( $(section) )).init();
        };

        var _init = function () {
            $sections = $(".add-to-cart--summary");
            $sections.each(_main);
        };

        return {
            init: _init
        };

    }());
})(jQuery);


jQuery(function(){
    APP.viewP013.init();
});

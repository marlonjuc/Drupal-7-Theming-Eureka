//Related products component
(function($){
    'use strict';

    var APP = window.APP = window.APP || {};

    APP.viewP008 = (function () {

        var $sections = "";

        function RelatedProducts($section){
            this.$el = $section;
            return this;
        }

        RelatedProducts.prototype.init = function(){
            

            if(this.$el.length > 0) {
                this.bindEventsToUI();
                this.addRelatedProductsSeparator();
                this.createDesktopView();
                this.initRelatedProductsSlickSlider();
            }

            return this;
            
        };

        RelatedProducts.prototype.bindEventsToUI = function(){

        };

        RelatedProducts.prototype.createDesktopView = function(){

            var THIS = this,
                $section = THIS.$el;

            var desktopItems = $section.find(".related-products .slides .views-row").clone();
            $section.find(".desktop-p008 .second").append(desktopItems);
            $section.find(".desktop-p008 .first").append(desktopItems.eq(0));
            desktopItems.last().remove();
            $section.find(".desktop-p008 .views-row").wrap( "<div class='product-tile'></div>" );

        }

        RelatedProducts.prototype.addRelatedProductsSeparator = function(){ 

            var THIS = this,
                $section = THIS.$el;

            $section.find("h2").after("<span class='h2-separator'></span>");

        };


        RelatedProducts.prototype.initRelatedProductsSlickSlider = function(){ 

            var THIS = this,
                $section = THIS.$el;

            $section.find('.related-products .slides').on('init', function(event, slick){
                $(this).animate({
                    opacity: 1
                    }, 700, function() {
                    // Animation complete.
                });
            });

            $section.find('.related-products .slides').slick({
                dots: false,
                slidesToShow: 3,
                infinite: false,
                slidesToScroll: 1,
                arrows: false,
                    responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                        slidesToShow: 2.5,
                        slidesToScroll: 1,
                        infinite: false,
                        dots: true
                    }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2.5,
                            slidesToScroll: 1,
                            infinite: false
                    }
                    },
                    {
                    breakpoint: 480,
                        settings: {
                        slidesToShow: 1.5,
                        slidesToScroll: 1,
                        infinite: false,
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
                ]
            });
        };


        var _main = function(i, section){
            (new RelatedProducts( $(section) )).init();
        };

        var _init = function () {
            $sections = $(".view-component-p008");
            $sections.each(_main);
        };

        return {
            init: _init
        };

    }());
})(jQuery);


jQuery(function(){
    APP.viewP008.init();
});

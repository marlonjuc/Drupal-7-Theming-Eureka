//Accessories component
(function($){

    'use strict';

    Drupal.behaviors.viewP007 = (function(){
        
        var _attach = function(context, settings){
            $('.view-component-p007', context)
                .once()
                .each(function(i, section){
                    var $section = $(section);
                    ( new ViewP007($section) ).init();
                });
        };

        return {
            attach: _attach
        };
    })();

    function ViewP007($el){
        this.$el = $el;
        return this;
    }

    ViewP007.prototype.init = function(){
        this
            .addAccessoriesSeparator()
            .initAccessoriesSlickSlider();
    };

    ViewP007.prototype.addAccessoriesSeparator = function () {
        this.$el
            .find("h2")
            .after($("<span class='h2-separator'></span>"));

        return this;
    };

    ViewP007.prototype.initAccessoriesSlickSlider = function() {

        this.$el
            .find('.accessories .slides')
            .on('init', function(event, slick){
                $(this).animate({
                    opacity: 1
                    }, 700, function() {
                    // Animation complete.
                });
            })
            .slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                nextArrow: '<a class="accessories-next"></a>',
                prevArrow: '<a class="accessories-prev"></a>',
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
                ]
            });
        return this;
    };

})(jQuery);
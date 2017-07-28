// product specifications component
(function($){
    
    Drupal.behaviors.p005 = (function(){

        var _attach = function(context, settings) {
            $(".p005-container", context)
                .once()
                .each(function(i, section){
                    (new TechnicalSpecifications( $(section) )).init();
                });
        };

        return {
            attach: _attach
        };

    })();

    
    function TechnicalSpecifications($section){
        this.$el = $section;
        return this;
    }

    TechnicalSpecifications.prototype.init = function(){
        this
            .setUpTabs()
            .setUpShowMoreLess();

        return this;
    };

    TechnicalSpecifications.prototype.setUpTabs = function(){
        var THIS = this,
            $section = THIS.$el;

        //hide default tab and add active state default button
        $section
            .find(".tab .materials-container")
            .hide();

        $section
            .find(".tab-button .title-tab[data-tab='details-container']")
            .addClass("active");

        $section
            .find(".tab-button .title-tab")
            .each(function() {
                var $this = $(this);
                $this.on("click", function () {
                    if( !$this.hasClass("active") ) {
                        var tabToShow = $this.attr("data-tab");
                        THIS.hideAllTabs();

                        setTimeout(function(){
                            $section.find(".tab." + tabToShow).fadeIn(250);
                        }, 250);

                        THIS.resetTabTitles();
                        $this.addClass("active");
                        THIS.moveTabSeparator(tabToShow);
                    }
                });
            });

        return THIS;
    };

    TechnicalSpecifications.prototype.moveTabSeparator = function(who) {
        var positionX = (who === "materials-container")?"50%":0;
        
        this
            .$el
            .find(".separator-active").animate({
                left: positionX,
            }, 300 );

        return this;
    };

    TechnicalSpecifications.prototype.resetTabTitles = function() {
        this
            .$el
            .find(".tab-button .title-tab")
            .each(function() {
                $(this).removeClass("active");
            });
        return this;
    };

    TechnicalSpecifications.prototype.hideAllTabs = function() {
        this
            .$el
            .find(".tab")
            .each(function() {
                $(this).fadeOut(250);
            });
        return this;
    };

    TechnicalSpecifications.prototype.setUpShowMoreLess = function (){
        this
            .$el
            .find('.show-more-link')
            .on('click', function(e){
                e.preventDefault();
                var $this = $(this);

                $this
                    .toggleClass('open',function(){
                        var rows = $this.closest('.tab').find('.hidden-row');

                        if($this.hasClass('open')){
                            $this.html($this.attr('data-less-text'));
                            rows.show();
                        }else{
                            $this.html($this.attr('data-more-text'));
                            rows.hide();
                        }
                    });
            });

        return this;
    };
})(jQuery);
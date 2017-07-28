(function($){
    
    Drupal.behaviors.newsletterModal = (function(){
        var newsletterModal;

        var _attach = function(context, settings) {
            $("#newsletter-modal", context)
                .once()
                .each(function(i, modal){  
                    newsletterModal = (new NewsletterModal( $(modal) ));
                });
        };

        var _open = function(){
            newsletterModal.showModal();
        };

        return {
            attach: _attach,
            open: _open
        };

    })();
    
    function NewsletterModal($modal){
        this.$el = $modal;
        this.firstTime = true;
        return this;
    }

    NewsletterModal.prototype.showModal = function() {

        /*
        if( this.firstTime ) {
            this.$el
                .find("iframe")
                .height("450px");
        }
        */
        

        this.$el.modal();

        this.firstTime = false;
            
        return this;
    };
    
})(jQuery);
(function($){
  'use strict';

  Drupal.behaviors.faqs = (function(){
    var _attach = function (context, settings) {
      $( '.component-c013', context )
        .once()
        .each( function(i, faqs){
          (new FAQS( $(faqs) ) ).init();
      });
    };

    return {
      attach: _attach
    };

  })();

  //ProductTile definition
  function FAQS($el){
      this.$el = $el;
      return this;
  }

  //initialization process
  FAQS.prototype.init = function(){
      return this
              .initFAQs()
              .onResize();
  }

    //initialize Questions and Answers expending behavior
    FAQS.prototype.initFAQs = function () {
      var faqs = this.$el;
      var faqsList = faqs.find( "ul.faqs-list" );
      this.closeFAQs();
      faqsList.find( "li" ).each(function() {
          var question = $( this ).find("a.question");
           question.on("click tap",function () {
                if($( this).parent().attr("expanded") == "true") {
                    $( this).parent().attr("expanded", "false");
                    $( this).parent().animate({
                        height: $( this).parent().attr("question-height")
                    }, 300, function() {
                        // Animation complete.
                    });
                    $( this).find("span").removeClass("expanded");
                } else {
                    $( this).parent().attr("expanded", "true");
                    $( this).parent().animate({
                        height: $( this).parent().attr("full-height")
                    }, 300, function() {
                        // Animation complete.
                    });
                    $( this).find("span").addClass("expanded");
                }
           });
        });
      return this;
      };

      //initialize Questions and Answers expending behavior
      FAQS.prototype.closeFAQs = function () {
          var faqs = this.$el;
          var faqsList = faqs.find( "ul.faqs-list" );
          faqsList.find( "li" ).css("height", "auto");
          faqsList.find( "li" ).each(function() {
              var question = $( this ).find("a.question");
              var questionHeight = question.height() + parseInt(question.css("margin-bottom"));
              $( this).attr("expanded", "false");
              $( this).attr("full-height", $( this ).height() + "px");
              $( this).attr("question-height", questionHeight + "px");
              $( this ).height(questionHeight);
              $( this).find(" a span").removeClass("expanded");
          });
      };

      //onResize close FAQS calculates height for expanding
      FAQS.prototype.onResize = function () {
          var THIS = this;
           $(window).resize(function() {
               THIS.closeFAQs();
           });
      };


})(jQuery);

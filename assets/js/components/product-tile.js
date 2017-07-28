(function($){
  'use strict';

  var MAX_COMPARE_ITEMS = 2;

  (function () {

      UTIL.media.once('sm_only', function(){
         MAX_COMPARE_ITEMS = 3;
      });

      UTIL.media.once('md', function(){
         MAX_COMPARE_ITEMS = 4;
      });

   })();

   //disable all Checkbox per Maximun products Selected reached
   var disableAllCheckBoxes = function () {
       $(".product-tile").each( function(){
           var $checkbox = $(this).find("input:checkbox");
           if(!$checkbox.prop("checked"))
           {
               $checkbox.prop("disabled", true);
           }
    });
   };

   //enable all Checkbox per Maximun products Selected left
   var enableAllCheckBoxes = function () {
       $(".product-tile").each( function(){
           var $checkbox = $(this).find("input:checkbox");
           $checkbox.prop("disabled", false);
     });
   };





  Drupal.behaviors.productTile = (function(){
    var _attach = function (context, settings) {
      $( '.product-tile', context )
        .once()
        .each( function(i, productTile){
          (new ProductTile( $(productTile) ) ).init();
        });
        if(Drupal.settings.compare != undefined) {
            Drupal.behaviors.events.emit("compare-count-loaded", Drupal.settings.compare.count);
        }
    };

    return {
      attach: _attach
    };

  })();

  //ProductTile definition
  function ProductTile($el){
      this.$el = $el;
      return this;
  }

  //initialization process
  ProductTile.prototype.init = function(){
      return this
              .addProductRating()
              .validateNewProduct()
              .validateColors()
              .addDrupalEventListener()
              .animateOnLoad()
              .validateOffer()
              .listenForSelectionOnLoad();
  }

    //validates if this is a new product or not
    ProductTile.prototype.validateNewProduct = function () {
        var $date = this.$el.find(".date"),
        newProduct = $date.text().trim().toUpperCase();
        if(newProduct == "YES" || newProduct == "1")

        $date.show();

        return this;
    };

    //it takes two prices, commerce price and sales price then calculates it's offer procentage
    ProductTile.prototype.validateOffer = function () {
        var $productTile = this.$el;
        var $offer = $productTile.find(".offer"),
            $salePrice = $offer.text().trim();//trim the string, clear blank spaces
            $offer.text("");//clean the div

        if($salePrice != "" && $salePrice.length > 0)
            var $offerPercent = Math.floor($salePrice);
            $offer.attr('data-after', $offerPercent + "% off");//updated the pseudo css after content
          //$offer.show();
          //TODO validates if offers and if New tag product, then hide New Tag Product

        return this;
    };

  //validates if this is a new product or not
  ProductTile.prototype.validateColors = function () {
      var $productTile = this.$el;
      var $colors = $productTile.find(".colors");
      var $widgets = $colors.find(".attribute-widgets");
      var $radioButtonsForm = $widgets.find(".form-radios");
      if($radioButtonsForm.length >= 1) {//The form it's comming=
          var $colors = $radioButtonsForm.find(".form-type-radio");// count how many colors
          if($colors.length == 1){ //there are more than just one
              $widgets.hide();
          }
      }
      return this;
  };

  //add event listener to count selected products on PLP
  ProductTile.prototype.addDrupalEventListener = function () {
      var $productTile = this.$el;
      var THIS = this;

      Drupal.behaviors.events.subscribe("compare-count-changed", function() {
          var $drupalCounter = parseInt(Drupal.settings.compare.count);
          var $content = $productTile.find(">div");
          var $checkbox = $content.find("input:checkbox");
          console.log(" Selected Products : " + $drupalCounter + " " + $content.find(".title").text() + " " + $checkbox.prop("checked"));
          if($checkbox.prop("checked")) {
              THIS.setAsSelected($drupalCounter);
          } else {
              THIS.setAsUnSelected();
          }
      });
      return this;
  };

   ProductTile.prototype.setAsSelected = function ($drupalCounter) {
       var $productTile = this.$el;
       var $content = $productTile.find(">div");
       var $compareNowLink = $content.find(".compare-now-link");
       var $label = $content.find(".check-box label span");
       var $chooseAnother = $content.find(".choose-another");
       $label.text("(" + $drupalCounter + ")");
       $label.css("visibility", "visible");
       $productTile.addClass("product-tile-selected");
       if($drupalCounter >= 2) {// if there are more than two products to compare
           $compareNowLink.css("visibility", "visible");
       } else {
           $compareNowLink.css("visibility", "hidden");
       }
       if($drupalCounter == 1)
       {
           $chooseAnother.show();
       } else {
           $chooseAnother.hide();
       }
       if($drupalCounter == 0) {
           $chooseAnother.hide();
       }
       if($drupalCounter == MAX_COMPARE_ITEMS) {
           disableAllCheckBoxes();
           console.log("- - - - - - - Maximum Number of Products Selected Reached - - - - - - -");
       } else {
           enableAllCheckBoxes();
       }
   };

   ProductTile.prototype.setAsUnSelected = function () {
       var $productTile = this.$el;
       var $content = $productTile.find(">div");
       var $compareNowLink = $content.find(".compare-now-link");
       var $chooseAnother = $content.find(".choose-another");
       $compareNowLink.css("visibility", "hidden");
       $productTile.removeClass("product-tile-selected");
       $chooseAnother.hide();
   };

   ProductTile.prototype.listenForSelectionOnLoad = function () {
        var $productTile = this.$el;
        var THIS = this;
        Drupal.behaviors.events.subscribe("compare-count-loaded", function() {
            var $checkbox = $productTile.find(">div .compare-check-box input:checkbox");
            console.log("Onload Currently Number of Selected CheckBoxes: " + Drupal.settings.compare.count);
            if($checkbox.prop("checked")) {
                 THIS.setAsSelected(Drupal.settings.compare.count);
            };
        });

   };

  //Animates Product Tile when Load
  ProductTile.prototype.animateOnLoad = function () {
      var $productTile = this.$el;
      var $productTileParent = $productTile.parent();
      var $productTileIndexPosition = $productTileParent.index();
      var $productTileTiming = $productTileIndexPosition * 500;
      //console.log("Product Tile Index Position: " + $productTileIndexPosition + " Animate In: " + $productTileTiming + " milliseconds");
     /* setTimeout(function() {
          $productTile.addClass("onload")
      }, $productTileTiming);*/
      $productTile.addClass("onload");
      return this;
  };

  //sets the stars rating for every product tile
  ProductTile.prototype.addProductRating = function () {
      var $productTile = this.$el,
          starSize = "14px",
          starFillColor = "#BCD647",
          $productRatingStars = $productTile.find(".rating-stars"),
          $productRatingStarsSvg,
          setStarsLook = function() {
            $productRatingStarsSvg.css({ "width": starSize });
            $productRatingStarsSvg.css({ "height": starSize });
          };

      UTIL
        .media
        .once('md', function(){
            starSize = "16px";
          },function(){
            starSize = "12px";
          });

      var ratingValue = parseFloat($productRatingStars.text());
      $productRatingStars
          .rateYo({
              rating: ratingValue,
              ratedFill: starFillColor,
              normalFill: "#FFFFFF",
              starWidth: starSize,
              spacing: "5px",
              readOnly: true
          });

      $productRatingStarsSvg = $productRatingStars.find("svg");
      $productRatingStarsSvg.find("polygon").css({ "stroke-width": "5" });

      UTIL
        .media
        .on('md', function(){
            starSize = "16px";
            setStarsLook();
          },function(){
            starSize = "12px";
            setStarsLook();
          });

      return this;
  };

})(jQuery);

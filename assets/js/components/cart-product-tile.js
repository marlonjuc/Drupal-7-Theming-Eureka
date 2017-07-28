(function($){
  'use strict';

  Drupal.behaviors.cartProductTile = (function(){
    var _attach = function (context, settings) {
      $( '.cart-product-tile', context )
        .once()
        .each( function(i, cartProductTile){
          (new CartProductTile( $(cartProductTile) ) ).init();
        });
    };

    return {
      attach: _attach
    };

  })();

  //ProductTile definition
  function CartProductTile($el){
      this.$el = $el;
      return this;
  }

  //initialization process
  CartProductTile.prototype.init = function(){
      return this
              .initOrderShipping()
              .activateChangeLink();
  }

    //initialize Shipping providers of products in orders, set plugin
    /*
    * http://selectric.js.org/
    */
    CartProductTile.prototype.initOrderShipping = function () {
      var cartProductTile = this.$el;
      var shippingDropDown = cartProductTile.find(".dropdown-shipping");
      var shippingSelect = shippingDropDown.find("select");
          //$(function(){
              shippingSelect.selectric({
                  disableOnMobile: false,
                  optionsItemBuilder: function(itemData, element, index) {
                      return itemData.text + "<span>" + element.val() + "</span>";
                  }
              });
          //});
      return this;
      };

      CartProductTile.prototype.activateChangeLink = function () {
          var cartProductTile = this.$el;
          var changeLink = cartProductTile.find("a.change");
          var select = cartProductTile.find(".dropdown-quantity .selectric-wrapper");
          var Selectric = $('.dropdown-quantityselect').data('selectric');
          changeLink.click(function() {
              //Selectric.open();
              select.toggleClass('selectric-open');
          });
      };

})(jQuery);

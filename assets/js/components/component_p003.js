( function($) {
    'use strict';

    var APP = window.APP = window.APP || {};

    APP.p003 = (function () {

        var $p003,
            $header,
            isDesktop,
            $pageBody,
            $sliderInit = false,
            $pdpModalMobile;


        var modifyDOM = {
            addToCartForm: '',
            addToCartSubmit: '',
            btnAddToCartPlaceholder: '',


            init: function() {
                // Class added to animate thumbs on desktop
                if(isDesktop) {
                    $('.pdp-carousel__drupal--placeholder').addClass('pdp-carousel-wrapper');
                }
            }
        }
        var manageZoomDesktop = {

            zoomEnabled: false,
            zoomSpeed: 300, // ms
            maxZoom: '90vw', // max zoom on Desktop modal
            animationSpeed: 300, // ms
            animatedRightPanelOffSet: [],
            animatedLeftPanelOffSet: [],
            animatedOffSetTop: '30', // This is the space between top and animation limit
            imgContainerWidth: '',
            zoomed: false,  // if the image is already zoomed in

            getZoomableArea: function() {
                return $p003.find('.pdp-carousel-display img');
            },
            openModal: function() {
                $p003.find('.pdp-modal__desktop').addClass('pdp-modal__desktop--open');
                $pageBody.addClass('pdp-modal__open');
                this.zoomEnabled = true;
                this.animateMe();
                $pageBody.css('overflow','hidden');
            },
            closeModal: function() {

                setTimeout(function(){
                    $pageBody.removeClass('pdp-modal__open');
                    $p003.find('.pdp-modal__desktop').removeClass('pdp-modal__desktop--open');
                    $pageBody.css('overflow','visible');
                    $pageBody.css('overflow-x','hidden');
                    manageCarousel.updateDisplay();
                },90);
                this.zoomEnabled = false;
                this.zoomed = false;
                this.animateMe();
            },
            animateMe: function() {
                var $leftPanel = $p003.find('.pdp-head-container'),
                    $rightPanel = $p003.find('.pdp-carousel__zoom--wrapper');

                if(this.zoomEnabled) { // opening
                    $leftPanel.addClass('panel-open');
                    $rightPanel.addClass('panel-open');
                    setTimeout(function(){
                        $leftPanel.addClass('animate');
                        $rightPanel.addClass('animate');
                    },100);
                }else { // closing
                    $leftPanel.removeClass('animate');
                    $rightPanel.removeClass('animate');
                    setTimeout(function(){
                        $leftPanel.removeClass('panel-open');
                        $rightPanel.removeClass('panel-open');
                    },100);
                }
            },
            zoomMeIn: function(event) {
                if(this.zoomEnabled && !this.zoomed) {
                    this.imgContainerWidth  = this.getZoomableArea().width();
                    this.getZoomableArea().animate({
                        width: this.maxZoom,
                        top: '0px'
                    },this.zoomSpeed);
                    //  Enable image drag
                    $p003.find('.pdp-carousel-display img').draggabilly();
                    $p003.find('.pdp-carousel-display img').draggabilly('enable');
                    this.zoomed = true;
                }
            },
            zoomMeOut: function() {
                if(this.zoomEnabled && this.zoomed) {
                    this.getZoomableArea().animate({
                        width: this.imgContainerWidth,
                        top: '150px',
                        left: '0px'
                    },this.zoomSpeed);
                    // Disable img drag
                    $p003.find('.pdp-carousel-display img').draggabilly();
                    $p003.find('.pdp-carousel-display img').draggabilly('disable');
                    this.zoomed = false;
                }
            },
            eventsBind: function(){
                var that = this;
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) that.closeModal();
                });


            },
            init: function() {
                this.eventsBind();
                this.openModal();
            }
        };
        var manageZoomMobileModal = {

            currentPinch: 0, // used to cach the pinch scale on zoom for mobile & tablet.
            mobileModalZoomSpeed: 20,
            imgMinWidth: '', // defautl img width
            imgMaxWidthScale: 2,  // Max zoom based on default width

            zoomMe: function() {
                var image       = $p003.find('#pdp-modal__mobile .modal-body img');
                var container   = $p003.find('#pdp-modal__mobile .modal-body');
                var imageWidth  = image.width();
                var newWidth,top,left;
                if(event.scale > this.currentPinch){ // zoom out
                    if(imageWidth < (this.imgMinWidth  * this.imgMaxWidthScale) ) {
                        newWidth    = imageWidth + this.mobileModalZoomSpeed;
                        top         = parseInt(container.css('top')) - (this.mobileModalZoomSpeed/4);
                        left        = parseInt(container.css('left')) - (this.mobileModalZoomSpeed/2);
                    }
                    
                } else { //zomm in
                    if(imageWidth > this.imgMinWidth) {
                        newWidth    = imageWidth - this.mobileModalZoomSpeed;
                        top         = parseInt(container.css('top')) + (this.mobileModalZoomSpeed/4);
                        left        = parseInt(container.css('left')) + (this.mobileModalZoomSpeed/2);
                    }
                } 
                image.width(newWidth);
                container.css('top',top);
                container.css('left',left);
                this.currentPinch = event.scale;
            },
            updateModalMobileDisplay: function() {
                $p003.find('#pdp-modal__mobile .modal-body').css('top','0px');
                $p003.find('#pdp-modal__mobile .modal-body').css('left','0px');
                var selectedImageURL = $p003.find('#pdp-modal__mobile .modal-footer .slick-current').clone().attr('src');
                $p003.find('#pdp-modal__mobile .modal-body').html('').append('<img src="'+selectedImageURL+'">'); 
                var img = $p003.find('#pdp-modal__mobile .modal-body img');
                img.draggabilly();
                this.imgMinWidth = img.width();
                console.log(this.imgMinWidth);
            }
        };
        var manageCarousel = {
            /*  This needs to be cached every time the Drupal-ajax call is performed
            |   when updating the colors due to DOM re-creation
            */
            getDrupalImagesClone: function() {
                // Clone the images
                var $clonedImgs = $('.pdp-carousel__drupal--placeholder')
                                    .find('.commerce-product-field.commerce-product-field-field-image.field-field-image img')
                                    .clone();
                // Clean them
                var whitelist = ["src","alt"];
                $clonedImgs.each(function() {
                    var attributes = this.attributes;
                    var i = attributes.length;
                    while( i-- ) {
                        var attr = attributes[i];
                        if( $.inArray(attr.name,whitelist) == -1 )
                            this.removeAttributeNode(attr);
                    }
                })
                return $clonedImgs;
            },
            initCarousel: function() { // This doesn't need a clone
                var $carouselTrigger = $('.pdp-carousel__drupal--placeholder');
                var $carouselWrapper = $carouselTrigger.find('.commerce-product-field.commerce-product-field-field-image.field-field-image');
                //Check if slick is init to destroy on resize(mobile to desktop, desktop to mobile)
                if($sliderInit){
                    $sliderInit.slick('unslick');
                }
                if(isDesktop){

                    $sliderInit = $carouselWrapper.slick({ // for Desktop
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        dots: false,
                        infinite: false,
                        centerMode: true,
                        focusOnSelect: true,
                        arrows: true,
                        nextArrow: '<span class="slick-next-custom "></span>',
                        prevArrow: '<span class="slick-prev-custom "></span>',
                        vertical: true
                    });
                }else{ // for Mobile & Tablet
                    // clone Carousel to top/display
                    var $carouselMobile = $('.pdp-carousel-wrapper_mobile').html(' ').wrapInner('<div> </div>').find('div');
                    $carouselMobile.append(this.getDrupalImagesClone());
                    // init carousel
                    $sliderInit = $carouselMobile.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        infinite: false,
                        centerMode: false,
                        focusOnSelect: false,
                        arrows: false
                    });
                }
            },
            initCarouselModal: function() { // For Mobile & Tablet
                var $mobileCarouselModal = $p003.find('#pdp-modal__mobile .modal-footer').html(' ').wrapInner('<div class="pdp-modal__mobile--thumbs"> </div>').find('div');
                $mobileCarouselModal.append(this.getDrupalImagesClone());

                $mobileCarouselModal.slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    dots: false,
                    infinite: false,
                    centerMode: false,
                    focusOnSelect: true,
                    arrows: false,
                    vertical: false
                });

                manageZoomMobileModal.updateModalMobileDisplay()
            },
            updateDisplay: function(display, image) {
                var selectedImageURL = $p003.find('.pdp-carousel__drupal--placeholder .slick-current img').clone().attr('src');
                $p003.find('.pdp-carousel-wrapper .pdp-carousel-display').html('').append('<img src="'+selectedImageURL+'">');
            },
            displayModalMobile: function() {
                $pdpModalMobile.modal('show');
            },
            /*  This Events are to be used for elements in the carousel
            |   that are re-created by drupal-ajax call ONLY
            |   For global, use the one out of this scope (bindEventsToUI).
            */
            bindEventsToUICarousel: function() {
                $p003.find('.pdp-carousel__drupal--placeholder').find('.slick-slide').on('click',function() {
                    manageZoomDesktop.zoomMeOut();
                    manageCarousel.updateDisplay();
                });
                $p003.find('.pdp-carousel__drupal--placeholder .slick-prev-custom, .pdp-carousel__drupal--placeholder .slick-next-custom').click(function() {
                    manageCarousel.updateDisplay();
                });
                //
                if(!isDesktop){
                    $p003.find('.pdp-carousel-wrapper img').on('click',function() {
                        manageCarousel.displayModalMobile();
                        $pageBody.removeClass('modal-open');
                    });
                };
                $p003.find('#pdp-modal__mobile .modal-footer').on('click',function() {
                    console.log('updating the modal display');
                    manageZoomMobileModal.updateModalMobileDisplay();                
                });
                var img = document.getElementById('pdp-modal__mobile');
                if(typeof img !== 'undefined' && img !== null) {
                    var hammertime = new Hammer(img);
                    hammertime.get('pinch').set({ enable: true });
                    hammertime.on('pinch', function(event) {
                        $p003.find('#pdp-modal__mobile .modal-body img').draggabilly('disable');
                        manageZoomMobileModal.zoomMe(event);
                    });
                    hammertime.on('pinchend', function() {
                        $p003.find('#pdp-modal__mobile .modal-body img').draggabilly('enable');
                    });
                }
            },
            init: function() {
                this.initCarousel();
                this.updateDisplay();
                this.bindEventsToUICarousel();
            }
        }

        var bindEventsToUI = function () {
            console.log('event');
            /*  This re-creates the carousel on the modal in case the user has selected a new color.
            |   Also, gives it some time for the modal to open and have Slick to display
            |   the carousel with proper height & width.
            */
            $p003.find('#pdp-modal__mobile').on('show.bs.modal', function (e) {
                setTimeout(function(){
                    manageCarousel.initCarouselModal();
              },200);
            });

            $p003.find('.pdp-button__addToCart-placeholder').on('click',function(){
                //$p003.find('form.commerce-add-to-cart').submit();
                $('#edit-submit', $p003)
                    .mousedown();
            });

            $p003.find('.pdp-carousel__zoom--magnify-glass').on('click',function() {
                manageZoomDesktop.init();
            });
            $p003.find('.pdp-carousel__zoom--close').on('click',function() {
                manageZoomDesktop.closeModal();
            });
            // Desktop Zoom
            $p003.find('.pdp-carousel-wrapper .pdp-carousel-display , .pdp-carousel__zoom--wrapper  .pdp-carousel__zoom-in').on('click', function(event){
                console.log('event fire');
                manageZoomDesktop.zoomMeIn();
                event.preventDefault();
            });
            $p003.find('.pdp-carousel__zoom--wrapper .pdp-carousel__zoom-out').on('click', function(event) {
                manageZoomDesktop.zoomMeOut();
                event.preventDefault();
            });

        };

        /*
        * http://rateyo.fundoocode.ninja/
        */
        var initRatingComponent = function () {

            var ratingValue = parseFloat($(".pdp-certlevel").text());

            $(".pdp-certlevel").rateYo({
                rating: ratingValue,
                ratedFill: "#BCD647",
                normalFill: "#FFFFFF",
                starWidth: "13px",
                spacing: "5px"
            });
        };
        /*
        * http://selectric.js.org/
        */
        var initQuantityComponent = function () {
            $(function(){
              $('.pdp-quantity select').selectric({
                  disableOnMobile: false
                });
            });
        };
        var initAnimations = function () {
           $('.product').addClass('animate');
       };
        var init = function () {

            $p003 = $('.pdp-p003'),
            $header = $('.header'),
            $pageBody = $('body'),
            $pdpModalMobile = $p003.find('#pdp-modal__mobile');

            if($p003.length === 0 || $('.pdp-details-container').length === 0) return;

            modifyDOM.addToCartForm = $p003.find('form.commerce-add-to-cart');
            modifyDOM.addToCartSubmit = $p003.find(':submit');
            modifyDOM.btnAddToCartPlaceholder = $p003.find('.pdp-button__addToCart-placeholder');
            modifyDOM.init();

            UTIL.media.on('md',function(){
                $pdpModalMobile.modal('hide');
                isDesktop = true;
                manageCarousel.init();
            },function(){
                manageZoomDesktop.closeModal();
                isDesktop = false;
                manageCarousel.init();
            });

            initRatingComponent();
            initQuantityComponent();
            initAnimations();
            bindEventsToUI();

            Drupal.behaviors.viewP003 = (function(){

                var _attach = function(context, settings){
                    //This will keep an eye on the slider in case the user updates the color
                    if (!$p003.find('.pdp-carousel__drupal--placeholder .commerce-product-field').hasClass('slick-initialized')) {
                        manageCarousel.init();
                    }
                };

                return {
                    attach: _attach
                };
            })();

        };
        /**
         * interfaces to public functions
         */
        return {
            init: init
        };

    }());

})(jQuery);

jQuery(function(){

  APP.p003.init();
});

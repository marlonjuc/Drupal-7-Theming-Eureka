//video player component
(function($){
    'use strict';

    Drupal.behaviors.c001 = (function(){
        var _attach = function(context, settings) {
            $(".c001-container", context)
                .once()
                .each(function(i, section){
                    (new VideoSection( $(section) )).init();
                });
        };

        return {
            attach: _attach
        };

    })();

    function VideoSection($section){
        this.$el = $section;
        this.$videoDisplay = this.$el.find('.c001__video-display');
        this.$videoDisplayHeight = this.$el.find('.c001__video-display').css('height');

        return this;
    }

    VideoSection.prototype.init = function(){
        this.videoHandler();
        this.modifyDom();
        this.bindEventsToUI();

        return this;
    };

    VideoSection.prototype.isMobile = function(){
        if($(window).width() < 768 ){
            return true;
        }else {
            return false;
        }
    };

    VideoSection.prototype.videoHandler = function(){
        var THIS = this,
            $section = THIS.$el;
        
        this.images = $section.find('.c001__video-carousel-images img');
            
        this.currenVideoId = '';
        
        $section.find('.c001__slick-display').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.c001__video-carousel-images'
        });

        var item_length = $section.find('.c001__video-carousel-images > div').length;

        if(item_length > 1) {

            $section.find('.c001__video-carousel-images').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.c001__slick-display',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                nextArrow: '<span class="slick-next-custom "></span>',
                prevArrow: '<span class="slick-prev-custom "></span>',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            arrows: false,
                            slidesToShow: 2.5
                        }
                    }
                ]
            }).on('beforeChange', function(event, slick, currentSlide, nextSlide){
                $('.slick-prev-custom.slick-arrow').show();
                $('.slick-next-custom.slick-arrow').show();
                if (nextSlide==0) {
                    $('.slick-prev-custom.slick-arrow').hide();
                    console.log("desaparece");
                } else if (nextSlide==item_length-1) {
                    $('.slick-next-custom.slick-arrow').hide();
                }
            });
            $('.slick-prev-custom.slick-arrow').hide();

        } else {
            $section.find('.c001__video-carousel-container').hide();
        }

        return this;
    }

    VideoSection.prototype.modifyDom = function(){
        this.loadVideo();
        this.loadPoster();
    }

    VideoSection.prototype.loadVideo = function(){
        var THIS = this,
            $section = THIS.$el;

        var play = play || false;
        var videoId = $section.find('.c001__video-image-wrapper.slick-current').attr('data-video-id');

        this.currenVideoId = videoId;
        $section.find('.c001__video-display').html('');
        $section.find('.c001__video-display').append('<iframe src="https://www.youtube.com/embed/'+ videoId +'" frameborder="0" allowfullscreen></iframe>');

        return this;
    
    }

    VideoSection.prototype.loadPoster = function(){
        var THIS = this,
            $section = THIS.$el;

        var $current = $section.find('.c001__video-image-wrapper.slick-current');
        var imgPoster = $section.find('.c001__video-image-wrapper.slick-current img').attr('src');
        var videoId = $current.attr('data-video-id');
        var title = $current.find('.c001__video-image-caption').text();
        var caption = $current.find('.c001__video-image-description').text();
        var time =    $current.find('.c001__video-image-time').text();

        $section.find('.c001__video-poster').css('background-image','url(' + imgPoster + ')');
        $section.find('.c001__video-poster').show();
        $section.find('.c001__video-display-info').html("");
        $section.find('.c001__video-display-info').append('<span class="c001__video-display-title">' + title + '</span><span class="c001__video-display-caption">' + caption + '</span><span class="c001__video-display-time">' + time + '</span>');
        $section.find('.c001__video-display-info').show();

        return this;
    }

    VideoSection.prototype.playVideo = function(){
        var THIS = this,
            $section = THIS.$el;

        $section.find('.c001__video-display iframe')[0].src += "?autoplay=1";

        return this;
    }


    VideoSection.prototype.updateCarousel = function(item) {

        this.images.removeClass('active');
        item.addClass('active');
        this.loadPoster();
        this.loadVideo();

        return this;        
    }


    VideoSection.prototype.bindEventsToUI = function () {

        var THIS = this,
            $section = THIS.$el;

        $section.find('.c001__video-image-wrapper, .c001__video-carousel-container .slick-arrow').click(function(){
            var img = "";
            img = $section.find('.c001__video-carousel-images img.slick-current');            
            THIS.updateCarousel(img);
        });

        $section.on( "click" , ".c001__video-poster", function() {
            $section.find('.c001__video-poster').fadeOut();
            $section.find('.c001__video-display-info').hide();
            THIS.playVideo();
        });

        return this;

    };

})(jQuery);

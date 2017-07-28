//reviews component
(function($){
    'use strict';

    Drupal.behaviors.p006 = (function(){
        
        var _attach = function(context, settings){
            $('.p006-container', context)
                .once()
                .each(function(i, section){
                    (new ReviewsComponent($(section))).init();
                });
        };

        return{
            attach: _attach
        };
    })();

    function ReviewsComponent($el){
        this.$el = $el;
        return this;
    }

    ReviewsComponent.prototype.init = function(){
        this
            .initRatingReviewsComponent()
            .showUserRatingReview()
            .addShowMore()
            .formatDate()
            .initWayPoint();
        return this;
    };

    
    ReviewsComponent.prototype.initRatingReviewsComponent = function () {
        var $ratingStars = this.$el.find(".rating-stars"),
            ratingValue = parseFloat( $ratingStars.text() ).toFixed(1);

        $ratingStars
            .rateYo({
                rating: ratingValue,
                ratedFill: "#D3D0C2",
                normalFill: "#FFFFFF",
                starWidth: "22px",
                spacing: "5px"
            });

        $ratingStars
            .find("svg polygon")
            .css({ stroke: "#D3D0C2", "stroke-width": "5" });

        return this;
    };


    ReviewsComponent.prototype.showUserRatingReview = function () {
        this
            .$el
            .find(".reviews .product-review")
            .each(function() {
                var $this = $(this),
                    $stars = $this.find(".review-rating"),
                    ratingValue = parseFloat($stars.text()).toFixed(1);
                
                $stars
                    .rateYo({
                        rating: ratingValue,
                        ratedFill: "#BCD647",
                        normalFill: "#FFFFFF",
                        starWidth: "16px",
                        spacing: "5px",
                        readOnly: true
                    });

                $stars
                    .find(".review-rating svg polygon")
                    .css({ "stroke-width": "5" });
            });

        return this;
    };

    /**
    Show more reviews functionality
    **/
    ReviewsComponent.prototype.addShowMore = function () {
        var THIS = this;
        
        THIS
            .$el
            .find('.show-more-link')
            .on('click', function(e){
                e.preventDefault();
                var $this = $(this);
                
                THIS
                    .$el
                    .find(".reviews ul")
                    .toggleClass("open"); //Add or remove "open" class

                if($this.hasClass('open')){ //if element has open class, change text and arrow direction
                    $this.text($this.attr('data-more-text'));
                    $this.toggleClass('open');
                }else{ //if element has open class, change text and arrow direction
                    $this.text($this.attr('data-less-text'));
                    $this.toggleClass('open');
                }
            });

        return this;
    };


    ReviewsComponent.prototype.formatDate = function () {
        this
            .$el
            .find(".reviews .product-review")
            .each(function() {
                var $this = $(this),
                    date = new Date($this.find(".date .date-display-single").attr("content")),
                    day = UTIL.getOrdinalDateSuffix_of(date.getDate()),
                    month =  UTIL.getMonthName(date.getMonth()),
                    year = date.getFullYear(),
                    fullDate = month + " " + day + "," + " " + year,
                    $date = $this.find(".date");

                $date.empty(".date-display-single");
                $date.text(fullDate);
            });

        return this;
    };

    /*
    * http://imakewebthings.com/waypoints/guides/getting-started/
    */
    ReviewsComponent.prototype.initWayPoint = function() {
        var THIS = this,
            isInview = false;
        
        THIS
            .$el
            .waypoint(function() {
                if(!isInview) {
                    THIS.initChartsAnimation();
                    isInview = true;
                }
            },{offset:'20%'});
    };

    ReviewsComponent.prototype.initChartsAnimation = function () {
        this.resetCharts();

        var $p006 = this.$el;

        //Stars divs
        var $rating_stars = [];
        $rating_stars.push($(".rating-total-one-star", $p006));
        $rating_stars.push($(".rating-total-two-stars", $p006));
        $rating_stars.push($(".rating-total-three-stars", $p006));
        $rating_stars.push($(".rating-total-four-stars", $p006));
        $rating_stars.push($(".rating-total-five-stars", $p006));

        //Get total votes
        var totalOfVotes = parseInt($(".total-votes span", $p006).text());

        //Get percents
        var percentFiveStars = (parseInt($rating_stars[4].text()) * 100) / totalOfVotes,
        percentFourStars = (parseInt($rating_stars[3].text()) * 100) / totalOfVotes,
        percentThreeStars = (parseInt($rating_stars[2].text()) * 100) / totalOfVotes,
        percentTwoStars = (parseInt($rating_stars[1].text()) * 100) / totalOfVotes,
        percentOneStar = (parseInt($rating_stars[0].text()) * 100) / totalOfVotes;

        //Assign Value to its parent
        $rating_stars[4].parent().attr("percent", percentFiveStars);
        $rating_stars[3].parent().attr("percent", percentFourStars);
        $rating_stars[2].parent().attr("percent", percentThreeStars);
        $rating_stars[1].parent().attr("percent", percentTwoStars);
        $rating_stars[0].parent().attr("percent", percentOneStar);

        $p006
            .find(".graphics li")
            .each(function() {
                var $this = $(this);
                $this
                    .find(".rating-bar-active")
                    .animate({
                        width: $this.attr("percent") + "%",
                    }, 2000 );
            });

        return this;
    };

    ReviewsComponent.prototype.resetCharts = function () {
        this.
            $el
            .each(function() {
                $(this).attr("percent", "0%");
            });

        this
            .$el
            .find(".rating-bar-active")
            .css("width", 0);

        return this;
    };

})(jQuery);